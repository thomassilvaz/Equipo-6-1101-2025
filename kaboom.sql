-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-10-2025 a las 21:34:16
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `kaboom`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `texto` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuario_doc` int(20) NOT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `texto`, `fecha`, `usuario_doc`, `parent_id`) VALUES
(1, 'Hola', '2025-08-05 19:36:28', 12345, NULL),
(3, 'COMENTARIO DE PRUEBA', '2025-08-05 19:41:25', 12345, NULL),
(17, 'ff', '2025-08-12 21:58:43', 123456, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reacciones`
--

CREATE TABLE `reacciones` (
  `id` int(11) NOT NULL,
  `tipo` enum('like','dislike') NOT NULL,
  `usuario_doc` int(20) NOT NULL,
  `comentario_id` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `reacciones`
--

INSERT INTO `reacciones` (`id`, `tipo`, `usuario_doc`, `comentario_id`, `fecha`) VALUES
(9, 'like', 12345, 17, '2025-09-25 15:15:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `Id` int(40) NOT NULL,
  `Nombre_rol` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`Id`, `Nombre_rol`) VALUES
(1, 'Administrador'),
(2, 'Operario'),
(3, 'Asesor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`id`, `nombre`) VALUES
(1, 'Cédula'),
(2, 'Tarjeta de Identidad'),
(3, 'Cédula de Extranjería');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `doc` int(20) NOT NULL,
  `tipo_documento` varchar(2) NOT NULL,
  `PNombre` varchar(60) NOT NULL,
  `SNombre` varchar(60) NOT NULL,
  `PApellido` varchar(60) NOT NULL,
  `SApellido` varchar(60) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `clave` varchar(101) NOT NULL,
  `Id_rol` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`doc`, `tipo_documento`, `PNombre`, `SNombre`, `PApellido`, `SApellido`, `tel`, `email`, `clave`, `Id_rol`) VALUES
(231, 'CC', 'gg', 'khl', 'mg', 'jkg', '432132', 'fggeth@h5342', '$2y$10$IdraJ7ZwBvRHJK6p2pN9zu5reWyqnCC0bO3eHqku5Fr0YLsJvbRjG', 3),
(4324, 'CE', 'sddddd', '', 'dasdsad', '', '321312313', 'sasdasda@dasddas', '$2y$10$q/B7v0ElZVbgUDkGqLBMA.zK4HkcNdRhKOhuE3TMihKkI1Og5S.ZS', 1),
(12345, 'CC', 'Thomas', '', 'Silva', 'Zapata', '123', 'gh@gmail.com', '$2y$10$mjpV.a5vGTU/dqB2L7/Xa.4o5BBQW9Pvut2Sq.kV4SuwbxQQmde1O', 2),
(123456, 'CC', 'Miguel', 'thsa', 'rwe', '', '432234432432', 'mdasdasd@dasdasd.comdsadsa', '$2y$10$iyju4I5LyVdI/ZuPbVjL3OXXhuealzDJB1zkoiuZPkoz/ptiouOhq', 2),
(1233222, 'TI', 'aassss', '', 'asdsas', '', '12222211', 'sasda@dasddas', '$2y$10$wNFXOpK5VCwvpmKF9i8DU.YyeqVSnuYCxeIHr550kjdBsoJO2HOIq', 1),
(1234511, 'TI', 'aaaaa', '', 'aasdds', '', '122222', 'saddasda@dasdaaaa', '$2y$10$IFW49c8yWsPvk1IjF.LeEObQNknDt4bqdNGVMaihqN04cwMrDYqt2', 3),
(1234522, 'TI', 'aaaaaaa', '', 'aaaaaaa', '', '1111111', 'saddasda@daaaaa', '$2y$10$U0kjYDtsk9g3G2mGTCf7.uI25OTrRI5Tw0utt8VpOSSWv2/nm9SAK', 1),
(1234567, 'CC', 'Miguel', '', 'Silva', 'Zapata', '213479', 'mdasdasd@dasdasd.comy', '$2y$10$6h/T5ClKgz/VYGYIZX5uWeAYHZ7eLMnUJ2qR9SFkQCXn.0V00hBYC', 1),
(10359781, 'CC', 'Miguel', 'Angel ', 'Silva', 'Lopez', '2147483647', 'mdasdasd@dasdasd.com', '$2y$10$1SJPU1Ok3khChHBB1SG/Re2kbTAyZvgX0bCeCZahQG77P6ueoV/aS', 2),
(11111111, 'TI', 'dsdsadadsdsa', '', 'adsadsadsadsads', '', '23213231212', 'saddasda@ddsadadsadsa', '$2y$10$hp1GUK1TZ1p6NeYHU4XWre5ZtmY1rSIzuGDN8HuDhcNbiSs6Y/6RK', 3),
(12345666, 'TI', 'sidio', '', 'god', '', '233133', 'ghdasd@gmail.com', '$2y$10$mRJdgdIm6loCi4KHhHGUPOohvJZivibFYp8krt6Ut0UcVXGTYgbyy', 1),
(12346667, 'TI', 'saaaa', '', 'dsas', '', '21112311', 'sasda@dasdaaaa', '$2y$10$r2VLqwVbHPM12OC3InNq3e.dlyozamNY7fIVqDjlzmrpzOi23c85m', 1),
(22222222, 'CC', 'Miguel', '', 'Silva', 'Zapata', '12356', 'thfd@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1),
(23134654, 'CC', 'ggtrts', 'khlew', 'mgeg', 'jkgtre', '432132234', 'fggeth@h5342gfds', '$2y$10$M6SkLfxhv5ire7msegkQzepx91FSXV.7Lboe.gT1SF2hDUsfoduVm', 2),
(103597811, 'CC', 'Miguel', 'Angel ', 'Marin', 'Lopez', '3053121826', 'mdasdasd@dasdasd.com', '$2y$10$ZkDgtXOOCRXUCMLeizNpauE8KJ4L3R0msDRMzOCBQdR0Bw1QkdhFu', 1),
(123456789, 'CC', 'Thomas', '', 'Silva', 'Zapata', '123', 'gh@gmail.com', '$2y$10$SXcrtHEgBeKPqcP45mdKbePmNSE8S1qFoMol1GTkxY31SnesujYIq', 1),
(1011399335, 'CC', 'Thomas', '', 'Silva', 'Zapata', '123', 'gh@gmail.com', '202cb962ac59075b964b07152d234b70', 2),
(1011399355, 'CC', 'Santiago', '', 'Salazar', 'a', '121', 'heg@fgs.com', '15de21c670ae7c3f6f3f1f37029303c9', 1),
(1035978097, 'CC', 'Miguel', 'Angel ', 'Marin', 'Lopez', '2147483647', 'mdasdasd@dasdasd.com', '$2y$10$wTQuN0m7oYDCL/FJ0x90BOOg6PUKjAm1naKg5h1XGrAYp8zGMKNfO', 1),
(2147483647, 'CC', 'Miguel', 'Angel ', 'Marin', 'Lopez', '2147483647', 'mdasdasd@dasdasd.com', '$2y$10$1zVZa8qh5CTP5AWz4xJ2ou1TKVHwShlfDz4JFmueP3JNOSaMNRuFS', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_doc` (`usuario_doc`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indices de la tabla `reacciones`
--
ALTER TABLE `reacciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario_comentario` (`usuario_doc`,`comentario_id`),
  ADD KEY `comentario_id` (`comentario_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`doc`),
  ADD KEY `Id_rol` (`Id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `reacciones`
--
ALTER TABLE `reacciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`usuario_doc`) REFERENCES `usuarios` (`doc`),
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `comentarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reacciones`
--
ALTER TABLE `reacciones`
  ADD CONSTRAINT `reacciones_ibfk_1` FOREIGN KEY (`usuario_doc`) REFERENCES `usuarios` (`doc`),
  ADD CONSTRAINT `reacciones_ibfk_2` FOREIGN KEY (`comentario_id`) REFERENCES `comentarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`Id_rol`) REFERENCES `rol` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
