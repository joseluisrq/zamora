-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-10-2019 a las 06:24:40
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
(1, 1, 1, '1000.00', '2019-10-07 20:41:02', 'Aporte', '12.00', '1', '2019-10-08 06:41:02', '2019-10-08 06:41:02'),
(2, 1, 1, '150.00', '2019-10-13 23:13:33', 'Aporte', '12.00', '1', '2019-10-14 09:13:33', '2019-10-14 09:13:33');

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
(2, 1, 1, 1, 'CZ000001', '10000.00', '2019-10-13', 12, '3.350000', '31.88', '1580.35', '1', '0', '12', '2019-10-14 06:30:46', '2019-10-14 06:30:46'),
(4, 4, 26, 14, 'CZ000003', '1000.00', '2019-10-13', 12, '3.350000', '31.88', '2968.99', '1', '0', '1', '2019-10-14 07:34:00', '2019-10-14 07:34:00'),
(5, 29, 30, 14, 'CZ000004', '5000.00', '2019-10-13', 12, '3.350000', '31.88', '790.18', '1', '1', '12', '2019-10-14 07:42:22', '2019-10-14 09:01:32');

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
  `tipocuenta` char(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1 cuenta corriente/2 cuenta plazo fijo',
  `estado` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cuentaahorros`
--

INSERT INTO `cuentaahorros` (`id`, `idsocio`, `idusuario`, `numerocuenta`, `saldoefectivo`, `fechaapertura`, `ultimomovimiento`, `descripcion`, `tasa`, `tipocuenta`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'C-00001', '9950.00', '2019-10-07 20:55:39', 4, 'Nueva Cuenta', '1.00', '1', '1', '2019-10-08 06:55:39', '2019-10-14 09:03:17'),
(2, 5, 14, 'C-00005', '18000.00', '2019-10-13 11:13:17', 1, 'Nueva Cuenta', '3.46', '1', '1', '2019-10-13 21:13:17', '2019-10-13 21:13:17'),
(3, 5, 14, 'C-00005_2', '1800.00', '2019-10-13 12:06:56', 2, '1', '1.35', '1', '1', '2019-10-13 22:06:56', '2019-10-13 22:06:56'),
(4, 2, 14, 'C-00002', '1505.00', '2019-10-13 12:08:16', 5, 'Nueva Cuenta', '1.35', '1', '1', '2019-10-13 22:08:16', '2019-10-14 09:05:10'),
(5, 5, 14, 'C-00005_3', '1800.00', '2019-10-13 23:10:38', 6, 'Nueva Cuenta', '1.35', '1', '1', '2019-10-14 09:10:38', '2019-10-14 09:10:38');

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
  `estado_mora` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `descripcion` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cuotas`
--

INSERT INTO `cuotas` (`id`, `numerodecuota`, `idcajero`, `idcredito`, `fechapago`, `fechacancelo`, `monto`, `interes`, `amortizacion`, `saldopendiente`, `mora`, `estado_mora`, `descripcion`, `estado`, `created_at`, `updated_at`) VALUES
(187, 1, 14, 2, '2019-10-13', '2019-10-13 21:53:50', '965.03', '233.28', '731.75', '9268.25', '0.00', '1', 'Pago', '1', '2019-10-14 06:30:46', '2019-10-14 07:53:50'),
(188, 2, 14, 2, '2019-11-13', '2019-10-13 21:58:05', '965.03', '216.21', '748.82', '8519.43', '0.00', '1', 'Pago', '1', '2019-10-14 06:30:46', '2019-10-14 07:58:05'),
(189, 3, 1, 2, '2019-12-13', NULL, '965.03', '198.74', '766.29', '7753.15', '0.00', '0', 'Debe', '0', '2019-10-14 06:30:46', '2019-10-14 06:30:46'),
(190, 4, 1, 2, '2020-01-13', NULL, '965.03', '180.87', '784.16', '6968.98', '0.00', '0', 'Debe', '0', '2019-10-14 06:30:46', '2019-10-14 06:30:46'),
(191, 5, 1, 2, '2020-02-13', NULL, '965.03', '162.57', '802.46', '6166.53', '0.00', '0', 'Debe', '0', '2019-10-14 06:30:46', '2019-10-14 06:30:46'),
(192, 6, 1, 2, '2020-03-13', NULL, '965.03', '143.85', '821.18', '5345.35', '0.00', '0', 'Debe', '0', '2019-10-14 06:30:46', '2019-10-14 06:30:46'),
(193, 7, 1, 2, '2020-04-13', NULL, '965.03', '124.70', '840.33', '4505.02', '0.00', '0', 'Debe', '0', '2019-10-14 06:30:46', '2019-10-14 06:30:46'),
(194, 8, 1, 2, '2020-05-13', NULL, '965.03', '105.09', '859.94', '3645.08', '0.00', '0', 'Debe', '0', '2019-10-14 06:30:46', '2019-10-14 06:30:46'),
(195, 9, 1, 2, '2020-06-13', NULL, '965.03', '85.03', '880.00', '2765.09', '0.00', '0', 'Debe', '0', '2019-10-14 06:30:46', '2019-10-14 06:30:46'),
(196, 10, 1, 2, '2020-07-13', NULL, '965.03', '64.50', '900.53', '1864.56', '0.00', '0', 'Debe', '0', '2019-10-14 06:30:46', '2019-10-14 06:30:46'),
(197, 11, 1, 2, '2020-08-13', NULL, '965.03', '43.50', '921.53', '943.03', '0.00', '0', 'Debe', '0', '2019-10-14 06:30:46', '2019-10-14 06:30:46'),
(198, 12, 1, 2, '2020-09-13', NULL, '965.03', '22.00', '943.03', '0.00', '0.00', '0', 'Debe', '0', '2019-10-14 06:30:46', '2019-10-14 06:30:46'),
(211, 1, 14, 4, '2019-10-13', '2019-10-13 21:36:47', '330.75', '318.80', '11.95', '988.05', '0.00', '1', 'Pago', '1', '2019-10-14 07:34:00', '2019-10-14 07:36:47'),
(212, 2, 14, 4, '2020-10-13', NULL, '330.75', '314.99', '15.76', '972.29', '0.00', '0', 'Debe', '0', '2019-10-14 07:34:00', '2019-10-14 07:34:00'),
(213, 3, 14, 4, '2021-10-13', NULL, '330.75', '309.97', '20.78', '951.51', '0.00', '0', 'Debe', '0', '2019-10-14 07:34:00', '2019-10-14 07:34:00'),
(214, 4, 14, 4, '2022-10-13', NULL, '330.75', '303.34', '27.41', '924.10', '0.00', '0', 'Debe', '0', '2019-10-14 07:34:00', '2019-10-14 07:34:00'),
(215, 5, 14, 4, '2023-10-13', NULL, '330.75', '294.60', '36.15', '887.95', '0.00', '0', 'Debe', '0', '2019-10-14 07:34:00', '2019-10-14 07:34:00'),
(216, 6, 14, 4, '2024-10-13', NULL, '330.75', '283.08', '47.67', '840.28', '0.00', '0', 'Debe', '0', '2019-10-14 07:34:00', '2019-10-14 07:34:00'),
(217, 7, 14, 4, '2025-10-13', NULL, '330.75', '267.88', '62.87', '777.42', '0.00', '0', 'Debe', '0', '2019-10-14 07:34:00', '2019-10-14 07:34:00'),
(218, 8, 14, 4, '2026-10-13', NULL, '330.75', '247.84', '82.91', '694.51', '0.00', '0', 'Debe', '0', '2019-10-14 07:34:00', '2019-10-14 07:34:00'),
(219, 9, 14, 4, '2027-10-13', NULL, '330.75', '221.41', '109.34', '585.16', '0.00', '0', 'Debe', '0', '2019-10-14 07:34:00', '2019-10-14 07:34:00'),
(220, 10, 14, 4, '2028-10-13', NULL, '330.75', '186.55', '144.20', '440.97', '0.00', '0', 'Debe', '0', '2019-10-14 07:34:00', '2019-10-14 07:34:00'),
(221, 11, 14, 4, '2029-10-13', NULL, '330.75', '140.58', '190.17', '250.80', '0.00', '0', 'Debe', '0', '2019-10-14 07:34:00', '2019-10-14 07:34:00'),
(222, 12, 14, 4, '2030-10-13', NULL, '330.75', '79.95', '250.80', '0.00', '0.00', '0', 'Debe', '0', '2019-10-14 07:34:00', '2019-10-14 07:34:00'),
(223, 1, 14, 5, '2019-10-15', '2019-10-13 21:44:34', '482.51', '116.64', '365.87', '4634.13', '0.00', '1', 'Pago', '1', '2019-10-14 07:42:22', '2019-10-14 07:44:34'),
(224, 2, 14, 5, '2019-11-15', '2019-10-13 22:47:57', '482.51', '108.11', '374.41', '4259.72', '0.00', '1', 'Pago', '1', '2019-10-14 07:42:22', '2019-10-14 08:47:57'),
(225, 3, 14, 5, '2019-12-15', NULL, '482.51', '99.37', '383.14', '3876.57', '0.00', '0', 'Debe', '0', '2019-10-14 07:42:22', '2019-10-14 07:42:22'),
(226, 4, 14, 5, '2020-01-15', NULL, '482.51', '90.43', '392.08', '3484.49', '0.00', '0', 'Debe', '0', '2019-10-14 07:42:22', '2019-10-14 07:42:22'),
(227, 5, 14, 5, '2020-02-15', NULL, '482.51', '81.29', '401.23', '3083.26', '0.00', '0', 'Debe', '0', '2019-10-14 07:42:22', '2019-10-14 07:42:22'),
(228, 6, 14, 5, '2020-03-15', NULL, '482.51', '71.93', '410.59', '2672.68', '0.00', '0', 'Debe', '0', '2019-10-14 07:42:22', '2019-10-14 07:42:22'),
(229, 7, 14, 5, '2020-04-15', NULL, '482.51', '62.35', '420.17', '2252.51', '0.00', '0', 'Debe', '0', '2019-10-14 07:42:22', '2019-10-14 07:42:22'),
(230, 8, 14, 5, '2020-05-15', NULL, '482.51', '52.55', '429.97', '1822.54', '0.00', '0', 'Debe', '0', '2019-10-14 07:42:22', '2019-10-14 07:42:22'),
(231, 9, 14, 5, '2020-06-15', NULL, '482.51', '42.52', '440.00', '1382.54', '0.00', '0', 'Debe', '0', '2019-10-14 07:42:22', '2019-10-14 07:42:22'),
(232, 10, 14, 5, '2020-07-15', NULL, '482.51', '32.25', '450.26', '932.28', '0.00', '0', 'Debe', '0', '2019-10-14 07:42:22', '2019-10-14 07:42:22'),
(233, 11, 14, 5, '2020-08-15', NULL, '482.51', '21.75', '460.77', '471.52', '0.00', '0', 'Debe', '0', '2019-10-14 07:42:22', '2019-10-14 07:42:22'),
(234, 12, 14, 5, '2020-09-15', NULL, '482.51', '11.00', '471.52', '0.00', '0.00', '0', 'Debe', '0', '2019-10-14 07:42:22', '2019-10-14 07:42:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id` int(10) UNSIGNED NOT NULL,
  `mora` decimal(5,2) NOT NULL,
  `interes` decimal(5,2) NOT NULL,
  `abonosocio` decimal(10,2) NOT NULL,
  `tasa_aportes` decimal(4,2) NOT NULL,
  `tasa_creditos` decimal(4,2) NOT NULL,
  `tasa_ahorros` decimal(4,2) NOT NULL COMMENT 'Cuenta Corriente',
  `tasa_ahorros_comisiones` decimal(10,2) NOT NULL COMMENT 'Consultas de estados de cuenta',
  `tasa_ahorros_gastos` decimal(10,2) NOT NULL COMMENT 'seguros de proteccion',
  `tasa_ahorroplazo_30` decimal(10,2) NOT NULL COMMENT 'Tasa de ahorros a plazo fijo',
  `tasa_ahorroplazo_90` decimal(10,2) NOT NULL COMMENT 'desde 31 hasta 90 dias',
  `tasa_ahorroplazo_180` decimal(10,2) NOT NULL COMMENT 'desde91 hasta 180 dias',
  `tasa_ahorroplazo_360` decimal(10,2) NOT NULL COMMENT '181-360',
  `tasa_ahorroplazo_361` decimal(10,2) NOT NULL COMMENT 'desde 361 a mas',
  `tasa_moratoria_anual` decimal(10,2) NOT NULL COMMENT 'calculo para mora',
  `tasa_compensatoria_anual` decimal(10,2) NOT NULL COMMENT 'calculo para mora'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `mora`, `interes`, `abonosocio`, `tasa_aportes`, `tasa_creditos`, `tasa_ahorros`, `tasa_ahorros_comisiones`, `tasa_ahorros_gastos`, `tasa_ahorroplazo_30`, `tasa_ahorroplazo_90`, `tasa_ahorroplazo_180`, `tasa_ahorroplazo_360`, `tasa_ahorroplazo_361`, `tasa_moratoria_anual`, `tasa_compensatoria_anual`) VALUES
(1, '12.00', '13.00', '14.00', '17.00', '31.88', '1.35', '0.00', '0.00', '2.28', '3.13', '3.76', '4.91', '5.37', '140.85', '150.00');

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

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`id`, `idusuario`, `idahorro`, `fecharegistro`, `monto`, `descripcion`, `tipomovimiento`, `estado`, `created_at`, `updated_at`) VALUES
(1, 14, 2, '2019-10-13 11:13:17', '18000.00', 'CREACIÓN DE CUENTA DE AHORROS', '1', '1', '2019-10-13 21:13:17', '2019-10-13 21:13:17'),
(2, 14, 3, '2019-10-13 12:06:56', '1800.00', 'CREACIÓN DE CUENTA DE AHORROS', '1', '1', '2019-10-13 22:06:56', '2019-10-13 22:06:56'),
(3, 14, 4, '2019-10-13 12:08:16', '1500.00', 'CREACIÓN DE CUENTA DE AHORROS', '1', '1', '2019-10-13 22:08:16', '2019-10-13 22:08:16'),
(4, 14, 1, '2019-10-13 23:03:17', '50.00', 'Aporte', '0', '1', '2019-10-14 09:03:17', '2019-10-14 09:03:17'),
(5, 14, 4, '2019-10-13 23:05:10', '5.00', 'Aporte', '1', '1', '2019-10-14 09:05:10', '2019-10-14 09:05:10'),
(6, 14, 5, '2019-10-13 23:10:38', '1800.00', 'CREACIÓN DE CUENTA DE AHORROS', '1', '1', '2019-10-14 09:10:38', '2019-10-14 09:10:38');

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
(19, '41231', 'asdasd', 'asdasd', '1995-03-01', 'asdas', 'asdasd', 'asdasd', 'dasdasd', 'asdsa', '2019-10-12 11:32:37', '2019-10-12 11:32:37'),
(20, '456231', 'asdas', 'asdasd', '2019-10-01', 'sadasd', 'dasd', 'asdasd', 'sadasd', 'sadas', '2019-10-13 23:06:24', '2019-10-13 23:06:24'),
(21, '70253458', 'ALEJANDROED', 'AGULAR', '2018-03-01', 'JR CASUARINAS 458', 'Cajamarca', 'Cajamarca', '964923450', 'alexzamora01@hotmail.com', '2019-10-14 02:38:41', '2019-10-14 03:47:25'),
(22, '454', 'sdf', 'sdfsdf', '2015-03-01', 'asdasd', 'dsfsd', 'asdasd', 'asdasd', 'asd', '2019-10-14 02:41:05', '2019-10-14 02:41:05'),
(23, '445', '4545', '4545', '2015-05-01', '545', '4545', '454', '454', '45', '2019-10-14 04:00:04', '2019-10-14 04:00:04'),
(24, '111111', 'GVHFGH', 'FGHGFHFGH', '2015-03-01', 'DFGDFG', 'Cajamarca', 'Cajamarca', 'dfgdfg', 'fdg@gmail.com', '2019-10-14 04:00:44', '2019-10-14 04:00:44'),
(25, '45', 'dsa', 'sadas', '2019-10-14', 'asd', 'asd', 'asd', '426456', 'sa6545@gmail.com', '2019-10-14 04:02:05', '2019-10-14 04:02:05'),
(26, '1231233', 'ANDRES', 'VILAR ESTACio', '1995-03-01', 'JR ATAHUALAP 500', 'CAJAMARca', 'CAJAMARCa', '964521254', 'anred@gmail.com', '2019-10-14 06:45:49', '2019-10-14 06:45:49'),
(29, '75889426', 'MARA JUDITH', 'QUILICHE HUARIPATA', '1996-04-07', 'C.P TARTAR CHICO', 'Cajamarca', 'Cajamarca', '92688541', 'mra@gmail.com', '2019-10-14 07:39:31', '2019-10-14 07:39:31'),
(30, '26354285', 'MARIA MELCHORE', 'HUARIPATA LUCANO', '1985-01-06', 'C.P TARTAR CHICO', 'CAJAMARCA', 'CAJAMARCA', '958254521', 'MARIAMECHORE@GMAIL.COM', '2019-10-14 07:42:22', '2019-10-14 07:42:22'),
(31, '7054821', 'FREDY', 'PORTILLA AGUILAR', '2019-03-01', 'AV. INDUSTRIAL', 'Cajamarca', 'Cajamarca', '965254521', 'fredyy@hotmail.com', '2019-10-14 09:09:19', '2019-10-14 09:09:19');

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
(17, '12.00', '1994-03-01', '2019-09-01', 12, '3.15', '4', '1', '70212063', 'JOSE LUIS RAMIREZ QUIROZ', '2019-10-12 12:17:41', '2019-10-12 12:17:41'),
(18, '1000.00', '2015-03-01', '2019-09-01', 12, '25.50', '12', '1', '2313216546', 'ALEJANDRO HUAMAN PEREZ', '2019-10-13 08:26:54', '2019-10-13 08:26:54'),
(19, '1200.00', '2015-03-01', '2019-09-01', 12, '3.15', '4', '1', '70212063', 'JOSE LUIS RAMIREZ QUIROZ', '2019-10-13 08:30:50', '2019-10-13 08:30:50'),
(20, '1500.00', '2018-03-01', '2019-09-01', 12, '12.00', '12', '1', '70212063', 'JOSE LUIS RAMIREZ QUIROZ', '2019-10-13 08:31:35', '2019-10-13 08:31:35'),
(21, '1200.00', '2019-10-01', '2019-09-01', 12, '3.15', '12', '1', '70212063', 'JOSE LUIS RAMIREZ QUIROZ', '2019-10-13 08:33:50', '2019-10-13 08:33:50');

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
(1, 1, '0', '1', '1', NULL, '2019-10-14 06:30:46'),
(2, 1, '0', '1', '1', NULL, '2019-10-14 06:45:49'),
(3, 1, '0', '0', '1', NULL, '2019-10-12 09:50:26'),
(4, 1, '0', '1', '1', NULL, '2019-10-14 07:34:00'),
(5, 1, '0', '0', '1', NULL, '2019-10-07 22:15:00'),
(6, 1, '0', '0', '1', NULL, '2019-10-12 09:23:59'),
(7, 1, '0', '0', '1', NULL, '2019-10-12 10:32:13'),
(8, 1, '0', '0', '1', NULL, '2019-10-12 09:21:20'),
(9, 1, '0', '0', '1', NULL, '2019-10-12 10:28:36'),
(10, 1, '0', '0', '1', NULL, '2019-10-12 11:30:58'),
(11, 1, '0', '0', '1', NULL, '2019-10-14 04:00:04'),
(12, 0, '0', '0', '1', NULL, '2019-10-08 06:37:14'),
(13, 0, '0', '0', 'socio', '2019-10-08 04:04:14', '2019-10-08 04:08:36'),
(16, 1, '0', '0', 'socio', '2019-10-08 06:39:15', '2019-10-12 11:32:37'),
(17, 1, '0', '0', 'socio', '2019-10-08 06:47:30', '2019-10-08 06:49:31'),
(21, 1, '0', '0', 'socio', '2019-10-14 02:38:41', '2019-10-14 02:41:05'),
(24, 1, '0', '0', 'socio', '2019-10-14 04:00:44', '2019-10-14 04:02:05'),
(29, 1, '0', '1', 'socio', '2019-10-14 07:39:31', '2019-10-14 07:42:22'),
(31, 1, '0', '0', 'socio', '2019-10-14 09:09:19', '2019-10-14 09:09:19');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `creditos`
--
ALTER TABLE `creditos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cuentaahorros`
--
ALTER TABLE `cuentaahorros`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cuotas`
--
ALTER TABLE `cuotas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `simulaciones`
--
ALTER TABLE `simulaciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
