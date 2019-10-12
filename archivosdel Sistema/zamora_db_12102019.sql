-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-10-2019 a las 09:19:41
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `zamora_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aportaciones`
--

CREATE TABLE `aportaciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `idsocio` int(10) UNSIGNED NOT NULL,
  `idusuario` int(10) UNSIGNED NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `fecharegistro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Nuevo Aporte',
  `tasa` decimal(4,2) NOT NULL,
  `estado` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `aportaciones`
--

INSERT INTO `aportaciones` (`id`, `idsocio`, `idusuario`, `monto`, `fecharegistro`, `descripcion`, `tasa`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1000.00', '2019-10-07 20:41:02', 'Aporte', '12.00', '1', '2019-10-08 06:41:02', '2019-10-08 06:41:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `creditos`
--

CREATE TABLE `creditos` (
  `id` int(10) UNSIGNED NOT NULL,
  `idsocio` int(10) UNSIGNED NOT NULL,
  `idgarante` int(10) UNSIGNED NOT NULL,
  `idusuario` int(10) UNSIGNED NOT NULL,
  `numeroprestamo` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montodesembolsado` decimal(10,2) NOT NULL,
  `fechadesembolso` date NOT NULL,
  `numerocuotas` int(11) NOT NULL,
  `tipocambio` decimal(7,6) NOT NULL,
  `tasa` decimal(4,2) NOT NULL,
  `interes` decimal(10,2) NOT NULL,
  `estado` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estadodesembolso` char(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `periodo` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `creditos`
--

INSERT INTO `creditos` (`id`, `idsocio`, `idgarante`, `idusuario`, `numeroprestamo`, `montodesembolsado`, `fechadesembolso`, `numerocuotas`, `tipocambio`, `tasa`, `interes`, `estado`, `estadodesembolso`, `periodo`, `created_at`, `updated_at`) VALUES
(1, 5, 5, 5, 'CZ-00001', '5000.00', '2019-10-07', 12, '3.350000', '13.00', '0.00', '1', '0', '1', '2019-10-07 22:14:59', '2019-10-07 22:14:59'),
(2, 1, 1, 1, 'CZ-00002', '1000.00', '2019-09-01', 12, '3.350000', '13.00', '0.00', '1', '0', '1', '2019-10-08 02:59:22', '2019-10-08 02:59:22'),
(3, 17, 17, 17, 'CZ-0003', '1000.00', '2019-09-01', 12, '3.350000', '1.80', '0.00', '1', '0', '1', '2019-10-08 06:49:31', '2019-10-08 06:49:31'),
(4, 8, 8, 8, 'CZ-05', '1000.00', '2019-09-01', 12, '3.350000', '13.00', '0.00', '1', '0', '12', '2019-10-12 09:21:20', '2019-10-12 09:21:20'),
(6, 3, 3, 3, 'CZ-05s', '1000.00', '2019-09-01', 12, '3.350000', '13.00', '67.78', '1', '0', '12', '2019-10-12 09:50:26', '2019-10-12 09:50:26'),
(7, 4, 4, 4, 'CZ000006', '1000.00', '2019-09-01', 12, '3.350000', '13.00', '67.78', '1', '0', '12', '2019-10-12 10:25:46', '2019-10-12 10:25:46'),
(8, 9, 9, 9, 'CZ000007', '1000.00', '2019-09-01', 12, '3.350000', '13.00', '1027.83', '1', '0', '1', '2019-10-12 10:28:36', '2019-10-12 10:28:36'),
(9, 7, 7, 7, 'CZ000008', '1000.00', '2019-09-01', 12, '3.350000', '13.00', '1027.83', '1', '0', '1', '2019-10-12 10:32:13', '2019-10-12 10:32:13'),
(10, 10, 10, 10, 'CZ000009', '1000.00', '2019-09-01', 12, '3.350000', '13.00', '1027.83', '1', '0', '12', '2019-10-12 11:30:58', '2019-10-12 11:30:58'),
(11, 16, 19, 16, 'CZ000010', '1000.00', '2019-09-01', 12, '3.350000', '13.00', '1027.83', '1', '0', '12', '2019-10-12 11:32:37', '2019-10-12 11:32:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentaahorros`
--

CREATE TABLE `cuentaahorros` (
  `id` int(10) UNSIGNED NOT NULL,
  `idsocio` int(10) UNSIGNED NOT NULL,
  `idusuario` int(10) UNSIGNED NOT NULL,
  `numerocuenta` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saldoefectivo` decimal(10,2) NOT NULL,
  `fechaapertura` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ultimomovimiento` int(11) NOT NULL DEFAULT '1' COMMENT 'idmovimiento',
  `descripcion` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Nueva cuenta de ahorros',
  `tasa` decimal(4,2) NOT NULL,
  `estado` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cuentaahorros`
--

INSERT INTO `cuentaahorros` (`id`, `idsocio`, `idusuario`, `numerocuenta`, `saldoefectivo`, `fechaapertura`, `ultimomovimiento`, `descripcion`, `tasa`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'C-00001', '10000.00', '2019-10-07 20:55:39', 1, 'Nueva Cuenta', '1.00', '1', '2019-10-08 06:55:39', '2019-10-08 06:55:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuotas`
--

CREATE TABLE `cuotas` (
  `id` int(10) UNSIGNED NOT NULL,
  `numerodecuota` int(11) NOT NULL,
  `idcajero` int(10) UNSIGNED NOT NULL,
  `idcredito` int(10) UNSIGNED NOT NULL,
  `fechapago` date NOT NULL,
  `fechacancelo` datetime DEFAULT NULL,
  `monto` decimal(7,2) NOT NULL,
  `interes` decimal(10,2) NOT NULL,
  `amortizacion` decimal(10,2) NOT NULL,
  `saldopendiente` decimal(12,2) NOT NULL,
  `mora` decimal(12,2) NOT NULL DEFAULT '0.00',
  `descripcion` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cuotas`
--

INSERT INTO `cuotas` (`id`, `numerodecuota`, `idcajero`, `idcredito`, `fechapago`, `fechacancelo`, `monto`, `interes`, `amortizacion`, `saldopendiente`, `mora`, `descripcion`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 1, '2019-11-07', NULL, '416.67', '0.00', '0.00', '4583.33', '0.00', 'Debe', '0', '2019-10-07 22:14:59', '2019-10-07 22:14:59'),
(2, 2, 5, 1, '2019-12-07', NULL, '416.67', '0.00', '0.00', '4166.66', '0.00', 'Debe', '0', '2019-10-07 22:14:59', '2019-10-07 22:14:59'),
(3, 3, 5, 1, '2020-01-07', NULL, '416.67', '0.00', '0.00', '3749.99', '0.00', 'Debe', '0', '2019-10-07 22:14:59', '2019-10-07 22:14:59'),
(4, 4, 5, 1, '2020-02-07', NULL, '416.67', '0.00', '0.00', '3333.32', '0.00', 'Debe', '0', '2019-10-07 22:15:00', '2019-10-07 22:15:00'),
(5, 5, 5, 1, '2020-03-07', NULL, '416.67', '0.00', '0.00', '2916.65', '0.00', 'Debe', '0', '2019-10-07 22:15:00', '2019-10-07 22:15:00'),
(6, 6, 5, 1, '2020-04-07', NULL, '416.67', '0.00', '0.00', '2499.98', '0.00', 'Debe', '0', '2019-10-07 22:15:00', '2019-10-07 22:15:00'),
(7, 7, 5, 1, '2020-05-07', NULL, '416.67', '0.00', '0.00', '2083.31', '0.00', 'Debe', '0', '2019-10-07 22:15:00', '2019-10-07 22:15:00'),
(8, 8, 5, 1, '2020-06-07', NULL, '416.67', '0.00', '0.00', '1666.64', '0.00', 'Debe', '0', '2019-10-07 22:15:00', '2019-10-07 22:15:00'),
(9, 9, 5, 1, '2020-07-07', NULL, '416.67', '0.00', '0.00', '1249.97', '0.00', 'Debe', '0', '2019-10-07 22:15:00', '2019-10-07 22:15:00'),
(10, 10, 5, 1, '2020-08-07', NULL, '416.67', '0.00', '0.00', '833.30', '0.00', 'Debe', '0', '2019-10-07 22:15:00', '2019-10-07 22:15:00'),
(11, 11, 5, 1, '2020-09-07', NULL, '416.67', '0.00', '0.00', '416.63', '0.00', 'Debe', '0', '2019-10-07 22:15:00', '2019-10-07 22:15:00'),
(12, 12, 5, 1, '2020-10-07', NULL, '416.67', '0.00', '0.00', '0.00', '0.00', 'Debe', '0', '2019-10-07 22:15:00', '2019-10-07 22:15:00'),
(13, 1, 1, 2, '2019-10-01', NULL, '83.33', '0.00', '0.00', '916.67', '0.00', 'Debe', '0', '2019-10-08 02:59:22', '2019-10-08 02:59:22'),
(14, 2, 1, 2, '2019-11-01', NULL, '83.33', '0.00', '0.00', '833.34', '0.00', 'Debe', '0', '2019-10-08 02:59:22', '2019-10-08 02:59:22'),
(15, 3, 1, 2, '2019-12-01', NULL, '83.33', '0.00', '0.00', '750.01', '0.00', 'Debe', '0', '2019-10-08 02:59:22', '2019-10-08 02:59:22'),
(16, 4, 1, 2, '2020-01-01', NULL, '83.33', '0.00', '0.00', '666.68', '0.00', 'Debe', '0', '2019-10-08 02:59:22', '2019-10-08 02:59:22'),
(17, 5, 1, 2, '2020-02-01', NULL, '83.33', '0.00', '0.00', '583.35', '0.00', 'Debe', '0', '2019-10-08 02:59:22', '2019-10-08 02:59:22'),
(18, 6, 1, 2, '2020-03-01', NULL, '83.33', '0.00', '0.00', '500.02', '0.00', 'Debe', '0', '2019-10-08 02:59:22', '2019-10-08 02:59:22'),
(19, 7, 1, 2, '2020-04-01', NULL, '83.33', '0.00', '0.00', '416.69', '0.00', 'Debe', '0', '2019-10-08 02:59:22', '2019-10-08 02:59:22'),
(20, 8, 1, 2, '2020-05-01', NULL, '83.33', '0.00', '0.00', '333.36', '0.00', 'Debe', '0', '2019-10-08 02:59:22', '2019-10-08 02:59:22'),
(21, 9, 1, 2, '2020-06-01', NULL, '83.33', '0.00', '0.00', '250.03', '0.00', 'Debe', '0', '2019-10-08 02:59:22', '2019-10-08 02:59:22'),
(22, 10, 1, 2, '2020-07-01', NULL, '83.33', '0.00', '0.00', '166.70', '0.00', 'Debe', '0', '2019-10-08 02:59:22', '2019-10-08 02:59:22'),
(23, 11, 1, 2, '2020-08-01', NULL, '83.33', '0.00', '0.00', '83.37', '0.00', 'Debe', '0', '2019-10-08 02:59:22', '2019-10-08 02:59:22'),
(24, 12, 1, 2, '2020-09-01', NULL, '83.33', '0.00', '0.00', '0.00', '0.00', 'Debe', '0', '2019-10-08 02:59:22', '2019-10-08 02:59:22'),
(25, 1, 17, 3, '2019-10-01', NULL, '83.33', '0.00', '0.00', '916.67', '0.00', 'Debe', '0', '2019-10-08 06:49:31', '2019-10-08 06:49:31'),
(26, 2, 17, 3, '2019-11-01', NULL, '83.33', '0.00', '0.00', '833.34', '0.00', 'Debe', '0', '2019-10-08 06:49:31', '2019-10-08 06:49:31'),
(27, 3, 17, 3, '2019-12-01', NULL, '83.33', '0.00', '0.00', '750.01', '0.00', 'Debe', '0', '2019-10-08 06:49:31', '2019-10-08 06:49:31'),
(28, 4, 17, 3, '2020-01-01', NULL, '83.33', '0.00', '0.00', '666.68', '0.00', 'Debe', '0', '2019-10-08 06:49:31', '2019-10-08 06:49:31'),
(29, 5, 17, 3, '2020-02-01', NULL, '83.33', '0.00', '0.00', '583.35', '0.00', 'Debe', '0', '2019-10-08 06:49:31', '2019-10-08 06:49:31'),
(30, 6, 17, 3, '2020-03-01', NULL, '83.33', '0.00', '0.00', '500.02', '0.00', 'Debe', '0', '2019-10-08 06:49:31', '2019-10-08 06:49:31'),
(31, 7, 17, 3, '2020-04-01', NULL, '83.33', '0.00', '0.00', '416.69', '0.00', 'Debe', '0', '2019-10-08 06:49:31', '2019-10-08 06:49:31'),
(32, 8, 17, 3, '2020-05-01', NULL, '83.33', '0.00', '0.00', '333.36', '0.00', 'Debe', '0', '2019-10-08 06:49:31', '2019-10-08 06:49:31'),
(33, 9, 17, 3, '2020-06-01', NULL, '83.33', '0.00', '0.00', '250.03', '0.00', 'Debe', '0', '2019-10-08 06:49:31', '2019-10-08 06:49:31'),
(34, 10, 17, 3, '2020-07-01', NULL, '83.33', '0.00', '0.00', '166.70', '0.00', 'Debe', '0', '2019-10-08 06:49:31', '2019-10-08 06:49:31'),
(35, 11, 17, 3, '2020-08-01', NULL, '83.33', '0.00', '0.00', '83.37', '0.00', 'Debe', '0', '2019-10-08 06:49:31', '2019-10-08 06:49:31'),
(36, 12, 17, 3, '2020-09-01', NULL, '83.33', '0.00', '0.00', '0.00', '0.00', 'Debe', '0', '2019-10-08 06:49:31', '2019-10-08 06:49:31'),
(37, 1, 8, 4, '2019-10-01', NULL, '88.98', '10.24', '78.74', '921.26', '0.00', 'Debe', '0', '2019-10-12 09:21:20', '2019-10-12 09:21:20'),
(38, 2, 8, 4, '2019-11-01', NULL, '88.98', '9.43', '79.55', '841.70', '0.00', 'Debe', '0', '2019-10-12 09:21:20', '2019-10-12 09:21:20'),
(39, 3, 8, 4, '2019-12-01', NULL, '88.98', '8.62', '80.37', '761.34', '0.00', 'Debe', '0', '2019-10-12 09:21:20', '2019-10-12 09:21:20'),
(40, 4, 8, 4, '2020-01-01', NULL, '88.98', '7.79', '81.19', '680.15', '0.00', 'Debe', '0', '2019-10-12 09:21:20', '2019-10-12 09:21:20'),
(41, 5, 8, 4, '2020-02-01', NULL, '88.98', '6.96', '82.02', '598.13', '0.00', 'Debe', '0', '2019-10-12 09:21:20', '2019-10-12 09:21:20'),
(42, 6, 8, 4, '2020-03-01', NULL, '88.98', '6.12', '82.86', '515.27', '0.00', 'Debe', '0', '2019-10-12 09:21:20', '2019-10-12 09:21:20'),
(43, 7, 8, 4, '2020-04-01', NULL, '88.98', '5.27', '83.71', '431.57', '0.00', 'Debe', '0', '2019-10-12 09:21:20', '2019-10-12 09:21:20'),
(44, 8, 8, 4, '2020-05-01', NULL, '88.98', '4.42', '84.56', '347.00', '0.00', 'Debe', '0', '2019-10-12 09:21:20', '2019-10-12 09:21:20'),
(45, 9, 8, 4, '2020-06-01', NULL, '88.98', '3.55', '85.43', '261.57', '0.00', 'Debe', '0', '2019-10-12 09:21:20', '2019-10-12 09:21:20'),
(46, 10, 8, 4, '2020-07-01', NULL, '88.98', '2.68', '86.30', '175.27', '0.00', 'Debe', '0', '2019-10-12 09:21:20', '2019-10-12 09:21:20'),
(47, 11, 8, 4, '2020-08-01', NULL, '88.98', '1.79', '87.19', '88.08', '0.00', 'Debe', '0', '2019-10-12 09:21:20', '2019-10-12 09:21:20'),
(48, 12, 8, 4, '2020-09-01', NULL, '88.98', '0.90', '88.08', '0.00', '0.00', 'Debe', '0', '2019-10-12 09:21:20', '2019-10-12 09:21:20'),
(61, 1, 3, 6, '2019-10-01', NULL, '88.98', '10.24', '78.74', '921.26', '0.00', 'Debe', '0', '2019-10-12 09:50:26', '2019-10-12 09:50:26'),
(62, 2, 3, 6, '2019-11-01', NULL, '88.98', '9.43', '79.55', '841.70', '0.00', 'Debe', '0', '2019-10-12 09:50:26', '2019-10-12 09:50:26'),
(63, 3, 3, 6, '2019-12-01', NULL, '88.98', '8.62', '80.37', '761.34', '0.00', 'Debe', '0', '2019-10-12 09:50:26', '2019-10-12 09:50:26'),
(64, 4, 3, 6, '2020-01-01', NULL, '88.98', '7.79', '81.19', '680.15', '0.00', 'Debe', '0', '2019-10-12 09:50:26', '2019-10-12 09:50:26'),
(65, 5, 3, 6, '2020-02-01', NULL, '88.98', '6.96', '82.02', '598.13', '0.00', 'Debe', '0', '2019-10-12 09:50:26', '2019-10-12 09:50:26'),
(66, 6, 3, 6, '2020-03-01', NULL, '88.98', '6.12', '82.86', '515.27', '0.00', 'Debe', '0', '2019-10-12 09:50:26', '2019-10-12 09:50:26'),
(67, 7, 3, 6, '2020-04-01', NULL, '88.98', '5.27', '83.71', '431.57', '0.00', 'Debe', '0', '2019-10-12 09:50:26', '2019-10-12 09:50:26'),
(68, 8, 3, 6, '2020-05-01', NULL, '88.98', '4.42', '84.56', '347.00', '0.00', 'Debe', '0', '2019-10-12 09:50:26', '2019-10-12 09:50:26'),
(69, 9, 3, 6, '2020-06-01', NULL, '88.98', '3.55', '85.43', '261.57', '0.00', 'Debe', '0', '2019-10-12 09:50:26', '2019-10-12 09:50:26'),
(70, 10, 3, 6, '2020-07-01', NULL, '88.98', '2.68', '86.30', '175.27', '0.00', 'Debe', '0', '2019-10-12 09:50:26', '2019-10-12 09:50:26'),
(71, 11, 3, 6, '2020-08-01', NULL, '88.98', '1.79', '87.19', '88.08', '0.00', 'Debe', '0', '2019-10-12 09:50:26', '2019-10-12 09:50:26'),
(72, 12, 3, 6, '2020-09-01', NULL, '88.98', '0.90', '88.08', '0.00', '0.00', 'Debe', '0', '2019-10-12 09:50:26', '2019-10-12 09:50:26'),
(73, 1, 4, 7, '2019-10-01', NULL, '88.98', '10.24', '78.74', '921.26', '0.00', 'Debe', '0', '2019-10-12 10:25:46', '2019-10-12 10:25:46'),
(74, 2, 4, 7, '2019-11-01', NULL, '88.98', '9.43', '79.55', '841.70', '0.00', 'Debe', '0', '2019-10-12 10:25:46', '2019-10-12 10:25:46'),
(75, 3, 4, 7, '2019-12-01', NULL, '88.98', '8.62', '80.37', '761.34', '0.00', 'Debe', '0', '2019-10-12 10:25:46', '2019-10-12 10:25:46'),
(76, 4, 4, 7, '2020-01-01', NULL, '88.98', '7.79', '81.19', '680.15', '0.00', 'Debe', '0', '2019-10-12 10:25:46', '2019-10-12 10:25:46'),
(77, 5, 4, 7, '2020-02-01', NULL, '88.98', '6.96', '82.02', '598.13', '0.00', 'Debe', '0', '2019-10-12 10:25:46', '2019-10-12 10:25:46'),
(78, 6, 4, 7, '2020-03-01', NULL, '88.98', '6.12', '82.86', '515.27', '0.00', 'Debe', '0', '2019-10-12 10:25:46', '2019-10-12 10:25:46'),
(79, 7, 4, 7, '2020-04-01', NULL, '88.98', '5.27', '83.71', '431.57', '0.00', 'Debe', '0', '2019-10-12 10:25:46', '2019-10-12 10:25:46'),
(80, 8, 4, 7, '2020-05-01', NULL, '88.98', '4.42', '84.56', '347.00', '0.00', 'Debe', '0', '2019-10-12 10:25:46', '2019-10-12 10:25:46'),
(81, 9, 4, 7, '2020-06-01', NULL, '88.98', '3.55', '85.43', '261.57', '0.00', 'Debe', '0', '2019-10-12 10:25:46', '2019-10-12 10:25:46'),
(82, 10, 4, 7, '2020-07-01', NULL, '88.98', '2.68', '86.30', '175.27', '0.00', 'Debe', '0', '2019-10-12 10:25:46', '2019-10-12 10:25:46'),
(83, 11, 4, 7, '2020-08-01', NULL, '88.98', '1.79', '87.19', '88.08', '0.00', 'Debe', '0', '2019-10-12 10:25:46', '2019-10-12 10:25:46'),
(84, 12, 4, 7, '2020-09-01', NULL, '88.98', '0.90', '88.08', '0.00', '0.00', 'Debe', '0', '2019-10-12 10:25:46', '2019-10-12 10:25:46'),
(85, 1, 9, 8, '2020-09-01', NULL, '168.99', '130.00', '38.99', '961.01', '0.00', 'Debe', '0', '2019-10-12 10:28:36', '2019-10-12 10:28:36'),
(86, 2, 9, 8, '2021-09-01', NULL, '168.99', '124.93', '44.05', '916.96', '0.00', 'Debe', '0', '2019-10-12 10:28:36', '2019-10-12 10:28:36'),
(87, 3, 9, 8, '2022-09-01', NULL, '168.99', '119.20', '49.78', '867.18', '0.00', 'Debe', '0', '2019-10-12 10:28:36', '2019-10-12 10:28:36'),
(88, 4, 9, 8, '2023-09-01', NULL, '168.99', '112.73', '56.25', '810.93', '0.00', 'Debe', '0', '2019-10-12 10:28:36', '2019-10-12 10:28:36'),
(89, 5, 9, 8, '2024-09-01', NULL, '168.99', '105.42', '63.57', '747.36', '0.00', 'Debe', '0', '2019-10-12 10:28:36', '2019-10-12 10:28:36'),
(90, 6, 9, 8, '2025-09-01', NULL, '168.99', '97.16', '71.83', '675.53', '0.00', 'Debe', '0', '2019-10-12 10:28:36', '2019-10-12 10:28:36'),
(91, 7, 9, 8, '2026-09-01', NULL, '168.99', '87.82', '81.17', '594.36', '0.00', 'Debe', '0', '2019-10-12 10:28:36', '2019-10-12 10:28:36'),
(92, 8, 9, 8, '2027-09-01', NULL, '168.99', '77.27', '91.72', '502.64', '0.00', 'Debe', '0', '2019-10-12 10:28:36', '2019-10-12 10:28:36'),
(93, 9, 9, 8, '2028-09-01', NULL, '168.99', '65.34', '103.64', '399.00', '0.00', 'Debe', '0', '2019-10-12 10:28:36', '2019-10-12 10:28:36'),
(94, 10, 9, 8, '2029-09-01', NULL, '168.99', '51.87', '117.12', '281.89', '0.00', 'Debe', '0', '2019-10-12 10:28:36', '2019-10-12 10:28:36'),
(95, 11, 9, 8, '2030-09-01', NULL, '168.99', '36.65', '132.34', '149.55', '0.00', 'Debe', '0', '2019-10-12 10:28:36', '2019-10-12 10:28:36'),
(96, 12, 9, 8, '2031-09-01', NULL, '168.99', '19.44', '149.55', '0.00', '0.00', 'Debe', '0', '2019-10-12 10:28:36', '2019-10-12 10:28:36'),
(97, 1, 7, 9, '2020-09-01', NULL, '168.99', '130.00', '38.99', '961.01', '0.00', 'Debe', '0', '2019-10-12 10:32:13', '2019-10-12 10:32:13'),
(98, 2, 7, 9, '2021-09-01', NULL, '168.99', '124.93', '44.05', '916.96', '0.00', 'Debe', '0', '2019-10-12 10:32:13', '2019-10-12 10:32:13'),
(99, 3, 7, 9, '2022-09-01', NULL, '168.99', '119.20', '49.78', '867.18', '0.00', 'Debe', '0', '2019-10-12 10:32:13', '2019-10-12 10:32:13'),
(100, 4, 7, 9, '2023-09-01', NULL, '168.99', '112.73', '56.25', '810.93', '0.00', 'Debe', '0', '2019-10-12 10:32:13', '2019-10-12 10:32:13'),
(101, 5, 7, 9, '2024-09-01', NULL, '168.99', '105.42', '63.57', '747.36', '0.00', 'Debe', '0', '2019-10-12 10:32:13', '2019-10-12 10:32:13'),
(102, 6, 7, 9, '2025-09-01', NULL, '168.99', '97.16', '71.83', '675.53', '0.00', 'Debe', '0', '2019-10-12 10:32:13', '2019-10-12 10:32:13'),
(103, 7, 7, 9, '2026-09-01', NULL, '168.99', '87.82', '81.17', '594.36', '0.00', 'Debe', '0', '2019-10-12 10:32:13', '2019-10-12 10:32:13'),
(104, 8, 7, 9, '2027-09-01', NULL, '168.99', '77.27', '91.72', '502.64', '0.00', 'Debe', '0', '2019-10-12 10:32:13', '2019-10-12 10:32:13'),
(105, 9, 7, 9, '2028-09-01', NULL, '168.99', '65.34', '103.64', '399.00', '0.00', 'Debe', '0', '2019-10-12 10:32:13', '2019-10-12 10:32:13'),
(106, 10, 7, 9, '2029-09-01', NULL, '168.99', '51.87', '117.12', '281.89', '0.00', 'Debe', '0', '2019-10-12 10:32:13', '2019-10-12 10:32:13'),
(107, 11, 7, 9, '2030-09-01', NULL, '168.99', '36.65', '132.34', '149.55', '0.00', 'Debe', '0', '2019-10-12 10:32:13', '2019-10-12 10:32:13'),
(108, 12, 7, 9, '2031-09-01', NULL, '168.99', '19.44', '149.55', '0.00', '0.00', 'Debe', '0', '2019-10-12 10:32:13', '2019-10-12 10:32:13'),
(109, 1, 10, 10, '2020-09-01', NULL, '168.99', '130.00', '38.99', '961.01', '0.00', 'Debe', '0', '2019-10-12 11:30:58', '2019-10-12 11:30:58'),
(110, 2, 10, 10, '2021-09-01', NULL, '168.99', '124.93', '44.05', '916.96', '0.00', 'Debe', '0', '2019-10-12 11:30:58', '2019-10-12 11:30:58'),
(111, 3, 10, 10, '2022-09-01', NULL, '168.99', '119.20', '49.78', '867.18', '0.00', 'Debe', '0', '2019-10-12 11:30:58', '2019-10-12 11:30:58'),
(112, 4, 10, 10, '2023-09-01', NULL, '168.99', '112.73', '56.25', '810.93', '0.00', 'Debe', '0', '2019-10-12 11:30:58', '2019-10-12 11:30:58'),
(113, 5, 10, 10, '2024-09-01', NULL, '168.99', '105.42', '63.57', '747.36', '0.00', 'Debe', '0', '2019-10-12 11:30:58', '2019-10-12 11:30:58'),
(114, 6, 10, 10, '2025-09-01', NULL, '168.99', '97.16', '71.83', '675.53', '0.00', 'Debe', '0', '2019-10-12 11:30:58', '2019-10-12 11:30:58'),
(115, 7, 10, 10, '2026-09-01', NULL, '168.99', '87.82', '81.17', '594.36', '0.00', 'Debe', '0', '2019-10-12 11:30:58', '2019-10-12 11:30:58'),
(116, 8, 10, 10, '2027-09-01', NULL, '168.99', '77.27', '91.72', '502.64', '0.00', 'Debe', '0', '2019-10-12 11:30:58', '2019-10-12 11:30:58'),
(117, 9, 10, 10, '2028-09-01', NULL, '168.99', '65.34', '103.64', '399.00', '0.00', 'Debe', '0', '2019-10-12 11:30:58', '2019-10-12 11:30:58'),
(118, 10, 10, 10, '2029-09-01', NULL, '168.99', '51.87', '117.12', '281.89', '0.00', 'Debe', '0', '2019-10-12 11:30:58', '2019-10-12 11:30:58'),
(119, 11, 10, 10, '2030-09-01', NULL, '168.99', '36.65', '132.34', '149.55', '0.00', 'Debe', '0', '2019-10-12 11:30:58', '2019-10-12 11:30:58'),
(120, 12, 10, 10, '2031-09-01', NULL, '168.99', '19.44', '149.55', '0.00', '0.00', 'Debe', '0', '2019-10-12 11:30:58', '2019-10-12 11:30:58'),
(121, 1, 16, 11, '2020-09-01', NULL, '168.99', '130.00', '38.99', '961.01', '0.00', 'Debe', '0', '2019-10-12 11:32:37', '2019-10-12 11:32:37'),
(122, 2, 16, 11, '2021-09-01', NULL, '168.99', '124.93', '44.05', '916.96', '0.00', 'Debe', '0', '2019-10-12 11:32:37', '2019-10-12 11:32:37'),
(123, 3, 16, 11, '2022-09-01', NULL, '168.99', '119.20', '49.78', '867.18', '0.00', 'Debe', '0', '2019-10-12 11:32:37', '2019-10-12 11:32:37'),
(124, 4, 16, 11, '2023-09-01', NULL, '168.99', '112.73', '56.25', '810.93', '0.00', 'Debe', '0', '2019-10-12 11:32:37', '2019-10-12 11:32:37'),
(125, 5, 16, 11, '2024-09-01', NULL, '168.99', '105.42', '63.57', '747.36', '0.00', 'Debe', '0', '2019-10-12 11:32:37', '2019-10-12 11:32:37'),
(126, 6, 16, 11, '2025-09-01', NULL, '168.99', '97.16', '71.83', '675.53', '0.00', 'Debe', '0', '2019-10-12 11:32:37', '2019-10-12 11:32:37'),
(127, 7, 16, 11, '2026-09-01', NULL, '168.99', '87.82', '81.17', '594.36', '0.00', 'Debe', '0', '2019-10-12 11:32:37', '2019-10-12 11:32:37'),
(128, 8, 16, 11, '2027-09-01', NULL, '168.99', '77.27', '91.72', '502.64', '0.00', 'Debe', '0', '2019-10-12 11:32:37', '2019-10-12 11:32:37'),
(129, 9, 16, 11, '2028-09-01', NULL, '168.99', '65.34', '103.64', '399.00', '0.00', 'Debe', '0', '2019-10-12 11:32:37', '2019-10-12 11:32:37'),
(130, 10, 16, 11, '2029-09-01', NULL, '168.99', '51.87', '117.12', '281.89', '0.00', 'Debe', '0', '2019-10-12 11:32:37', '2019-10-12 11:32:37'),
(131, 11, 16, 11, '2030-09-01', NULL, '168.99', '36.65', '132.34', '149.55', '0.00', 'Debe', '0', '2019-10-12 11:32:37', '2019-10-12 11:32:37'),
(132, 12, 16, 11, '2031-09-01', NULL, '168.99', '19.44', '149.55', '0.00', '0.00', 'Debe', '0', '2019-10-12 11:32:37', '2019-10-12 11:32:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id` int(10) UNSIGNED NOT NULL,
  `mora` decimal(5,2) NOT NULL,
  `interes` decimal(5,2) NOT NULL,
  `abonosocio` decimal(10,2) NOT NULL,
  `tasa_ahorros` decimal(4,2) NOT NULL,
  `tasa_creditos` decimal(4,2) NOT NULL,
  `tasa_aportes` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2017_18_11_203549_create_simulador_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `id` int(10) UNSIGNED NOT NULL,
  `idusuario` int(10) UNSIGNED NOT NULL,
  `idahorro` int(10) UNSIGNED NOT NULL,
  `fecharegistro` datetime NOT NULL,
  `monto` decimal(7,2) NOT NULL,
  `descripcion` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipomovimiento` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` int(10) UNSIGNED NOT NULL,
  `dni` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fechanacimiento` date NOT NULL,
  `direccion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departamento` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Cajamarca',
  `ciudad` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Cajamarca',
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `dni`, `nombre`, `apellidos`, `fechanacimiento`, `direccion`, `departamento`, `ciudad`, `telefono`, `email`, `created_at`, `updated_at`) VALUES
(1, '45997675', 'GILBERTO AGAPITO', 'GARCIAS RAMIREZ', '1993-04-05', 'JR SAN MARTIN 458', 'Cajamarca', 'Cajamarca', '964923450', 'correo@gmail.com', NULL, NULL),
(2, '27903790', 'JOSÉ TEOFILO', 'GARCÍAS RAMIREZ', '1993-04-05', 'JR SAN MARTIN 458', 'Cajamarca', 'Cajamarca', '964923450', 'correo@gmail.com', NULL, NULL),
(3, '27907682', 'MARCOS AMADOR', 'BURGOS RAMIREZ', '1993-04-05', 'JR SAN MARTIN 458', 'Cajamarca', 'Cajamarca', '964923450', 'correo@gmail.com', NULL, NULL),
(4, '41803968', 'VILMA MARILU', 'PAREDES RAMIREZ', '1993-04-05', 'JR SAN MARTIN 458', 'Cajamarca', 'Cajamarca', '964923450', 'correo@gmail.com', NULL, NULL),
(5, '26702047', 'DOMINGO', 'SANCHS RAMIREZ', '1993-04-05', 'JR SAN MARTIN 458', 'Cajamarca', 'Cajamarca', '964923450', 'correo@gmail.com', NULL, NULL),
(6, '27929064', 'ROSA VIOLETA', 'MUÑS RAMIREZ', '1993-04-05', 'JR SAN MARTIN 458', 'Cajamarca', 'Cajamarca', '964923450', 'correo@gmail.com', NULL, NULL),
(7, '27916604', 'JULIO', 'CABANILLAS RAMIREZ', '1993-04-05', 'JR SAN MARTIN 458', 'Cajamarca', 'Cajamarca', '964923450', 'correo@gmail.com', NULL, NULL),
(8, '27901578', 'MARIA', 'HERLINS RAMIREZ', '1993-04-05', 'JR SAN MARTIN 458', 'Cajamarca', 'Cajamarca', '964923450', 'correo@gmail.com', NULL, NULL),
(9, '43728818', 'ERMINDA', 'JARAS RAMIREZ', '1993-04-05', 'JR SAN MARTIN 458', 'Cajamarca', 'Cajamarca', '964923450', 'correo@gmail.com', NULL, NULL),
(10, '21012004', 'MARIA ESTELA', 'RODRIGUES RAMIREZ', '1993-04-05', 'JR SAN MARTIN 458', 'Cajamarca', 'Cajamarca', '964923450', 'correo@gmail.com', NULL, NULL),
(11, '20962820', 'EVA MARIA', 'ABANTOS RAMIREZ', '1993-04-05', 'JR SAN MARTIN 458', 'Cajamarca', 'Cajamarca', '964923450', 'correo@gmail.com', NULL, NULL),
(12, '27905558', 'MANUEL', 'PERALS RAMIREZ', '1993-04-05', 'JR SAN MARTIN 458', 'Cajamarca', 'Cajamarca', '964923450', 'correo@gmail.com', NULL, '2019-10-08 06:37:07'),
(13, '12458235', 'MARA JUDIT', 'QUILICHE HUARIPATA', '1993-03-01', 'JR CASUARINAS 458', 'Cajamarca', 'Cajamarca', '964923450', 'mara@gmail.com', '2019-10-08 04:04:14', '2019-10-08 04:08:14'),
(14, '70212063', 'JOSE LUIS', 'RAMIREZ QUIROZ', '1993-03-01', 'JR CASUARINAS 458', 'Cajamarca', 'Cajamarca', '964923450', 'jose@cersa.org.pe', '2019-10-08 04:07:41', '2019-10-08 04:07:41'),
(15, '32139074', 'ALEX', 'ZAMORA ROJAS', '1976-09-06', 'AV. INDUSTRIAL', 'Cajamarca', 'Cajamarca', '974173399', 'alexzamora01@hotmail.com', '2019-10-08 06:33:41', '2019-10-08 06:34:23'),
(16, '8888888', 'MARTIN', 'BRAVO', '1993-01-03', 'JR CASUARINAS 458', 'Cajamarca', 'Cajamarca', '964923450', 'martin@gmail.com', '2019-10-08 06:39:15', '2019-10-08 06:39:15'),
(17, '32139071', 'ALEX', 'ZAMORA ROJAS', '1976-09-06', 'AV. INDUSTRIAL', 'Cajamarca', 'Cajamarca', '974173399', 'alexzamora01@hotmail.com', '2019-10-08 06:47:30', '2019-10-08 06:47:30'),
(18, '1231', 'asdasd', 'asdasd', '1995-03-01', 'sadasd', 'asdasd', 'asdasd', '56465', 'asdasd@gmail.com', '2019-10-12 11:30:58', '2019-10-12 11:30:58'),
(19, '41231', 'asdasd', 'asdasd', '1995-03-01', 'asdas', 'asdasd', 'asdasd', 'dasdasd', 'asdsa', '2019-10-12 11:32:37', '2019-10-12 11:32:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `descripcion`, `condicion`, `created_at`, `updated_at`) VALUES
(1, 'Adminstrador', 'Control total del sistema', 1, NULL, NULL),
(2, 'Analista', 'Administracion de creditos', 1, NULL, NULL),
(3, 'Cajero', 'Cobro de cuotas y aportaciones', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `simulaciones`
--

CREATE TABLE `simulaciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `montodesembolsado` decimal(10,2) NOT NULL,
  `fechadesembolso` date NOT NULL,
  `fechaprimeracuota` date NOT NULL,
  `numerocuotas` int(11) NOT NULL,
  `tasa` decimal(4,2) NOT NULL,
  `periodo` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dni` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombresapellidos` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `simulaciones`
--

INSERT INTO `simulaciones` (`id`, `montodesembolsado`, `fechadesembolso`, `fechaprimeracuota`, `numerocuotas`, `tasa`, `periodo`, `estado`, `dni`, `nombresapellidos`, `created_at`, `updated_at`) VALUES
(1, '18000.00', '2019-10-11', '2019-10-25', 12, '30.00', '1', '1', NULL, NULL, NULL, NULL),
(2, '1000.00', '2019-09-01', '2019-09-01', 12, '13.00', '1', '1', '70212063', 'JOSE LUIS RAMIREZ QUIROZ', '2019-10-12 03:18:25', '2019-10-12 03:18:25'),
(3, '1000.00', '2019-09-01', '2019-09-01', 12, '13.00', '1', '1', '70212063', 'JOSE LUIS RAMIREZ QUIROZ', '2019-10-12 03:25:30', '2019-10-12 03:25:30'),
(4, '1000.00', '2019-09-01', '2019-09-01', 12, '13.00', '1', '1', '70212063', 'JOSE LUIS RAMIREZ QUIROZ', '2019-10-12 03:28:25', '2019-10-12 03:28:25'),
(5, '1000.00', '2019-09-01', '2019-09-01', 12, '13.00', '1', '1', '70212063', 'JOSE LUIS RAMIREZ QUIROZ', '2019-10-12 04:14:26', '2019-10-12 04:14:26'),
(6, '1000.00', '2019-09-01', '2019-09-01', 12, '13.00', '1', '1', '70212063', 'JOSE LUIS RAMIREZ QUIROZ', '2019-10-12 04:18:08', '2019-10-12 04:18:08'),
(7, '1000.00', '2019-09-01', '2019-09-01', 12, '13.00', '1', '1', '70212063', 'JOSE LUIS RAMIREZ QUIROZ', '2019-10-12 04:18:37', '2019-10-12 04:18:37'),
(8, '1000.00', '2019-09-01', '2019-09-01', 12, '13.00', '1', '1', '70212063', 'JOSE LUIS RAMIREZ QUIROZ', '2019-10-12 04:19:05', '2019-10-12 04:19:05'),
(9, '1000.00', '2019-09-01', '2019-09-01', 12, '13.00', '1', '1', '70212063', 'JOSE LUIS RAMIREZ QUIROZ', '2019-10-12 04:21:51', '2019-10-12 04:21:51'),
(10, '1000.00', '2019-09-01', '2019-09-01', 12, '13.00', '1', '1', '70212063', 'JOSE LUIS RAMIREZ QUIROZ', '2019-10-12 04:24:02', '2019-10-12 04:24:02'),
(11, '1000.00', '2019-09-01', '2019-09-01', 12, '13.00', '1', '1', '70212063', 'JOSE LUIS RAMIREZ QUIROZ', '2019-10-12 04:24:49', '2019-10-12 04:24:49'),
(12, '1000.00', '2019-09-01', '2019-09-01', 12, '13.00', '1', '1', '70212063', 'JOSE LUIS RAMIREZ QUIROZ', '2019-10-12 04:26:20', '2019-10-12 04:26:20'),
(13, '1000.00', '2019-09-01', '2019-09-01', 12, '13.00', '1', '1', '70212063', 'JOSE LUIS RAMIREZ QUIROZ', '2019-10-12 04:40:55', '2019-10-12 04:40:55'),
(14, '1000.00', '2019-09-01', '2019-09-01', 12, '13.00', '1', '1', '70212063', 'JOSE LUIS RAMIREZ QUIROZ', '2019-10-12 04:41:35', '2019-10-12 04:41:35'),
(15, '1285.00', '2019-10-02', '2019-09-01', 12, '15.00', '12', '1', '70212063', 'JOSE LUIS RAMIREZ QUIROZ', '2019-10-12 11:58:33', '2019-10-12 11:58:33'),
(16, '2500.00', '2019-10-01', '2019-09-05', 12, '25.00', '12', '1', '65451231', 'JOadsasd sadasd', '2019-10-12 12:16:13', '2019-10-12 12:16:13'),
(17, '12.00', '1994-03-01', '2019-09-01', 12, '3.15', '4', '1', '70212063', 'JOSE LUIS RAMIREZ QUIROZ', '2019-10-12 12:17:41', '2019-10-12 12:17:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socios`
--

CREATE TABLE `socios` (
  `id` int(10) UNSIGNED NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `estadoahorro` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `estadocredito` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `tipo` char(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `socios`
--

INSERT INTO `socios` (`id`, `estado`, `estadoahorro`, `estadocredito`, `tipo`, `created_at`, `updated_at`) VALUES
(1, 1, '0', '1', '1', NULL, '2019-10-08 02:59:22'),
(2, 1, '0', '0', '1', NULL, NULL),
(3, 1, '0', '1', '1', NULL, '2019-10-12 09:50:26'),
(4, 1, '0', '1', '1', NULL, '2019-10-12 10:25:46'),
(5, 1, '0', '1', '1', NULL, '2019-10-07 22:15:00'),
(6, 1, '0', '1', '1', NULL, '2019-10-12 09:23:59'),
(7, 1, '0', '1', '1', NULL, '2019-10-12 10:32:13'),
(8, 1, '0', '1', '1', NULL, '2019-10-12 09:21:20'),
(9, 1, '0', '1', '1', NULL, '2019-10-12 10:28:36'),
(10, 1, '0', '1', '1', NULL, '2019-10-12 11:30:58'),
(11, 1, '0', '0', '1', NULL, NULL),
(12, 0, '0', '0', '1', NULL, '2019-10-08 06:37:14'),
(13, 0, '0', '0', 'socio', '2019-10-08 04:04:14', '2019-10-08 04:08:36'),
(16, 1, '0', '1', 'socio', '2019-10-08 06:39:15', '2019-10-12 11:32:37'),
(17, 1, '0', '1', 'socio', '2019-10-08 06:47:30', '2019-10-08 06:49:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `usuario` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT '1',
  `idrol` int(10) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `usuario`, `password`, `condicion`, `idrol`, `remember_token`, `created_at`, `updated_at`) VALUES
(14, 'ADMIN', '$2y$10$vAcRZbpdN3MDTJ/pKPbpSOKSqE3KKqwFhVWoAfiF4A/UTB.6er7pG', 1, 1, NULL, NULL, NULL),
(15, 'ALEX', '$2y$10$3MGmyVaJhgp1.j1tjqBgx.bHkxf4nEZNLmV6rfp1Ipq.BfasavWyq', 1, 1, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aportaciones`
--
ALTER TABLE `aportaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aportaciones_idsocio_foreign` (`idsocio`),
  ADD KEY `aportaciones_idusuario_foreign` (`idusuario`);

--
-- Indices de la tabla `creditos`
--
ALTER TABLE `creditos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numeroprestamo` (`numeroprestamo`),
  ADD KEY `creditos_idsocio_foreign` (`idsocio`),
  ADD KEY `creditos_idgarante_foreign` (`idgarante`),
  ADD KEY `creditos_idusuario_foreign` (`idusuario`);

--
-- Indices de la tabla `cuentaahorros`
--
ALTER TABLE `cuentaahorros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ahorros_idsocio_foreign` (`idsocio`),
  ADD KEY `ahorros_idusuario_foreign` (`idusuario`);

--
-- Indices de la tabla `cuotas`
--
ALTER TABLE `cuotas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cuotas_idcajero_foreign` (`idcajero`),
  ADD KEY `cuotas_idcredito_foreign` (`idcredito`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movimientos_idusuario_foreign` (`idusuario`),
  ADD KEY `movimientos_idahorro_foreign` (`idahorro`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personas_dni_unique` (`dni`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_nombre_unique` (`nombre`);

--
-- Indices de la tabla `simulaciones`
--
ALTER TABLE `simulaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `socios`
--
ALTER TABLE `socios`
  ADD KEY `socios_id_foreign` (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `users_usuario_unique` (`usuario`),
  ADD KEY `users_id_foreign` (`id`),
  ADD KEY `users_idrol_foreign` (`idrol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aportaciones`
--
ALTER TABLE `aportaciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `creditos`
--
ALTER TABLE `creditos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `cuentaahorros`
--
ALTER TABLE `cuentaahorros`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cuotas`
--
ALTER TABLE `cuotas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `simulaciones`
--
ALTER TABLE `simulaciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aportaciones`
--
ALTER TABLE `aportaciones`
  ADD CONSTRAINT `aportaciones_idsocio_foreign` FOREIGN KEY (`idsocio`) REFERENCES `personas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `aportaciones_idusuario_foreign` FOREIGN KEY (`idusuario`) REFERENCES `personas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `creditos`
--
ALTER TABLE `creditos`
  ADD CONSTRAINT `creditos_idgarante_foreign` FOREIGN KEY (`idgarante`) REFERENCES `personas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `creditos_idsocio_foreign` FOREIGN KEY (`idsocio`) REFERENCES `personas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `creditos_idusuario_foreign` FOREIGN KEY (`idusuario`) REFERENCES `personas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cuentaahorros`
--
ALTER TABLE `cuentaahorros`
  ADD CONSTRAINT `ahorros_idsocio_foreign` FOREIGN KEY (`idsocio`) REFERENCES `personas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ahorros_idusuario_foreign` FOREIGN KEY (`idusuario`) REFERENCES `personas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cuotas`
--
ALTER TABLE `cuotas`
  ADD CONSTRAINT `cuotas_idcajero_foreign` FOREIGN KEY (`idcajero`) REFERENCES `personas` (`id`),
  ADD CONSTRAINT `cuotas_idcredito_foreign` FOREIGN KEY (`idcredito`) REFERENCES `creditos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `movimientos_idahorro_foreign` FOREIGN KEY (`idahorro`) REFERENCES `cuentaahorros` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `movimientos_idusuario_foreign` FOREIGN KEY (`idusuario`) REFERENCES `personas` (`id`);

--
-- Filtros para la tabla `socios`
--
ALTER TABLE `socios`
  ADD CONSTRAINT `socios_id_foreign` FOREIGN KEY (`id`) REFERENCES `personas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_id_foreign` FOREIGN KEY (`id`) REFERENCES `personas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_idrol_foreign` FOREIGN KEY (`idrol`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
