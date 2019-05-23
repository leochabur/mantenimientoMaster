-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-04-2019 a las 21:59:21
-- Versión del servidor: 5.5.54-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `gestion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleadores`
--

CREATE TABLE IF NOT EXISTS `empleadores` (
  `id` bigint(20) unsigned NOT NULL,
  `razon_social` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `cuit_cuil` varchar(20) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `www` varchar(45) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `id_estructura` int(11) DEFAULT NULL,
  `color` varchar(45) NOT NULL,
  `usr` varchar(45) NOT NULL,
  `pwd` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_empleadores_1` (`id_estructura`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleadores`
--

INSERT INTO `empleadores` (`id`, `razon_social`, `direccion`, `cuit_cuil`, `telefono`, `mail`, `www`, `activo`, `id_estructura`, `color`, `usr`, `pwd`) VALUES
(1, 'MASTER BUS S.A', 'Dr Salk 243', '30-65276194-4', '03489-448800', 'info@masterbus.net', '', 1, 1, '808080', '', ''),
(3, 'ARCA DE SAN VICENTE', 'Cordoba 272', '30-71090928-4', '', 'turismobrandsen@speedy.com.ar', '', 1, 1, 'FF0000', '', ''),
(4, 'BARADERO TOURS SRL', 'Sanchez de Bustamante 1795', '30-64739423-6', '', 'baraderotours@arnetbiz.com.ar', '', 1, 1, 'FF0000', '', ''),
(6, 'CAMPI BUS SRL', 'Av. Directorio 421', '30-71150738-4', '', 'alfredolojoya@hotmail.com', '', 1, 1, 'FF0000', '', ''),
(10, 'MAROÑO JORGE MANUEL', 'David Prando 768', '20-28768442-9', '', 'maroniobus@yahoo.com.ar', '', 1, 1, 'FF0000', '', ''),
(15, 'MILEOBUS', '', '', '', '', '', 1, 1, 'FF0000', '', ''),
(21, 'MALINTOPI', '', '', '', '', '', 0, 1, 'FF0000', '', ''),
(23, 'TRANSPORTE PILAR SRL', '', '', '', '', '', 1, 1, 'FF0000', '', ''),
(24, 'BASANTE', '', '', '', '', '', 1, 1, 'FF0000', '', ''),
(26, 'CARLOS GARCIA', '', '', '', '', '', 1, 1, 'FF0000', '', ''),
(27, 'Transper', '', '', '', '', '', 1, 1, 'FF0000', '', ''),
(28, 'Walter Viajes', '', '', '', '', '', 1, 1, 'FF0000', '', ''),
(29, 'Quintian', '', '', '', '', '', 1, 1, 'FF0000', '', ''),
(30, 'BASO', '', '', '', '', '', 1, 1, 'FF0000', '', ''),
(31, 'GUILLERMO MENA', '', '', '', '', '', 1, 1, 'FF0000', '', ''),
(32, 'PUERTO DESEADO', '', '', '', '', '', 1, 1, 'FF0000', '', ''),
(38, 'Ciusio', '', '', '', '', '', 1, 1, 'FF0000', '', ''),
(39, 'SURPRISE', '', '', '', '', '', 1, 1, 'FF0000', '', ''),
(40, 'Garcia Gonzalo', '', '', '', '', '', 1, 1, 'FF0000', '', ''),
(41, 'Plusmar', '', '', '', '', '', 1, 1, 'FF0000', '', ''),
(42, 'Autotransporte CITA', 'SIMBRON 5742 DTO 5 CF', '', '', '', '', 1, 1, 'FF0000', '', ''),
(43, 'TRANSPORTES EL LUCERO SRL', '', '', '', '', '', 1, 1, 'FF0000', '', ''),
(44, 'Galdeano Francisco Osvaldo', '', '', '011-15-4028-2507', '', '', 1, 1, 'FF0000', '', ''),
(45, 'Mercedes Bus', 'Mercedes', '', '284*5059', '', '', 1, 1, 'FF0000', '', ''),
(46, 'Rapido Argentino', '', '', '', '', '', 1, 1, 'FF0000', '', ''),
(47, 'Malintopi', '', '', '', '', '', 1, 1, 'FF0000', '', ''),
(48, 'Manuel Tienda Leon', '', '', '', '', '', 1, 1, 'FF0000', '', ''),
(49, 'El Rapido', '', '', '', '', '', 1, 1, 'FF0000', '', ''),
(50, 'Daniel Martin', '', '', '', '', '', 1, 1, 'FF0000', '', ''),
(51, 'Sintra', 'Dr. Salk 243', '', '03489-', '', '', 1, 1, 'FF0000', 'usrsintra', 'sintra'),
(52, 'TRANSPORTE COSTERA SUR SRL', 'BRASIL 433', '', '011-1544037909', '', '', 1, 1, 'FF0000', '', ''),
(53, 'Lobos Bus ', '', '', '', '', '', 1, 1, 'FF0000', '', ''),
(54, 'PCA', 'RICCHIERI 1681', '', '', '', '', 1, 1, 'FF0000', '', ''),
(55, 'BASSO HECTOR', '', '', '', '', '', 1, 1, 'FF0000', '', ''),
(56, 'NUEVO EXPRESO', '', '', '', '', '', 1, 1, 'FF0000', '', ''),
(57, 'VIA BARILOCHE', '', '', '', '', '', 1, 1, 'FF0000', '', ''),
(58, 'Emp. Santa Rita S.R.L', 'Ruta 210 Km 68', '', '', '', '', 1, 1, 'FF0000', '', ''),
(59, 'Transporte Alvarez S.A', '', '', '011 - 15 - 23562372', '', '', 1, 1, 'FF0000', '', ''),
(60, 'Almendra Oscar Osvaldo', 'Soberanía Argentina 04', '', '', '', '', 1, 1, 'FF0000', '', ''),
(61, 'LOBOS BUS', '', '', '', '', '', 1, 1, 'FF0000', '', ''),
(62, 'Billoch', '', '', '', '', '', 1, 1, 'FF0000', '', ''),
(63, 'TURISMO YRIGOYEN', '', '', '', '', '', 1, 1, 'FF0000', '', ''),
(64, 'MITUR SRL', '', '', '', '', '', 1, 1, 'FF0000', '', ''),
(65, 'Luis Podesta', '', '', '', '', '', 1, 1, 'FF0000', '', ''),
(66, 'TURISMO CLAUDIO Y LEO', 'LANUS', '', '', '', '', 1, 1, 'FF0000', '', ''),
(67, 'INDIGO EXPRESS SRL', 'CALLE 7 618 MERCEDES', '', '0232415471976', '', '', 1, 1, 'FF0000', '', ''),
(68, 'ABBRUZZI LEONARDO JUAN', 'TUYUTI 1432 LANUS', '', '42090020', '', '', 1, 1, 'FF0000', '', ''),
(69, 'VENTUR S.R.L.', '13 DE DICIEMBRE 32', '', '', '', '', 1, 5, 'FF0000', '', ''),
(70, 'VENTUR S.R.L.', '13 DE DICIEMBRE 32', '', '', '', '', 1, 1, 'FF0000', '', ''),
(71, 'Fanti Tours SRL', 'Av. Galicia 2341, Santa Fe', '', '4602535', '', '', 1, 1, 'FF0000', '', ''),
(72, 'TRANSPORTES CEFERINO', 'GAIMAN CHUBUT', '', '', '', '', 1, 1, 'FF0000', '', ''),
(73, 'Espinosa Claudio', '', '', '', '', '', 1, 1, 'FF0000', '', ''),
(74, 'Expreso Pilar', '', '', '', '', '', 1, 1, 'FF0000', '', ''),
(75, 'Manuel Tienda Leon', '', '', '', '', '', 1, 1, 'FF0000', '', ''),
(76, 'Greacy Empresa de TTE Viajes y Tur', 'Parana 539 Piso 6 Dtpto 38', '', '3424898289', '', '', 1, 1, 'FF0000', '', ''),
(77, 'Tejera Juan', '', '', '', '', '', 1, 1, 'FF0000', '', ''),
(78, 'LA NUEVA MERCEDES BUS ', 'MERCEDES ', '', '00', '', '', 1, 1, 'FF0000', '', ''),
(79, 'Talka Minera S. A', 'Gob Gregores', '', '000000000000000', '', '', 1, 1, 'FF0000', '', ''),
(80, 'Talka Minera S. A', 'Gob. Gregores', '', '000', '', '', 1, 2, 'FF0000', '', '');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empleadores`
--
ALTER TABLE `empleadores`
  ADD CONSTRAINT `FK_8AD8F848FFABC0C8` FOREIGN KEY (`id_estructura`) REFERENCES `estructuras` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
