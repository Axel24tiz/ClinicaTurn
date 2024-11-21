-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 20-11-2024 a las 01:06:58
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
-- Base de datos: `clinicakrause`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

DROP TABLE IF EXISTS `especialidad`;
CREATE TABLE IF NOT EXISTS `especialidad` (
  `id_especialidad` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_especialidad`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `especialidad`
--

INSERT INTO `especialidad` (`id_especialidad`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Cardiología', '2024-09-22 23:28:48', '2024-09-22 23:28:48'),
(2, 'Dermatología', '2024-09-22 23:28:48', '2024-09-22 23:28:48'),
(3, 'Pediatría', '2024-09-22 23:28:48', '2024-09-22 23:28:48'),
(4, 'Neurología', '2024-09-22 23:28:48', '2024-09-22 23:28:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `feriados`
--

DROP TABLE IF EXISTS `feriados`;
CREATE TABLE IF NOT EXISTS `feriados` (
  `id_feriado` int NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_feriado`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `feriados`
--

INSERT INTO `feriados` (`id_feriado`, `fecha`, `descripcion`) VALUES
(1, '2024-01-01', 'Año Nuevo'),
(2, '2024-03-24', 'Día Nacional de la Memoria por la Verdad y la Justicia'),
(3, '2024-04-18', 'Jueves Santo'),
(4, '2024-04-19', 'Viernes Santo'),
(5, '2024-05-01', 'Día del Trabajador'),
(6, '2024-06-20', 'Día de la Bandera'),
(7, '2024-07-09', 'Día de la Independencia'),
(8, '2024-12-25', 'Navidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horariomedico`
--

DROP TABLE IF EXISTS `horariomedico`;
CREATE TABLE IF NOT EXISTS `horariomedico` (
  `id_horario` int NOT NULL AUTO_INCREMENT,
  `id_medico` int NOT NULL,
  `dia_semana` enum('Lunes','Martes','Miércoles','Jueves','Viernes','Sábado') NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_horario`),
  UNIQUE KEY `id_medico` (`id_medico`,`dia_semana`,`hora_inicio`,`hora_fin`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `horariomedico`
--

INSERT INTO `horariomedico` (`id_horario`, `id_medico`, `dia_semana`, `hora_inicio`, `hora_fin`, `created_at`, `updated_at`) VALUES
(11, 5, 'Lunes', '09:00:00', '13:00:00', '2024-09-22 23:35:34', '2024-09-22 23:35:34'),
(12, 5, 'Miércoles', '14:00:00', '18:00:00', '2024-09-22 23:35:34', '2024-09-22 23:35:34'),
(15, 7, 'Lunes', '08:00:00', '12:00:00', '2024-09-22 23:35:34', '2024-09-22 23:35:34'),
(16, 7, 'Viernes', '13:00:00', '17:00:00', '2024-09-22 23:35:34', '2024-09-22 23:35:34'),
(17, 8, 'Martes', '09:00:00', '12:00:00', '2024-09-22 23:35:34', '2024-09-22 23:35:34'),
(18, 8, 'Jueves', '14:00:00', '18:00:00', '2024-09-22 23:35:34', '2024-09-22 23:35:34'),
(19, 6, 'Lunes', '08:00:00', '12:00:00', '2024-09-23 12:43:25', '2024-09-23 12:43:25'),
(20, 6, 'Martes', '08:00:00', '12:00:00', '2024-09-23 12:43:25', '2024-09-23 12:43:25'),
(21, 6, 'Miércoles', '08:00:00', '12:00:00', '2024-09-23 12:43:25', '2024-09-23 12:43:25'),
(22, 6, 'Jueves', '08:00:00', '12:00:00', '2024-09-23 12:43:25', '2024-09-23 12:43:25'),
(23, 6, 'Viernes', '08:00:00', '12:00:00', '2024-09-23 12:43:25', '2024-09-23 12:43:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico`
--

DROP TABLE IF EXISTS `medico`;
CREATE TABLE IF NOT EXISTS `medico` (
  `id_medico` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `id_especialidad` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_medico`),
  KEY `id_especialidad` (`id_especialidad`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `medico`
--

INSERT INTO `medico` (`id_medico`, `nombre`, `apellido`, `id_especialidad`, `created_at`, `updated_at`) VALUES
(5, 'Ana', 'García', 2, '2024-09-22 23:28:59', '2024-09-22 23:28:59'),
(6, 'Luis', 'Martínez', 3, '2024-09-22 23:28:59', '2024-09-22 23:28:59'),
(7, 'Carlos', 'Sánchez', 4, '2024-09-22 23:28:59', '2024-09-22 23:28:59'),
(8, 'Lucía', 'Fernández', 1, '2024-09-22 23:28:59', '2024-09-22 23:28:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico_obrasocial`
--

DROP TABLE IF EXISTS `medico_obrasocial`;
CREATE TABLE IF NOT EXISTS `medico_obrasocial` (
  `id_medico` int NOT NULL,
  `id_obra_social` int NOT NULL,
  PRIMARY KEY (`id_medico`,`id_obra_social`),
  KEY `id_obra_social` (`id_obra_social`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `medico_obrasocial`
--

INSERT INTO `medico_obrasocial` (`id_medico`, `id_obra_social`) VALUES
(5, 1),
(6, 1),
(8, 1),
(5, 2),
(7, 2),
(6, 3),
(8, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obrasocial`
--

DROP TABLE IF EXISTS `obrasocial`;
CREATE TABLE IF NOT EXISTS `obrasocial` (
  `id_obra_social` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `estado` enum('habilitada','no habilitada') NOT NULL DEFAULT 'habilitada',
  `descuento_porcentaje` decimal(5,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_obra_social`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `obrasocial`
--

INSERT INTO `obrasocial` (`id_obra_social`, `nombre`, `estado`, `descuento_porcentaje`, `created_at`, `updated_at`) VALUES
(1, 'OSDE', 'habilitada', '15.00', '2024-09-22 23:29:27', '2024-09-22 23:29:27'),
(2, 'Swiss Medical', 'habilitada', '10.00', '2024-09-22 23:29:27', '2024-09-22 23:29:27'),
(3, 'Osmedica', 'no habilitada', '0.00', '2024-09-22 23:29:27', '2024-09-22 23:29:27'),
(4, 'Apos', 'habilitada', '20.00', '2024-09-22 23:29:27', '2024-09-22 23:29:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

DROP TABLE IF EXISTS `paciente`;
CREATE TABLE IF NOT EXISTS `paciente` (
  `id_paciente` int NOT NULL AUTO_INCREMENT,
  `dni` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `obra_social_id` int DEFAULT NULL,
  `numero_carnet` varchar(50) DEFAULT NULL,
  `edad` int DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_paciente`),
  UNIQUE KEY `dni` (`dni`),
  KEY `obra_social_id` (`obra_social_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`id_paciente`, `dni`, `nombre`, `apellido`, `obra_social_id`, `numero_carnet`, `edad`, `email`, `telefono`, `created_at`, `updated_at`) VALUES
(1, '30123456', 'María', 'López', 1, '12345', 35, 'maria@example.com', '11223344', '2024-09-22 23:34:06', '2024-09-22 23:34:06'),
(2, '30123457', 'Pedro', 'Gómez', 1, '67890', 28, 'pedro.gomez@example.com', '22334455', '2024-09-22 23:34:06', '2024-09-22 23:34:06'),
(3, '30123458', 'Laura', 'Ramírez', 2, '54321', 42, 'laura.ramirez@example.com', '33445566', '2024-09-22 23:34:06', '2024-09-22 23:34:06'),
(4, '30123459', 'Diego', 'Torres', NULL, '98765', 35, 'diego.torres@example.com', '44556677', '2024-09-22 23:34:06', '2024-09-22 23:34:06'),
(5, '30123460', 'Sofía', 'Vargas', 4, '11223', 30, 'sofia.vargas@example.com', '55667788', '2024-09-22 23:34:06', '2024-09-22 23:34:06'),
(6, '12345678', 'Hortencia', 'Diaz', NULL, NULL, 54, 'mmadvent@gmail.com', '3804119419', '2024-09-23 20:17:03', '2024-09-23 20:17:03'),
(7, '123456789', 'Laura', 'Vidal', 4, '111222', 32, 'lauravidal@example.com', NULL, '2024-09-30 15:23:51', '2024-09-30 15:23:51'),
(8, '987654321', 'Diego', 'López', 2, '333444', 29, 'diegolopez@example.com', NULL, '2024-09-30 15:23:51', '2024-09-30 15:23:51'),
(9, '567891234', 'Ana', 'Martínez', 1, '555666', 35, 'anamartinez@example.com', NULL, '2024-09-30 15:23:51', '2024-09-30 15:23:51'),
(10, '234567891', 'Carlos', 'Pérez', 3, '777888', 38, 'carlosperez@example.com', NULL, '2024-09-30 15:23:51', '2024-09-30 15:23:51'),
(11, '891234567', 'Sofía', 'González', 4, '999000', 27, 'sofiagonzalez@example.com', NULL, '2024-09-30 15:23:51', '2024-09-30 15:23:51'),
(12, '456789123', 'Lucas', 'Rodríguez', 2, '111222', 31, 'lucasrodriguez@example.com', NULL, '2024-09-30 15:23:51', '2024-09-30 15:23:51'),
(13, '789123456', 'Camila', 'Fernández', 1, '333444', 25, 'camilafernandez@example.com', NULL, '2024-09-30 15:23:51', '2024-09-30 15:23:51'),
(14, '345678912', 'Mateo', 'Silva', 3, '555666', 30, 'mateosilva@example.com', NULL, '2024-09-30 15:23:51', '2024-09-30 15:23:51'),
(15, '678912345', 'Victoria', 'Castro', 4, '777888', 28, 'victoriacastro@example.com', NULL, '2024-09-30 15:23:51', '2024-09-30 15:23:51'),
(16, '912345678', 'Benjamin', 'Díaz', 2, '999000', 33, 'benjamindiaz@example.com', NULL, '2024-09-30 15:23:51', '2024-09-30 15:23:51');

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
(3, 26771651, 'nalaniz@gmail.com', 'nelson1', 'Nelson Nicolas', 'ALANIZ', '1978-09-16', 3804672010, '2', 'Pasaje Rioja N339 B Estacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno`
--

DROP TABLE IF EXISTS `turno`;
CREATE TABLE IF NOT EXISTS `turno` (
  `id_turno` int NOT NULL AUTO_INCREMENT,
  `id_paciente` int DEFAULT NULL,
  `id_medico` int DEFAULT NULL,
  `tipo_turno` enum('particular','obra_social') NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `sobre_turno` tinyint(1) DEFAULT '0',
  `estado` enum('pendiente','confirmado','cancelado') DEFAULT 'pendiente',
  `monto_a_pagar` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id_turno`),
  KEY `id_paciente` (`id_paciente`),
  KEY `id_medico` (`id_medico`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `turno`
--

INSERT INTO `turno` (`id_turno`, `id_paciente`, `id_medico`, `tipo_turno`, `fecha`, `hora`, `sobre_turno`, `estado`, `monto_a_pagar`) VALUES
(1, 1, 5, 'particular', '2024-10-01', '10:00:00', 0, 'pendiente', '15000.00'),
(2, 2, 6, 'obra_social', '2024-10-02', '08:00:00', 0, 'confirmado', '7000.00'),
(3, 1, 5, 'particular', '2024-10-01', '11:00:00', 0, 'confirmado', '0.00'),
(4, 4, 5, 'obra_social', '2024-10-01', '08:00:00', 0, 'pendiente', '0.00'),
(5, 2, 5, 'obra_social', '2024-10-09', '08:00:00', 0, 'confirmado', '0.00'),
(6, 8, 5, 'obra_social', '2024-10-09', '18:00:00', 0, 'confirmado', '0.00'),
(7, 7, 5, 'obra_social', '2024-10-07', '11:30:00', 0, 'confirmado', '0.00'),
(8, 1, 5, 'obra_social', '2024-11-04', '08:00:00', 0, 'pendiente', '0.00'),
(9, 7, 5, 'particular', '2024-11-04', '08:00:00', 0, 'pendiente', '0.00'),
(10, 8, 5, 'obra_social', '2024-11-04', '08:30:00', 0, 'confirmado', '0.00'),
(11, 9, 5, 'particular', '2024-11-20', '08:00:00', 0, 'confirmado', '0.00'),
(17, 3, 5, 'particular', '2024-11-06', '08:00:00', 0, 'pendiente', '0.00'),
(19, 1, 5, 'particular', '2024-11-06', '08:00:00', 0, 'pendiente', '0.00'),
(20, 2, 5, 'particular', '2024-11-14', '08:00:00', 0, 'confirmado', '0.00'),
(21, 2, 5, 'particular', '2024-11-14', '08:00:00', 0, 'pendiente', '0.00'),
(22, 10, 5, 'particular', '2024-11-14', '08:30:00', 0, 'confirmado', '0.00'),
(23, 14, 5, 'particular', '2024-11-14', '09:00:00', 0, 'confirmado', '0.00'),
(24, 6, 5, 'particular', '2024-11-11', '08:00:00', 0, 'confirmado', '0.00'),
(25, 14, 5, 'particular', '2024-11-11', '08:00:00', 0, 'confirmado', '0.00'),
(26, 6, 5, 'particular', '2024-11-14', '10:00:00', 0, 'confirmado', '0.00'),
(27, 9, 5, 'particular', '2024-11-12', '08:00:00', 0, 'confirmado', '0.00'),
(28, 4, 5, 'particular', '2024-11-08', '08:00:00', 0, 'pendiente', '0.00'),
(29, 1, 5, 'particular', '2024-11-14', '08:00:00', 1, 'confirmado', '0.00'),
(30, 9, 5, 'particular', '2024-11-14', '10:00:00', 0, 'confirmado', '0.00'),
(31, 8, 5, 'particular', '2024-11-14', '10:00:00', 0, 'confirmado', '0.00'),
(32, 13, 5, 'particular', '2024-11-14', '08:00:00', 1, 'confirmado', '0.00'),
(33, 8, 5, 'particular', '2024-11-12', '08:30:00', 0, 'confirmado', '0.00'),
(34, 8, 5, 'particular', '2024-11-12', '08:30:00', 1, 'confirmado', '0.00'),
(35, 1, 5, 'obra_social', '2024-12-02', '08:00:00', 0, 'pendiente', '0.00'),
(36, 2, 5, 'obra_social', '2024-12-02', '08:30:00', 0, 'confirmado', '0.00'),
(37, 9, 5, 'obra_social', '2024-11-05', '08:00:00', 0, 'confirmado', '0.00'),
(38, 1, 6, 'obra_social', '2024-11-04', '08:00:00', 0, 'confirmado', '0.00'),
(39, 2, 6, 'obra_social', '2024-11-04', '08:30:00', 0, 'confirmado', '0.00');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `medico`
--
ALTER TABLE `medico`
  ADD CONSTRAINT `medico_ibfk_1` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidad` (`id_especialidad`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
