ALTER TABLE `brokers`.`pedidos` ADD COLUMN `tipo_negocio` INT(11) NOT NULL DEFAULT 0 AFTER `estado`, ADD COLUMN `com_inicial` INT(11) NULL DEFAULT 0 AFTER `tipo_negocio`, ADD COLUMN `com_mensual` INT(11) NULL DEFAULT 0 AFTER `com_inicial`;

ALTER TABLE `brokers`.`pedidos` ADD COLUMN `recurrente` INT(11) NULL AFTER `com_mensual`;

ALTER TABLE `brokers`.`creditos` CHANGE COLUMN `valor` `valor` VARCHAR(45) NULL DEFAULT NULL ,ADD COLUMN `idpago` INT(11) NULL AFTER `idpedido`,ADD COLUMN `intereses` VARCHAR(45) NULL DEFAULT 0 AFTER `idpago`;

CREATE TABLE `creditos` ( `idcreditos` int(11) NOT NULL AUTO_INCREMENT, `fecha` date NOT NULL, `detalles` varchar(100) DEFAULT NULL, `valor` varchar(45) DEFAULT NULL, `idclientes` int(11) NOT NULL, `idpedido` int(11) DEFAULT NULL, `idpago` int(11) DEFAULT NULL, `intereses` varchar(45) DEFAULT '0', PRIMARY KEY (`idcreditos`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;