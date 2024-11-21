-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 01-11-2024 a las 05:11:22
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `clinica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

DROP TABLE IF EXISTS `personal`;
CREATE TABLE IF NOT EXISTS `personal` (
  `id_personal` int NOT NULL AUTO_INCREMENT,
  `dni_personal` int NOT NULL,
  `email_personal` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `clave` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `nombre_personal` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellido_personal` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `fecha_n_personal` date NOT NULL,
  `tel_personal` bigint NOT NULL,
  `rol_personal` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `direccion_personal` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id_personal`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id_personal`, `dni_personal`, `email_personal`, `clave`, `nombre_personal`, `apellido_personal`, `fecha_n_personal`, `tel_personal`, `rol_personal`, `direccion_personal`) VALUES
(1, 123, 'admin@gmail.com', '123', 'Admin', 'ADMIN', '0000-00-00', 0, '', ''),
(3, 26771651, 'nalaniz@gmail.com', 'nelson1', 'Nelson Nicolas', 'ALANIZ', '1978-09-16', 3804672010, '2', 'Pasaje Rioja N339 B Estacion'),
(9, 26158495, 'jtorres@gmail.com', 'torres1', 'Torres', 'JUAN CARLOS', '1979-08-23', 3804956251, '4', 'Su Casa'),
(7, 23456789, 'marta@gmail.com', '23456789', 'Marta', 'LUNA', '2003-09-11', 54923454656, '2', 'Pelagio B Luna 1435'),
(8, 30568921, 'mdiaz@gmail.com', 'maria1', 'Maria Lourdes', 'DIAZ', '1990-09-16', 3804695216, '4', 'Su Casa'),
(10, 2147483647, 'jperez@gmail.com', '99999999222', 'Juan', 'PEREZ', '2003-01-01', 3804672010, '2', 'Su Casa'),
(11, 89674523, 'benites@gmail.com', '89674523', 'Susana', 'BENITEZ', '1960-01-01', 12348890, '3', 'Dardo Rocha 3369');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesional`
--

DROP TABLE IF EXISTS `profesional`;
CREATE TABLE IF NOT EXISTS `profesional` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dniProf` int DEFAULT NULL,
  `abreviaturaProf` char(4) DEFAULT NULL,
  `apellidoProf` varchar(50) DEFAULT NULL,
  `nombreProf` varchar(50) DEFAULT NULL,
  `especialidad` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `profesional`
--

INSERT INTO `profesional` (`id`, `dniProf`, `abreviaturaProf`, `apellidoProf`, `nombreProf`, `especialidad`) VALUES
(2, 37771321, 'Dr.', 'Maidana', 'Carla', 'Oftalmólogo'),
(3, 21436576, 'Dr.', 'Perea', 'Alberto Nicolas', 'Oftalmólogo'),
(5, 26771651, 'Dr.', 'Alaniz', 'Nelson N.', 'Oftalmólogo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

DROP TABLE IF EXISTS `turnos`;
CREATE TABLE IF NOT EXISTS `turnos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `medico_id` int DEFAULT NULL,
  `paciente_nombre` varchar(255) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `motivo` varchar(255) DEFAULT NULL,
  `estado` enum('Pendiente','Confirmado','Cancelado') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'Pendiente',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`id`, `medico_id`, `paciente_nombre`, `fecha`, `hora`, `motivo`, `estado`) VALUES
(1, 3, 'nelson', '2024-10-26', '09:00:00', 'consulta', 'Pendiente'),
(2, 2, 'nicolas', '2024-09-26', '10:00:27', 'consulta', 'Pendiente'),
(3, 2, 'gustavo', '2024-09-30', '08:00:00', 'consulta', 'Pendiente'),
(4, 5, 'prueba 2', '2024-09-30', '15:00:01', 'consulta', 'Pendiente'),
(5, 2, 'prueba tres', '2024-10-01', '15:00:00', 'consulta', 'Pendiente'),
(6, 3, 'gustavo', '2024-10-03', '08:00:00', NULL, 'Pendiente'),
(7, 3, 'nicolas', '2024-09-20', '14:00:00', NULL, 'Pendiente'),
(8, 2, 'frfdedf edfede', '2024-09-27', '19:00:00', 'frfde frfrfrfde dede', 'Pendiente'),
(9, 5, 'prueba defecha', '2024-09-12', '08:00:00', 'otra prueba', 'Pendiente');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
