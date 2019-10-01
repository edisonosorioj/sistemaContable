ALTER TABLE `brokers`.`pedidos` ADD COLUMN `tipo_negocio` INT(11) NOT NULL DEFAULT 0 AFTER `estado`, ADD COLUMN `com_inicial` INT(11) NULL DEFAULT 0 AFTER `tipo_negocio`, ADD COLUMN `com_mensual` INT(11) NULL DEFAULT 0 AFTER `com_inicial`;

ALTER TABLE `brokers`.`pedidos` ADD COLUMN `recurrente` INT(11) NULL AFTER `com_mensual`;

ALTER TABLE `brokers`.`creditos` CHANGE COLUMN `valor` `valor` VARCHAR(45) NULL DEFAULT NULL ,ADD COLUMN `idpago` INT(11) NULL AFTER `idpedido`,ADD COLUMN `intereses` VARCHAR(45) NULL DEFAULT 0 AFTER `idpago`;