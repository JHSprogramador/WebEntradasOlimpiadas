-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-04-2024 a las 12:02:18
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
  `nombre_deporte` varchar(255) NOT NULL,
  `periodo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `deportes`
--

INSERT INTO `deportes` (`id`, `nombre_deporte`, `periodo`) VALUES
(1, 'Fútbol', 1),
(2, 'Baloncesto', 1),
(3, 'Tenis', 1),
(4, 'Golf', 1),
(5, 'Natación', 2),
(6, 'Atletismo', 2),
(7, 'Ciclismo', 2),
(8, 'Voleibol', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deportes_eventos`
--

CREATE TABLE `deportes_eventos` (
  `id` int(11) NOT NULL,
  `id_deporte_id` int(11) DEFAULT NULL,
  `id_evento_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `deportes_eventos`
--

INSERT INTO `deportes_eventos` (`id`, `id_deporte_id`, `id_evento_id`) VALUES
(1, 1, 3),
(2, 1, 5),
(3, 1, 6),
(4, 2, 1),
(5, 2, 5),
(6, 2, 6),
(7, 3, 1),
(8, 3, 3),
(9, 3, 5),
(10, 4, 3),
(11, 4, 4),
(12, 4, 5),
(13, 5, 4),
(14, 5, 5),
(15, 5, 6),
(16, 6, 1),
(17, 6, 3),
(18, 6, 5),
(19, 7, 3),
(20, 7, 5),
(21, 7, 6),
(22, 8, 1),
(23, 8, 3),
(24, 8, 5);

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

--
-- Volcado de datos para la tabla `estadios`
--

INSERT INTO `estadios` (`id`, `nombre_estadio`) VALUES
(1, 'Estadio A'),
(2, 'Estadio B'),
(3, 'Estadio C'),
(4, 'Estadio D');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `nombre_evento` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `nombre_evento`) VALUES
(1, 'Final femenina'),
(2, 'Final masculina'),
(3, 'Semifinal femenina'),
(4, 'Semifinal masculina'),
(5, 'Encuentro femenino'),
(6, 'Encuentro masculino');

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

--
-- Volcado de datos para la tabla `secciones`
--

INSERT INTO `secciones` (`id`, `id_estadio_id`, `aforo`, `nombre_seccion`) VALUES
(1, 1, 1130, 'Sección 1 en Estadio A'),
(2, 1, 4839, 'Sección 2 en Estadio A'),
(3, 1, 1908, 'Sección 3 en Estadio A'),
(4, 1, 3200, 'Sección 4 en Estadio A'),
(5, 2, 4495, 'Sección 1 en Estadio B'),
(6, 2, 2675, 'Sección 2 en Estadio B'),
(7, 2, 2123, 'Sección 3 en Estadio B'),
(8, 2, 1144, 'Sección 4 en Estadio B'),
(9, 3, 2287, 'Sección 1 en Estadio C'),
(10, 3, 1894, 'Sección 2 en Estadio C'),
(11, 3, 4407, 'Sección 3 en Estadio C'),
(12, 3, 3696, 'Sección 4 en Estadio C'),
(13, 4, 2121, 'Sección 1 en Estadio D'),
(14, 4, 3941, 'Sección 2 en Estadio D'),
(15, 4, 1251, 'Sección 3 en Estadio D'),
(16, 4, 4957, 'Sección 4 en Estadio D');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion_evento`
--

CREATE TABLE `seccion_evento` (
  `id` int(11) NOT NULL,
  `id_seccion_id` int(11) DEFAULT NULL,
  `id_deporte_evento_id` int(11) DEFAULT NULL,
  `precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `seccion_evento`
--

INSERT INTO `seccion_evento` (`id`, `id_seccion_id`, `id_deporte_evento_id`, `precio`) VALUES
(1, 5, 1, 95.8),
(2, 6, 1, 26.1),
(3, 7, 1, 18.7),
(4, 8, 1, 24.5),
(5, 5, 2, 88.1),
(6, 6, 2, 32.6),
(7, 7, 2, 90),
(8, 8, 2, 99.3),
(9, 5, 3, 58.6),
(10, 6, 3, 46.9),
(11, 7, 3, 30),
(12, 8, 3, 60.9),
(13, 1, 4, 50.9),
(14, 2, 4, 47.1),
(15, 3, 4, 28.7),
(16, 4, 4, 16.5),
(17, 1, 5, 30.2),
(18, 2, 5, 13.8),
(19, 3, 5, 32.2),
(20, 4, 5, 34.8),
(21, 1, 6, 74.2),
(22, 2, 6, 67.8),
(23, 3, 6, 66.6),
(24, 4, 6, 25.7),
(25, 9, 7, 87.1),
(26, 10, 7, 11.9),
(27, 11, 7, 77.7),
(28, 12, 7, 32.4),
(29, 9, 8, 50.7),
(30, 10, 8, 22.1),
(31, 11, 8, 53.3),
(32, 12, 8, 62),
(33, 9, 9, 37.3),
(34, 10, 9, 49.2),
(35, 11, 9, 98.8),
(36, 12, 9, 88.9),
(37, 13, 10, 76.5),
(38, 14, 10, 80.1),
(39, 15, 10, 10.8),
(40, 16, 10, 35.8),
(41, 13, 11, 97.8),
(42, 14, 11, 89.6),
(43, 15, 11, 91.3),
(44, 16, 11, 66.5),
(45, 13, 12, 54.8),
(46, 14, 12, 24),
(47, 15, 12, 85.4),
(48, 16, 12, 44.5),
(49, 1, 13, 35),
(50, 2, 13, 60.1),
(51, 3, 13, 37.7),
(52, 4, 13, 87.1),
(53, 1, 14, 26.3),
(54, 2, 14, 41.2),
(55, 3, 14, 49.9),
(56, 4, 14, 43.1),
(57, 1, 15, 24.5),
(58, 2, 15, 48.1),
(59, 3, 15, 32.8),
(60, 4, 15, 40.9),
(61, 5, 16, 45.8),
(62, 6, 16, 21.9),
(63, 7, 16, 38.9),
(64, 8, 16, 99.4),
(65, 5, 17, 19.3),
(66, 6, 17, 10.1),
(67, 7, 17, 17.1),
(68, 8, 17, 32.5),
(69, 5, 18, 86.6),
(70, 6, 18, 85.6),
(71, 7, 18, 36.1),
(72, 8, 18, 80.3),
(73, 9, 19, 35.9),
(74, 10, 19, 79),
(75, 11, 19, 11.2),
(76, 12, 19, 54.6),
(77, 9, 20, 74.2),
(78, 10, 20, 56.9),
(79, 11, 20, 42.7),
(80, 12, 20, 55.3),
(81, 9, 21, 25.9),
(82, 10, 21, 38.3),
(83, 11, 21, 20.1),
(84, 12, 21, 70.5),
(85, 13, 22, 16.8),
(86, 14, 22, 80.7),
(87, 15, 22, 90.3),
(88, 16, 22, 62.6),
(89, 13, 23, 42.4),
(90, 14, 23, 40.5),
(91, 15, 23, 96.8),
(92, 16, 23, 66.9),
(93, 13, 24, 60.1),
(94, 14, 24, 91.8),
(95, 15, 24, 58.5),
(96, 16, 24, 22.6);

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

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `id_auth0`, `mail`, `name`) VALUES
(1, 'google-oauth2|111801699804509519790', 'kkk2004@gmail.com', 'kkk');

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
-- Volcado de datos para la tabla `usuarios_meses`
--

INSERT INTO `usuarios_meses` (`id`, `id_usuario_id`, `mes1`, `mes2`) VALUES
(1, 1, 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `deportes`
--
ALTER TABLE `deportes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `deportes_eventos`
--
ALTER TABLE `deportes_eventos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B1BD40B68616D40A` (`id_deporte_id`),
  ADD KEY `IDX_B1BD40B67904465` (`id_evento_id`);

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
  ADD KEY `IDX_8A03286B52EC209E` (`id_deporte_evento_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `deportes_eventos`
--
ALTER TABLE `deportes_eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `entrada`
--
ALTER TABLE `entrada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estadios`
--
ALTER TABLE `estadios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `secciones`
--
ALTER TABLE `secciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `seccion_evento`
--
ALTER TABLE `seccion_evento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT de la tabla `transaxxiones`
--
ALTER TABLE `transaxxiones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios_meses`
--
ALTER TABLE `usuarios_meses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `deportes_eventos`
--
ALTER TABLE `deportes_eventos`
  ADD CONSTRAINT `FK_B1BD40B67904465` FOREIGN KEY (`id_evento_id`) REFERENCES `eventos` (`id`),
  ADD CONSTRAINT `FK_B1BD40B68616D40A` FOREIGN KEY (`id_deporte_id`) REFERENCES `deportes` (`id`);

--
-- Filtros para la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD CONSTRAINT `FK_C949A27417A0767C` FOREIGN KEY (`id_seccion_evento_id`) REFERENCES `seccion_evento` (`id`),
  ADD CONSTRAINT `FK_C949A2747EB2C349` FOREIGN KEY (`id_usuario_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `FK_C949A274B0DFD449` FOREIGN KEY (`id_transaccion_id`) REFERENCES `transaxxiones` (`id`);

--
-- Filtros para la tabla `secciones`
--
ALTER TABLE `secciones`
  ADD CONSTRAINT `FK_E7BAC5CA4039A3B9` FOREIGN KEY (`id_estadio_id`) REFERENCES `estadios` (`id`);

--
-- Filtros para la tabla `seccion_evento`
--
ALTER TABLE `seccion_evento`
  ADD CONSTRAINT `FK_8A03286B52EC209E` FOREIGN KEY (`id_deporte_evento_id`) REFERENCES `deportes_eventos` (`id`),
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
