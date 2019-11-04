-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-11-2019 a las 05:34:53
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
-- Base de datos: `zamora2_db`
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
(2, 1, 1, '150.00', '2019-10-13 23:13:33', 'Aporte', '12.00', '1', '2019-10-14 09:13:33', '2019-10-14 09:13:33'),
(3, 1, 1, '5000.00', '2019-10-15 21:03:32', 'Aporte', '17.00', '1', '2019-10-16 07:03:32', '2019-10-16 07:03:32'),
(4, 8, 8, '1100.00', '2019-10-23 21:40:42', 'Aporte', '17.00', '1', '2019-10-24 07:40:42', '2019-10-24 07:40:42'),
(5, 3, 3, '2344.00', '2019-10-27 22:20:45', 'asfsdfs', '17.00', '1', '2019-10-28 08:20:45', '2019-10-28 08:20:45'),
(6, 7, 7, '678.00', '2019-10-31 13:19:47', 'sr arer wer', '17.00', '1', '2019-10-31 23:19:47', '2019-10-31 23:19:47'),
(7, 4, 4, '123.00', '2019-10-31 13:43:16', 'qweqweqwe', '17.00', '1', '2019-10-31 23:43:16', '2019-10-31 23:43:16'),
(8, 8, 35, '1423.00', '2019-11-02 14:37:07', 'aporte maria', '17.00', '1', '2019-11-03 00:37:07', '2019-11-03 00:37:07'),
(9, 2, 14, '1500.00', '2019-11-02 18:01:01', 'Aporte', '17.00', '1', '2019-11-03 04:01:01', '2019-11-03 04:01:01'),
(10, 1, 14, '1000.00', '2019-11-02 20:14:43', 'Aporte', '17.00', '1', '2019-11-03 06:14:43', '2019-11-03 06:14:43');

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
  `estadodesembolso` char(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0 sin deseombolsar/1 desembolsadao',
  `periodo` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `creditos`
--

INSERT INTO `creditos` (`id`, `idsocio`, `idgarante`, `idusuario`, `numeroprestamo`, `montodesembolsado`, `fechadesembolso`, `numerocuotas`, `tipocambio`, `tasa`, `interes`, `estado`, `estadodesembolso`, `periodo`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 1, 'CZ000001', '10000.00', '2019-10-13', 12, '3.350000', '31.88', '1580.35', '1', '0', '12', '2019-10-14 06:30:46', '2019-10-14 06:30:46'),
(4, 4, 26, 14, 'CZ000003', '1000.00', '2019-10-13', 12, '3.350000', '31.88', '2968.99', '1', '1', '1', '2019-10-14 07:34:00', '2019-10-15 08:28:27'),
(5, 29, 30, 14, 'CZ000004', '5000.00', '2019-10-13', 12, '3.350000', '31.88', '790.18', '1', '1', '12', '2019-10-14 07:42:22', '2019-10-14 09:01:32'),
(6, 3, 3, 14, 'CZ000005', '50000.00', '2019-10-14', 12, '3.350000', '31.88', '7901.76', '1', '1', '12', '2019-10-15 08:35:16', '2019-10-16 04:35:15'),
(7, 5, 32, 14, 'CZ000006', '10000.00', '2019-10-15', 12, '3.350000', '31.87', '1579.90', '1', '1', '12', '2019-10-16 06:37:03', '2019-10-16 06:39:55'),
(8, 6, 6, 14, 'CZ000007', '10000.00', '2019-10-15', 12, '3.350000', '31.87', '1579.90', '1', '2', '12', '2019-10-16 06:55:32', '2019-10-22 08:40:13'),
(9, 8, 8, 14, 'CZ000008', '3000.00', '2019-10-17', 12, '3.350000', '31.87', '473.97', '1', '2', '12', '2019-10-18 07:21:17', '2019-10-22 08:49:23');

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
  `interes_ganado` decimal(10,2) NOT NULL,
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

INSERT INTO `cuentaahorros` (`id`, `idsocio`, `idusuario`, `numerocuenta`, `saldoefectivo`, `interes_ganado`, `fechaapertura`, `ultimomovimiento`, `descripcion`, `tasa`, `tipocuenta`, `estado`, `created_at`, `updated_at`) VALUES
(32, 3, 35, 'C-00003', '1577.00', '3.30', '2019-11-02 02:06:27', 60, 'Nueva Cuenta de Ahorros', '1.95', '1', '1', '2019-11-02 12:06:27', '2019-11-03 00:32:54'),
(34, 9, 35, 'C-00009', '0.00', '8.01', '2019-11-02 02:07:25', 49, 'Nueva Cuenta a Plazo Fijo', '2.28', '2', '0', '2019-11-02 12:07:25', '2019-11-02 12:39:21'),
(35, 8, 35, 'C-00008', '0.00', '1849.51', '2019-11-02 02:08:21', 57, 'Nueva Cuenta a Plazo Fijo', '4.91', '2', '0', '2019-11-02 12:08:21', '2019-11-02 13:26:50'),
(36, 8, 35, 'C-00008_2', '3921.00', '0.00', '2019-11-02 13:01:07', 58, 'Nueva Cuenta a Plazo Fijo', '5.37', '2', '1', '2019-11-02 23:01:07', '2019-11-02 23:01:07'),
(37, 4, 35, 'C-00004', '1600.00', '0.00', '2019-11-02 15:36:57', 61, 'Nueva Cuenta a Plazo Fijo', '3.13', '2', '1', '2019-11-03 01:36:57', '2019-11-03 01:36:58'),
(38, 37, 35, 'C-00037', '15382.00', '321.03', '2019-11-02 15:39:18', 70, 'Nueva Cuenta de Ahorros', '1.95', '1', '1', '2019-11-03 01:39:18', '2019-11-03 05:47:42'),
(39, 1, 14, 'C-00001', '1500.00', '0.00', '2019-11-02 17:57:09', 63, 'Nueva Cuenta a Plazo Fijo', '2.28', '2', '1', '2019-11-03 03:57:09', '2019-11-03 03:57:09'),
(40, 4, 14, 'C-00004_2', '500.00', '0.00', '2019-11-02 19:15:15', 65, 'Nueva Cuenta de Ahorros', '1.95', '1', '1', '2019-11-03 05:15:15', '2019-11-03 05:15:16'),
(41, 13, 14, 'C-00013', '0.00', '63.53', '2018-09-02 19:19:09', 67, 'Nueva Cuenta a Plazo Fijo', '3.76', '2', '0', '2019-11-03 05:19:09', '2019-11-03 05:29:07');

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
  `transaccion` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT 'umero de transaccion',
  `pagodeposito` decimal(10,2) NOT NULL DEFAULT '0.00',
  `fechadeposito` date DEFAULT NULL,
  `tipopago` int(2) NOT NULL DEFAULT '0' COMMENT '1 efectivo, 2 a deposito',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cuotas`
--

INSERT INTO `cuotas` (`id`, `numerodecuota`, `idcajero`, `idcredito`, `fechapago`, `fechacancelo`, `monto`, `interes`, `amortizacion`, `saldopendiente`, `mora`, `estado_mora`, `descripcion`, `estado`, `transaccion`, `pagodeposito`, `fechadeposito`, `tipopago`, `created_at`, `updated_at`) VALUES
(187, 1, 14, 2, '2019-10-13', '2019-10-13 21:53:50', '965.03', '233.28', '731.75', '9268.25', '0.00', '1', 'Pago', '1', '0', '0.00', NULL, 0, '2019-10-14 06:30:46', '2019-10-14 07:53:50'),
(188, 2, 14, 2, '2019-11-13', '2019-10-13 21:58:05', '965.03', '216.21', '748.82', '8519.43', '0.00', '1', 'Pago', '1', '0', '0.00', NULL, 0, '2019-10-14 06:30:46', '2019-10-14 07:58:05'),
(189, 3, 14, 2, '2019-12-13', '2019-10-14 22:15:21', '965.03', '198.74', '766.29', '7753.15', '0.00', '1', 'Pago', '1', '0', '0.00', NULL, 0, '2019-10-14 06:30:46', '2019-10-15 08:15:21'),
(190, 4, 1, 2, '2020-01-13', NULL, '965.03', '180.87', '784.16', '6968.98', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-14 06:30:46', '2019-10-14 06:30:46'),
(191, 5, 1, 2, '2020-02-13', NULL, '965.03', '162.57', '802.46', '6166.53', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-14 06:30:46', '2019-10-14 06:30:46'),
(192, 6, 1, 2, '2020-03-13', NULL, '965.03', '143.85', '821.18', '5345.35', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-14 06:30:46', '2019-10-14 06:30:46'),
(193, 7, 1, 2, '2020-04-13', NULL, '965.03', '124.70', '840.33', '4505.02', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-14 06:30:46', '2019-10-14 06:30:46'),
(194, 8, 1, 2, '2020-05-13', NULL, '965.03', '105.09', '859.94', '3645.08', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-14 06:30:46', '2019-10-14 06:30:46'),
(195, 9, 1, 2, '2020-06-13', NULL, '965.03', '85.03', '880.00', '2765.09', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-14 06:30:46', '2019-10-14 06:30:46'),
(196, 10, 1, 2, '2020-07-13', NULL, '965.03', '64.50', '900.53', '1864.56', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-14 06:30:46', '2019-10-14 06:30:46'),
(197, 11, 1, 2, '2020-08-13', NULL, '965.03', '43.50', '921.53', '943.03', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-14 06:30:46', '2019-10-14 06:30:46'),
(198, 12, 1, 2, '2020-09-13', NULL, '965.03', '22.00', '943.03', '0.00', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-14 06:30:46', '2019-10-14 06:30:46'),
(211, 1, 14, 4, '2019-10-13', '2019-10-13 21:36:47', '330.75', '318.80', '11.95', '988.05', '0.00', '1', 'Pago', '1', '0', '0.00', NULL, 0, '2019-10-14 07:34:00', '2019-10-14 07:36:47'),
(212, 2, 14, 4, '2020-10-13', NULL, '330.75', '314.99', '15.76', '972.29', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-14 07:34:00', '2019-10-14 07:34:00'),
(213, 3, 14, 4, '2021-10-13', NULL, '330.75', '309.97', '20.78', '951.51', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-14 07:34:00', '2019-10-14 07:34:00'),
(214, 4, 14, 4, '2022-10-13', NULL, '330.75', '303.34', '27.41', '924.10', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-14 07:34:00', '2019-10-14 07:34:00'),
(215, 5, 14, 4, '2023-10-13', NULL, '330.75', '294.60', '36.15', '887.95', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-14 07:34:00', '2019-10-14 07:34:00'),
(216, 6, 14, 4, '2024-10-13', NULL, '330.75', '283.08', '47.67', '840.28', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-14 07:34:00', '2019-10-14 07:34:00'),
(217, 7, 14, 4, '2025-10-13', NULL, '330.75', '267.88', '62.87', '777.42', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-14 07:34:00', '2019-10-14 07:34:00'),
(218, 8, 14, 4, '2026-10-13', NULL, '330.75', '247.84', '82.91', '694.51', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-14 07:34:00', '2019-10-14 07:34:00'),
(219, 9, 14, 4, '2027-10-13', NULL, '330.75', '221.41', '109.34', '585.16', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-14 07:34:00', '2019-10-14 07:34:00'),
(220, 10, 14, 4, '2028-10-13', NULL, '330.75', '186.55', '144.20', '440.97', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-14 07:34:00', '2019-10-14 07:34:00'),
(221, 11, 14, 4, '2029-10-13', NULL, '330.75', '140.58', '190.17', '250.80', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-14 07:34:00', '2019-10-14 07:34:00'),
(222, 12, 14, 4, '2030-10-13', NULL, '330.75', '79.95', '250.80', '0.00', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-14 07:34:00', '2019-10-14 07:34:00'),
(223, 1, 14, 5, '2019-10-15', '2019-10-13 21:44:34', '482.51', '116.64', '365.87', '4634.13', '0.00', '1', 'Pago', '1', '0', '0.00', NULL, 0, '2019-10-14 07:42:22', '2019-10-14 07:44:34'),
(224, 2, 14, 5, '2019-11-15', '2019-10-13 22:47:57', '482.51', '108.11', '374.41', '4259.72', '0.00', '1', 'Pago', '1', '0', '0.00', NULL, 0, '2019-10-14 07:42:22', '2019-10-14 08:47:57'),
(225, 3, 14, 5, '2019-12-15', NULL, '482.51', '99.37', '383.14', '3876.57', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-14 07:42:22', '2019-10-14 07:42:22'),
(226, 4, 14, 5, '2020-01-15', NULL, '482.51', '90.43', '392.08', '3484.49', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-14 07:42:22', '2019-10-14 07:42:22'),
(227, 5, 14, 5, '2020-02-15', NULL, '482.51', '81.29', '401.23', '3083.26', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-14 07:42:22', '2019-10-14 07:42:22'),
(228, 6, 14, 5, '2020-03-15', NULL, '482.51', '71.93', '410.59', '2672.68', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-14 07:42:22', '2019-10-14 07:42:22'),
(229, 7, 14, 5, '2020-04-15', NULL, '482.51', '62.35', '420.17', '2252.51', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-14 07:42:22', '2019-10-14 07:42:22'),
(230, 8, 14, 5, '2020-05-15', NULL, '482.51', '52.55', '429.97', '1822.54', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-14 07:42:22', '2019-10-14 07:42:22'),
(231, 9, 14, 5, '2020-06-15', NULL, '482.51', '42.52', '440.00', '1382.54', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-14 07:42:22', '2019-10-14 07:42:22'),
(232, 10, 14, 5, '2020-07-15', NULL, '482.51', '32.25', '450.26', '932.28', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-14 07:42:22', '2019-10-14 07:42:22'),
(233, 11, 14, 5, '2020-08-15', NULL, '482.51', '21.75', '460.77', '471.52', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-14 07:42:22', '2019-10-14 07:42:22'),
(234, 12, 14, 5, '2020-09-15', NULL, '482.51', '11.00', '471.52', '0.00', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-14 07:42:22', '2019-10-14 07:42:22'),
(235, 1, 14, 6, '2019-10-20', '2019-10-20 19:19:19', '4825.15', '1166.41', '3658.74', '46341.26', '0.00', '1', 'Pago', '1', '0', '0.00', NULL, 0, '2019-10-15 08:35:16', '2019-10-21 05:19:19'),
(236, 2, 14, 6, '2019-11-20', NULL, '4825.15', '1081.05', '3744.09', '42597.17', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-15 08:35:16', '2019-10-15 08:35:16'),
(237, 3, 14, 6, '2019-12-20', NULL, '4825.15', '993.71', '3831.43', '38765.73', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-15 08:35:16', '2019-10-15 08:35:16'),
(238, 4, 14, 6, '2020-01-20', NULL, '4825.15', '904.33', '3920.81', '34844.92', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-15 08:35:16', '2019-10-15 08:35:16'),
(239, 5, 14, 6, '2020-02-20', NULL, '4825.15', '812.87', '4012.28', '30832.64', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-15 08:35:16', '2019-10-15 08:35:16'),
(240, 6, 14, 6, '2020-03-20', NULL, '4825.15', '719.27', '4105.88', '26726.76', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-15 08:35:16', '2019-10-15 08:35:16'),
(241, 7, 14, 6, '2020-04-20', NULL, '4825.15', '623.49', '4201.66', '22525.10', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-15 08:35:16', '2019-10-15 08:35:16'),
(242, 8, 14, 6, '2020-05-20', NULL, '4825.15', '525.47', '4299.68', '18225.42', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-15 08:35:16', '2019-10-15 08:35:16'),
(243, 9, 14, 6, '2020-06-20', NULL, '4825.15', '425.16', '4399.98', '13825.44', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-15 08:35:16', '2019-10-15 08:35:16'),
(244, 10, 14, 6, '2020-07-20', NULL, '4825.15', '322.52', '4502.63', '9322.81', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-15 08:35:16', '2019-10-15 08:35:16'),
(245, 11, 14, 6, '2020-08-20', NULL, '4825.15', '217.48', '4607.66', '4715.15', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-15 08:35:16', '2019-10-15 08:35:16'),
(246, 12, 14, 6, '2020-09-20', NULL, '4825.15', '110.00', '4715.15', '0.00', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-15 08:35:16', '2019-10-15 08:35:16'),
(247, 1, 14, 7, '2019-10-15', '2019-10-15 20:41:42', '964.99', '233.22', '731.77', '9268.23', '0.00', '1', 'Pago', '1', '0', '0.00', NULL, 0, '2019-10-16 06:37:03', '2019-10-16 06:41:42'),
(248, 2, 14, 7, '2019-11-15', NULL, '964.99', '216.15', '748.84', '8519.38', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-16 06:37:03', '2019-10-16 06:37:03'),
(249, 3, 14, 7, '2019-12-15', NULL, '964.99', '198.69', '766.31', '7753.08', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-16 06:37:03', '2019-10-16 06:37:03'),
(250, 4, 14, 7, '2020-01-15', NULL, '964.99', '180.81', '784.18', '6968.90', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-16 06:37:03', '2019-10-16 06:37:03'),
(251, 5, 14, 7, '2020-02-15', NULL, '964.99', '162.53', '802.46', '6166.44', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-16 06:37:03', '2019-10-16 06:37:03'),
(252, 6, 14, 7, '2020-03-15', NULL, '964.99', '143.81', '821.18', '5345.26', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-16 06:37:03', '2019-10-16 06:37:03'),
(253, 7, 14, 7, '2020-04-15', NULL, '964.99', '124.66', '840.33', '4504.93', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-16 06:37:03', '2019-10-16 06:37:03'),
(254, 8, 14, 7, '2020-05-15', NULL, '964.99', '105.06', '859.93', '3645.00', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-16 06:37:03', '2019-10-16 06:37:03'),
(255, 9, 14, 7, '2020-06-15', NULL, '964.99', '85.01', '879.98', '2765.01', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-16 06:37:03', '2019-10-16 06:37:03'),
(256, 10, 14, 7, '2020-07-15', NULL, '964.99', '64.48', '900.51', '1864.51', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-16 06:37:03', '2019-10-16 06:37:03'),
(257, 11, 14, 7, '2020-08-15', NULL, '964.99', '43.48', '921.51', '943.00', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-16 06:37:03', '2019-10-16 06:37:03'),
(258, 12, 14, 7, '2020-09-15', NULL, '964.99', '21.99', '943.00', '0.00', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-16 06:37:03', '2019-10-16 06:37:03'),
(259, 1, 14, 8, '2019-09-15', '2019-10-15 20:58:04', '964.99', '233.22', '731.77', '9268.23', '146.37', '1', 'Pago', '1', '0', '0.00', NULL, 0, '2019-10-16 06:55:32', '2019-10-16 06:58:04'),
(260, 2, 14, 8, '2019-10-15', '2019-10-20 13:28:02', '964.99', '216.15', '748.84', '8519.38', '23.66', '1', 'Pago', '1', '0', '0.00', NULL, 0, '2019-10-16 06:55:32', '2019-10-20 23:28:02'),
(261, 3, 14, 8, '2019-11-15', '2019-10-20 13:28:10', '964.99', '198.69', '766.31', '7753.08', '0.00', '1', 'Pago', '1', '0', '0.00', NULL, 0, '2019-10-16 06:55:32', '2019-10-20 23:28:10'),
(262, 4, 14, 8, '2019-12-15', NULL, '964.99', '180.81', '784.18', '6968.90', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-16 06:55:32', '2019-10-16 06:55:32'),
(263, 5, 14, 8, '2020-01-15', NULL, '964.99', '162.53', '802.46', '6166.44', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-16 06:55:32', '2019-10-16 06:55:32'),
(264, 6, 14, 8, '2020-02-15', NULL, '964.99', '143.81', '821.18', '5345.26', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-16 06:55:32', '2019-10-16 06:55:32'),
(265, 7, 14, 8, '2020-03-15', NULL, '964.99', '124.66', '840.33', '4504.93', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-16 06:55:32', '2019-10-16 06:55:32'),
(266, 8, 14, 8, '2020-04-15', NULL, '964.99', '105.06', '859.93', '3645.00', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-16 06:55:32', '2019-10-16 06:55:32'),
(267, 9, 14, 8, '2020-05-15', NULL, '964.99', '85.01', '879.98', '2765.01', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-16 06:55:32', '2019-10-16 06:55:32'),
(268, 10, 14, 8, '2020-06-15', NULL, '964.99', '64.48', '900.51', '1864.51', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-16 06:55:32', '2019-10-16 06:55:32'),
(269, 11, 14, 8, '2020-07-15', NULL, '964.99', '43.48', '921.51', '943.00', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-16 06:55:32', '2019-10-16 06:55:32'),
(270, 12, 14, 8, '2020-08-15', NULL, '964.99', '21.99', '943.00', '0.00', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-16 06:55:32', '2019-10-16 06:55:32'),
(271, 1, 14, 9, '2019-10-17', '2019-11-02 17:25:04', '289.50', '69.96', '219.53', '2780.47', '23.02', '1', 'Pago', '1', '789798', '312.52', '2019-11-02', 2, '2019-10-18 07:21:17', '2019-11-03 03:25:04'),
(272, 2, 14, 9, '2019-11-17', '2019-11-02 17:59:08', '289.50', '64.85', '224.65', '2555.82', '0.00', '1', 'Pago', '1', '0', '0.00', NULL, 1, '2019-10-18 07:21:17', '2019-11-03 03:59:08'),
(273, 3, 14, 9, '2019-12-17', NULL, '289.50', '59.61', '229.89', '2325.92', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-18 07:21:17', '2019-10-18 07:21:17'),
(274, 4, 14, 9, '2020-01-17', NULL, '289.50', '54.24', '235.25', '2090.67', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-18 07:21:17', '2019-10-18 07:21:17'),
(275, 5, 14, 9, '2020-02-17', NULL, '289.50', '48.76', '240.74', '1849.93', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-18 07:21:17', '2019-10-18 07:21:17'),
(276, 6, 14, 9, '2020-03-17', NULL, '289.50', '43.14', '246.35', '1603.58', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-18 07:21:17', '2019-10-18 07:21:17'),
(277, 7, 14, 9, '2020-04-17', NULL, '289.50', '37.40', '252.10', '1351.48', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-18 07:21:17', '2019-10-18 07:21:17'),
(278, 8, 14, 9, '2020-05-17', NULL, '289.50', '31.52', '257.98', '1093.50', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-18 07:21:17', '2019-10-18 07:21:17'),
(279, 9, 14, 9, '2020-06-17', NULL, '289.50', '25.50', '264.00', '829.50', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-18 07:21:17', '2019-10-18 07:21:17'),
(280, 10, 14, 9, '2020-07-17', NULL, '289.50', '19.35', '270.15', '559.35', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-18 07:21:17', '2019-10-18 07:21:17'),
(281, 11, 14, 9, '2020-08-17', NULL, '289.50', '13.05', '276.45', '282.90', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-18 07:21:17', '2019-10-18 07:21:17'),
(282, 12, 14, 9, '2020-09-17', NULL, '289.50', '6.60', '282.90', '0.00', '0.00', '0', 'Debe', '0', '0', '0.00', NULL, 0, '2019-10-18 07:21:18', '2019-10-18 07:21:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `depositos_fijo`
--

CREATE TABLE `depositos_fijo` (
  `id` int(11) NOT NULL,
  `idcuenta` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `tasa` double NOT NULL,
  `monto` double NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fecha_cobro` date DEFAULT NULL,
  `monto_cobrado` double NOT NULL,
  `interes_cobrado` double NOT NULL,
  `descripcion` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `depositos_fijo`
--

INSERT INTO `depositos_fijo` (`id`, `idcuenta`, `fecha_inicio`, `fecha_fin`, `tasa`, `monto`, `updated_at`, `created_at`, `fecha_cobro`, `monto_cobrado`, `interes_cobrado`, `descripcion`) VALUES
(7, 34, '2019-10-02', '2019-12-02', 2.28, 4123, '2019-11-02 12:39:21', '2019-11-02 07:39:21', '2019-11-02', 4123, 8.01, 'CANCELACIÓN DE CUENTA'),
(8, 35, '2019-01-02', '2019-12-28', 4.91, 3098, '2019-11-02 12:53:22', '2019-11-02 07:53:22', '2019-11-02', 0, 127.97, 'CANCELACIÓN DE CUENTA'),
(9, 35, '2019-01-02', '2019-12-28', 4.91, 3098, '2019-11-02 12:59:05', '2019-11-02 07:59:05', '2019-11-02', 0, 127.97, 'CANCELACIÓN DE CUENTA'),
(10, 35, '2019-01-02', '2019-12-28', 4.91, 3098, '2019-11-02 13:09:45', '2019-11-02 08:09:45', '2019-11-02', 0, 127.97, 'RENOVACIÓN DE CUENTA'),
(11, 35, '2019-01-02', '2019-12-28', 4.91, 8350, '2019-11-02 13:20:24', '2019-11-02 08:20:24', '2019-11-02', 0, 344.91, 'RENOVACIÓN DE CUENTA/CANCELACIÓN DE CUENTA'),
(12, 35, '2019-01-02', '2019-12-28', 4.91, 8350, '2019-11-02 13:23:26', '2019-11-02 08:23:26', '2019-11-02', 0, 344.91, 'RENOVACIÓN DE CUENTA'),
(13, 35, '2019-01-02', '2019-12-28', 4.91, 8350, '2019-11-02 13:25:22', '2019-11-02 08:25:22', '2019-11-02', 0, 344.91, 'RENOVACIÓN DE CUENTA'),
(14, 35, '2019-01-02', '2019-12-28', 4.31, 8350, '2019-11-02 13:26:50', '2019-11-02 08:26:50', '2019-11-02', 8350, 302.9, 'RENOVACIÓN DE CUENTA/CANCELACIÓN DE CUENTA'),
(15, 36, '2019-11-02', '2020-10-28', 5.37, 3921, '2019-11-02 23:01:07', '2019-11-02 23:01:07', NULL, 0, 0, 'CREACIÓN DE CUENTA'),
(16, 37, '2019-11-02', '2020-01-31', 3.13, 1600, '2019-11-03 01:36:58', '2019-11-03 01:36:58', NULL, 0, 0, 'CREACIÓN DE CUENTA'),
(17, 39, '2019-11-02', '2019-12-02', 2.28, 1500, '2019-11-03 03:57:09', '2019-11-03 03:57:09', NULL, 0, 0, 'CREACIÓN DE CUENTA'),
(18, 41, '2019-01-02', '2019-12-28', 3.76, 2000.1, '2019-11-03 05:29:07', '2019-11-03 00:29:07', '2019-11-02', 2000.1, 63.53, 'CREACIÓN DE CUENTA/CANCELACIÓN DE CUENTA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id` int(10) UNSIGNED NOT NULL,
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
  `tasa_compensatoria_anual` decimal(10,2) NOT NULL COMMENT 'calculo para mora',
  `monto_min_30` decimal(11,0) NOT NULL,
  `monto_min_90` decimal(10,0) NOT NULL,
  `monto_min_180` decimal(10,0) NOT NULL,
  `monto_min_360` decimal(10,0) NOT NULL,
  `monto_min_361` decimal(10,0) NOT NULL,
  `monto_min_ahorros` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `tasa_aportes`, `tasa_creditos`, `tasa_ahorros`, `tasa_ahorros_comisiones`, `tasa_ahorros_gastos`, `tasa_ahorroplazo_30`, `tasa_ahorroplazo_90`, `tasa_ahorroplazo_180`, `tasa_ahorroplazo_360`, `tasa_ahorroplazo_361`, `tasa_moratoria_anual`, `tasa_compensatoria_anual`, `monto_min_30`, `monto_min_90`, `monto_min_180`, `monto_min_360`, `monto_min_361`, `monto_min_ahorros`) VALUES
(1, '17.00', '31.87', '1.95', '2.00', '5.00', '2.28', '3.13', '3.76', '4.31', '5.37', '141.85', '139.00', '1000', '1500', '2000', '2500', '3000', '350');

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
  `interes_ganado` decimal(10,2) NOT NULL,
  `descripcion` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipomovimiento` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `interes_ganado_total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`id`, `idusuario`, `idahorro`, `fecharegistro`, `monto`, `interes_ganado`, `descripcion`, `tipomovimiento`, `estado`, `created_at`, `updated_at`, `interes_ganado_total`) VALUES
(43, 35, 32, '2019-10-02 02:06:27', '1234.00', '0.00', 'CREACIÓN DE CUENTA', '1', '1', '2019-11-02 12:06:27', '2019-11-02 12:06:27', 0),
(45, 35, 34, '2019-10-02 02:07:25', '4123.00', '0.00', 'CREACIÓN DE CUENTA', '1', '1', '2019-11-02 12:07:25', '2019-11-02 12:07:25', 0),
(46, 35, 35, '2019-11-02 02:08:21', '3098.00', '0.00', 'CREACIÓN DE CUENTA', '1', '1', '2019-11-02 12:08:21', '2019-11-02 12:08:21', 0),
(47, 35, 32, '2019-10-12 02:26:46', '123.00', '2.05', 'retiro de cuenta ahorros', '0', '1', '2019-11-02 12:26:46', '2019-11-02 12:26:46', 2.05),
(48, 35, 32, '2019-11-02 02:31:11', '500.00', '1.25', 'Aporte de ahorros', '1', '1', '2019-11-02 12:31:11', '2019-11-02 12:31:11', 3.3),
(49, 35, 34, '2019-11-02 02:39:21', '4123.00', '8.01', 'COBRO DE MONTO E INTERÉS Y CANCELACIÓN DE CUENTA', '0', '1', '2019-11-02 12:39:21', '2019-11-02 12:39:21', 8.01),
(50, 35, 35, '2019-11-02 02:53:22', '0.00', '127.97', 'COBRO DE INTERÉS Y RENOVACIÓN DE CUENTA', '1', '1', '2019-11-02 12:53:22', '2019-11-02 12:53:22', 127.97),
(51, 35, 35, '2019-11-02 02:59:05', '0.00', '127.97', 'COBRO DE INTERÉS Y RENOVACIÓN DE CUENTA', '1', '1', '2019-11-02 12:59:05', '2019-11-02 12:59:05', 255.94),
(52, 35, 35, '2019-11-02 03:09:45', '0.00', '127.97', 'COBRO DE INTERÉS Y RENOVACIÓN DE CUENTA', '1', '1', '2019-11-02 13:09:45', '2019-11-02 13:09:45', 383.90999999999997),
(53, 35, 35, '2019-11-02 03:11:14', '3098.00', '127.97', 'COBRO DE MONTO E INTERÉS Y CANCELACIÓN DE CUENTA', '0', '1', '2019-11-02 13:11:14', '2019-11-02 13:11:14', 511.88),
(54, 35, 35, '2019-11-02 03:20:24', '0.00', '344.91', 'COBRO DE INTERÉS Y RENOVACIÓN DE CUENTA', '1', '1', '2019-11-02 13:20:24', '2019-11-02 13:20:24', 856.79),
(55, 35, 35, '2019-11-02 03:23:26', '0.00', '344.91', 'COBRO DE INTERÉS Y RENOVACIÓN DE CUENTA', '1', '1', '2019-11-02 13:23:26', '2019-11-02 13:23:26', 1201.7),
(56, 35, 35, '2019-11-02 03:25:22', '0.00', '344.91', 'COBRO DE INTERÉS Y RENOVACIÓN DE CUENTA', '1', '1', '2019-11-02 13:25:22', '2019-11-02 13:25:22', 1546.6100000000001),
(57, 35, 35, '2019-11-02 03:26:50', '8350.00', '302.90', 'COBRO DE MONTO E INTERÉS Y CANCELACIÓN DE CUENTA', '0', '1', '2019-11-02 13:26:50', '2019-11-02 13:26:50', 1849.5099999999998),
(58, 35, 36, '2019-11-02 13:01:07', '3921.00', '0.00', 'CREACIÓN DE CUENTA', '1', '1', '2019-11-02 23:01:07', '2019-11-02 23:01:07', 0),
(59, 35, 32, '2019-11-02 14:26:26', '1234.00', '0.00', 'asdasd', '0', '1', '2019-11-03 00:26:26', '2019-11-03 00:26:26', 3.3),
(60, 35, 32, '2019-11-02 14:32:54', '1200.00', '0.00', 'apoprte', '1', '1', '2019-11-03 00:32:54', '2019-11-03 00:32:54', 3.3),
(61, 35, 37, '2019-11-02 15:36:57', '1600.00', '0.00', 'CREACIÓN DE CUENTA', '1', '1', '2019-11-03 01:36:57', '2019-11-03 01:36:57', 0),
(62, 35, 38, '2019-11-02 15:39:18', '12432.00', '0.00', 'CREACIÓN DE CUENTA', '1', '1', '2019-11-03 01:39:18', '2019-11-03 01:39:18', 0),
(63, 14, 39, '2019-11-02 17:57:09', '1500.00', '0.00', 'CREACIÓN DE CUENTA', '1', '1', '2019-11-03 03:57:09', '2019-11-03 03:57:09', 0),
(64, 14, 38, '2019-11-02 18:03:07', '1000.00', '0.00', 'Retiro', '0', '1', '2019-11-03 04:03:07', '2019-11-03 04:03:07', 0),
(65, 14, 40, '2019-11-02 19:15:15', '500.00', '0.00', 'CREACIÓN DE CUENTA', '1', '1', '2019-11-03 05:15:15', '2019-11-03 05:15:15', 0),
(66, 14, 41, '2019-11-02 19:19:09', '2000.10', '0.00', 'CREACIÓN DE CUENTA', '1', '1', '2019-11-03 05:19:09', '2019-11-03 05:19:09', 0),
(67, 14, 41, '2019-11-02 19:29:07', '2000.10', '63.53', 'COBRO DE MONTO E INTERÉS Y CANCELACIÓN DE CUENTA', '0', '1', '2019-11-03 05:29:07', '2019-11-03 05:29:07', 63.53),
(68, 14, 38, '2019-11-02 19:32:35', '5000.00', '0.00', 'Aporte', '1', '1', '2019-11-03 05:32:35', '2019-11-03 05:32:35', 0),
(69, 14, 38, '2018-11-02 19:36:43', '50.00', '0.00', 'Retiro', '0', '1', '2019-11-03 05:36:43', '2019-11-03 05:36:43', 0),
(70, 14, 38, '2019-11-02 19:47:42', '1000.00', '321.03', 'Retiro', '0', '1', '2019-11-03 05:47:42', '2019-11-03 05:47:42', 321.03);

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
(9, '43728818-d-9', 'ERMINDA', 'JARAS RAMIREZ', '1993-04-05', 'JR SAN MARTIN 458', 'Cajamarca', 'Cajamarca', '964923450', 'correo@gmail.com', NULL, '2019-11-03 01:13:28'),
(10, '21012004', 'MARIA ESTELA', 'RODRIGUES RAMIREZ', '1993-04-05', 'JR SAN MARTIN 458', 'Cajamarca', 'Cajamarca', '964923450', 'correo@gmail.com', NULL, NULL),
(11, '20962820', 'EVA MARIA', 'ABANTOS RAMIREZ', '1993-04-05', 'JR SAN MARTIN 458', 'Cajamarca', 'Cajamarca', '964923450', 'correo@gmail.com', NULL, NULL),
(12, '27905558', 'MANUEL', 'PERALS RAMIREZ', '1993-04-05', 'JR SAN MARTIN 458', 'Cajamarca', 'Cajamarca', '964923450', 'correo@gmail.com', NULL, '2019-10-08 06:37:07'),
(13, '12458235', 'MARA JUDIT', 'QUILICHE HUARIPATA', '1993-03-01', 'JR CASUARINAS 458', 'Cajamarca', 'Cajamarca', '964923450', 'mara@gmail.com', '2019-10-08 04:04:14', '2019-10-08 04:08:14'),
(14, '70212063', 'JOSE LUIS', 'RAMIREZ QUIROZ', '1993-03-01', 'JR CASUARINAS 458', 'Cajamarca', 'Cajamarca', '964923450', 'jose@cersa.org.pe', '2019-10-08 04:07:41', '2019-10-08 04:07:41'),
(15, '20394056', 'ALEX', 'ZAMORA ROJAS', '1976-09-06', 'AV. INDUSTRIAL', 'Cajamarca', 'Cajamarca', '974173399', 'alexzamora01@hotmail.com', '2019-10-08 06:33:41', '2019-11-03 01:29:02'),
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
(31, '7054821', 'FREDY', 'PORTILLA AGUILAR', '2019-03-01', 'AV. INDUSTRIAL', 'Cajamarca', 'Cajamarca', '965254521', 'fredyy@hotmail.com', '2019-10-14 09:09:19', '2019-10-14 09:09:19'),
(32, '89653200', 'ANDRES', 'VILLAR', '1991-03-01', 'JR INSDUSTRIAL', 'CAJAMARCA', 'CAJAMARCA', '964923540', 'ANDRES@GMAIL.COM', '2019-10-16 06:37:02', '2019-10-16 06:37:02'),
(33, '80978658', 'ADMIN', 'ADMIN', '1993-03-01', 'JR CASUARINAS 458', 'Cajamarca', 'Cajamarca', '964923450', 'alexzamora01@hotmail.com', '2019-10-20 22:00:20', '2019-11-03 01:14:24'),
(34, '12345678', 'ADMIN', 'ASD', '2019-10-02', 'ASD', 'Cajamarca', 'Cajamarca', 'asd', 'mara@gmail.com', '2019-10-20 23:34:57', '2019-11-03 01:29:26'),
(35, '90897876', 'JUAN', 'VALERA GÁLVEZ', '1992-12-01', 'URB. OISJE 903', 'CAJAMARCA', 'CAJAMARCA', '9012398', 'asd@asd.com', '2019-10-27 10:15:58', '2019-11-03 01:14:00'),
(37, '12343213-d-37', 'UWE', 'IUQHWE', '1992-09-18', 'IUQWHE 12398123', 'IUQHWE', 'IQUWHE', '12938123', NULL, '2019-10-27 10:30:35', '2019-11-03 01:39:37');

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
(21, '1200.00', '2019-10-01', '2019-09-01', 12, '3.15', '12', '1', '70212063', 'JOSE LUIS RAMIREZ QUIROZ', '2019-10-13 08:33:50', '2019-10-13 08:33:50'),
(22, '1540.00', '2015-03-01', '2019-09-01', 12, '38.15', '12', '1', '70212063', 'JOSE LUIS RAMIREZ QUIROZ', '2019-10-15 08:39:33', '2019-10-15 08:39:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socios`
--

CREATE TABLE `socios` (
  `id` int(10) UNSIGNED NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `estadoahorro` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `estadocredito` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `interes_aportaciones` decimal(10,2) NOT NULL,
  `tipo` char(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `socios`
--

INSERT INTO `socios` (`id`, `estado`, `estadoahorro`, `estadocredito`, `interes_aportaciones`, `tipo`, `created_at`, `updated_at`) VALUES
(1, 1, '0', '1', '0.00', '1', NULL, '2019-10-14 06:30:46'),
(2, 1, '0', '1', '0.00', '1', NULL, '2019-10-14 06:45:49'),
(3, 1, '0', '1', '0.00', '1', NULL, '2019-10-15 08:35:16'),
(4, 1, '0', '1', '0.00', '1', NULL, '2019-10-14 07:34:00'),
(5, 1, '0', '1', '0.00', '1', NULL, '2019-10-16 06:37:03'),
(6, 1, '0', '1', '0.00', '1', NULL, '2019-10-16 06:55:32'),
(7, 1, '0', '0', '0.00', '1', NULL, '2019-10-12 10:32:13'),
(8, 1, '0', '1', '0.00', '1', NULL, '2019-10-18 07:21:18'),
(9, 1, '0', '0', '0.00', '1', NULL, '2019-11-03 01:35:22'),
(10, 1, '0', '0', '0.00', '1', NULL, '2019-10-12 11:30:58'),
(11, 1, '0', '0', '0.00', '1', NULL, '2019-10-14 04:00:04'),
(12, 1, '0', '0', '0.00', '1', NULL, '2019-10-08 06:37:14'),
(13, 1, '0', '0', '0.00', 'socio', '2019-10-08 04:04:14', '2019-10-08 04:08:36'),
(16, 1, '0', '0', '0.00', 'socio', '2019-10-08 06:39:15', '2019-10-12 11:32:37'),
(17, 1, '0', '0', '0.00', 'socio', '2019-10-08 06:47:30', '2019-10-08 06:49:31'),
(21, 1, '0', '0', '0.00', 'socio', '2019-10-14 02:38:41', '2019-10-14 02:41:05'),
(24, 1, '0', '0', '0.00', 'socio', '2019-10-14 04:00:44', '2019-10-14 04:02:05'),
(29, 1, '0', '1', '0.00', 'socio', '2019-10-14 07:39:31', '2019-10-14 07:42:22'),
(31, 1, '0', '0', '0.00', 'socio', '2019-10-14 09:09:19', '2019-10-14 09:09:19'),
(37, 1, '0', '0', '0.00', 'socio', '2019-10-27 10:30:35', '2019-11-03 01:40:19');

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
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `usuario`, `password`, `condicion`, `idrol`, `remember_token`) VALUES
(13, '22', '22', 1, 1, NULL),
(14, 'DES-14', '$2y$10$vAcRZbpdN3MDTJ/pKPbpSOKSqE3KKqwFhVWoAfiF4A/UTB.6er7pG', 1, 1, NULL),
(15, 'DES-15', '$2y$10$3MGmyVaJhgp1.j1tjqBgx.bHkxf4nEZNLmV6rfp1Ipq.BfasavWyq', 1, 1, NULL),
(33, 'DES-33', '$2y$10$ZrfVMq9dj4n9ohSGA1WEWOe9KVDdpbJDN4p/ucIREbAFTV97/4oDW', 1, 1, NULL),
(34, 'DES-34', '$2y$10$hS9HpkhYqeMh7672ybeJ3.yMTc9vEwhyYPLhnBgA5BtgAMtVUXZQe', 1, 1, NULL),
(35, 'DES-35', '$2y$10$AXX1jNVjpRZRD1yPhzOebuWgi8nsicvlMxldDXCfLa/l0FfMl0FxS', 1, 1, NULL);

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
-- Indices de la tabla `depositos_fijo`
--
ALTER TABLE `depositos_fijo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idcuenta` (`idcuenta`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
