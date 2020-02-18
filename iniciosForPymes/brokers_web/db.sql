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

