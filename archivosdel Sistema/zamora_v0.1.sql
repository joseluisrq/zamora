-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-10-2019 a las 04:58:01
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
  `estado` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `periodo` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `creditos`
--

INSERT INTO `creditos` (`id`, `idsocio`, `idgarante`, `idusuario`, `numeroprestamo`, `montodesembolsado`, `fechadesembolso`, `numerocuotas`, `tipocambio`, `tasa`, `estado`, `periodo`, `created_at`, `updated_at`) VALUES
(1, 5, 5, 5, 'CZ-00001', '5000.00', '2019-10-07', 12, '3.350000', '13.00', '1', '1', '2019-10-07 22:14:59', '2019-10-07 22:14:59'),
(2, 1, 1, 1, 'CZ-00002', '1000.00', '2019-09-01', 12, '3.350000', '13.00', '1', '1', '2019-10-08 02:59:22', '2019-10-08 02:59:22'),
(3, 17, 17, 17, 'CZ-0003', '1000.00', '2019-09-01', 12, '3.350000', '1.80', '1', '1', '2019-10-08 06:49:31', '2019-10-08 06:49:31');

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

INSERT INTO `cuotas` (`id`, `numerodecuota`, `idcajero`, `idcredito`, `fechapago`, `fechacancelo`, `monto`, `saldopendiente`, `mora`, `descripcion`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 1, '2019-11-07', NULL, '416.67', '4583.33', '0.00', 'Debe', '0', '2019-10-07 22:14:59', '2019-10-07 22:14:59'),
(2, 2, 5, 1, '2019-12-07', NULL, '416.67', '4166.66', '0.00', 'Debe', '0', '2019-10-07 22:14:59', '2019-10-07 22:14:59'),
(3, 3, 5, 1, '2020-01-07', NULL, '416.67', '3749.99', '0.00', 'Debe', '0', '2019-10-07 22:14:59', '2019-10-07 22:14:59'),
(4, 4, 5, 1, '2020-02-07', NULL, '416.67', '3333.32', '0.00', 'Debe', '0', '2019-10-07 22:15:00', '2019-10-07 22:15:00'),
(5, 5, 5, 1, '2020-03-07', NULL, '416.67', '2916.65', '0.00', 'Debe', '0', '2019-10-07 22:15:00', '2019-10-07 22:15:00'),
(6, 6, 5, 1, '2020-04-07', NULL, '416.67', '2499.98', '0.00', 'Debe', '0', '2019-10-07 22:15:00', '2019-10-07 22:15:00'),
(7, 7, 5, 1, '2020-05-07', NULL, '416.67', '2083.31', '0.00', 'Debe', '0', '2019-10-07 22:15:00', '2019-10-07 22:15:00'),
(8, 8, 5, 1, '2020-06-07', NULL, '416.67', '1666.64', '0.00', 'Debe', '0', '2019-10-07 22:15:00', '2019-10-07 22:15:00'),
(9, 9, 5, 1, '2020-07-07', NULL, '416.67', '1249.97', '0.00', 'Debe', '0', '2019-10-07 22:15:00', '2019-10-07 22:15:00'),
(10, 10, 5, 1, '2020-08-07', NULL, '416.67', '833.30', '0.00', 'Debe', '0', '2019-10-07 22:15:00', '2019-10-07 22:15:00'),
(11, 11, 5, 1, '2020-09-07', NULL, '416.67', '416.63', '0.00', 'Debe', '0', '2019-10-07 22:15:00', '2019-10-07 22:15:00'),
(12, 12, 5, 1, '2020-10-07', NULL, '416.67', '0.00', '0.00', 'Debe', '0', '2019-10-07 22:15:00', '2019-10-07 22:15:00'),
(13, 1, 1, 2, '2019-10-01', NULL, '83.33', '916.67', '0.00', 'Debe', '0', '2019-10-08 02:59:22', '2019-10-08 02:59:22'),
(14, 2, 1, 2, '2019-11-01', NULL, '83.33', '833.34', '0.00', 'Debe', '0', '2019-10-08 02:59:22', '2019-10-08 02:59:22'),
(15, 3, 1, 2, '2019-12-01', NULL, '83.33', '750.01', '0.00', 'Debe', '0', '2019-10-08 02:59:22', '2019-10-08 02:59:22'),
(16, 4, 1, 2, '2020-01-01', NULL, '83.33', '666.68', '0.00', 'Debe', '0', '2019-10-08 02:59:22', '2019-10-08 02:59:22'),
(17, 5, 1, 2, '2020-02-01', NULL, '83.33', '583.35', '0.00', 'Debe', '0', '2019-10-08 02:59:22', '2019-10-08 02:59:22'),
(18, 6, 1, 2, '2020-03-01', NULL, '83.33', '500.02', '0.00', 'Debe', '0', '2019-10-08 02:59:22', '2019-10-08 02:59:22'),
(19, 7, 1, 2, '2020-04-01', NULL, '83.33', '416.69', '0.00', 'Debe', '0', '2019-10-08 02:59:22', '2019-10-08 02:59:22'),
(20, 8, 1, 2, '2020-05-01', NULL, '83.33', '333.36', '0.00', 'Debe', '0', '2019-10-08 02:59:22', '2019-10-08 02:59:22'),
(21, 9, 1, 2, '2020-06-01', NULL, '83.33', '250.03', '0.00', 'Debe', '0', '2019-10-08 02:59:22', '2019-10-08 02:59:22'),
(22, 10, 1, 2, '2020-07-01', NULL, '83.33', '166.70', '0.00', 'Debe', '0', '2019-10-08 02:59:22', '2019-10-08 02:59:22'),
(23, 11, 1, 2, '2020-08-01', NULL, '83.33', '83.37', '0.00', 'Debe', '0', '2019-10-08 02:59:22', '2019-10-08 02:59:22'),
(24, 12, 1, 2, '2020-09-01', NULL, '83.33', '0.00', '0.00', 'Debe', '0', '2019-10-08 02:59:22', '2019-10-08 02:59:22'),
(25, 1, 17, 3, '2019-10-01', NULL, '83.33', '916.67', '0.00', 'Debe', '0', '2019-10-08 06:49:31', '2019-10-08 06:49:31'),
(26, 2, 17, 3, '2019-11-01', NULL, '83.33', '833.34', '0.00', 'Debe', '0', '2019-10-08 06:49:31', '2019-10-08 06:49:31'),
(27, 3, 17, 3, '2019-12-01', NULL, '83.33', '750.01', '0.00', 'Debe', '0', '2019-10-08 06:49:31', '2019-10-08 06:49:31'),
(28, 4, 17, 3, '2020-01-01', NULL, '83.33', '666.68', '0.00', 'Debe', '0', '2019-10-08 06:49:31', '2019-10-08 06:49:31'),
(29, 5, 17, 3, '2020-02-01', NULL, '83.33', '583.35', '0.00', 'Debe', '0', '2019-10-08 06:49:31', '2019-10-08 06:49:31'),
(30, 6, 17, 3, '2020-03-01', NULL, '83.33', '500.02', '0.00', 'Debe', '0', '2019-10-08 06:49:31', '2019-10-08 06:49:31'),
(31, 7, 17, 3, '2020-04-01', NULL, '83.33', '416.69', '0.00', 'Debe', '0', '2019-10-08 06:49:31', '2019-10-08 06:49:31'),
(32, 8, 17, 3, '2020-05-01', NULL, '83.33', '333.36', '0.00', 'Debe', '0', '2019-10-08 06:49:31', '2019-10-08 06:49:31'),
(33, 9, 17, 3, '2020-06-01', NULL, '83.33', '250.03', '0.00', 'Debe', '0', '2019-10-08 06:49:31', '2019-10-08 06:49:31'),
(34, 10, 17, 3, '2020-07-01', NULL, '83.33', '166.70', '0.00', 'Debe', '0', '2019-10-08 06:49:31', '2019-10-08 06:49:31'),
(35, 11, 17, 3, '2020-08-01', NULL, '83.33', '83.37', '0.00', 'Debe', '0', '2019-10-08 06:49:31', '2019-10-08 06:49:31'),
(36, 12, 17, 3, '2020-09-01', NULL, '83.33', '0.00', '0.00', 'Debe', '0', '2019-10-08 06:49:31', '2019-10-08 06:49:31');

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
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(17, '32139071', 'ALEX', 'ZAMORA ROJAS', '1976-09-06', 'AV. INDUSTRIAL', 'Cajamarca', 'Cajamarca', '974173399', 'alexzamora01@hotmail.com', '2019-10-08 06:47:30', '2019-10-08 06:47:30');

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
(3, 1, '0', '0', '1', NULL, NULL),
(4, 1, '0', '0', '1', NULL, NULL),
(5, 1, '0', '1', '1', NULL, '2019-10-07 22:15:00'),
(6, 1, '0', '0', '1', NULL, NULL),
(7, 1, '0', '0', '1', NULL, NULL),
(8, 1, '0', '0', '1', NULL, NULL),
(9, 1, '0', '0', '1', NULL, NULL),
(10, 1, '0', '0', '1', NULL, NULL),
(11, 1, '0', '0', '1', NULL, NULL),
(12, 0, '0', '0', '1', NULL, '2019-10-08 06:37:14'),
(13, 0, '0', '0', 'socio', '2019-10-08 04:04:14', '2019-10-08 04:08:36'),
(16, 1, '0', '0', 'socio', '2019-10-08 06:39:15', '2019-10-08 06:39:15'),
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cuentaahorros`
--
ALTER TABLE `cuentaahorros`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cuotas`
--
ALTER TABLE `cuotas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
