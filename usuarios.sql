-- phpMyAdmin SQL Dump
-- version 4.6.4deb1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 18-11-2017 a las 11:12:45
-- Versión del servidor: 10.0.29-MariaDB-0ubuntu0.16.10.1
-- Versión de PHP: 7.0.18-0ubuntu0.16.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `scd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `tipo` enum('user','admin') NOT NULL DEFAULT 'user',
  `cedula` int(8) NOT NULL,
  `cargo` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `direccion` text NOT NULL,
  `sangre` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla para el manejo de usuarios';

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `correo`, `nombre`, `tipo`, `cedula`, `cargo`, `telefono`, `direccion`, `sangre`) VALUES
(2, '1user', 'e10adc3949ba59abbe56e057f20f883e', '1user@pdvsa.com', 'primer usuario', 'user', 19168691, 'algo', '123456', 'somewhere', 'O-'),
(3, '2user', 'e10adc3949ba59abbe56e057f20f883e', '2user@pdvsa.com', 'segundo usuario', 'admin', 0, '', '', '', ''),
(8, 'finalUser', '202cb962ac59075b964b07152d234b70', 'finalUser@hotmail.com', 'usuario final', 'user', 0, '', '', '', ''),
(9, '3user', 'e10adc3949ba59abbe56e057f20f883e', 'user3@pdvsa.com', 'usuario numero 3', 'user', 0, '', '', '', ''),
(11, '4user', 'e10adc3949ba59abbe56e057f20f883e', 'user4@pdvsa.com', 'Usuario numero 4', 'user', 0, '', '', '', ''),
(12, '5user', 'e10adc3949ba59abbe56e057f20f883e', '4user@pdvsa.com', 'otro usuario mas', 'admin', 0, '', '', '', ''),
(13, '6user', 'e10adc3949ba59abbe56e057f20f883e', 'user4@pdvsa.com', 'usuario 6', 'admin', 0, '', '', '', ''),
(15, 'aaa', 'e35cf7b66449df565f93c607d5a81d09', 'aaa@gmail.com', 'aaa', 'user', 0, '', '', '', ''),
(16, 'alguienx', 'e10adc3949ba59abbe56e057f20f883e', 'alguienx@pdvsa.com', 'alguien', 'admin', 123456789, 'algo-1', '123456', 'som', 'O+');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
