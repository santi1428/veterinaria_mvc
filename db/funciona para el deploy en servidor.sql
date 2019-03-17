-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-02-2019 a las 04:39:44
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pluto`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE PROCEDURE `inicioSesion` (IN `_usuario` VARCHAR(18), IN `_contrasena` VARCHAR(50), OUT `_resp` INT)  BEGIN
IF(SELECT COUNT(*) FROM empleado WHERE usuario = _usuario AND contrasena = _contrasena)>0 THEN
SET _resp = 1;
ELSE
SET _resp = 0;
END IF;
END$$

CREATE PROCEDURE `registro` (IN `_usuario` VARCHAR(18), IN `_nombre` VARCHAR(50), IN `_contrasena` VARCHAR(255), OUT `_resp` INT)  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
          SET _resp = 2;
          ROLLBACK;
    END;

    IF(SELECT COUNT(*) FROM empleado WHERE usuario = _usuario) = 0 THEN
    START TRANSACTION;
    INSERT INTO empleado VALUES (_usuario, _nombre, _contrasena);
    COMMIT;
    SET _resp = 1;
    ELSE
    SET _resp = 0;
    END IF;

END$$

CREATE PROCEDURE `registroCliente` (IN `_id` VARCHAR(11), IN `_nombre` VARCHAR(50), IN `_tipodocumento` VARCHAR(50), OUT `_resp` INT)  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
          SET _resp = 2;
          ROLLBACK;
    END;

    IF(SELECT COUNT(*) FROM cliente WHERE ID = _id) = 0 THEN
    START TRANSACTION;
    INSERT INTO cliente VALUES (_id, _nombre, _tipodocumento);

    COMMIT;
    SET _resp = 1;
    ELSE
    SET _resp = 0;
    END IF;
END$$

CREATE PROCEDURE `registroControl` (IN `_fechaControl` DATE, IN `_fechaProxima` DATE, IN `_metodoPago` VARCHAR(50), IN `_valorTotal` INT, OUT `_resp` INT)  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
          SET _resp = 2;
SELECT @p1 as RETURNED_SQLSTATE  , @p2 as MESSAGE_TEXT;
          ROLLBACK;
    END;
    
    START TRANSACTION;
    INSERT INTO tblcontrol (FECHACONTROL, FECHAPROX, METODOPAGO, VALORTOTAL) VALUES(_fechaControl, _fechaProxima, _metodoPago, _valorTotal);
    SET _resp = LAST_INSERT_ID();
    COMMIT;
    
END$$

CREATE PROCEDURE `registroDireccion` (IN `_id` VARCHAR(11), IN `_direccion` VARCHAR(50), IN `_ciudad` VARCHAR(25), OUT `_resp` INT)  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
          SET _resp = 2;
          ROLLBACK;
    END;
    IF(SELECT COUNT(*) FROM direccion WHERE IDCLIENTE = _id AND DIRECCION = _direccion AND CIUDAD = _ciudad) = 0 THEN
    START TRANSACTION;
    INSERT INTO direccion VALUES(_id, _direccion, _ciudad);
    COMMIT;
    SET _resp = 1;
    ELSE
    SET _resp = 0;
    END IF;

END$$

CREATE PROCEDURE `registroMascota` (IN `_edad` TINYINT(4), IN `_raza` VARCHAR(18), IN `_nombre` VARCHAR(50), IN `_id` VARCHAR(11), OUT `_resp` INT)  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
          SET _resp = 2;
SELECT @p1 as RETURNED_SQLSTATE  , @p2 as MESSAGE_TEXT;
          ROLLBACK;
    END;
    IF (SELECT COUNT(*) FROM mascota WHERE EDAD = _edad AND RAZA = _raza AND NOMBRE = _nombre AND IDCLIENTE = _id) = 0 THEN
    START TRANSACTION;
    INSERT INTO mascota (EDAD, RAZA, NOMBRE, IDCLIENTE) VALUES (_edad, _raza, _nombre, _id);
    COMMIT;
    SET _resp = 1;
    ELSE
    SET _resp = 0;
    END IF;
END$$

CREATE PROCEDURE `registroServicio` (IN `_tipo` VARCHAR(18), IN `_valor` INT(11), OUT `_resp` INT)  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
          SET _resp = 2;
SELECT @p1 as RETURNED_SQLSTATE  , @p2 as MESSAGE_TEXT;
          ROLLBACK;
    END;
    IF (SELECT COUNT(*) FROM servicio WHERE TIPO = _tipo) = 0 THEN
    START TRANSACTION;
    INSERT INTO servicio (TIPO, VALOR) VALUES (_tipo, _valor);
    COMMIT;
    SET _resp = 1;
    ELSE
    SET _resp = 0;
    END IF;
END$$

CREATE PROCEDURE `registroServicioMascotaYControl` (IN `_idMascota` INT, IN `_codigoServicio` INT, IN `_idVeterinario` VARCHAR(11), IN `_numeroControl` INT, OUT `_resp` INT)  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
          SET _resp = 2;
SELECT @p1 as RETURNED_SQLSTATE  , @p2 as MESSAGE_TEXT;
          ROLLBACK;
    END;
    
    START TRANSACTION;
    INSERT INTO servicio_mascota (IDMASCOTA, CODIGOSERVICIO, IDVETERINARIO) VALUES(_idMascota, _codigoServicio, _idVeterinario);
    INSERT INTO servicio_control (MASCOTAID, SERVICIOCODIGO, CONTROLNUMERO) VALUES(_idMascota, _codigoServicio, _numeroControl);
    SET _resp = 1;
    COMMIT;
    
END$$

CREATE PROCEDURE `registroTelefono` (IN `_id` VARCHAR(11), IN `_telefono` INT(11), OUT `_resp` INT)  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
          SET _resp = 2;
          ROLLBACK;
    END;

    IF (SELECT COUNT(*) FROM telefono WHERE IDCLIENTE = _id AND TELEFONO = _telefono) = 0 THEN
    START TRANSACTION;
    INSERT INTO telefono VALUES(_id, _telefono);
    COMMIT;
    SET _resp = 1;
    ELSE
    SET _resp = 0;
    END IF;
END$$

CREATE PROCEDURE `registroVeterinario` (IN `_id` VARCHAR(11), IN `_nombre` VARCHAR(50), IN `_tipoDocumento` VARCHAR(50), OUT `_resp` INT)  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
          SET _resp = 2;
SELECT @p1 as RETURNED_SQLSTATE  , @p2 as MESSAGE_TEXT;
          ROLLBACK;
    END;
    IF (SELECT COUNT(*) FROM veterinario WHERE ID = _id) = 0 THEN
    START TRANSACTION;
    INSERT INTO veterinario (ID, NOMBRE, TIPODOCUMENTO) VALUES (_id, _nombre, _tipoDocumento);
    COMMIT;
    SET _resp = 1;
    ELSE
    SET _resp = 0;
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `ID` varchar(11) COLLATE latin1_spanish_ci NOT NULL,
  `NOMBRE` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `TIPODOCUMENTO` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`ID`, `NOMBRE`, `TIPODOCUMENTO`) VALUES
('1', 'asdf', 'Cedula de Ciudadania'),
('123456789', 'Santiago Molina Restrepo', 'Cedula de Ciudadania'),
('145785476', 'Carlos Andres Giraldo Restrepo', 'Cedula de Ciudadania'),
('21830818', 'Santiago Molina Restrepo', 'Cedula de Ciudadania'),
('4446', 'dfsafads', 'Cedula de Ciudadania'),
('47825845619', 'Luis Eduardo Giraldo Restrepo', 'Registro Civil'),
('4785454545', 'Luis Felipe MejÃ­a', 'Cedula de Ciudadania'),
('4789546812', 'Mateo Restrepo', 'Documento de ciudadano extranjero'),
('6', 'fdsafsda', 'Documento de ciudadano extranjero'),
('78945665478', 'Esteban Gonzales', 'Documento de ciudadano extranjero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

CREATE TABLE `direccion` (
  `IDCLIENTE` varchar(11) COLLATE latin1_spanish_ci NOT NULL,
  `DIRECCION` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `CIUDAD` varchar(25) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `direccion`
--

INSERT INTO `direccion` (`IDCLIENTE`, `DIRECCION`, `CIUDAD`) VALUES
('123456789', 'Calle 2', 'NULL'),
('123456789', 'Calle 44a ', 'Medellin'),
('123456789', 'NULL', 'Cali'),
('145785476', 'Calle 44 a', 'Medellin'),
('145785476', 'Calle 45', 'NULL'),
('145785476', 'Cra 79d', 'Cali'),
('47825845619', 'Calle 44B', 'Barranquilla'),
('47825845619', 'Carrera 79D', 'NULL'),
('47825845619', 'NULL', 'Cali');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `USUARIO` varchar(18) COLLATE latin1_spanish_ci NOT NULL,
  `NOMBRE` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `CONTRASENA` varchar(255) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`USUARIO`, `NOMBRE`, `CONTRASENA`) VALUES
('asdffdsafdsasdf', 'SANTIAGO', '123456'),
('da', 'dasf', '123456'),
('dsafdsfadsafdsafsd', 'SANTIAGO', '123456'),
('marlon28', 'Marlon Moreno', '7891011'),
('safdasfd', 'adfs', '123456'),
('santi1428', 'Santiago', '123456'),
('santi14288', 'SANTIAGO', '123456'),
('santimoli', 'santiago', '456789'),
('sdfsfd', 'sdf', 'asdasd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascota`
--

CREATE TABLE `mascota` (
  `ID` int(11) NOT NULL,
  `EDAD` tinyint(4) DEFAULT NULL,
  `RAZA` varchar(18) COLLATE latin1_spanish_ci DEFAULT NULL,
  `NOMBRE` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `IDCLIENTE` varchar(11) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `mascota`
--

INSERT INTO `mascota` (`ID`, `EDAD`, `RAZA`, `NOMBRE`, `IDCLIENTE`) VALUES
(127, 6, 'Chow Chow', 'Drako', '145785476'),
(141, 2, 'Chihuaha', 'Rafael', '4789546812'),
(142, 6, 'Boxer', 'Pepo', '4789546812'),
(143, 11, 'Border Terrier', 'Luis', '4789546812'),
(144, 2, 'Bulldog', 'Lucio', '4789546812'),
(145, 5, 'Loro Cariamarillo', 'Rafael', '145785476'),
(146, 6, 'Bulldog', 'Lucio', '145785476'),
(149, 2, ' Bombay', 'Perla', '47825845619'),
(151, 10, 'Border Terrier', 'Nicolas', '47825845619'),
(152, 2, 'Boxer', 'Paco', '47825845619'),
(153, 9, 'Bulldog', 'Drako', '47825845619'),
(155, 7, ' Bombay', 'Manolo', '47825845619'),
(157, 2, 'Chihuaha', 'Pepe', '4785454545'),
(158, 2, 'Cocker Spaniel', 'Luna', '78945665478'),
(159, 1, 'Cocker Spaniel', 'Manolo', '78945665478'),
(160, 54, 'Chow Chow', 'fdasfdsa', '4446');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `CODIGO` int(11) NOT NULL,
  `TIPO` varchar(18) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VALOR` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`CODIGO`, `TIPO`, `VALOR`) VALUES
(19, 'CirugÃ­a', 500000),
(20, 'aafds', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_control`
--

CREATE TABLE `servicio_control` (
  `MASCOTAID` int(11) NOT NULL,
  `SERVICIOCODIGO` int(11) NOT NULL,
  `CONTROLNUMERO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_mascota`
--

CREATE TABLE `servicio_mascota` (
  `IDMASCOTA` int(11) NOT NULL,
  `CODIGOSERVICIO` int(11) NOT NULL,
  `IDVETERINARIO` varchar(11) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcontrol`
--

CREATE TABLE `tblcontrol` (
  `NUMERO` int(11) NOT NULL,
  `FECHACONTROL` date DEFAULT NULL,
  `FECHAPROX` date DEFAULT NULL,
  `METODOPAGO` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VALORTOTAL` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefono`
--

CREATE TABLE `telefono` (
  `IDCLIENTE` varchar(11) COLLATE latin1_spanish_ci NOT NULL,
  `TELEFONO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `telefono`
--

INSERT INTO `telefono` (`IDCLIENTE`, `TELEFONO`) VALUES
('123456789', 4798519),
('145785476', 2054789),
('145785476', 5040920),
('145785476', 2147483647),
('47825845619', 4587452),
('47825845619', 2147483647);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipomascota`
--

CREATE TABLE `tipomascota` (
  `RAZAMASCOTA` varchar(18) COLLATE latin1_spanish_ci NOT NULL,
  `DESCRIPCION` varchar(18) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `tipomascota`
--

INSERT INTO `tipomascota` (`RAZAMASCOTA`, `DESCRIPCION`) VALUES
(' Birmano', 'Gato'),
(' Bombay', 'Gato'),
('Beagle', 'Perro'),
('Border Terrier', 'Perro'),
('Boxer', 'Perro'),
('Bulldog', 'Perro'),
('Chihuaha', 'Perro'),
('Chow Chow', 'Perro'),
('Cocker Spaniel', 'Perro'),
('Loro Cariamarillo', 'Ave'),
('Loro gris', 'Ave'),
('Siames', 'Gato');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `veterinario`
--

CREATE TABLE `veterinario` (
  `ID` varchar(11) COLLATE latin1_spanish_ci NOT NULL,
  `NOMBRE` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `TIPODOCUMENTO` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`IDCLIENTE`,`DIRECCION`,`CIUDAD`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`USUARIO`);

--
-- Indices de la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDCLIENTE` (`IDCLIENTE`),
  ADD KEY `RAZA` (`RAZA`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`CODIGO`);

--
-- Indices de la tabla `servicio_control`
--
ALTER TABLE `servicio_control`
  ADD PRIMARY KEY (`MASCOTAID`,`SERVICIOCODIGO`,`CONTROLNUMERO`),
  ADD KEY `CONTROLNUMERO` (`CONTROLNUMERO`);

--
-- Indices de la tabla `servicio_mascota`
--
ALTER TABLE `servicio_mascota`
  ADD PRIMARY KEY (`IDMASCOTA`,`CODIGOSERVICIO`),
  ADD KEY `CODIGOSERVICIO` (`CODIGOSERVICIO`),
  ADD KEY `IDVETERINARIO` (`IDVETERINARIO`);

--
-- Indices de la tabla `tblcontrol`
--
ALTER TABLE `tblcontrol`
  ADD PRIMARY KEY (`NUMERO`);

--
-- Indices de la tabla `telefono`
--
ALTER TABLE `telefono`
  ADD PRIMARY KEY (`IDCLIENTE`,`TELEFONO`);

--
-- Indices de la tabla `tipomascota`
--
ALTER TABLE `tipomascota`
  ADD PRIMARY KEY (`RAZAMASCOTA`);

--
-- Indices de la tabla `veterinario`
--
ALTER TABLE `veterinario`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mascota`
--
ALTER TABLE `mascota`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `CODIGO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `tblcontrol`
--
ALTER TABLE `tblcontrol`
  MODIFY `NUMERO` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD CONSTRAINT `direccion_ibfk_1` FOREIGN KEY (`IDCLIENTE`) REFERENCES `cliente` (`ID`);

--
-- Filtros para la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD CONSTRAINT `mascota_ibfk_1` FOREIGN KEY (`IDCLIENTE`) REFERENCES `cliente` (`ID`),
  ADD CONSTRAINT `mascota_ibfk_2` FOREIGN KEY (`RAZA`) REFERENCES `tipomascota` (`RAZAMASCOTA`);

--
-- Filtros para la tabla `servicio_control`
--
ALTER TABLE `servicio_control`
  ADD CONSTRAINT `servicio_control_ibfk_1` FOREIGN KEY (`MASCOTAID`,`SERVICIOCODIGO`) REFERENCES `servicio_mascota` (`IDMASCOTA`, `CODIGOSERVICIO`),
  ADD CONSTRAINT `servicio_control_ibfk_2` FOREIGN KEY (`CONTROLNUMERO`) REFERENCES `tblcontrol` (`NUMERO`);

--
-- Filtros para la tabla `servicio_mascota`
--
ALTER TABLE `servicio_mascota`
  ADD CONSTRAINT `servicio_mascota_ibfk_1` FOREIGN KEY (`IDMASCOTA`) REFERENCES `mascota` (`ID`),
  ADD CONSTRAINT `servicio_mascota_ibfk_2` FOREIGN KEY (`CODIGOSERVICIO`) REFERENCES `servicio` (`CODIGO`),
  ADD CONSTRAINT `servicio_mascota_ibfk_3` FOREIGN KEY (`IDVETERINARIO`) REFERENCES `veterinario` (`ID`);

--
-- Filtros para la tabla `telefono`
--
ALTER TABLE `telefono`
  ADD CONSTRAINT `telefono_ibfk_1` FOREIGN KEY (`IDCLIENTE`) REFERENCES `cliente` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
