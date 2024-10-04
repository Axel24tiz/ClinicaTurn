CREATE DATABASE clinicakrause;

USE clinicakrause;

DROP TABLE IF EXISTS `especialidad`;
CREATE TABLE IF NOT EXISTS `especialidad` (
  `id_especialidad` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_especialidad`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



INSERT INTO `especialidad` (`id_especialidad`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Cardiología', '2024-09-22 23:28:48', '2024-09-22 23:28:48'),
(2, 'Dermatología', '2024-09-22 23:28:48', '2024-09-22 23:28:48'),
(3, 'Pediatría', '2024-09-22 23:28:48', '2024-09-22 23:28:48'),
(4, 'Neurología', '2024-09-22 23:28:48', '2024-09-22 23:28:48');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



INSERT INTO `medico` (`id_medico`, `nombre`, `apellido`, `id_especialidad`, `created_at`, `updated_at`) VALUES
(5, 'Ana', 'García', 2, '2024-09-22 23:28:59', '2024-09-22 23:28:59'),
(6, 'Luis', 'Martínez', 3, '2024-09-22 23:28:59', '2024-09-22 23:28:59'),
(7, 'Carlos', 'Sánchez', 4, '2024-09-22 23:28:59', '2024-09-22 23:28:59'),
(8, 'Lucía', 'Fernández', 1, '2024-09-22 23:28:59', '2024-09-22 23:28:59');


DROP TABLE IF EXISTS `feriados`;
CREATE TABLE IF NOT EXISTS `feriados` (
  `id_feriado` int NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_feriado`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



INSERT INTO `feriados` (`id_feriado`, `fecha`, `descripcion`) VALUES
(1, '2024-01-01', 'Año Nuevo'),
(2, '2024-03-24', 'Día Nacional de la Memoria por la Verdad y la Justicia'),
(3, '2024-04-18', 'Jueves Santo'),
(4, '2024-04-19', 'Viernes Santo'),
(5, '2024-05-01', 'Día del Trabajador'),
(6, '2024-06-20', 'Día de la Bandera'),
(7, '2024-07-09', 'Día de la Independencia'),
(8, '2024-12-25', 'Navidad');


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



INSERT INTO `obrasocial` (`id_obra_social`, `nombre`, `estado`, `descuento_porcentaje`, `created_at`, `updated_at`) VALUES
(1, 'OSDE', 'habilitada', '15.00', '2024-09-22 23:29:27', '2024-09-22 23:29:27'),
(2, 'Swiss Medical', 'habilitada', '10.00', '2024-09-22 23:29:27', '2024-09-22 23:29:27'),
(3, 'Osmedica', 'no habilitada', '0.00', '2024-09-22 23:29:27', '2024-09-22 23:29:27'),
(4, 'Apos', 'habilitada', '20.00', '2024-09-22 23:29:27', '2024-09-22 23:29:27');

DROP TABLE IF EXISTS `medico_obrasocial`;
CREATE TABLE IF NOT EXISTS `medico_obrasocial` (
  `id_medico` int NOT NULL,
  `id_obra_social` int NOT NULL,
  PRIMARY KEY (`id_medico`,`id_obra_social`),
  KEY `id_obra_social` (`id_obra_social`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO `medico_obrasocial` (`id_medico`, `id_obra_social`) VALUES
(5, 1),
(6, 1),
(8, 1),
(5, 2),
(7, 2),
(6, 3),
(8, 4);


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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



INSERT INTO `paciente` (`id_paciente`, `dni`, `nombre`, `apellido`, `obra_social_id`, `numero_carnet`, `edad`, `email`, `telefono`, `created_at`, `updated_at`) VALUES
(1, '30123456', 'María', 'López', 1, '12345', 35, 'maria@example.com', '11223344', '2024-09-22 23:34:06', '2024-09-22 23:34:06'),
(2, '30123457', 'Pedro', 'Gómez', 1, '67890', 28, 'pedro.gomez@example.com', '22334455', '2024-09-22 23:34:06', '2024-09-22 23:34:06'),
(3, '30123458', 'Laura', 'Ramírez', 2, '54321', 42, 'laura.ramirez@example.com', '33445566', '2024-09-22 23:34:06', '2024-09-22 23:34:06'),
(4, '30123459', 'Diego', 'Torres', NULL, '98765', 35, 'diego.torres@example.com', '44556677', '2024-09-22 23:34:06', '2024-09-22 23:34:06'),
(5, '30123460', 'Sofía', 'Vargas', 4, '11223', 30, 'sofia.vargas@example.com', '55667788', '2024-09-22 23:34:06', '2024-09-22 23:34:06'),
(6, '12345678', 'Hortencia', 'Diaz', NULL, NULL, 54, 'mmadvent@gmail.com', '3804119419', '2024-09-23 20:17:03', '2024-09-23 20:17:03'),
(7, '42058901', 'axel', 'ortiz', NULL, NULL, 25, 'mmadvent@gmail.com', '3804119419', '2024-09-30 23:59:49', '2024-09-30 23:59:49'),
(8, '52043344', 'Thiago', 'Juarez', 4, '466443', 12, 'thiagonce12@gmail.com', '3804217908', '2024-10-01 20:20:07', '2024-10-01 20:20:07');



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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



INSERT INTO `turno` (`id_turno`, `id_paciente`, `id_medico`, `tipo_turno`, `fecha`, `hora`, `sobre_turno`, `estado`, `monto_a_pagar`) VALUES
(1, 1, 5, 'particular', '2024-10-01', '10:00:00', 0, 'pendiente', '15000.00'),
(2, 2, 6, 'obra_social', '2024-10-02', '08:00:00', 0, 'confirmado', '7000.00'),
(4, 7, 5, 'particular', '2024-10-02', '14:00:00', 0, 'pendiente', '15000.00'),
(5, 8, 7, 'obra_social', '2024-10-07', '09:30:00', 0, 'pendiente', '7000.00'),
(6, 8, 6, 'particular', '2024-10-04', '11:30:00', 0, 'pendiente', '15000.00'),
(7, 8, 5, 'obra_social', '2024-10-28', '11:30:00', 0, 'pendiente', '7000.00');


ALTER TABLE `medico`
  ADD CONSTRAINT `medico_ibfk_1` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidad` (`id_especialidad`);
COMMIT;

