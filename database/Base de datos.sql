-- Ejecutar seleccionar y pulsar F9
CREATE DATABASE oficina;

USE oficina;

-- ENGINE = Motor
-- INNODB = Tablas sean relacionales
-- MYISAM = Sin relación (muy veloz)
CREATE TABLE areas
(
	idarea			INT AUTO_INCREMENT PRIMARY KEY,
	nombrearea		VARCHAR(50)	NOT NULL,
	estado 			CHAR(1)		NOT NULL DEFAULT '1',
	fechacreacion	DATETIME 	NOT NULL DEFAULT NOW(),
	fechabaja 		DATETIME 	NULL,
	CONSTRAINT uk_nombrearea_areas UNIQUE (nombrearea)
)
ENGINE = INNODB;


INSERT INTO areas (nombrearea) VALUES
	('Recursos Humanos'),
	('Informática'),
	('Contabilidad');
SELECT * FROM areas;

CREATE TABLE empleados
(
	idempleado		INT AUTO_INCREMENT PRIMARY KEY,
	idarea			INT 		NOT NULL, -- FK
	apellidos		VARCHAR(30)	NOT NULL,
	nombres 		VARCHAR(30)	NOT NULL,
	dni 			CHAR(8)		NOT NULL,
	telefono 		CHAR(9)		NULL,
	email 			VARCHAR(70)	NULL,
	direccion		VARCHAR(70)	NULL,
	estado 			CHAR(1) 	NOT NULL DEFAULT '1',
	fechacreacion		DATETIME 	NOT NULL DEFAULT NOW(),
	fechabaja 		DATETIME	NULL,
	CONSTRAINT fk_idarea_empleado FOREIGN KEY (idarea) REFERENCES areas (idarea),
	CONSTRAINT uk_dni_empleado UNIQUE (dni)
)ENGINE = INNODB;

INSERT INTO empleados (idarea, apellidos, nombres, dni, telefono) VALUES 
	(1, 'Martinez', 'Jorge', '74748855', '956777444'),
	(2, 'Perez', 'Lucia', '45126633', '987444111'),
	(3, 'Torres', 'Ana', '78985566', NULL);
SELECT * FROM empleados;

-- PROCEDIMIENTOS ALMACENADOS
-- PROGRAMAS EJECUTAN EN EL SGBD

DELIMITER $$
CREATE PROCEDURE spu_areas_listar()
BEGIN
	SELECT idarea, nombrearea 
		FROM areas 
		WHERE estado = '1'
		ORDER BY nombrearea;
END $$

-- Verificando procedimiento
CALL spu_areas_listar();

-- Elimina el procedimiento
DROP PROCEDURE spu_empleados_listar();

DELIMITER $$
CREATE PROCEDURE spu_empleados_listar()
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
END $$

CALL spu_empleados_listar();


-- Requiere variables de entrada (similar a un método)
-- IN / INPUT / ENTRADA
DROP PROCEDURE spu_empleados_registrar;

DELIMITER $$
CREATE PROCEDURE spu_empleados_registrar
(
	IN _idarea		INT,
	IN _apellidos	VARCHAR(30),
	IN _nombres 	VARCHAR(30),
	IN _dni			CHAR(8),
	IN _telefono	CHAR(9),
	IN _email		VARCHAR(70),
	IN _direccion	VARCHAR(70)
)
BEGIN

	-- Validación...
	IF _telefono = '' THEN SET _telefono = NULL; END IF;
	IF _email = '' THEN SET _email = NULL; END IF;
	IF _direccion = '' THEN SET _direccion = NULL; END IF;

	INSERT INTO empleados (idarea, apellidos, nombres, dni, telefono, email, direccion) VALUES
		(_idarea, _apellidos, _nombres, _dni, _telefono, _email, _direccion);
END $$

CALL spu_empleados_registrar(3, 'Pachas Mejía', 'Fiorella', '55887744', '', '', '');
CALL spu_empleados_listar();


-- Creamos un buscador de empleados
DELIMITER $$
CREATE PROCEDURE spu_empleados_buscar_dni(IN _dni CHAR(8))
BEGIN
	SELECT	empleados.idempleado,
				areas.nombrearea,
				empleados.apellidos, empleados.nombres,
				empleados.dni, empleados.telefono, 
				empleados.email, empleados.direccion
		FROM empleados
		INNER JOIN areas ON areas.idarea = empleados.idarea
		WHERE empleados.dni = _dni AND empleados.estado = '1';
END $$

DELIMITER $$
CREATE PROCEDURE spu_empleados_eliminar(IN _idempleado INT)
BEGIN
	UPDATE empleados SET estado = '0' 
		WHERE idempleado = _idempleado;
END $$

DELIMITER $$
CREATE PROCEDURE spu_empleados_getdata(IN _idempleado INT)
BEGIN
	SELECT	idempleado, idarea, apellidos, nombres,
				dni, telefono, email, direccion
		FROM empleados
		WHERE idempleado = _idempleado;
END $$

DELIMITER $$
CREATE PROCEDURE spu_empleados_actualizar
(
	IN _idempleado	INT,
	IN _idarea		INT,
	IN _apellidos	VARCHAR(30),
	IN _nombres 	VARCHAR(30),
	IN _dni			CHAR(8),
	IN _telefono	CHAR(9),
	IN _email		VARCHAR(70),
	IN _direccion	VARCHAR(70)
)
BEGIN
	
	IF _telefono = '' THEN SET _telefono = NULL; END IF;
	IF _email = '' THEN SET _email = NULL; END IF;
	IF _direccion = '' THEN SET _direccion = NULL; END IF;

	UPDATE empleados SET
		idarea = _idarea,
		apellidos = _apellidos,
		nombres = _nombres,
		dni = _dni,
		telefono = _telefono,
		email = _email,
		direccion = _direccion
	WHERE idempleado = _idempleado;
	
END $$


-- DESARROLLAR:
-- REGISTRAR/ELIMINAR/ACTUALIZAR/BUSCAR/EDITAR/OBTENER
-- PARA TAREA (PENDIENTE)
CREATE TABLE marcas
(
	idmarca 		INT AUTO_INCREMENT PRIMARY KEY,
	marca 		VARCHAR(30)	NOT NULL,
	estado		CHAR(1)		NOT NULL DEFAULT '1',
	-- continua...
)ENGINE = INNODB;

CREATE TABLE productos
(
	idproducto	INT AUTO_INCREMENT PRIMARY KEY,
	descripcion	VARCHAR(70),
	idmarca 		INT,
	precio		DECIMAL(7,2),
	garantia 	TINYINT
	-- continua...
)ENGINE = INNODB;


CREATE TABLE usuarios 
(
	idusuario		INT AUTO_INCREMENT PRIMARY KEY,
	apellidos		VARCHAR(40)	NOT NULL,
	nombres 		VARCHAR(40)	NOT NULL,
	telefono		CHAR(9)		NULL,
	email 			VARCHAR(70) 	NOT NULL,
	claveacceso		VARCHAR(90)	NOT NULL,
	nivelacceso		CHAR(1)		NOT NULL DEFAULT 'S', -- S = Standard | A = Administrador | I = Invitado
	fecharegistro		DATETIME	NOT NULL DEFAULT NOW(),
	fechabaja 		DATETIME 	NULL,
	estado			CHAR(1)		NOT NULL DEFAULT '1', -- 1 = activo | 0 = inactivo
	CONSTRAINT uk_email_usu UNIQUE (email)
) ENGINE = INNODB;

INSERT INTO usuarios (apellidos, nombres, email, claveacceso) VALUES
	('Francia Minaya', 'Jhon Edward', 'jfrancia@senati.pe', '12345');

-- La contraseña: 12345
UPDATE usuarios 
	SET claveacceso = '$2y$10$5e63qlOmwesxpr1x7rITNe48M.sCsZWGdDFGJOIO3eZ9VBKnB2v5C'
	WHERE idusuario = 1;
	
INSERT INTO usuarios (apellidos, nombres, email, claveacceso) VALUES
	('Mendoza Peña', 'Maria Teresa', 'mmendoza@senati.pe', '12345');

-- La contraseña: 12345
UPDATE usuarios 
	SET claveacceso = '$2y$10$CHCGIRmZ4Z6Mhr5GfLAVUuLnvHbTLk1Dp2nmVwcsreNuuMposfdku'
	WHERE idusuario = 2;

SELECT * FROM usuarios;

-- STORE PROCEDURE LOGIN
DELIMITER $$
CREATE PROCEDURE spu_usuarios_login(IN _email VARCHAR(70))
BEGIN
	SELECT	idusuario,
				apellidos,
				nombres,
				email,
				claveacceso,
				nivelacceso
		FROM usuarios 
		WHERE email = _email AND estado = '1';
END $$

CALL spu_usuarios_login('jfrancia@senati.pe');










-- Ejecutar seleccionar y pulsar F9
CREATE DATABASE oficina;

USE oficina;

-- ENGINE = Motor
-- INNODB = Tablas sean relacionales
-- MYISAM = Sin relación (muy veloz)
CREATE TABLE areas
(
	idarea			INT AUTO_INCREMENT PRIMARY KEY,
	nombrearea		VARCHAR(50)	NOT NULL,
	estado 			CHAR(1)		NOT NULL DEFAULT '1',
	fechacreacion	DATETIME 	NOT NULL DEFAULT NOW(),
	fechabaja 		DATETIME 	NULL,
	CONSTRAINT uk_nombrearea_areas UNIQUE (nombrearea)
)
ENGINE = INNODB;


INSERT INTO areas (nombrearea) VALUES
	('Recursos Humanos'),
	('Informática'),
	('Contabilidad');

SELECT * FROM areas;

CREATE TABLE empleados
(
	idempleado		INT AUTO_INCREMENT PRIMARY KEY,
	idarea			INT 			NOT NULL, -- FK
	apellidos		VARCHAR(30)	NOT NULL,
	nombres 			VARCHAR(30)	NOT NULL,
	dni 				CHAR(8)		NOT NULL,
	telefono 		CHAR(9)		NULL,
	email 			VARCHAR(70)	NULL,
	direccion		VARCHAR(70)	NULL,
	estado 			CHAR(1) 		NOT NULL DEFAULT '1',
	fechacreacion	DATETIME 	NOT NULL DEFAULT NOW(),
	fechabaja 		DATETIME		NULL,
	CONSTRAINT fk_idarea_empleado FOREIGN KEY (idarea) REFERENCES areas (idarea),
	CONSTRAINT uk_dni_empleado UNIQUE (dni)
)ENGINE = INNODB;

INSERT INTO empleados (idarea, apellidos, nombres, dni, telefono) VALUES 
	(1, 'Martinez', 'Jorge', '74748855', '956777444'),
	(2, 'Perez', 'Lucia', '45126633', '987444111'),
	(3, 'Torres', 'Ana', '78985566', NULL);

SELECT * FROM empleados;

-- PROCEDIMIENTOS ALMACENADOS
-- PROGRAMAS EJECUTAN EN EL SGBD

DELIMITER $$
CREATE PROCEDURE spu_areas_listar()
BEGIN
	SELECT idarea, nombrearea 
		FROM areas 
		WHERE estado = '1'
		ORDER BY nombrearea;
END $$

-- Verificando procedimiento
CALL spu_areas_listar();

-- Elimina el procedimiento
DROP PROCEDURE spu_empleados_listar;

DELIMITER $$
CREATE PROCEDURE spu_empleados_listar()
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
END $$

CALL spu_empleados_listar();


-- Requiere variables de entrada (similar a un método)
-- IN / INPUT / ENTRADA
DROP PROCEDURE spu_empleados_registrar;

DELIMITER $$
CREATE PROCEDURE spu_empleados_registrar
(
	IN _idarea		INT,
	IN _apellidos	VARCHAR(30),
	IN _nombres 	VARCHAR(30),
	IN _dni			CHAR(8),
	IN _telefono	CHAR(9),
	IN _email		VARCHAR(70),
	IN _direccion	VARCHAR(70)
)
BEGIN

	-- Validación...
	IF _telefono = '' THEN SET _telefono = NULL; END IF;
	IF _email = '' THEN SET _email = NULL; END IF;
	IF _direccion = '' THEN SET _direccion = NULL; END IF;

	INSERT INTO empleados (idarea, apellidos, nombres, dni, telefono, email, direccion) VALUES
		(_idarea, _apellidos, _nombres, _dni, _telefono, _email, _direccion);
END $$

CALL spu_empleados_registrar(3, 'Pachas Mejía', 'Fiorella', '55887744', '', '', '');
CALL spu_empleados_listar();


-- Creamos un buscador de empleados
DELIMITER $$
CREATE PROCEDURE spu_empleados_buscar_dni(IN _dni CHAR(8))
BEGIN
	SELECT	empleados.idempleado,
				areas.nombrearea,
				empleados.apellidos, empleados.nombres,
				empleados.dni, empleados.telefono, 
				empleados.email, empleados.direccion
		FROM empleados
		INNER JOIN areas ON areas.idarea = empleados.idarea
		WHERE empleados.dni = _dni AND empleados.estado = '1';
END $$

DELIMITER $$
CREATE PROCEDURE spu_empleados_eliminar(IN _idempleado INT)
BEGIN
	UPDATE empleados SET estado = '0' 
		WHERE idempleado = _idempleado;
END $$

DELIMITER $$
CREATE PROCEDURE spu_empleados_getdata(IN _idempleado INT)
BEGIN
	SELECT	idempleado, idarea, apellidos, nombres,
				dni, telefono, email, direccion
		FROM empleados
		WHERE idempleado = _idempleado;
END $$

DELIMITER $$
CREATE PROCEDURE spu_empleados_actualizar
(
	IN _idempleado	INT,
	IN _idarea		INT,
	IN _apellidos	VARCHAR(30),
	IN _nombres 	VARCHAR(30),
	IN _dni			CHAR(8),
	IN _telefono	CHAR(9),
	IN _email		VARCHAR(70),
	IN _direccion	VARCHAR(70)
)
BEGIN
	
	IF _telefono = '' THEN SET _telefono = NULL; END IF;
	IF _email = '' THEN SET _email = NULL; END IF;
	IF _direccion = '' THEN SET _direccion = NULL; END IF;

	UPDATE empleados SET
		idarea = _idarea,
		apellidos = _apellidos,
		nombres = _nombres,
		dni = _dni,
		telefono = _telefono,
		email = _email,
		direccion = _direccion
	WHERE idempleado = _idempleado;
	
END $$






-- DESARROLLAR:
-- REGISTRAR/ELIMINAR/ACTUALIZAR/BUSCAR/EDITAR/OBTENER
-- PARA TAREA (PENDIENTE)
CREATE TABLE marcas
(
	idmarca 		INT AUTO_INCREMENT PRIMARY KEY,
	marca 		VARCHAR(30)	NOT NULL,
	estado		CHAR(1)		NOT NULL DEFAULT '1',
	-- continua...
)ENGINE = INNODB;

CREATE TABLE productos
(
	idproducto	INT AUTO_INCREMENT PRIMARY KEY,
	descripcion	VARCHAR(70),
	idmarca 		INT,
	precio		DECIMAL(7,2),
	garantia 	TINYINT
	-- continua...
)ENGINE = INNODB;



CREATE TABLE usuarios 
(
	idusuario		INT AUTO_INCREMENT PRIMARY KEY,
	apellidos		VARCHAR(40)	NOT NULL,
	nombres 			VARCHAR(40)	NOT NULL,
	telefono			CHAR(9)		NULL,
	email 			VARCHAR(70) NOT NULL,
	claveacceso		VARCHAR(90)	NOT NULL,
	nivelacceso		CHAR(1)		NOT NULL DEFAULT 'S', -- S = Standard | A = Administrador | I = Invitado
	fecharegistro	DATETIME		NOT NULL DEFAULT NOW(),
	fechabaja 		DATETIME 	NULL,
	estado			CHAR(1)		NOT NULL DEFAULT '1', -- 1 = activo | 0 = inactivo
	CONSTRAINT uk_email_usu UNIQUE (email)
) ENGINE = INNODB;

INSERT INTO usuarios (apellidos, nombres, email, claveacceso) VALUES
	('Francia Minaya', 'Jhon Edward', 'jfrancia@senati.pe', '12345');

-- La contraseña: 12345
UPDATE usuarios 
	SET claveacceso = '$2y$10$5e63qlOmwesxpr1x7rITNe48M.sCsZWGdDFGJOIO3eZ9VBKnB2v5C'
	WHERE idusuario = 1;
	
INSERT INTO usuarios (apellidos, nombres, email, claveacceso) VALUES
	('Mendoza Peña', 'Maria Teresa', 'mmendoza@senati.pe', '12345');

-- La contraseña: 12345
UPDATE usuarios 
	SET claveacceso = '$2y$10$CHCGIRmZ4Z6Mhr5GfLAVUuLnvHbTLk1Dp2nmVwcsreNuuMposfdku'
	WHERE idusuario = 2;

SELECT * FROM usuarios;

-- STORE PROCEDURE LOGIN
DELIMITER $$
CREATE PROCEDURE spu_usuarios_login(IN _email VARCHAR(70))
BEGIN
	SELECT	idusuario,
				apellidos,
				nombres,
				email,
				claveacceso,
				nivelacceso
		FROM usuarios 
		WHERE email = _email AND estado = '1';
END $$

CALL spu_usuarios_login('jfranciaaahahahahshs@senati.pe');
