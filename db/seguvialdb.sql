-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 24-12-2018 a las 12:28:44
-- Versión del servidor: 10.1.37-MariaDB-0+deb9u1
-- Versión de PHP: 7.1.25-1+0~20181207224650.11+stretch~1.gbpf65b84

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `seguvialdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `antecedentes`
--

CREATE TABLE `antecedentes` (
  `nro_ant` int(10) UNSIGNED NOT NULL,
  `fuenteOrigen` varchar(50) NOT NULL,
  `estado_alta` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `fe_comp` varchar(50) NOT NULL,
  `fe_compTxt` varchar(50) NOT NULL,
  `tcomp` varchar(50) NOT NULL,
  `ncomp` varchar(50) NOT NULL,
  `tinfraccion` varchar(50) NOT NULL,
  `finfraccion` varchar(50) NOT NULL,
  `fe_infr` varchar(50) NOT NULL,
  `fe_infrTxt` varchar(50) NOT NULL,
  `lugar` varchar(50) NOT NULL,
  `jurisdiccion` varchar(50) NOT NULL,
  `dominio` varchar(50) NOT NULL,
  `tdoc_titular` varchar(50) NOT NULL,
  `ndoc_titular` varchar(50) NOT NULL,
  `dato_conductor` varchar(50) NOT NULL,
  `tdoc_conductor` varchar(50) NOT NULL,
  `ndoc_conductor` varchar(50) NOT NULL,
  `nivel_ejecucion` varchar(50) NOT NULL,
  `estado_infraccion` varchar(50) NOT NULL,
  `isFirme` varchar(50) NOT NULL,
  `isPaga` varchar(50) NOT NULL,
  `fe_resolucion` varchar(50) NOT NULL,
  `fe_resolucionTxt` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imputacionesSch`
--

CREATE TABLE `imputacionesSch` (
  `nro_imputacion` int(10) UNSIGNED NOT NULL,
  `nro_ant` int(10) UNSIGNED NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `asunto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `infracciones`
--

CREATE TABLE `infracciones` (
  `nro_infraccion` int(11) NOT NULL,
  `dni` int(11) NOT NULL,
  `monto` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `infracciones`
--

INSERT INTO `infracciones` (`nro_infraccion`, `dni`, `monto`) VALUES
(1, 11111111, 11),
(2, 11111111, 22),
(3, 11111111, 590),
(4, 11111112, 444),
(5, 11111113, 123),
(6, 11111113, 456);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `dni` int(11) NOT NULL,
  `nyape` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`dni`, `nyape`) VALUES
(11111111, 'Jose Castro'),
(11111112, 'Matias Gonzales'),
(11111113, 'Liza Chand'),
(11111114, 'Grazyna Linen'),
(11111115, 'Marinda Bracy'),
(11111116, 'Hermelinda Page'),
(11111117, 'Lana Ruben'),
(11111118, 'Marilyn Drumm'),
(11111119, 'Roland Goldsby'),
(11111120, 'Lizbeth Deherrera'),
(11111121, 'Laurette Kovach'),
(11111122, 'Roselee Calixte'),
(11111123, 'Anita Larrimore'),
(11111124, 'Leeann Crossley'),
(11111125, 'Jeanett Claw'),
(11111126, 'Dewey Avitia'),
(11111127, 'Zonia Kung'),
(11111128, 'Maudie Taul'),
(11111129, 'Mitchell Samms'),
(11111130, 'Rina Stalder'),
(11111131, 'Mack Damron'),
(11111132, 'Nona Rhode'),
(11111133, 'Elizbeth Harwell'),
(11111134, 'Rosanna Royall'),
(11111135, 'Katia Domingue'),
(11111136, 'Marielle Goree'),
(11111137, 'Wynona Worthen'),
(11111138, 'Johnette Agron'),
(11111139, 'Fredricka Welte'),
(11111140, 'Gilberto Azevedo'),
(11111141, 'Idalia Naugle'),
(11111142, 'Fonda Blythe'),
(11111143, 'Vernon Rolling'),
(11111144, 'Migdalia Mcnitt'),
(11111145, 'Sanda Betancourt'),
(11111146, 'Cleopatra Carrizales'),
(11111147, 'Eldora Ferranti'),
(11111148, 'Gaynell Bernstein'),
(11111149, 'Noel Toki'),
(11111150, 'Karrie Gunn'),
(11111151, 'Felton Norden'),
(11111152, 'Temeka Chock'),
(11111153, 'Donetta Justiniano'),
(11111154, 'Katharina Scot'),
(11111155, 'Elene Principato'),
(11111156, 'Tess Mcclellan'),
(11111157, 'Chet Hewey'),
(11111158, 'Kimberley Gathers'),
(11111159, 'Carletta Knipe'),
(11111160, 'Leoma Lindow'),
(11111161, 'Juan Perez'),
(11111162, 'Ana Perez'),
(11111163, 'Ana Juarez'),
(11111164, 'aaaaaa'),
(11111165, 'vvvv'),
(11111166, 'mati');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `antecedentes`
--
ALTER TABLE `antecedentes`
  ADD PRIMARY KEY (`nro_ant`);

--
-- Indices de la tabla `imputacionesSch`
--
ALTER TABLE `imputacionesSch`
  ADD PRIMARY KEY (`nro_imputacion`),
  ADD KEY `CF_imputacionesSch` (`nro_ant`);

--
-- Indices de la tabla `infracciones`
--
ALTER TABLE `infracciones`
  ADD PRIMARY KEY (`nro_infraccion`),
  ADD KEY `CF_ingracciones` (`dni`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`dni`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `antecedentes`
--
ALTER TABLE `antecedentes`
  MODIFY `nro_ant` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `infracciones`
--
ALTER TABLE `infracciones`
  MODIFY `nro_infraccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `dni` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11111167;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `imputacionesSch`
--
ALTER TABLE `imputacionesSch`
  ADD CONSTRAINT `CF_imputacionesSch` FOREIGN KEY (`nro_ant`) REFERENCES `antecedentes` (`nro_ant`);

--
-- Filtros para la tabla `infracciones`
--
ALTER TABLE `infracciones`
  ADD CONSTRAINT `CF_ingracciones` FOREIGN KEY (`dni`) REFERENCES `usuarios` (`dni`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
