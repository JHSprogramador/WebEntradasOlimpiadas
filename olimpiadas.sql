-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-04-2024 a las 13:53:29
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `olimpiadas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deportes`
--

CREATE TABLE `deportes` (
  `id` int(11) NOT NULL,
  `nombre_deporte` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240423085514', '2024-04-23 10:55:25', 126),
('DoctrineMigrations\\Version20240423110738', '2024-04-23 13:08:34', 429);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada`
--

CREATE TABLE `entrada` (
  `id` int(11) NOT NULL,
  `id_usuario_id` int(11) DEFAULT NULL,
  `id_seccion_evento_id` int(11) DEFAULT NULL,
  `id_transaccion_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadios`
--

CREATE TABLE `estadios` (
  `id` int(11) NOT NULL,
  `nombre_estadio` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `nombre_evento` varchar(255) NOT NULL,
  `periodo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos_deportes`
--

CREATE TABLE `eventos_deportes` (
  `eventos_id` int(11) NOT NULL,
  `deportes_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones`
--

CREATE TABLE `secciones` (
  `id` int(11) NOT NULL,
  `id_estadio_id` int(11) DEFAULT NULL,
  `aforo` int(11) NOT NULL,
  `nombre_seccion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion_evento`
--

CREATE TABLE `seccion_evento` (
  `id` int(11) NOT NULL,
  `id_seccion_id` int(11) DEFAULT NULL,
  `id_evento_id` int(11) DEFAULT NULL,
  `precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transaxxiones`
--

CREATE TABLE `transaxxiones` (
  `id` int(11) NOT NULL,
  `fecha_transaccion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `id_auth0` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_meses`
--

CREATE TABLE `usuarios_meses` (
  `id` int(11) NOT NULL,
  `id_usuario_id` int(11) DEFAULT NULL,
  `mes1` int(11) NOT NULL,
  `mes2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `deportes`
--
ALTER TABLE `deportes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C949A2747EB2C349` (`id_usuario_id`),
  ADD KEY `IDX_C949A27417A0767C` (`id_seccion_evento_id`),
  ADD KEY `IDX_C949A274B0DFD449` (`id_transaccion_id`);

--
-- Indices de la tabla `estadios`
--
ALTER TABLE `estadios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `eventos_deportes`
--
ALTER TABLE `eventos_deportes`
  ADD PRIMARY KEY (`eventos_id`,`deportes_id`),
  ADD KEY `IDX_FDBC7DD87F243861` (`eventos_id`),
  ADD KEY `IDX_FDBC7DD81F308F18` (`deportes_id`);

--
-- Indices de la tabla `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indices de la tabla `secciones`
--
ALTER TABLE `secciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E7BAC5CA4039A3B9` (`id_estadio_id`);

--
-- Indices de la tabla `seccion_evento`
--
ALTER TABLE `seccion_evento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8A03286BDFD0C1ED` (`id_seccion_id`),
  ADD KEY `IDX_8A03286B7904465` (`id_evento_id`);

--
-- Indices de la tabla `transaxxiones`
--
ALTER TABLE `transaxxiones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios_meses`
--
ALTER TABLE `usuarios_meses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_547E76C07EB2C349` (`id_usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `deportes`
--
ALTER TABLE `deportes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `entrada`
--
ALTER TABLE `entrada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estadios`
--
ALTER TABLE `estadios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `secciones`
--
ALTER TABLE `secciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `seccion_evento`
--
ALTER TABLE `seccion_evento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `transaxxiones`
--
ALTER TABLE `transaxxiones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios_meses`
--
ALTER TABLE `usuarios_meses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD CONSTRAINT `FK_C949A27417A0767C` FOREIGN KEY (`id_seccion_evento_id`) REFERENCES `seccion_evento` (`id`),
  ADD CONSTRAINT `FK_C949A2747EB2C349` FOREIGN KEY (`id_usuario_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `FK_C949A274B0DFD449` FOREIGN KEY (`id_transaccion_id`) REFERENCES `transaxxiones` (`id`);

--
-- Filtros para la tabla `eventos_deportes`
--
ALTER TABLE `eventos_deportes`
  ADD CONSTRAINT `FK_FDBC7DD81F308F18` FOREIGN KEY (`deportes_id`) REFERENCES `deportes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_FDBC7DD87F243861` FOREIGN KEY (`eventos_id`) REFERENCES `eventos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `secciones`
--
ALTER TABLE `secciones`
  ADD CONSTRAINT `FK_E7BAC5CA4039A3B9` FOREIGN KEY (`id_estadio_id`) REFERENCES `estadios` (`id`);

--
-- Filtros para la tabla `seccion_evento`
--
ALTER TABLE `seccion_evento`
  ADD CONSTRAINT `FK_8A03286B7904465` FOREIGN KEY (`id_evento_id`) REFERENCES `eventos` (`id`),
  ADD CONSTRAINT `FK_8A03286BDFD0C1ED` FOREIGN KEY (`id_seccion_id`) REFERENCES `secciones` (`id`);

--
-- Filtros para la tabla `usuarios_meses`
--
ALTER TABLE `usuarios_meses`
  ADD CONSTRAINT `FK_547E76C07EB2C349` FOREIGN KEY (`id_usuario_id`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
