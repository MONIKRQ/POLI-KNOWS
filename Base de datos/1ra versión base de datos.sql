-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 14-09-2018 a las 01:26:47
-- Versión del servidor: 5.1.36
-- Versión de PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de datos: `bdpoliknows`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblusuario`
--

CREATE TABLE IF NOT EXISTS `tblusuario` (
  `codigo` int(11) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `activo` int(11) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `tblusuario`
--

INSERT INTO `tblusuario` (`codigo`, `correo`, `password`, `activo`) VALUES
(1610010972, 'alejo_leal13@hotmail.com', '123456789', 0);
