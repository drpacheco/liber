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
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 *  Licensed under The Open Group Test Suite License
 *  Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2008, Cake Software Foundation, Inc.
 * @link				https://trac.cakephp.org/wiki/Developement/TestSuite CakePHP(tm) Tests
 * @package			cake.tests
 * @subpackage		cake.tests.cases.libs.view.helpers
 * @since			CakePHP(tm) v 1.2.0.4206
 * @version			$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 * @license			http://www.opensource.org/licenses/opengroup.php The Open Group Test Suite License
 */
if (!defined('CAKEPHP_UNIT_TEST_EXECUTION')) {
	define('CAKEPHP_UNIT_TEST_EXECUTION', 1);
}

uses('view'.DS.'helpers'.DS.'app_helper', 'controller'.DS.'controller', 'model'.DS.'model', 'view'.DS.'helper', 'view'.DS.'helpers'.DS.'xml');

/**
 * Short description for class.
 *
 * @package		cake.tests
 * @subpackage	cake.tests.cases.libs.view.helpers
 */
class XmlHelperTest extends UnitTestCase {

	function setUp() {
		$this->Xml = new XmlHelper();
	}

	function testAddNamespace() {
		$this->Xml->addNs('custom', 'http://example.com/dtd.xml');
		$manager =& XmlManager::getInstance();

		$expected = array('custom' => 'http://example.com/dtd.xml');
		$this->assertEqual($manager->namespaces, $expected);
	}

	function testRemoveNamespace() {
		$this->Xml->addNs('custom', 'http://example.com/dtd.xml');
		$this->Xml->addNs('custom2', 'http://example.com/dtd2.xml');
		$manager =& XmlManager::getInstance();

		$expected = array('custom' => 'http://example.com/dtd.xml', 'custom2' => 'http://example.com/dtd2.xml');
		$this->assertEqual($manager->namespaces, $expected);

		$this->Xml->removeNs('custom');
		$expected = array('custom2' => 'http://example.com/dtd2.xml');
		$this->assertEqual($manager->namespaces, $expected);
	}

	function testRenderZeroElement() {
		$result = $this->Xml->elem('count', null, 0);
		$expected = '<count>0</count>';
		$this->assertEqual($result, $expected);
	}

	function tearDown() {
		unset($this->Xml);
	}
}

?>