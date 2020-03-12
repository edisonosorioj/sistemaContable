CREATE DATABASE brokers_web;

CREATE TABLE `brokers_web`.`propiedad` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NULL,
  `tipo` VARCHAR(45) NULL,
  `zona` INT NULL,
  `estado` INT NULL,
  `img` VARCHAR(100) NULL,
  `pagina` VARCHAR(100) NULL,
  `dato1` VARCHAR(100) NULL,
  `dato2` VARCHAR(100) NULL,
  `dato3` VARCHAR(100) NULL,
  `costo` VARCHAR(45) NULL,
  `directorio` VARCHAR(45) NULL,
  `descripcion` VARCHAR(5000) NULL,
  `creador` INT(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`));

insert into propiedad (nombre,tipo,zona,estado,img,pagina,dato1,dato2,dato3,costo) values ();

INSERT INTO `propiedad`(`nombre`, `tipo`, `zona`, `estado`) VALUES ('Proyecto Babilonia',1,3,1);
INSERT INTO `propiedad`(`nombre`, `tipo`, `zona`, `estado`) VALUES ('Girasoles del Tambo',1,4,1);
INSERT INTO `propiedad`(`nombre`, `tipo`, `zona`, `estado`) VALUES ('Urbanización San Angel',1,5,1);
INSERT INTO `propiedad`(`nombre`, `tipo`, `zona`, `estado`) VALUES ('Manantiales',1,6,1);
INSERT INTO `propiedad`(`nombre`, `tipo`, `zona`, `estado`) VALUES ('Apartamento Marinilla',1,3,1);

update propiedad set img='images/work-1.jpg', pagina='babilonia.html', dato1=3, dato2=2, dato3='Desde 35 Mt2', costo='130000000', zona='3', tipo='1' where id = 1;
update propiedad set img='images/work-2.jpg', pagina='girasoles.html', dato1=3, dato2=2, dato3='Desde 56 Mt2', costo='105000000', zona='4', tipo='1' where id = 2;
update propiedad set img='images/work-3.jpg', pagina='sanangel.html', dato1=3, dato2=2, dato3='141 Lotes', costo='78000000', zona='5', tipo='1' where id = 3;
update propiedad set img='images/work-4.jpg', pagina='manantiales.html', dato1=3, dato2=2, dato3='Desde 80 Mt2', costo='300000000', zona='6', tipo='1' where id = 4;
update propiedad set img='images/work-5.jpg', pagina='marinilla01.html', dato1=3, dato2=2, dato3='67 Mt2', costo='750000', zona='3', tipo='2' where id = 5;

CREATE TABLE `brokers_web`.`zonas` (`id` INT NOT NULL AUTO_INCREMENT,`zona_padre` INT NOT NULL DEFAULT 0,`nombre` VARCHAR(45) NULL,`estado` INT NULL DEFAULT 1,PRIMARY KEY (`id`));

insert into zonas (zona_padre,nombre,estado) values ('0','Colombia',1);
insert into zonas (zona_padre,nombre,estado) values ('1','Antioquia',1);
insert into zonas (zona_padre,nombre,estado) values ('2','Marinilla',1);
insert into zonas (zona_padre,nombre,estado) values ('2','La Ceja',1);
insert into zonas (zona_padre,nombre,estado) values ('2','La Unión',1);
insert into zonas (zona_padre,nombre,estado) values ('2','Sabaneta',1);

CREATE TABLE `brokers_web`.`especificaciones_propiedad` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_propiedad` INT NOT NULL,
  `dato1` VARCHAR(100) NULL,
  `dato2` VARCHAR(100) NULL,
  `dato3` VARCHAR(100) NULL,
  `dato4` VARCHAR(100) NULL,
  `dato5` VARCHAR(100) NULL,
  `dato6` VARCHAR(100) NULL,
  `dato7` VARCHAR(100) NULL,
  `dato8` VARCHAR(100) NULL,
  `dato9` VARCHAR(100) NULL,
  `dato10` VARCHAR(100) NULL,
  `dato11` VARCHAR(100) NULL,
  `dato12` VARCHAR(100) NULL,
  `dato13` VARCHAR(100) NULL,
  `dato14` VARCHAR(100) NULL,
  `dato15` VARCHAR(100) NULL,
  `dato16` VARCHAR(100) NULL,
  `dato17` VARCHAR(100) NULL,
  `dato18` VARCHAR(100) NULL,
  `dato19` VARCHAR(100) NULL,
  `dato20` VARCHAR(100) NULL,
  PRIMARY KEY (`id`),
  INDEX `id_propiedad` (`id_propiedad` ASC));

#ALTER TABLE `brokers_web`.`propiedad` 
#ADD COLUMN `directorio` VARCHAR(45) NULL AFTER `costo`;

UPDATE `brokers_web`.`propiedad` SET `directorio`='images/manantiales/' WHERE `id`='4';
UPDATE `brokers_web`.`propiedad` SET `directorio`='images/san-angel/' WHERE `id`='3';
UPDATE `brokers_web`.`propiedad` SET `directorio`='images/girasoles/' WHERE `id`='2';
UPDATE `brokers_web`.`propiedad` SET `directorio`='images/babilonia/' WHERE `id`='1';

INSERT INTO `brokers_web`.`especificaciones_propiedad` (`id_propiedad`, `dato1`, `dato2`, `dato3`, `dato4`, `dato5`, `dato6`, `dato7`, `dato8`, `dato9`, `dato10`, `dato11`, `dato12`, `dato13`, `dato14`, `dato15`) VALUES ('1', 'Áreas desde: 39.73 Mts2', 'Portería', 'Recepción', 'Lobby', 'Salón Social', 'Áreas hasta: 84.53 Mts2', 'Sala de Negocios', 'Gimnasio', 'Piscina', 'Turco', 'Jacuzzi', 'Senderos Ecológicos', 'Solárium', 'Guarderia Infantil', 'Zona BBQ');

#ALTER TABLE `brokers_web`.`propiedad` 
#ADD COLUMN `descripcion` VARCHAR(5000) NULL AFTER `directorio`;

UPDATE `brokers_web`.`propiedad` SET `img`='work-1.jpg', `directorio`='images' WHERE `id`='1';
UPDATE `brokers_web`.`propiedad` SET `img`='work-2.jpg', `directorio`='images' WHERE `id`='2';
UPDATE `brokers_web`.`propiedad` SET `directorio`='images' WHERE `id`='3';
UPDATE `brokers_web`.`propiedad` SET `directorio`='images' WHERE `id`='4';
UPDATE `brokers_web`.`propiedad` SET `img`='work-3.jpg' WHERE `id`='3';
UPDATE `brokers_web`.`propiedad` SET `img`='work-4.jpg' WHERE `id`='4';

UPDATE `brokers_web`.`propiedad` SET `directorio`='babilonia' WHERE `id`='1';
UPDATE `brokers_web`.`propiedad` SET `directorio`='girasoles' WHERE `id`='2';
UPDATE `brokers_web`.`propiedad` SET `directorio`='sanangel' WHERE `id`='3';
UPDATE `brokers_web`.`propiedad` SET `directorio`='manantiales' WHERE `id`='4';

ALTER TABLE `brokers_web`.`propiedad` 
ADD COLUMN `creador` INT(11) NOT NULL DEFAULT 1 AFTER `descripcion`;



