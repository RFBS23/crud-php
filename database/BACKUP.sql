/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.24-MariaDB : Database - oficina
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`oficina` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `oficina`;

/*Table structure for table `areas` */

DROP TABLE IF EXISTS `areas`;

CREATE TABLE `areas` (
  `idarea` int(11) NOT NULL AUTO_INCREMENT,
  `nombrearea` varchar(50) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  `fechacreacion` datetime NOT NULL DEFAULT current_timestamp(),
  `fechabaja` datetime DEFAULT NULL,
  PRIMARY KEY (`idarea`),
  UNIQUE KEY `uk_nombrearea_areas` (`nombrearea`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `areas` */

insert  into `areas`(`idarea`,`nombrearea`,`estado`,`fechacreacion`,`fechabaja`) values 
(1,'Recursos Humanos','1','2022-11-09 09:58:23',NULL),
(2,'Informática','1','2022-11-09 09:58:23',NULL),
(3,'Contabilidad','1','2022-11-09 09:58:23',NULL);

/*Table structure for table `empleados` */

DROP TABLE IF EXISTS `empleados`;

CREATE TABLE `empleados` (
  `idempleado` int(11) NOT NULL AUTO_INCREMENT,
  `idarea` int(11) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `nombres` varchar(30) NOT NULL,
  `dni` char(8) NOT NULL,
  `telefono` char(9) DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  `direccion` varchar(70) DEFAULT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  `fechacreacion` datetime NOT NULL DEFAULT current_timestamp(),
  `fechabaja` datetime DEFAULT NULL,
  PRIMARY KEY (`idempleado`),
  UNIQUE KEY `uk_dni_empleado` (`dni`),
  KEY `fk_idarea_empleado` (`idarea`),
  CONSTRAINT `fk_idarea_empleado` FOREIGN KEY (`idarea`) REFERENCES `areas` (`idarea`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `empleados` */

insert  into `empleados`(`idempleado`,`idarea`,`apellidos`,`nombres`,`dni`,`telefono`,`email`,`direccion`,`estado`,`fechacreacion`,`fechabaja`) values 
(1,1,'Martinez','Jorge','74748855','956777444',NULL,NULL,'1','2022-11-09 10:07:43',NULL),
(2,2,'Perez','Lucia','45126633','987444111',NULL,NULL,'1','2022-11-09 10:07:43',NULL),
(3,3,'Torres','Ana','78985566',NULL,NULL,NULL,'1','2022-11-09 10:07:43',NULL),
(4,2,'Francia Minaya','Jhon','11223344',NULL,NULL,NULL,'1','2022-11-09 11:03:04',NULL),
(5,3,'Pachas Mejía','Fiorella','55887744',NULL,NULL,NULL,'1','2022-11-09 11:18:33',NULL),
(6,2,'Mejía Pachas','Carmen','74545465','956834915','carmen@gmail.com','Calle Lima 455','1','2022-11-16 11:04:01',NULL);

/* Procedure structure for procedure `spu_areas_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_areas_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_areas_listar`()
BEGIN
	SELECT idarea, nombrearea 
		FROM areas 
		WHERE estado = '1'
		ORDER BY nombrearea;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_empleados_buscar_dni` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_empleados_buscar_dni` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_empleados_buscar_dni`(in _dni CHAR(8))
BEGIN
	SELECT	empleados.idempleado,
				areas.nombrearea,
				empleados.apellidos, empleados.nombres,
				empleados.dni, empleados.telefono, 
				empleados.email, empleados.direccion
		FROM empleados
		INNER JOIN areas ON areas.idarea = empleados.idarea
		WHERE empleados.dni = _dni AND empleados.estado = '1';
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_empleados_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_empleados_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_empleados_listar`()
BEGIN
	SELECT	empleados.idempleado,
				areas.nombrearea,
				empleados.apellidos, empleados.nombres,
				empleados.dni, empleados.telefono, 
				empleados.email, empleados.direccion
		FROM empleados
		INNER JOIN areas ON areas.idarea = empleados.idarea
		WHERE empleados.estado = '1'
		ORDER BY empleados.idempleado DESC;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_empleados_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_empleados_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_empleados_registrar`(
	in _idarea		INT,
	IN _apellidos	VARCHAR(30),
	IN _nombres 	VARCHAR(30),
	IN _dni			CHAR(8),
	IN _telefono	CHAR(9),
	IN _email		VARCHAR(70),
	IN _direccion	VARCHAR(70)
)
BEGIN

	-- Validación...
	IF _telefono = '' THEN set _telefono = NULL; END IF;
	IF _email = '' THEN SET _email = NULL; END IF;
	IF _direccion = '' THEN SET _direccion = NULL; END IF;

	INSERT INTO empleados (idarea, apellidos, nombres, dni, telefono, email, direccion) VALUES
		(_idarea, _apellidos, _nombres, _dni, _telefono, _email, _direccion);
END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
