-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-04-2021 a las 06:09:57
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `red_social`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE IF NOT EXISTS `comentarios` (
`cod_com` int(5) NOT NULL,
  `desc_com` varchar(250) NOT NULL,
  `cod_post` int(5) NOT NULL,
  `cod_user` int(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`cod_com`, `desc_com`, `cod_post`, `cod_user`) VALUES
(8, 'Hermosa foto, lugar? ', 14, 15),
(9, 'Un sensor de mucha importancia dentro del Ã¡mbito ', 15, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `connects`
--

CREATE TABLE IF NOT EXISTS `connects` (
`cod_con` int(5) NOT NULL,
  `cod_inv` int(5) NOT NULL,
  `cod_env` int(5) NOT NULL,
  `cod_rec` int(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `connects`
--

INSERT INTO `connects` (`cod_con`, `cod_inv`, `cod_env`, `cod_rec`) VALUES
(30, 1, 14, 15),
(31, 1, 14, 16),
(28, 1, 15, 17),
(29, 1, 15, 17),
(27, 1, 17, 16),
(24, 2, 13, 15),
(25, 2, 13, 17),
(26, 2, 17, 14),
(22, 2, 18, 14),
(23, 2, 18, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_cuenta`
--

CREATE TABLE IF NOT EXISTS `estado_cuenta` (
`cod_ec` int(5) NOT NULL,
  `desc_ec` varchar(65) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado_cuenta`
--

INSERT INTO `estado_cuenta` (`cod_ec`, `desc_ec`) VALUES
(1, 'Verificada'),
(2, 'Sin verificar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invitacion`
--

CREATE TABLE IF NOT EXISTS `invitacion` (
`cod_inv` int(5) NOT NULL,
  `desc_inv` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `invitacion`
--

INSERT INTO `invitacion` (`cod_inv`, `desc_inv`) VALUES
(1, 'Pendiente'),
(2, 'Aceptada'),
(3, 'Rechazada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE IF NOT EXISTS `perfiles` (
`cod_per` int(5) NOT NULL,
  `pais_per` varchar(100) NOT NULL,
  `rese_per` varchar(100) NOT NULL,
  `proy_per` varchar(100) NOT NULL,
  `exp_per` varchar(100) NOT NULL,
  `educ_per` varchar(100) NOT NULL,
  `hab_per` varchar(100) NOT NULL,
  `rec_per` varchar(100) NOT NULL,
  `prem_per` varchar(100) NOT NULL,
  `int_per` varchar(100) NOT NULL,
  `idiom_per` varchar(100) NOT NULL,
  `cod_user` int(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`cod_per`, `pais_per`, `rese_per`, `proy_per`, `exp_per`, `educ_per`, `hab_per`, `rec_per`, `prem_per`, `int_per`, `idiom_per`, `cod_user`) VALUES
(1, 'Alemania ', 'Desarrollador ', 'Facebook ', 'Facebook INC ', 'Tercer nivel ', 'ProgramaciÃ³n, diseÃ±o web', 'Facebook INC ', 'Mejor del mes', 'Project manager', 'Aleman', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--

CREATE TABLE IF NOT EXISTS `post` (
`cod_post` int(5) NOT NULL,
  `tit_post` varchar(100) NOT NULL,
  `det_post` text NOT NULL,
  `fech_post` datetime NOT NULL,
  `cod_user` int(5) NOT NULL,
  `img_post` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `post`
--

INSERT INTO `post` (`cod_post`, `tit_post`, `det_post`, `fech_post`, `cod_user`, `img_post`) VALUES
(14, '', 'Mis futuras vacaciones', '2021-04-10 23:30:10', 13, 'demo/photos/mont.jpg'),
(15, '', 'Que tal, mi nuevo modulo ðŸ˜Ž', '2021-04-10 23:31:53', 17, 'demo/photos/Screenshot_20210116-153544_Samsung Internet.jpg'),
(16, '', 'Que les parece ðŸ™ƒ', '2021-04-10 23:36:39', 15, 'demo/photos/ping.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reacciones`
--

CREATE TABLE IF NOT EXISTS `reacciones` (
`cod_reac` int(5) NOT NULL,
  `cod_user` int(5) NOT NULL,
  `cod_post` int(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reacciones`
--

INSERT INTO `reacciones` (`cod_reac`, `cod_user`, `cod_post`) VALUES
(132, 14, 15),
(129, 15, 14),
(130, 15, 16),
(128, 17, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
`cod_user` int(5) NOT NULL,
  `nombre` varchar(65) NOT NULL,
  `apellido` varchar(85) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `clave` varchar(12) NOT NULL,
  `cod_est` int(5) NOT NULL,
  `numero` varchar(15) NOT NULL,
  `img_user` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`cod_user`, `nombre`, `apellido`, `correo`, `clave`, `cod_est`, `numero`, `img_user`) VALUES
(13, 'Pedro', 'Gomez', 'pedrogom@hotmail.com', 'pedro23', 1, '412254136', 'demo/faces/img/pedro.jpg'),
(14, 'Carlos', 'Sanchez', 'carlitos23san@gmail.com', 'carlos321', 1, '412254125', 'demo/faces/img/carlos.jpg'),
(15, 'Alfonso', 'Castillo', 'alfonso34_cast@gmail.com', 'castiloalf', 1, '412251478', 'demo/faces/img/alfonso.jpg'),
(16, 'Julian', 'Pacheco', 'july_pach@hotmail.com', 'julyan22', 1, '412236521', 'demo/faces/img/julian.jpg'),
(17, 'Santiago', 'Echeverria', 'sant123.cast@gmail.com', 'santicas', 1, '4123354', 'demo/faces/img/santiago.jpg'),
(18, 'JosÃ© ', 'Gomez', 'cast2000gomez@gmail.com', 'jota123', 1, '4125384925', 'demo/faces/img/defect.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
 ADD PRIMARY KEY (`cod_com`), ADD KEY `cod_post` (`cod_post`,`cod_user`), ADD KEY `cod_user` (`cod_user`);

--
-- Indices de la tabla `connects`
--
ALTER TABLE `connects`
 ADD PRIMARY KEY (`cod_con`), ADD KEY `cod_inv` (`cod_inv`,`cod_env`,`cod_rec`), ADD KEY `cod_env` (`cod_env`), ADD KEY `cod_rec` (`cod_rec`);

--
-- Indices de la tabla `estado_cuenta`
--
ALTER TABLE `estado_cuenta`
 ADD PRIMARY KEY (`cod_ec`);

--
-- Indices de la tabla `invitacion`
--
ALTER TABLE `invitacion`
 ADD PRIMARY KEY (`cod_inv`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
 ADD PRIMARY KEY (`cod_per`), ADD KEY `cod_user` (`cod_user`);

--
-- Indices de la tabla `post`
--
ALTER TABLE `post`
 ADD PRIMARY KEY (`cod_post`), ADD KEY `cod_user` (`cod_user`);

--
-- Indices de la tabla `reacciones`
--
ALTER TABLE `reacciones`
 ADD PRIMARY KEY (`cod_reac`), ADD KEY `cod_user` (`cod_user`,`cod_post`), ADD KEY `cod_post` (`cod_post`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`cod_user`), ADD KEY `cod_est` (`cod_est`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
MODIFY `cod_com` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `connects`
--
ALTER TABLE `connects`
MODIFY `cod_con` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT de la tabla `estado_cuenta`
--
ALTER TABLE `estado_cuenta`
MODIFY `cod_ec` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `invitacion`
--
ALTER TABLE `invitacion`
MODIFY `cod_inv` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
MODIFY `cod_per` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
MODIFY `cod_post` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `reacciones`
--
ALTER TABLE `reacciones`
MODIFY `cod_reac` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=133;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
MODIFY `cod_user` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`cod_post`) REFERENCES `post` (`cod_post`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`cod_user`) REFERENCES `usuario` (`cod_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `connects`
--
ALTER TABLE `connects`
ADD CONSTRAINT `connects_ibfk_1` FOREIGN KEY (`cod_env`) REFERENCES `usuario` (`cod_user`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `connects_ibfk_2` FOREIGN KEY (`cod_rec`) REFERENCES `usuario` (`cod_user`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `connects_ibfk_3` FOREIGN KEY (`cod_inv`) REFERENCES `invitacion` (`cod_inv`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `post`
--
ALTER TABLE `post`
ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`cod_user`) REFERENCES `usuario` (`cod_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reacciones`
--
ALTER TABLE `reacciones`
ADD CONSTRAINT `reacciones_ibfk_1` FOREIGN KEY (`cod_user`) REFERENCES `usuario` (`cod_user`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `reacciones_ibfk_2` FOREIGN KEY (`cod_post`) REFERENCES `post` (`cod_post`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`cod_est`) REFERENCES `estado_cuenta` (`cod_ec`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
