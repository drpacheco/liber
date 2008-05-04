<?php
/* SVN FILE: $Id$ */
/**
 * Short description for file.
 *
 * Long description for file
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) Tests <https://trac.cakephp.org/wiki/Developement/TestSuite>
 * Copyright 2006-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 *  Licensed under The Open Group Test Suite License
 *  Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2006-2008, Cake Software Foundation, Inc.
 * @link				https://trac.cakephp.org/wiki/Developement/TestSuite CakePHP(tm) Tests
 * @package			cake.tests
 * @subpackage		cake.tests.cases.libs.view.helpers
 * @since			CakePHP(tm) v 1.2.0.4206
 * @version			$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 * @license			http://www.opensource.org/licenses/opengroup.php The Open Group Test Suite License
 */
uses('view'.DS.'helpers'.DS.'app_helper', 'view'.DS.'helper', 'view'.DS.'helpers'.DS.'javascript','view'.DS.'view',
	'view'.DS.'helpers'.DS.'html', 'view'.DS.'helpers'.DS.'form', 'class_registry', 'controller'.DS.'controller');

class TheJsTestController extends Controller {
	var $name = 'TheTest';
	var $uses = null;
}
/**
 * Short description for class.
 *
 * @package    test_suite
 * @subpackage test_suite.cases.libs
 * @since      CakePHP Test Suite v 1.0.0.0
 */
class JavascriptTest extends UnitTestCase {

	function setUp() {
		$this->Javascript = new JavascriptHelper();
		$this->Javascript->Html = new HtmlHelper();
		$this->Javascript->Form = new FormHelper();
		$view =& new View(new TheJsTestController());
		ClassRegistry::addObject('view', $view);
	}

	function testLink() {
		$result = $this->Javascript->link('script.js');
		$expected = '<script type="text/javascript" src="js/script.js"></script>';
		$this->assertEqual($result, $expected);

		$result = $this->Javascript->link('script');
		$expected = '<script type="text/javascript" src="js/script.js"></script>';
		$this->assertEqual($result, $expected);

		$result = $this->Javascript->link('scriptaculous.js?load=effects');
		$expected = '<script type="text/javascript" src="js/scriptaculous.js?load=effects"></script>';
		$this->assertEqual($result, $expected);

		$result = $this->Javascript->link('jquery-1.1.2');
		$expected = '<script type="text/javascript" src="js/jquery-1.1.2.js"></script>';
		$this->assertEqual($result, $expected);

		$result = $this->Javascript->link('jquery-1.1.2');
		$expected = '<script type="text/javascript" src="js/jquery-1.1.2.js"></script>';
		$this->assertEqual($result, $expected);

		$result = $this->Javascript->link('/plugin/js/jquery-1.1.2');
		$expected = '<script type="text/javascript" src="/plugin/js/jquery-1.1.2.js"></script>';
		$this->assertEqual($result, $expected);

		$result = $this->Javascript->link('/some_other_path/myfile.1.2.2.min.js');
		$expected = '<script type="text/javascript" src="/some_other_path/myfile.1.2.2.min.js"></script>';
		$this->assertEqual($result, $expected);

		$result = $this->Javascript->link('some_other_path/myfile.1.2.2.min.js');
		$expected = '<script type="text/javascript" src="js/some_other_path/myfile.1.2.2.min.js"></script>';
		$this->assertEqual($result, $expected);

		$result = $this->Javascript->link('some_other_path/myfile.1.2.2.min');
		$expected = '<script type="text/javascript" src="js/some_other_path/myfile.1.2.2.min.js"></script>';
		$this->assertEqual($result, $expected);
	}

	function testFilteringAndTimestamping() {
		if (!is_writable(JS)) {
			echo "<br />JavaScript directory not writable, skipping JS asset timestamp tests<br />";
			return;
		}

		cache(str_replace(WWW_ROOT, '', JS) . '__cake_js_test.js', 'alert("test")', '+999 days', 'public');
		$timestamp = substr(strtotime('now'), 0, 8);

		Configure::write('Asset.timestamp', true);
		$result = $this->Javascript->link('__cake_js_test');
		$this->assertPattern('/^<script[^<>]+src=".*js\/__cake_js_test.js\?' . $timestamp . '[0-9]{2}"[^<>]*>/', $result);

		$debug = Configure::read('debug');
		Configure::write('debug', 0);
		$result = $this->Javascript->link('__cake_js_test');
		$expected = '<script type="text/javascript" src="js/__cake_js_test.js"></script>';
		$this->assertEqual($result, $expected);

		Configure::write('Asset.timestamp', 'force');
		$result = $this->Javascript->link('__cake_js_test');
		$this->assertPattern('/^<script[^<>]+src=".*js\/__cake_js_test.js\?' . $timestamp . '[0-9]{2}"[^<>]*>/', $result);

		Configure::write('debug', $debug);
		Configure::write('Asset.timestamp', false);

		Configure::write('Asset.filter.js', 'js.php');
		$result = $this->Javascript->link('__cake_js_test');
		$this->assertPattern('/^<script[^<>]+src=".*cjs\/__cake_js_test.js"[^<>]*>/', $result);
		Configure::write('Asset.filter.js', false);

		unlink(JS . '__cake_js_test.js');
	}

	function testObjectGeneration() {
		$object = array('title' => 'New thing', 'indexes' => array(5, 6, 7, 8));

		$result = $this->Javascript->object($object);
		$expected = '{"title":"New thing","indexes":[5,6,7,8]}';
		$this->assertEqual($result, $expected);

		$result = $this->Javascript->object(array('default' => 0));
		$expected = '{"default":0}';
		$this->assertEqual($result, $expected);

		$result = $this->Javascript->object(array(
			'2007' => array(
				'Spring' => array('1' => array('id' => 1, 'name' => 'Josh'), '2' => array('id' => 2, 'name' => 'Becky')),
				'Fall' => array('1' => array('id' => 1, 'name' => 'Josh'), '2' => array('id' => 2, 'name' => 'Becky'))
			), '2006' => array(
				'Spring' => array('1' => array('id' => 1, 'name' => 'Josh'), '2' => array('id' => 2, 'name' => 'Becky')),
				'Fall' => array('1' => array('id' => 1, 'name' => 'Josh'), '2' => array('id' => 2, 'name' => 'Becky')
			))
		));
		$expected = '{"2007":{"Spring":{"1":{"id":1,"name":"Josh"},"2":{"id":2,"name":"Becky"}},"Fall":{"1":{"id":1,"name":"Josh"},"2":{"id":2,"name":"Becky"}}},"2006":{"Spring":{"1":{"id":1,"name":"Josh"},"2":{"id":2,"name":"Becky"}},"Fall":{"1":{"id":1,"name":"Josh"},"2":{"id":2,"name":"Becky"}}}}';
		$this->assertEqual($result, $expected);

		$result = $this->Javascript->object(array('Object' => array(true, false, 1, '02101', 0, -1, 3.141592653589, "1")));
		$expected = '{"Object":[true,false,1,"02101",0,-1,3.14159265359,"1"]}';
		$this->assertEqual($result, $expected);

		$result = $this->Javascript->object(array('Object' => array(true => true, false, -3.141592653589, -10)));
		$expected = '{"Object":{"1":true,"2":false,"3":-3.14159265359,"4":-10}}';
		$this->assertEqual($result, $expected);

		if ($this->Javascript->useNative) {
			$this->Javascript->useNative = false;
			$this->testObjectGeneration();
			$this->Javascript->useNative = true;
		}
	}

	function testScriptBlock() {
		$result = $this->Javascript->codeBlock('something', true, false);
		$this->assertPattern('/^<script[^<>]+>something<\/script>$/', $result);
		$this->assertPattern('/^<script[^<>]+type="text\/javascript">something<\/script>$/', $result);
		$this->assertPattern('/^<script[^<>]+type="text\/javascript"[^<>]*>/', $result);
		$this->assertNoPattern('/^<script[^type]=[^<>]*>/', $result);

		$result = $this->Javascript->codeBlock('something', array('safe' => false));
		$this->assertPattern('/^<script[^<>]+>something<\/script>$/', $result);
		$this->assertPattern('/^<script[^<>]+type="text\/javascript">something<\/script>$/', $result);
		$this->assertPattern('/^<script[^<>]+type="text\/javascript"[^<>]*>/', $result);
		$this->assertNoPattern('/^<script[^type]=[^<>]*>/', $result);

		$result = $this->Javascript->codeBlock('something');
		$this->assertPattern('/^<script[^<>]+>\s*' . str_replace('/', '\\/', preg_quote('//<![CDATA[')) . '\s*something\s*' . str_replace('/', '\\/', preg_quote('//]]>')) . '\s*<\/script>$/', $result);
		$this->assertPattern('/^<script[^<>]+type="text\/javascript">.+<\/script>$/s', $result);
		$this->assertPattern('/^<script[^<>]+type="text\/javascript"[^<>]*>/', $result);
		$this->assertNoPattern('/^<script[^type]=[^<>]*>/', $result);

		$result = $this->Javascript->codeBlock();
		$this->assertPattern('/^<script[^<>]+>$/', $result);
		$this->assertNoPattern('/^<script[^type]=[^<>]*>/', $result);

		$result = $this->Javascript->blockEnd();
		$this->assertEqual("</script>", $result);

		$this->Javascript->cacheEvents(false, true);
		$this->assertFalse($this->Javascript->inBlock);
		$result = $this->Javascript->codeBlock();
		$this->assertIdentical($result, null);
		$this->assertTrue($this->Javascript->inBlock);
		echo 'alert("this is a buffered script");';

		$result = $this->Javascript->blockEnd();
		$this->assertIdentical($result, null);
		$this->assertFalse($this->Javascript->inBlock);

		$result = $this->Javascript->getCache();
		$this->assertEqual('alert("this is a buffered script");', $result);
	}

	function testOutOfLineScriptWriting() {
		echo $this->Javascript->codeBlock('$(document).ready(function() { /* ... */ });', array('inline' => false));

		$this->Javascript->codeBlock(null, array('inline' => false));
		echo '$(function(){ /* ... */ });';
		$this->Javascript->blockEnd();

		$view =& ClassRegistry::getObject('view');
	}

	function testEvent() {
		$result = $this->Javascript->event('myId', 'click', 'something();');
		$this->assertPattern('/^<script[^<>]+>\s*' . str_replace('/', '\\/', preg_quote('//<![CDATA[')) . '\s*.+\s*' . str_replace('/', '\\/', preg_quote('//]]>')) . '\s*<\/script>$/', $result);
		$this->assertPattern('/^<script[^<>]+type="text\/javascript">.+' . str_replace('/', '\\/', preg_quote('Event.observe($(\'myId\'), \'click\', function(event) { something(); }, false);')) . '.+<\/script>$/s', $result);
		$this->assertPattern('/^<script[^<>]+type="text\/javascript"[^<>]*>/', $result);
		$this->assertNoPattern('/^<script[^type]=[^<>]*>/', $result);

		$result = $this->Javascript->event('myId', 'click', 'something();', array('safe' => false));
		$this->assertPattern('/^<script[^<>]+>[^<>]+<\/script>$/', $result);
		$this->assertPattern('/^<script[^<>]+type="text\/javascript">' . str_replace('/', '\\/', preg_quote('Event.observe($(\'myId\'), \'click\', function(event) { something(); }, false);')) . '<\/script>$/', $result);
		$this->assertPattern('/^<script[^<>]+type="text\/javascript"[^<>]*>/', $result);
		$this->assertNoPattern('/^<script[^type]=[^<>]*>/', $result);
	}

	function tearDown() {
		unset($this->Javascript);
	}
}

?>