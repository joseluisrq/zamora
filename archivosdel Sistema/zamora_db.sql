-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-10-2019 a las 07:51:30
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
-- Estructura de tabla para la tabla `ahorros`
--

CREATE TABLE `ahorros` (
  `id` int(10) UNSIGNED NOT NULL,
  `idsocio` int(10) UNSIGNED NOT NULL,
  `idusuario` int(10) UNSIGNED NOT NULL,
  `numerocuenta` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saldoefectivo` decimal(10,2) NOT NULL,
  `fechaapertura` date NOT NULL,
  `ultimodesembolso` date NOT NULL,
  `numerocuotas` int(11) NOT NULL,
  `tasa` decimal(4,2) NOT NULL,
  `estado` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuotas`
--

CREATE TABLE `cuotas` (
  `id` int(10) UNSIGNED NOT NULL,
  `idusuario` int(10) UNSIGNED NOT NULL,
  `idcredito` int(10) UNSIGNED NOT NULL,
  `fechapago` date NOT NULL,
  `fechacancelacion` datetime NOT NULL,
  `saldopendiente` decimal(12,2) NOT NULL,
  `monto` decimal(7,2) NOT NULL,
  `otroscostos` decimal(7,2) DEFAULT NULL,
  `descripcion` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id` int(10) UNSIGNED NOT NULL,
  `mora` decimal(5,2) NOT NULL,
  `interes` decimal(5,2) NOT NULL,
  `abonosocio` decimal(10,2) NOT NULL
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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_10_01_041422_create_personas_table', 1),
(5, '2019_10_01_042659_create_socios_table', 2),
(6, '2019_10_01_044538_create_roles_table', 3),
(7, '2019_10_02_000000_create_users_table', 4),
(8, '2019_10_01_051309_create_creditos_table', 5),
(9, '2019_10_01_051914_create_ahorros_table', 6),
(10, '2019_10_01_053510_create_cuotas_table', 7),
(12, '2019_10_01_054220_create_movimientos_table', 8),
(13, '2019_10_01_054447_create_empresa__table', 9);

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
  `saldopendiente` decimal(12,2) NOT NULL,
  `descripcion` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipomovimiento` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socios`
--

CREATE TABLE `socios` (
  `id` int(10) UNSIGNED NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `tipo` char(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ahorros`
--
ALTER TABLE `ahorros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ahorros_idsocio_foreign` (`idsocio`),
  ADD KEY `ahorros_idusuario_foreign` (`idusuario`);

--
-- Indices de la tabla `creditos`
--
ALTER TABLE `creditos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creditos_idsocio_foreign` (`idsocio`),
  ADD KEY `creditos_idgarante_foreign` (`idgarante`),
  ADD KEY `creditos_idusuario_foreign` (`idusuario`);

--
-- Indices de la tabla `cuotas`
--
ALTER TABLE `cuotas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cuotas_idusuario_foreign` (`idusuario`),
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
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT de la tabla `ahorros`
--
ALTER TABLE `ahorros`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `creditos`
--
ALTER TABLE `creditos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cuotas`
--
ALTER TABLE `cuotas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `socios`
--
ALTER TABLE `socios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ahorros`
--
ALTER TABLE `ahorros`
  ADD CONSTRAINT `ahorros_idsocio_foreign` FOREIGN KEY (`idsocio`) REFERENCES `socios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ahorros_idusuario_foreign` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `creditos`
--
ALTER TABLE `creditos`
  ADD CONSTRAINT `creditos_idgarante_foreign` FOREIGN KEY (`idgarante`) REFERENCES `socios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `creditos_idsocio_foreign` FOREIGN KEY (`idsocio`) REFERENCES `socios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `creditos_idusuario_foreign` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cuotas`
--
ALTER TABLE `cuotas`
  ADD CONSTRAINT `cuotas_idcredito_foreign` FOREIGN KEY (`idcredito`) REFERENCES `creditos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cuotas_idusuario_foreign` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `movimientos_idahorro_foreign` FOREIGN KEY (`idahorro`) REFERENCES `ahorros` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `movimientos_idusuario_foreign` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `socios`
--
ALTER TABLE `socios`
  ADD CONSTRAINT `socios_ibfk_1` FOREIGN KEY (`id`) REFERENCES `personas` (`id`);

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
