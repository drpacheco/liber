SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

ALTER TABLE `liber`.`produtos` DROP FOREIGN KEY `fk_produtos_categoria_produtos1` ;

ALTER TABLE `liber`.`empresas` ADD COLUMN `cep` CHAR(8) NOT NULL  AFTER `estado` ;

ALTER TABLE `liber`.`produtos` CHANGE COLUMN `categoria_produto_id` `produto_categoria_id` INT(11) NOT NULL  , 
  ADD CONSTRAINT `fk_produtos_categoria_produtos1`
  FOREIGN KEY (`produto_categoria_id` )
  REFERENCES `liber`.`produto_categorias` (`id` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `liber`.`categoria_produtos` RENAME TO  `liber`.`produto_categorias` ;

ALTER TABLE `liber`.`pagar_contas` CHANGE COLUMN `valor` `valor` FLOAT(5) NOT NULL  ;

ALTER TABLE `liber`.`receber_contas` CHANGE COLUMN `valor` `valor` FLOAT(5) NOT NULL  ;

ALTER TABLE `liber`.`pedido_vendas` CHANGE COLUMN `custo_frete` `custo_frete` FLOAT(5) NULL DEFAULT NULL  , CHANGE COLUMN `custo_seguro` `custo_seguro` FLOAT(5) NULL DEFAULT NULL  , CHANGE COLUMN `custo_outros` `custo_outros` FLOAT(5) NULL DEFAULT NULL  , CHANGE COLUMN `desconto` `desconto` FLOAT(5) NULL DEFAULT NULL  ;

ALTER TABLE `liber`.`servico_ordens` DROP COLUMN `data_hora_cadastrada` , ADD COLUMN `data_hora_cadastrada` DATETIME NOT NULL  AFTER `id` ;

ALTER TABLE `liber`.`servicos` CHANGE COLUMN `valor` `valor` FLOAT(5) NOT NULL  ;

ALTER TABLE `liber`.`servico_ordem_itens` CHANGE COLUMN `valor` `valor` FLOAT(5) NOT NULL  ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
