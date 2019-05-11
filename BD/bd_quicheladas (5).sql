-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-05-2019 a las 21:41:27
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_quicheladas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ajustes`
--

CREATE TABLE `ajustes` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ajustes`
--

INSERT INTO `ajustes` (`id`, `fecha`, `usuario_id`) VALUES
(1, '2019-04-30 23:30:57', 5),
(2, '2019-05-01 23:49:28', 5),
(3, '2019-05-03 11:17:18', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ajustes_productos`
--

CREATE TABLE `ajustes_productos` (
  `id` int(11) NOT NULL,
  `ajuste_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `stock_bd` int(11) NOT NULL,
  `stock_fisico` int(11) NOT NULL,
  `diferencia_stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ajustes_productos`
--

INSERT INTO `ajustes_productos` (`id`, `ajuste_id`, `producto_id`, `stock_bd`, `stock_fisico`, `diferencia_stock`) VALUES
(0, 1, 66, 408, 408, 0),
(0, 1, 67, 157, 157, 0),
(0, 1, 68, 331, 331, 0),
(0, 1, 69, 67, 67, 0),
(0, 1, 70, 375, 375, 0),
(0, 1, 71, 49, 49, 0),
(0, 1, 72, 0, 0, 0),
(0, 1, 74, 54, 54, 0),
(0, 1, 75, 648, 648, 0),
(0, 1, 76, 169, 169, 0),
(0, 1, 77, 423, 423, 0),
(0, 1, 78, 120, 120, 0),
(0, 1, 79, 66, 66, 0),
(0, 1, 80, 127, 127, 0),
(0, 1, 81, 143, 143, 0),
(0, 1, 82, 111, 111, 0),
(0, 1, 83, 82, 82, 0),
(0, 1, 84, 152, 152, 0),
(0, 1, 85, 206, 206, 0),
(0, 1, 86, 197, 197, 0),
(0, 1, 122, 15, 15, 0),
(0, 1, 123, 0, 0, 0),
(0, 1, 124, 26, 26, 0),
(0, 1, 125, 571, 571, 0),
(0, 1, 126, 65, 65, 0),
(0, 1, 127, 53, 53, 0),
(0, 1, 130, 1, 1, 0),
(0, 1, 132, 18, 18, 0),
(0, 1, 133, 62, 62, 0),
(0, 1, 134, 26, 26, 0),
(0, 1, 135, 11, 11, 0),
(0, 1, 139, 8, 8, 0),
(0, 1, 140, 0, 0, 0),
(0, 1, 141, 5, 5, 0),
(0, 1, 142, 5, 5, 0),
(0, 1, 143, 5, 5, 0),
(0, 1, 172, 5, 5, 0),
(0, 1, 173, 7, 7, 0),
(0, 1, 174, 6, 6, 0),
(0, 1, 177, 18, 18, 0),
(0, 1, 178, 42, 42, 0),
(0, 1, 181, 47, 47, 0),
(0, 1, 186, 395, 395, 0),
(0, 1, 190, 7, 7, 0),
(0, 1, 191, 1, 1, 0),
(0, 1, 192, 2, 2, 0),
(0, 1, 199, 22, 22, 0),
(0, 1, 210, 16, 16, 0),
(0, 1, 211, 39, 39, 0),
(0, 1, 212, 28, 28, 0),
(0, 1, 228, 4, 4, 0),
(0, 1, 230, 9, 9, 0),
(0, 1, 232, 1, 1, 0),
(0, 1, 233, 6, 6, 0),
(0, 1, 234, 8, 8, 0),
(0, 2, 66, 408, 408, 0),
(0, 2, 67, 157, 157, 0),
(0, 2, 68, 331, 331, 0),
(0, 2, 69, 67, 67, 0),
(0, 2, 70, 375, 375, 0),
(0, 2, 71, 49, 49, 0),
(0, 2, 72, 0, 0, 0),
(0, 2, 74, 54, 54, 0),
(0, 2, 75, 648, 648, 0),
(0, 2, 76, 169, 169, 0),
(0, 2, 77, 423, 423, 0),
(0, 2, 78, 120, 120, 0),
(0, 2, 79, 66, 66, 0),
(0, 2, 80, 127, 127, 0),
(0, 2, 81, 143, 143, 0),
(0, 2, 82, 111, 111, 0),
(0, 2, 83, 82, 82, 0),
(0, 2, 84, 152, 152, 0),
(0, 2, 85, 206, 206, 0),
(0, 2, 86, 197, 197, 0),
(0, 2, 122, 15, 15, 0),
(0, 2, 123, 0, 0, 0),
(0, 2, 124, 26, 26, 0),
(0, 2, 125, 571, 571, 0),
(0, 2, 126, 65, 65, 0),
(0, 2, 127, 53, 53, 0),
(0, 2, 130, 1, 1, 0),
(0, 2, 132, 18, 18, 0),
(0, 2, 133, 62, 62, 0),
(0, 2, 134, 26, 26, 0),
(0, 2, 135, 11, 11, 0),
(0, 2, 139, 8, 8, 0),
(0, 2, 140, 0, 0, 0),
(0, 2, 141, 5, 5, 0),
(0, 2, 142, 5, 5, 0),
(0, 2, 143, 5, 5, 0),
(0, 2, 172, 5, 5, 0),
(0, 2, 173, 7, 7, 0),
(0, 2, 174, 6, 6, 0),
(0, 2, 177, 18, 18, 0),
(0, 2, 178, 42, 42, 0),
(0, 2, 181, 47, 47, 0),
(0, 2, 186, 395, 395, 0),
(0, 2, 190, 7, 7, 0),
(0, 2, 191, 1, 1, 0),
(0, 2, 192, 2, 2, 0),
(0, 2, 199, 22, 22, 0),
(0, 2, 210, 16, 16, 0),
(0, 2, 211, 39, 39, 0),
(0, 2, 212, 28, 28, 0),
(0, 2, 228, 4, 4, 0),
(0, 2, 230, 9, 9, 0),
(0, 2, 232, 1, 1, 0),
(0, 2, 233, 6, 6, 0),
(0, 2, 234, 8, 8, 0),
(0, 3, 66, 408, 408, 0),
(0, 3, 67, 157, 157, 0),
(0, 3, 68, 331, 331, 0),
(0, 3, 69, 67, 67, 0),
(0, 3, 70, 375, 375, 0),
(0, 3, 71, 49, 49, 0),
(0, 3, 72, 0, 0, 0),
(0, 3, 74, 54, 54, 0),
(0, 3, 75, 648, 648, 0),
(0, 3, 76, 169, 169, 0),
(0, 3, 77, 423, 423, 0),
(0, 3, 78, 120, 120, 0),
(0, 3, 79, 66, 66, 0),
(0, 3, 80, 127, 127, 0),
(0, 3, 81, 143, 143, 0),
(0, 3, 82, 111, 111, 0),
(0, 3, 83, 82, 82, 0),
(0, 3, 84, 152, 152, 0),
(0, 3, 85, 206, 206, 0),
(0, 3, 86, 197, 197, 0),
(0, 3, 122, 15, 15, 0),
(0, 3, 123, 0, 0, 0),
(0, 3, 124, 26, 26, 0),
(0, 3, 125, 571, 571, 0),
(0, 3, 126, 65, 65, 0),
(0, 3, 127, 53, 53, 0),
(0, 3, 130, 1, 1, 0),
(0, 3, 132, 18, 18, 0),
(0, 3, 133, 62, 62, 0),
(0, 3, 134, 26, 26, 0),
(0, 3, 135, 11, 11, 0),
(0, 3, 139, 8, 8, 0),
(0, 3, 140, 0, 0, 0),
(0, 3, 141, 5, 5, 0),
(0, 3, 142, 5, 5, 0),
(0, 3, 143, 5, 5, 0),
(0, 3, 172, 5, 5, 0),
(0, 3, 173, 7, 7, 0),
(0, 3, 174, 6, 6, 0),
(0, 3, 177, 18, 18, 0),
(0, 3, 178, 42, 42, 0),
(0, 3, 181, 47, 47, 0),
(0, 3, 186, 395, 395, 0),
(0, 3, 190, 7, 7, 0),
(0, 3, 191, 1, 1, 0),
(0, 3, 192, 2, 2, 0),
(0, 3, 199, 22, 22, 0),
(0, 3, 210, 16, 16, 0),
(0, 3, 211, 39, 39, 0),
(0, 3, 212, 28, 28, 0),
(0, 3, 228, 4, 4, 0),
(0, 3, 230, 9, 9, 0),
(0, 3, 232, 1, 1, 0),
(0, 3, 233, 6, 6, 0),
(0, 3, 234, 8, 8, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `nombre`, `estado`) VALUES
(1, 'Terraza', 1),
(2, 'Sala', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `id` int(11) NOT NULL,
  `fecha_apertura` datetime NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `observacion` varchar(200) NOT NULL,
  `fecha_cierre` datetime DEFAULT NULL,
  `monto_apertura` double(10,2) NOT NULL,
  `numero_ventas` int(11) NOT NULL,
  `monto_ventas` double(10,2) NOT NULL,
  `monto_final_caja` double(10,2) NOT NULL,
  `monto_ventas_tarjeta` double(10,2) NOT NULL,
  `gastos` double(10,2) NOT NULL,
  `monto_creditos` double(10,2) NOT NULL,
  `efectivo_caja` double(10,2) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `monto_efectivo` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`id`, `fecha_apertura`, `usuario_id`, `observacion`, `fecha_cierre`, `monto_apertura`, `numero_ventas`, `monto_ventas`, `monto_final_caja`, `monto_ventas_tarjeta`, `gastos`, `monto_creditos`, `efectivo_caja`, `estado`, `monto_efectivo`) VALUES
(1, '2019-04-23 13:39:08', 5, 'cierre de caja', '2019-04-27 20:27:42', 100.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00),
(2, '2019-04-27 20:44:22', 5, 'cierre de caja', '2019-04-27 20:45:28', 200.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00),
(3, '2019-04-28 10:13:29', 5, 'Cierre de Caja', '2019-04-28 10:16:08', 200.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00),
(4, '2019-04-28 10:18:15', 5, 'Cierre de Caja', '2019-04-28 10:28:12', 300.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00),
(5, '2019-04-28 10:38:59', 5, 'Cierre de Caja', '2019-04-28 10:39:59', 320.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00),
(6, '2019-04-28 10:41:07', 5, 'Cierre de caja', '2019-04-28 10:46:52', 200.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00),
(7, '2019-04-28 10:48:17', 5, 'Cierre de Caja', '2019-04-28 10:49:31', 200.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00),
(8, '2019-04-28 10:52:02', 5, 'Cierre de Caja', '2019-04-28 10:52:52', 100.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00),
(9, '2019-04-28 12:43:14', 5, 'Caja Cerrrada', '2019-04-28 20:24:39', 200.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 398.00),
(10, '2019-04-28 20:47:19', 5, 'Cierre de Caja', '2019-04-28 21:56:41', 200.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 320.00),
(11, '2019-04-28 22:01:33', 5, 'Cierre de Caja', '2019-04-28 22:07:50', 200.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 410.00),
(12, '2019-04-28 22:45:39', 5, 'Cierre de Caja', '2019-04-28 22:53:46', 200.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 358.00),
(13, '2019-04-28 22:54:22', 5, 'c', '2019-04-28 22:54:47', 200.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 200.00),
(14, '2019-04-28 22:59:18', 5, 'Caja', '2019-04-28 22:59:34', 200.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 200.00),
(15, '2019-04-28 23:03:51', 5, 'cierre', '2019-04-28 23:10:20', 200.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 200.00),
(16, '2019-04-28 23:19:06', 5, 'cccc', '2019-04-28 23:19:17', 200.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 200.00),
(17, '2019-04-28 23:22:24', 5, 'ccccc', '2019-04-28 23:22:37', 200.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 200.00),
(18, '2019-04-28 23:41:08', 5, 'sdsds', '2019-04-28 23:41:23', 200.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 200.00),
(19, '2019-04-28 23:45:39', 5, 'Cieere de Caja', '2019-04-29 19:41:02', 200.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 310.00),
(20, '2019-04-29 19:41:47', 5, '', NULL, 200.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 0.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`, `estado`) VALUES
(4, 'Panes', 'Panes', 1),
(5, 'Boquitas', 'Acompañamientos', 1),
(6, 'Pizzas', 'Artesanales', 1),
(7, 'Caldos', 'Caldos', 0),
(8, 'Quesadillas', 'Quesadillas', 1),
(9, 'Tortillas y Tacos', 'Tacos o Tortillas', 1),
(10, 'Gallo', 'Cervecería Nacional', 0),
(11, 'Pepsi', 'Distribuidora ', 0),
(12, 'Licor', 'Cervecería Nacional', 1),
(13, 'Tragos ', 'Licor Preparado', 1),
(14, 'Plato Fuerte', 'Platos Fuertes', 1),
(15, 'Ceviches', 'Ceviches', 1),
(16, 'Coca Cola', 'Gaseosa', 0),
(17, 'Ofertas', 'Cerveza', 0),
(18, 'Bebidas Calientes', 'Bebida', 1),
(19, 'Cerveza', 'Todo lo que se refiere a Cerveza', 1),
(20, 'Gaseosas', 'Gaseosa', 1),
(21, 'Quicheladas y  Picositas', 'Cerveza Preparada', 1),
(22, 'Boquitas de Promoción y De Botellas', 'Promocion', 1),
(23, 'Cigarros', 'Cancer', 1),
(24, 'Jirafas', 'Cerveza', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `tipo_cliente_id` int(11) DEFAULT NULL,
  `tipo_documento_id` int(11) DEFAULT NULL,
  `num_documento` varchar(45) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `telefono`, `direccion`, `tipo_cliente_id`, `tipo_documento_id`, `num_documento`, `estado`) VALUES
(1, 'CF', '00000000', 'Ciudad', NULL, NULL, NULL, 1),
(2, 'Cliente', '00000000', 'Ciudad', NULL, NULL, NULL, 0),
(39, 'Cliente', '', '', NULL, NULL, NULL, 0),
(40, 'Cliente', '', '', NULL, NULL, NULL, 0),
(41, 'Cliente', '', '', NULL, NULL, NULL, 0),
(42, 'Cliente', '000000', 'Ciudad', NULL, NULL, NULL, 0),
(43, 'Cliente', '', '', NULL, NULL, NULL, 0),
(44, 'Cliente', '', '', NULL, NULL, NULL, 0),
(45, 'Cliente', '', '', NULL, NULL, NULL, 0),
(46, 'Mesa.', '', '', NULL, NULL, NULL, 0),
(47, 'fg', '', '', NULL, NULL, NULL, 0),
(48, 'Se digito de mas', '', '', NULL, NULL, NULL, 0),
(49, 'Se digito de mas', '', '', NULL, NULL, NULL, 0),
(50, 'Se digito de mas', '', '', NULL, NULL, NULL, 0),
(51, 'Se digito de mas', '', '', NULL, NULL, NULL, 0),
(52, 'Se digito de mas', '', '', NULL, NULL, NULL, 0),
(53, 'Cliente', '', '', NULL, NULL, NULL, 0),
(54, 'Cliente', '', '', NULL, NULL, NULL, 0),
(55, 'Cliente', '', '', NULL, NULL, NULL, 0),
(56, 'Cliente', '', '', NULL, NULL, NULL, 0),
(57, 'Cliente', '', '', NULL, NULL, NULL, 0),
(58, 'Mesas', '', '', NULL, NULL, NULL, 0),
(59, 'Cliente', '', '', NULL, NULL, NULL, 0),
(60, 'Cliente', '', '', NULL, NULL, NULL, 0),
(61, 'Cliente', '', '', NULL, NULL, NULL, 0),
(62, 'Cliente', '', '', NULL, NULL, NULL, 0),
(63, 'Cliente', '', '', NULL, NULL, NULL, 0),
(64, 'Cliente', '', '', NULL, NULL, NULL, 0),
(65, 'Cliente', '', '', NULL, NULL, NULL, 0),
(66, 'Cliente', '', '', NULL, NULL, NULL, 0),
(67, 'Cliente', '', '', NULL, NULL, NULL, 0),
(68, 'Cliente', '', '', NULL, NULL, NULL, 0),
(69, 'Cliente', '', '', NULL, NULL, NULL, 0),
(70, 'Cliente', '', '', NULL, NULL, NULL, 0),
(71, 'Cliente', '', '', NULL, NULL, NULL, 0),
(72, 'Cliente', '', '', NULL, NULL, NULL, 0),
(73, 'Cliente', '', '', NULL, NULL, NULL, 0),
(74, 'Cliente', '', '', NULL, NULL, NULL, 0),
(75, 'Cliente', '', '', NULL, NULL, NULL, 0),
(76, 'Cliente', '', '', NULL, NULL, NULL, 0),
(77, 'Cliente', '', '', NULL, NULL, NULL, 0),
(78, 'Cliente', '', '', NULL, NULL, NULL, 0),
(79, 'Cliente', '', '', NULL, NULL, NULL, 0),
(80, 'Cliente', '', '', NULL, NULL, NULL, 0),
(81, 'Cliente', '', '', NULL, NULL, NULL, 0),
(82, 'C/F', '', '', NULL, NULL, NULL, 0),
(83, 'C/F', '', '', NULL, NULL, NULL, 0),
(84, 'C/F', '', '', NULL, NULL, NULL, 0),
(85, 'C/F', '', '', NULL, NULL, NULL, 0),
(86, 'C/F', '', '', NULL, NULL, NULL, 0),
(87, 'C/F', '', '', NULL, NULL, NULL, 0),
(88, 'Rafa', '', '', NULL, NULL, NULL, 1),
(89, 'Leslie', '', '', NULL, NULL, NULL, 1),
(90, 'Papi', '', '', NULL, NULL, NULL, 1),
(91, 'tele', '', '', NULL, NULL, NULL, 0),
(92, 'donel', '', '', NULL, NULL, NULL, 1),
(93, 'Comida', '', '', NULL, NULL, NULL, 0),
(94, 'Bebidas', '', '', NULL, NULL, NULL, 0),
(95, 'Inicio de Dia', '', '', 1, 1, '154165', 1),
(96, 'Chejo Medrano', '', '', NULL, NULL, NULL, 1),
(97, 'Grupo', '', '', NULL, NULL, NULL, 1),
(98, 'Fin', '', '', NULL, NULL, NULL, 1),
(99, 'Fuentes Poli', '', '', NULL, NULL, NULL, 1),
(100, 'jeff', '', '', NULL, NULL, NULL, 1),
(101, 'Chepe Ozuna', '', '', NULL, NULL, NULL, 1),
(102, 'cambio', '', '', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `subtotal` varchar(45) DEFAULT NULL,
  `total` varchar(45) DEFAULT NULL,
  `comprobante_id` varchar(100) NOT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `tipo_pago` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `numero` varchar(50) NOT NULL,
  `serie` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `fecha`, `subtotal`, `total`, `comprobante_id`, `proveedor_id`, `tipo_pago`, `usuario_id`, `estado`, `numero`, `serie`) VALUES
(1, '2019-04-26', '48.00', '48.00', '1', 1, 1, 5, 1, '0000021', '001');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuraciones`
--

CREATE TABLE `configuraciones` (
  `id` int(11) NOT NULL,
  `clave_permiso` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `configuraciones`
--

INSERT INTO `configuraciones` (`id`, `clave_permiso`) VALUES
(1, '2403quiche2018');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuraciones_cupones`
--

CREATE TABLE `configuraciones_cupones` (
  `id` int(11) NOT NULL,
  `tipo_cupon` int(11) NOT NULL,
  `valor` double(10,2) NOT NULL,
  `monto_minimo` decimal(10,2) NOT NULL,
  `monto_maximo` decimal(10,2) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `configuraciones_cupones`
--

INSERT INTO `configuraciones_cupones` (`id`, `tipo_cupon`, `valor`, `monto_minimo`, `monto_maximo`, `fecha_inicio`, `fecha_final`) VALUES
(1, 1, 5.00, '300.00', '500.00', '2019-05-10', '2019-05-13'),
(2, 1, 10.00, '500.00', '1000.00', '2019-05-10', '2019-05-13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correos`
--

CREATE TABLE `correos` (
  `id` int(11) NOT NULL,
  `correo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `correos`
--

INSERT INTO `correos` (`id`, `correo`) VALUES
(1, 'yonybrondy@gmail.com'),
(2, 'julio@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_cobrar`
--

CREATE TABLE `cuentas_cobrar` (
  `id` int(11) NOT NULL,
  `venta_id` int(11) NOT NULL,
  `monto` double(10,2) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cupones_generados`
--

CREATE TABLE `cupones_generados` (
  `id` int(11) NOT NULL,
  `codigo` varchar(150) NOT NULL,
  `tipo_cupon` int(11) NOT NULL,
  `valor` double(10,2) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `fecha_limite` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cupones_generados`
--

INSERT INTO `cupones_generados` (`id`, `codigo`, `tipo_cupon`, `valor`, `estado`, `fecha_limite`) VALUES
(1, 'f7b57', 1, 5.00, 1, '2019-05-13'),
(2, 'e8a1c', 1, 5.00, 1, '2019-05-13'),
(3, 'beaa7', 1, 5.00, 1, '2019-05-13'),
(4, 'c27aa', 1, 5.00, 1, '2019-05-13'),
(5, '2268c', 1, 5.00, 1, '2019-05-13'),
(6, '1b2f4', 1, 5.00, 1, '2019-05-13'),
(7, '0caf2', 1, 5.00, 1, '2019-05-13'),
(8, '20443', 1, 5.00, 1, '2019-05-13'),
(9, '00efb', 1, 5.00, 1, '2019-05-13'),
(10, '12191', 1, 5.00, 1, '2019-05-13'),
(11, '32381', 1, 5.00, 1, '2019-05-13'),
(12, 'b238b', 1, 5.00, 0, '2019-05-13'),
(13, '95d6e', 1, 5.00, 0, '2019-05-13'),
(14, 'cb839', 1, 5.00, 1, '2019-05-13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `id` int(11) NOT NULL,
  `compra_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `precio` varchar(45) DEFAULT NULL,
  `cantidad` varchar(45) DEFAULT NULL,
  `importe` varchar(45) DEFAULT NULL,
  `unidad_medida_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalle_compra`
--

INSERT INTO `detalle_compra` (`id`, `compra_id`, `producto_id`, `precio`, `cantidad`, `importe`, `unidad_medida_id`) VALUES
(1, 1, 69, '24.00', '2', '48.00', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `venta_id` int(11) DEFAULT NULL,
  `precio` varchar(45) DEFAULT NULL,
  `cantidad` varchar(45) DEFAULT NULL,
  `importe` varchar(45) DEFAULT NULL,
  `descuento` double(10,2) NOT NULL,
  `codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`id`, `producto_id`, `venta_id`, `precio`, `cantidad`, `importe`, `descuento`, `codigo`) VALUES
(1, 9, 1, '35.00', '4', '136.00', 4.00, 0),
(2, 10, 1, '45.00', '3', '135.00', 0.00, 0),
(3, 23, 1, '30.00', '3', '90.00', 0.00, 0),
(4, 9, 2, '35.00', '3', '103.00', 2.00, 0),
(5, 10, 2, '45.00', '4', '180.00', 0.00, 0),
(6, 23, 2, '30.00', '3', '90.00', 0.00, 0),
(7, 9, 3, '35.00', '2', '68.00', 2.00, 0),
(8, 10, 3, '45.00', '2', '90.00', 0.00, 0),
(9, 23, 3, '30.00', '3', '90.00', 0.00, 0),
(10, 9, 4, '35.00', '3', '103.00', 2.00, 0),
(11, 23, 4, '30.00', '4', '120.00', 0.00, 0),
(12, 10, 5, '45.00', '3', '135.00', 0.00, 0),
(13, 23, 5, '30.00', '3', '90.00', 0.00, 0),
(14, 9, 6, '35.00', '2', '68.00', 2.00, 0),
(15, 10, 6, '45.00', '2', '90.00', 0.00, 0),
(16, 23, 7, '30.00', '2', '60.00', 0.00, 0),
(17, 9, 8, '35.00', '2', '68.00', 2.00, 0),
(18, 10, 8, '45.00', '2', '90.00', 0.00, 0),
(19, 9, 9, '35.00', '4', '136.00', 4.00, 0),
(20, 10, 10, '45.00', '2', '90.00', 0.00, 0),
(21, 23, 10, '30.00', '2', '60.00', 0.00, 0),
(22, 9, 11, '35.00', '2', '68.00', 2.00, 0),
(23, 10, 11, '45.00', '2', '90.00', 0.00, 0),
(24, 23, 11, '30.00', '2', '60.00', 0.00, 0),
(25, 9, 12, '35.00', '2', '68.00', 2.00, 0),
(26, 10, 12, '45.00', '2', '90.00', 0.00, 0),
(27, 23, 12, '30.00', '2', '60.00', 0.00, 0),
(28, 10, 13, '45.00', '2', '90.00', 0.00, 0),
(29, 23, 13, '30.00', '2', '60.00', 0.00, 0),
(30, 9, 14, '35.00', '2', '68.00', 2.00, 0),
(31, 10, 14, '45.00', '2', '90.00', 0.00, 0),
(32, 23, 14, '30.00', '2', '60.00', 0.00, 0),
(33, 10, 15, '45.00', '2', '90.00', 0.00, 0),
(34, 23, 15, '30.00', '2', '60.00', 0.00, 0),
(35, 11, 16, '20.00', '2', '40.00', 0.00, 0),
(36, 12, 16, '30.00', '2', '60.00', 0.00, 0),
(37, 13, 16, '40.00', '2', '80.00', 0.00, 0),
(38, 9, 17, '35.00', '2', '68.00', 2.00, 0),
(39, 10, 17, '45.00', '2', '90.00', 0.00, 0),
(40, 23, 17, '30.00', '2', '60.00', 0.00, 0),
(41, 9, 18, '35.00', '2', '68.00', 2.00, 0),
(42, 10, 18, '45.00', '2', '90.00', 0.00, 0),
(43, 23, 18, '30.00', '2', '60.00', 0.00, 0),
(44, 9, 19, '35.00', '1', '35.00', 0.00, 0),
(45, 10, 19, '45.00', '1', '45.00', 0.00, 0),
(46, 9, 20, '35.00', '2', '68.00', 2.00, 0),
(47, 23, 20, '30.00', '2', '60.00', 0.00, 0),
(48, 9, 21, '35.00', '2', '68.00', 2.00, 0),
(49, 10, 21, '45.00', '2', '90.00', 0.00, 0),
(50, 23, 21, '30.00', '2', '60.00', 0.00, 0),
(51, 10, 22, '45.00', '2', '90.00', 0.00, 0),
(52, 23, 22, '30.00', '2', '60.00', 0.00, 0),
(53, 9, 23, '35.00', '2', '68.00', 2.00, 0),
(54, 10, 23, '45.00', '2', '90.00', 0.00, 0),
(55, 9, 24, '35.00', '1', '35.00', 0.00, 0),
(56, 10, 24, '45.00', '1', '45.00', 0.00, 0),
(57, 23, 24, '30.00', '1', '30.00', 0.00, 0),
(58, 9, 25, '35.00', '1', '35.00', 0.00, 0),
(59, 10, 25, '45.00', '1', '45.00', 0.00, 0),
(60, 10, 26, '45.00', '1', '45.00', 0.00, 0),
(61, 23, 26, '30.00', '1', '30.00', 0.00, 0),
(62, 9, 27, '35.00', '2', '68.00', 2.00, 0),
(63, 10, 27, '45.00', '2', '90.00', 0.00, 0),
(64, 9, 28, '35.00', '3', '103.00', 2.00, 0),
(65, 10, 28, '45.00', '2', '90.00', 0.00, 0),
(66, 9, 29, '35.00', '2', '68.00', 2.00, 0),
(67, 10, 29, '45.00', '2', '90.00', 0.00, 0),
(68, 23, 29, '30.00', '1', '30.00', 0.00, 0),
(69, 9, 30, '35.00', '2', '68.00', 2.00, 0),
(70, 10, 30, '45.00', '2', '90.00', 0.00, 0),
(71, 23, 30, '30.00', '2', '60.00', 0.00, 0),
(72, 23, 31, '30.00', '2', '60.00', 0.00, 0),
(73, 9, 31, '35.00', '2', '68.00', 2.00, 0),
(74, 9, 32, '35.00', '2', '68.00', 2.00, 0),
(75, 23, 32, '30.00', '2', '60.00', 0.00, 0),
(76, 9, 33, '35.00', '2', '68.00', 2.00, 0),
(77, 9, 34, '35.00', '1', '35.00', 0.00, 0),
(78, 69, 35, '10.00', '2', '20.00', 0.00, 0),
(79, 9, 36, '35.00', '1', '35.00', 0.00, 0),
(80, 10, 36, '45.00', '1', '45.00', 0.00, 0),
(81, 23, 36, '30.00', '1', '30.00', 0.00, 0),
(82, 9, 37, '35.00', '1', '35.00', 0.00, 0),
(83, 23, 37, '30.00', '2', '60.00', 0.00, 0),
(84, 9, 38, '35.00', '2', '68.00', 2.00, 0),
(85, 10, 38, '45.00', '2', '90.00', 0.00, 0),
(86, 23, 38, '30.00', '2', '60.00', 0.00, 0),
(87, 9, 39, '35.00', '1', '35.00', 0.00, 0),
(88, 10, 39, '45.00', '1', '45.00', 0.00, 0),
(89, 9, 40, '35.00', '2', '68.00', 2.00, 0),
(90, 10, 40, '45.00', '2', '90.00', 0.00, 0),
(91, 9, 41, '35.00', '2', '68.00', 2.00, 0),
(92, 10, 41, '45.00', '2', '90.00', 0.00, 0),
(93, 9, 42, '35.00', '2', '68.00', 2.00, 0),
(94, 10, 42, '45.00', '2', '90.00', 0.00, 0),
(95, 23, 42, '30.00', '2', '60.00', 0.00, 0),
(96, 9, 43, '35.00', '3', '118.00', 2.00, 84),
(97, 10, 43, '45.00', '3', '141.00', 0.00, 673),
(98, 23, 43, '30.00', '3', '90.00', 0.00, 394),
(99, 9, 44, '35.00', '3', '118.00', 2.00, 454),
(100, 23, 44, '30.00', '3', '90.00', 0.00, 381),
(101, 10, 44, '45.00', '3', '141.00', 0.00, 550),
(102, 9, 45, '35.00', '3', '103.00', 2.00, 121),
(103, 10, 45, '45.00', '3', '135.00', 0.00, 690),
(104, 23, 45, '30.00', '3', '90.00', 0.00, 201),
(105, 9, 46, '35.00', '3', '103.00', 2.00, 818),
(106, 10, 46, '45.00', '3', '135.00', 0.00, 438),
(107, 23, 46, '30.00', '3', '90.00', 0.00, 983),
(108, 9, 47, '35.00', '3', '103.00', 2.00, 33),
(109, 10, 47, '45.00', '3', '135.00', 0.00, 491),
(110, 23, 47, '30.00', '3', '90.00', 0.00, 215),
(111, 9, 48, '35.00', '3', '103.00', 2.00, 599),
(112, 10, 48, '45.00', '3', '135.00', 0.00, 152),
(113, 23, 48, '30.00', '3', '90.00', 0.00, 842),
(114, 9, 49, '35.00', '3', '103.00', 2.00, 154),
(115, 10, 49, '45.00', '3', '135.00', 0.00, 660),
(116, 23, 49, '30.00', '3', '90.00', 0.00, 347),
(117, 9, 50, '35.00', '3', '103.00', 2.00, 578),
(118, 10, 50, '45.00', '3', '135.00', 0.00, 27),
(119, 23, 50, '30.00', '3', '90.00', 0.00, 779),
(120, 9, 51, '35.00', '3', '103.00', 2.00, 495),
(121, 10, 51, '45.00', '3', '135.00', 0.00, 996),
(122, 23, 51, '30.00', '3', '90.00', 0.00, 491),
(123, 9, 52, '35.00', '3', '118.00', 2.00, 499),
(124, 10, 52, '45.00', '3', '135.00', 0.00, 949),
(125, 23, 52, '30.00', '3', '90.00', 0.00, 442),
(126, 9, 53, '35.00', '3', '118.00', 2.00, 913),
(127, 10, 53, '45.00', '4', '180.00', 0.00, 419),
(128, 23, 53, '30.00', '2', '60.00', 0.00, 316),
(129, 9, 54, '35.00', '3', '103.00', 2.00, 740),
(130, 10, 54, '45.00', '3', '135.00', 0.00, 231),
(131, 23, 54, '30.00', '3', '90.00', 0.00, 810),
(132, 9, 55, '35.00', '3', '103.00', 2.00, 257),
(133, 10, 55, '45.00', '4', '180.00', 0.00, 711),
(134, 23, 55, '30.00', '2', '60.00', 0.00, 305),
(135, 9, 56, '35.00', '3', '118.00', 2.00, 180),
(136, 10, 56, '45.00', '3', '141.00', 0.00, 589),
(137, 23, 56, '30.00', '3', '90.00', 0.00, 77),
(138, 9, 57, '35.00', '3', '103.00', 2.00, 945),
(139, 9, 57, '35.00', '3', '103.00', 2.00, 327),
(140, 10, 57, '45.00', '3', '135.00', 0.00, 856),
(141, 9, 58, '35.00', '3', '103.00', 2.00, 706),
(142, 10, 58, '45.00', '1', '45.00', 0.00, 181),
(143, 23, 58, '30.00', '1', '30.00', 0.00, 636),
(144, 9, 59, '35.00', '1', '35.00', 0.00, 988),
(145, 10, 59, '45.00', '1', '45.00', 0.00, 665),
(146, 9, 60, '35.00', '3', '103.00', 2.00, 900),
(147, 10, 60, '45.00', '3', '135.00', 0.00, 394),
(148, 23, 60, '30.00', '3', '90.00', 0.00, 659);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `extras`
--

CREATE TABLE `extras` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `precio` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `extras`
--

INSERT INTO `extras` (`id`, `producto_id`, `nombre`, `precio`) VALUES
(11, 9, 'ketchup', 2.00),
(12, 9, 'mayonesa', 2.00),
(13, 10, 'ketchup', 2.00),
(14, 9, 'Mostaza', 1.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `monto` double(10,2) NOT NULL,
  `fecha` datetime NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `caja_id` int(11) NOT NULL,
  `observaciones` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gastos`
--

INSERT INTO `gastos` (`id`, `nombre`, `monto`, `fecha`, `usuario_id`, `caja_id`, `observaciones`) VALUES
(1, 'Compra de Escoba', 10.00, '2019-04-10 00:42:52', 5, 48, 'Pago por la escoba'),
(2, 'Compra de Cremas', 30.00, '2019-04-10 00:44:44', 5, 48, 'compra de mostaza, mayonesa, rocoto'),
(3, 'leches', 100.00, '2019-04-28 12:45:45', 5, 9, 'compra de leches ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos`
--

CREATE TABLE `insumos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `unidad_medida_id` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `insumos`
--

INSERT INTO `insumos` (`id`, `nombre`, `cantidad`, `unidad_medida_id`, `estado`) VALUES
(1, 'Carne', -11650, 4, 1),
(2, 'Pan', -223, 1, 1),
(3, 'Pollo', -19400, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `parent` varchar(10) NOT NULL,
  `orden` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `menus`
--

INSERT INTO `menus` (`id`, `nombre`, `link`, `parent`, `orden`, `estado`) VALUES
(1, 'Inicio', 'dashboard', '0', 1, 1),
(2, 'Categorias', 'mantenimiento/categorias', '9', 0, 1),
(3, 'Clientes', 'mantenimiento/clientes', '9', 0, 1),
(4, 'Productos', 'mantenimiento/productos', '9', 0, 1),
(5, 'Ventas', 'movimientos/ventas', '10', 0, 1),
(6, 'Reporte de Ventas', 'reportes/ventas', '11', 0, 1),
(7, 'Usuarios', 'administrador/usuarios', '12', 0, 1),
(8, 'Permisos', 'administrador/permisos', '12', 0, 1),
(9, 'Mantenimiento', '#', '0', 3, 1),
(10, 'Movimientos', '#', '0', 5, 1),
(11, 'Reportes', '#', '0', 6, 1),
(12, 'Administrador', '#', '0', 7, 1),
(13, 'Configuraciones', '#', '0', 0, 1),
(15, 'Caja', '#', '0', 4, 1),
(17, 'Reporte de Inventario', 'reportes/inventario', '11', 0, 1),
(18, 'Ordenes', 'movimientos/ordenes', '10', 0, 1),
(19, 'Mesas', 'mantenimiento/mesas', '9', 0, 1),
(20, 'Clave de Permiso', 'administrador/clave-permiso', '12', 0, 1),
(21, 'Productos Vendidos', 'reportes/productos', '11', 0, 1),
(22, 'Subcategorias', 'mantenimiento/subcategorias', '9', 0, 1),
(23, 'Panel de Control', 'reportes/grafico', '0', 0, 0),
(24, 'Cuentas por Cobrar', '#', '0', 6, 1),
(25, 'Ordenes Pendientes', 'movimientos/Ordenes_Pendientes', '24', 0, 1),
(26, 'Areas', 'mantenimiento/areas', '9', 0, 1),
(27, 'Correos', 'administrador/correos', '12', 0, 1),
(28, 'Aperturas y Cierres', 'caja/apertura_cierre', '15', 0, 1),
(29, 'Gastos', 'caja/gastos', '15', 0, 1),
(30, 'Tarjetas', 'administrador/tarjetas', '12', 0, 1),
(31, 'Compras', 'movimientos/compras', '10', 0, 1),
(32, 'Proveedores', 'mantenimiento/proveedores', '9', 0, 1),
(33, 'Unidades de Medidas', 'mantenimiento/unidades_medidas', '9', 0, 1),
(34, 'Produccion', '#', '0', 8, 1),
(35, 'Insumos', 'produccion/insumos', '34', 0, 1),
(36, 'Establecer Insumos', 'produccion/establecer_insumos', '34', 0, 1),
(37, 'Listado de Creditos', 'cuentas_cobrar/creditos', '24', 0, 1),
(38, 'Comprobantes', 'administrador/comprobantes', '12', 0, 1),
(39, 'Mi Perfil', 'usuario/perfil', '0', 9, 1),
(40, 'Reporte de Compras', 'reportes/compras', '11', 0, 1),
(41, 'Reportes de Insumos', 'reportes/insumos', '11', 0, 1),
(42, 'Cocina', 'pedidos/cocina', '0', 10, 1),
(43, 'Ajuste de Inventario', 'mantenimiento/ajuste', '9', 0, 1),
(44, 'Gestion de Cupones', 'administrador/cupones', '12', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `id` int(11) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `area_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`id`, `numero`, `estado`, `area_id`) VALUES
(1, '01', 1, 2),
(2, '02', 0, 2),
(3, '03', 0, 1),
(4, '04', 0, 1),
(5, '05', 1, 1),
(6, '06', 1, 1),
(7, '07', 1, 1),
(14, 'V-1', 1, 1),
(16, 'V-2', 1, 1),
(17, 'Barra 1', 1, 1),
(18, 'Barra 2', 1, 1),
(19, 'Barra 3', 1, 1),
(64, 'A-1', 1, 1),
(65, 'A-2', 1, 1),
(66, 'A-3', 1, 1),
(67, 'A-4', 1, 1),
(68, 'A-5', 1, 1),
(69, 'A-6', 1, 1),
(70, 'A-7', 1, 1),
(71, 'A-8', 1, 1),
(72, 'A-9', 1, 1),
(73, 'A-10', 1, 1),
(74, 'A-11', 1, 1),
(75, 'A-12', 1, 1),
(76, 'A-13', 1, 1),
(77, 'A-14', 1, 1),
(78, 'A-15', 1, 1),
(79, 'Para Lleva', 1, 1),
(80, 'PAGADO', 1, 1),
(81, 'Leslie', 1, 1),
(82, 'Chejo Medr', 1, 1),
(83, 'A-15 B', 1, 1),
(84, 'Gerson T', 1, 1),
(85, 'Leo ', 1, 1),
(87, 'A-6B', 1, 1),
(88, 'AB-5', 1, 1),
(91, 'v-3', 1, 1),
(92, 'valcon 1', 1, 1),
(93, 'valcon 2', 1, 1),
(94, 'valcon 3', 1, 1),
(95, 'valcon 4', 1, 1),
(96, 'valcon 5', 1, 1),
(97, 'Wachito', 1, 1),
(98, 'guayo', 1, 1),
(99, 'Mami', 1, 1),
(102, 'Chon Gónza', 1, 1),
(103, 'Grupo', 1, 1),
(104, 'poli nas', 1, 1),
(105, 'cano', 1, 1),
(106, 'batrez', 1, 1),
(108, 'extra', 1, 1),
(109, 'kevin gonz', 1, 1),
(110, 'payaso', 1, 1),
(111, 'wachito', 1, 1),
(113, 'pika', 1, 1),
(114, 'jeff', 1, 1),
(115, 'Chepe Ozun', 1, 1),
(116, 'Duy', 1, 1),
(117, 'Don Bol', 1, 1),
(118, 'cambio', 1, 1),
(119, 'jeff', 1, 1),
(120, 'tele', 1, 1),
(121, '08', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_producto_extra`
--

CREATE TABLE `orden_producto_extra` (
  `id` int(11) NOT NULL,
  `orden_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `extra_id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `orden_producto_extra`
--

INSERT INTO `orden_producto_extra` (`id`, `orden_id`, `producto_id`, `extra_id`, `codigo`) VALUES
(1, 38, 9, 11, 0),
(2, 38, 9, 12, 0),
(3, 38, 9, 11, 0),
(4, 38, 9, 12, 0),
(5, 43, 9, 11, 645),
(6, 43, 9, 12, 645),
(7, 43, 9, 12, 717),
(8, 43, 9, 14, 717),
(9, 44, 9, 11, 84),
(10, 44, 9, 12, 84),
(11, 44, 9, 14, 84),
(12, 44, 10, 13, 673),
(13, 45, 9, 11, 454),
(14, 45, 9, 12, 454),
(15, 45, 9, 14, 454),
(16, 45, 10, 13, 550),
(17, 53, 9, 11, 499),
(18, 53, 9, 12, 499),
(19, 53, 9, 14, 499),
(20, 54, 9, 11, 913),
(21, 54, 9, 12, 913),
(22, 54, 9, 14, 913),
(23, 57, 9, 11, 180),
(24, 57, 9, 12, 180),
(25, 57, 9, 14, 180),
(26, 57, 10, 13, 589);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int(11) NOT NULL,
  `monto` double(10,2) NOT NULL,
  `cuenta_cobrar_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `monto`, `cuenta_cobrar_id`, `fecha`) VALUES
(1, 100.00, 1, '2019-04-25 20:39:22'),
(2, 73.00, 1, '2019-04-25 20:41:06'),
(3, 50.00, 2, '2019-04-25 21:43:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `preparado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `fecha`, `usuario_id`, `estado`, `preparado`) VALUES
(1, '2019-04-23', 5, 0, 0),
(2, '2019-04-25', 5, 0, 0),
(3, '2019-04-25', 5, 0, 0),
(4, '2019-04-25', 5, 0, 0),
(5, '2019-04-25', 5, 0, 0),
(6, '2019-04-25', 5, 0, 0),
(7, '2019-04-26', 5, 0, 0),
(8, '2019-04-26', 5, 0, 0),
(9, '2019-04-26', 5, 0, 0),
(10, '2019-04-27', 5, 0, 0),
(11, '2019-04-27', 5, 0, 0),
(12, '2019-04-28', 5, 0, 0),
(13, '2019-04-28', 5, 0, 0),
(14, '2019-04-28', 5, 0, 0),
(15, '2019-04-28', 5, 0, 0),
(16, '2019-04-28', 5, 0, 0),
(17, '2019-04-28', 5, 0, 0),
(18, '2019-04-28', 5, 0, 0),
(19, '2019-04-28', 5, 0, 0),
(20, '2019-04-28', 5, 0, 0),
(21, '2019-04-28', 5, 0, 0),
(22, '2019-04-28', 5, 0, 0),
(23, '2019-04-29', 5, 0, 2),
(24, '2019-04-29', 5, 0, 2),
(25, '2019-04-29', 5, 0, 2),
(26, '2019-04-29', 5, 0, 2),
(27, '2019-04-29', 5, 0, 0),
(28, '2019-04-30', 5, 0, 0),
(29, '2019-04-30', 5, 0, 0),
(30, '2019-04-30', 5, 0, 0),
(31, '2019-04-30', 5, 0, 1),
(32, '2019-04-30', 5, 0, 2),
(33, '2019-04-30', 5, 0, 2),
(34, '2019-04-30', 5, 0, 2),
(35, '2019-04-30', 5, 0, 2),
(36, '2019-04-30', 5, 0, 2),
(37, '2019-05-03', 5, 0, 0),
(38, '2019-05-06', 5, 0, 0),
(39, '2019-05-06', 5, 0, 0),
(40, '2019-05-08', 5, 1, 0),
(41, '2019-05-08', 5, 1, 0),
(42, '2019-05-08', 5, 1, 0),
(43, '2019-05-08', 5, 1, 0),
(44, '2019-05-10', 5, 0, 0),
(45, '2019-05-10', 5, 0, 0),
(46, '2019-05-10', 5, 0, 0),
(47, '2019-05-10', 5, 0, 0),
(48, '2019-05-10', 5, 0, 0),
(49, '2019-05-10', 5, 0, 0),
(50, '2019-05-10', 5, 0, 0),
(51, '2019-05-11', 5, 0, 0),
(52, '2019-05-11', 5, 0, 0),
(53, '2019-05-11', 5, 0, 0),
(54, '2019-05-11', 5, 0, 0),
(55, '2019-05-11', 5, 0, 0),
(56, '2019-05-11', 5, 0, 0),
(57, '2019-05-11', 5, 0, 0),
(58, '2019-05-11', 5, 0, 0),
(59, '2019-05-11', 5, 0, 0),
(60, '2019-05-11', 5, 0, 0),
(61, '2019-05-11', 5, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_mesa`
--

CREATE TABLE `pedidos_mesa` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `mesa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos_mesa`
--

INSERT INTO `pedidos_mesa` (`id`, `pedido_id`, `mesa_id`) VALUES
(1, 1, 4),
(2, 2, 6),
(3, 3, 5),
(4, 4, 6),
(5, 5, 6),
(6, 6, 5),
(7, 7, 1),
(8, 8, 1),
(9, 9, 1),
(10, 10, 1),
(11, 11, 2),
(12, 12, 2),
(13, 13, 1),
(14, 14, 2),
(15, 15, 2),
(16, 16, 2),
(17, 17, 2),
(18, 18, 3),
(19, 19, 2),
(20, 20, 2),
(21, 21, 1),
(22, 22, 1),
(23, 23, 3),
(24, 24, 5),
(25, 25, 14),
(26, 26, 4),
(27, 27, 7),
(28, 28, 6),
(29, 29, 16),
(30, 30, 1),
(31, 31, 64),
(32, 32, 17),
(33, 33, 1),
(34, 34, 17),
(35, 35, 2),
(36, 36, 18),
(37, 37, 3),
(38, 38, 64),
(39, 39, 1),
(40, 40, 2),
(41, 42, 4),
(42, 43, 3),
(43, 44, 7),
(44, 45, 6),
(45, 46, 6),
(46, 47, 6),
(47, 48, 6),
(48, 49, 6),
(49, 50, 7),
(50, 51, 14),
(51, 52, 14),
(52, 53, 5),
(53, 54, 16),
(54, 55, 14),
(55, 56, 7),
(56, 57, 17),
(57, 58, 7),
(58, 59, 17),
(59, 60, 16),
(60, 61, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_productos`
--

CREATE TABLE `pedidos_productos` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `pagados` int(11) NOT NULL,
  `updated` int(11) NOT NULL DEFAULT '1',
  `codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos_productos`
--

INSERT INTO `pedidos_productos` (`id`, `pedido_id`, `producto_id`, `cantidad`, `estado`, `pagados`, `updated`, `codigo`) VALUES
(1, 1, 9, 2, 1, 2, 1, 0),
(2, 1, 10, 2, 1, 2, 1, 0),
(3, 2, 9, 4, 1, 4, 1, 0),
(4, 2, 10, 3, 1, 3, 1, 0),
(5, 2, 23, 3, 1, 3, 1, 0),
(6, 3, 9, 3, 1, 3, 1, 0),
(7, 3, 10, 4, 1, 4, 1, 0),
(8, 3, 23, 3, 1, 3, 1, 0),
(9, 4, 9, 2, 1, 2, 1, 0),
(10, 4, 10, 2, 1, 2, 1, 0),
(11, 4, 23, 3, 1, 3, 1, 0),
(12, 5, 9, 3, 1, 3, 1, 0),
(13, 5, 23, 4, 1, 4, 1, 0),
(14, 6, 10, 3, 1, 3, 1, 0),
(15, 6, 23, 3, 1, 3, 1, 0),
(16, 7, 9, 0, 1, 0, 1, 0),
(17, 7, 10, 0, 1, 0, 1, 0),
(18, 7, 23, 2, 1, 2, 1, 0),
(19, 8, 9, 2, 1, 2, 1, 0),
(20, 8, 10, 2, 1, 2, 1, 0),
(21, 9, 9, 4, 1, 4, 1, 0),
(22, 10, 10, 2, 1, 2, 1, 0),
(23, 10, 23, 2, 1, 2, 1, 0),
(24, 11, 9, 2, 1, 2, 1, 0),
(25, 11, 10, 2, 1, 2, 1, 0),
(26, 11, 23, 2, 1, 2, 1, 0),
(27, 12, 9, 2, 1, 2, 1, 0),
(28, 12, 10, 2, 1, 2, 1, 0),
(29, 12, 23, 2, 1, 2, 1, 0),
(30, 13, 9, 2, 1, 2, 1, 0),
(31, 13, 10, 2, 1, 2, 1, 0),
(32, 13, 23, 2, 1, 2, 1, 0),
(33, 14, 10, 2, 1, 2, 1, 0),
(34, 14, 23, 2, 1, 2, 1, 0),
(35, 15, 11, 2, 1, 2, 1, 0),
(36, 15, 12, 2, 1, 2, 1, 0),
(37, 15, 13, 2, 1, 2, 1, 0),
(38, 16, 9, 2, 1, 2, 1, 0),
(39, 16, 10, 2, 1, 2, 1, 0),
(40, 16, 23, 2, 1, 2, 1, 0),
(41, 17, 9, 2, 1, 2, 1, 0),
(42, 17, 10, 2, 1, 2, 1, 0),
(43, 17, 23, 2, 1, 2, 1, 0),
(44, 18, 9, 1, 1, 1, 1, 0),
(45, 18, 10, 1, 1, 1, 1, 0),
(46, 19, 9, 2, 1, 2, 1, 0),
(47, 19, 23, 2, 1, 2, 1, 0),
(48, 20, 9, 2, 1, 2, 1, 0),
(49, 20, 10, 2, 1, 2, 1, 0),
(50, 20, 23, 2, 1, 2, 1, 0),
(51, 21, 10, 2, 1, 2, 1, 0),
(52, 21, 23, 2, 1, 2, 1, 0),
(53, 22, 9, 2, 1, 2, 1, 0),
(54, 22, 10, 2, 1, 2, 1, 0),
(55, 23, 9, 2, 1, 2, 1, 0),
(56, 23, 10, 2, 1, 2, 1, 0),
(57, 23, 23, 2, 1, 2, 1, 0),
(58, 24, 9, 1, 1, 1, 1, 0),
(59, 24, 10, 1, 1, 1, 1, 0),
(60, 24, 23, 1, 1, 1, 1, 0),
(61, 25, 9, 1, 1, 1, 1, 0),
(62, 25, 23, 2, 1, 2, 1, 0),
(63, 26, 9, 2, 1, 2, 1, 0),
(64, 26, 10, 2, 1, 2, 1, 0),
(65, 26, 23, 2, 1, 2, 1, 0),
(66, 27, 9, 1, 1, 1, 1, 0),
(67, 27, 10, 1, 1, 1, 1, 0),
(68, 28, 9, 1, 1, 1, 1, 0),
(69, 28, 10, 1, 1, 1, 1, 0),
(70, 29, 10, 1, 1, 1, 1, 0),
(71, 29, 23, 1, 1, 1, 1, 0),
(72, 30, 9, 2, 1, 2, 1, 0),
(73, 30, 10, 2, 1, 2, 1, 0),
(74, 31, 9, 3, 1, 3, 1, 0),
(75, 31, 10, 2, 1, 2, 1, 0),
(76, 32, 9, 2, 1, 2, 1, 0),
(77, 32, 10, 2, 1, 2, 1, 0),
(78, 32, 23, 1, 1, 1, 1, 0),
(79, 33, 23, 2, 1, 2, 1, 0),
(80, 33, 9, 2, 1, 2, 1, 0),
(81, 34, 9, 2, 1, 2, 1, 0),
(82, 34, 23, 2, 1, 2, 1, 0),
(83, 35, 9, 2, 1, 2, 1, 0),
(84, 35, 10, 2, 1, 2, 1, 0),
(85, 36, 9, 2, 1, 2, 1, 0),
(86, 36, 10, 2, 1, 2, 1, 0),
(87, 37, 9, 2, 1, 2, 1, 0),
(88, 37, 10, 2, 1, 2, 1, 0),
(89, 37, 23, 2, 1, 2, 1, 0),
(90, 38, 9, 2, 1, 2, 2, 0),
(91, 38, 9, 1, 1, 1, 1, 0),
(92, 39, 69, 2, 1, 2, 1, 0),
(93, 43, 9, 1, 0, 0, 2, 645),
(94, 43, 23, 1, 0, 0, 2, 926),
(95, 43, 9, 2, 0, 0, 1, 717),
(96, 44, 9, 3, 1, 3, 1, 84),
(97, 44, 10, 3, 1, 3, 1, 673),
(98, 44, 23, 3, 1, 3, 1, 394),
(99, 45, 9, 3, 1, 3, 1, 454),
(100, 45, 23, 3, 1, 3, 1, 381),
(101, 45, 10, 3, 1, 3, 1, 550),
(102, 46, 9, 3, 1, 3, 1, 121),
(103, 46, 10, 3, 1, 3, 1, 690),
(104, 46, 23, 3, 1, 3, 1, 201),
(105, 47, 9, 3, 1, 3, 1, 818),
(106, 47, 10, 3, 1, 3, 1, 438),
(107, 47, 23, 3, 1, 3, 1, 983),
(108, 48, 9, 3, 1, 3, 1, 33),
(109, 48, 10, 3, 1, 3, 1, 491),
(110, 48, 23, 3, 1, 3, 1, 215),
(111, 49, 9, 3, 1, 3, 1, 599),
(112, 49, 10, 3, 1, 3, 1, 152),
(113, 49, 23, 3, 1, 3, 1, 842),
(114, 50, 9, 3, 1, 3, 1, 154),
(115, 50, 10, 3, 1, 3, 1, 660),
(116, 50, 23, 3, 1, 3, 1, 347),
(117, 51, 9, 3, 1, 3, 1, 578),
(118, 51, 10, 3, 1, 3, 1, 27),
(119, 51, 23, 3, 1, 3, 1, 779),
(120, 52, 9, 3, 1, 3, 1, 495),
(121, 52, 10, 3, 1, 3, 1, 996),
(122, 52, 23, 3, 1, 3, 1, 491),
(123, 53, 9, 3, 1, 3, 1, 499),
(124, 53, 10, 3, 1, 3, 1, 949),
(125, 53, 23, 3, 1, 3, 1, 442),
(126, 54, 9, 3, 1, 3, 1, 913),
(127, 54, 10, 4, 1, 4, 1, 419),
(128, 54, 23, 2, 1, 2, 1, 316),
(129, 55, 9, 3, 1, 3, 1, 740),
(130, 55, 10, 3, 1, 3, 1, 231),
(131, 55, 23, 3, 1, 3, 1, 810),
(132, 56, 9, 3, 1, 3, 1, 257),
(133, 56, 10, 4, 1, 4, 1, 711),
(134, 56, 23, 2, 1, 2, 1, 305),
(135, 57, 9, 3, 1, 3, 1, 180),
(136, 57, 10, 3, 1, 3, 1, 589),
(137, 57, 23, 3, 1, 3, 1, 77),
(138, 58, 9, 3, 1, 3, 1, 945),
(139, 58, 9, 3, 1, 3, 1, 327),
(140, 58, 10, 3, 1, 3, 1, 856),
(141, 59, 9, 3, 1, 3, 1, 706),
(142, 59, 10, 1, 1, 1, 1, 181),
(143, 59, 23, 1, 1, 1, 1, 636),
(144, 60, 9, 1, 1, 1, 1, 988),
(145, 60, 10, 1, 1, 1, 1, 665),
(146, 61, 9, 3, 1, 3, 1, 900),
(147, 61, 10, 3, 1, 3, 1, 394),
(148, 61, 23, 3, 1, 3, 1, 659);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `read` int(11) DEFAULT NULL,
  `insert` int(11) DEFAULT NULL,
  `update` int(11) DEFAULT NULL,
  `delete` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `menu_id`, `rol_id`, `read`, `insert`, `update`, `delete`) VALUES
(1, 1, 2, 1, 1, 1, 1),
(2, 2, 2, 0, 0, 0, 0),
(3, 3, 2, 1, 1, 1, 1),
(4, 4, 2, 0, 0, 0, 0),
(5, 5, 2, 1, 1, 1, 1),
(10, 1, 1, 1, 1, 1, 1),
(11, 2, 1, 0, 0, 0, 0),
(12, 4, 1, 1, 1, 1, 1),
(13, 5, 1, 1, 1, 1, 1),
(14, 6, 1, 1, 1, 1, 1),
(15, 7, 1, 1, 1, 1, 1),
(16, 3, 1, 1, 1, 1, 1),
(17, 8, 1, 1, 1, 1, 1),
(18, 9, 1, 1, 1, 1, 1),
(19, 10, 1, 1, 1, 1, 1),
(20, 11, 1, 1, 1, 1, 1),
(21, 12, 1, 1, 1, 1, 1),
(23, 9, 2, 1, 1, 1, 1),
(24, 10, 2, 1, 1, 1, 1),
(25, 15, 1, 1, 1, 1, 1),
(26, 14, 1, 1, 1, 1, 1),
(27, 16, 1, 1, 1, 1, 1),
(28, 14, 2, 1, 1, 1, 1),
(29, 16, 2, 1, 1, 1, 1),
(30, 17, 1, 1, 1, 1, 1),
(31, 18, 1, 1, 1, 1, 1),
(32, 19, 1, 1, 1, 1, 1),
(33, 18, 2, 1, 1, 1, 1),
(34, 17, 2, 0, 0, 0, 0),
(35, 6, 2, 0, 0, 0, 0),
(36, 11, 2, 1, 1, 1, 1),
(37, 15, 2, 1, 1, 1, 1),
(38, 19, 2, 1, 1, 1, 1),
(39, 20, 1, 1, 1, 1, 1),
(40, 21, 1, 1, 1, 1, 1),
(41, 22, 1, 1, 1, 1, 1),
(42, 22, 2, 0, 0, 0, 0),
(44, 10, 4, 1, 1, 1, 1),
(45, 18, 4, 1, 1, 1, 0),
(46, 23, 1, 1, 1, 1, 1),
(47, 23, 2, 0, 1, 1, 1),
(48, 23, 3, 0, 1, 1, 1),
(49, 23, 4, 0, 1, 1, 1),
(53, 24, 1, 1, 1, 1, 1),
(54, 25, 1, 1, 1, 1, 1),
(55, 25, 2, 1, 1, 1, 1),
(56, 24, 2, 1, 1, 1, 1),
(57, 26, 1, 1, 1, 1, 1),
(58, 27, 1, 1, 1, 1, 1),
(59, 28, 1, 1, 1, 1, 1),
(60, 29, 1, 1, 1, 1, 1),
(61, 30, 1, 1, 1, 1, 1),
(62, 31, 1, 1, 1, 1, 1),
(63, 32, 1, 1, 1, 1, 1),
(64, 33, 1, 1, 1, 1, 1),
(65, 34, 1, 1, 1, 1, 1),
(66, 35, 1, 1, 1, 1, 1),
(67, 36, 1, 1, 1, 1, 1),
(68, 37, 1, 1, 1, 1, 1),
(69, 38, 1, 1, 1, 1, 1),
(70, 39, 1, 1, 1, 1, 1),
(71, 40, 1, 1, 1, 1, 1),
(72, 41, 1, 1, 1, 1, 1),
(73, 42, 1, 1, 1, 1, 1),
(74, 39, 5, 1, 1, 1, 1),
(75, 42, 5, 1, 1, 1, 1),
(76, 43, 1, 1, 1, 1, 1),
(77, 44, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `precio` varchar(45) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `stock_minimo` int(11) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `subcategoria` int(11) NOT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL,
  `asociado` tinyint(1) NOT NULL,
  `cantidad_extras` int(11) NOT NULL DEFAULT '0',
  `imagen` text NOT NULL,
  `cantidad_descuento` int(11) NOT NULL,
  `monto_descuento` double(10,2) NOT NULL,
  `precio_compra` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo`, `nombre`, `descripcion`, `precio`, `stock`, `stock_minimo`, `categoria_id`, `subcategoria`, `estado`, `condicion`, `asociado`, `cantidad_extras`, `imagen`, `cantidad_descuento`, `monto_descuento`, `precio_compra`) VALUES
(9, 'PanPo', 'Pan con Pollo', 'Delicioso pan Chapata con pollo, aguacate y queso, acompañado de unas deliciosas papas Crinkle.', '35.00', 20, 0, 4, 2, 1, 0, 0, 3, 'image_default.jpg', 2, 2.00, 0.00),
(10, 'PanCa', 'Pan con Carne', 'Delicioso Pan Chapata con carne, aguacate y queso, acompañado de unas deliciosas papas Crinkle', '45.00', 16, 0, 4, 2, 1, 0, 0, 1, 'image_default.jpg', 0, 0.00, 0.00),
(11, 'ArCe', 'Aros de Cebolla', 'Deliciosos Aros de Cebolla con Aderezo de la casa (15 Aprox.)', '20.00', 12, 0, 5, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(12, 'Ali', 'Alitas', 'Deliciosas Alitas de Pollo bañadas en Barbacoa o simples, acompañadas de nuestro delicioso aderezo de la Casa, acompañados de Apio y Zanahoria (7 uni. Aprox.)', '30.00', 11, 0, 5, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(13, 'AliPa', 'Alitas con Papas', 'Deliciosas Alitas de Pollo bañadas en Barbacoa o simples, acompañadas de nuestro delicioso aderezo de la Casa, acompañado de Papas fritas. (7 uni. Aprox.)', '40.00', 1, 0, 5, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(14, 'Pap', 'Papas Fritas', 'Papas', '15.00', 7, 0, 5, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(15, 'Pechu', 'Pechuguitas', 'Deliciosas Pechuguitas de Pollo acompañadas de Papas Fritas.', '30.00', 6, 0, 5, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(16, 'PlaMx', 'Plato Mixto de Boquitas', 'Ideal para compartir con los Quichelamigos, disfrutando de Alitas, Pechuguitas, Papas fritas o Aros de Cebolla.', '45.00', 2, 0, 5, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(17, 'Mo', 'Mollejas personal', 'Deliciosas Mollejas empanizadas, exquisitamente preparadas para ti.', '15.00', 15, 0, 5, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(18, 'MoC', 'Mollejas Pa´Compartir', 'Deliciosas Mollejitas solamente empanizadas o si deseas preparadas para compartir con los Quichelamigos.', '40.00', 5, 0, 5, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(19, 'EnsCam', 'Ensalada de Camaron', 'Ensalada con Camaron Precocido, preparado especialmente para ti.', '20.00', 1, 0, 5, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(20, 'CamEmp1', 'Camaron Empanizado ', 'Camarones Pelados y desvenados totalmente empanizados acompañados de Arroz, Guacamole y Pan tostado con mantequilla o tortillas.', '45.00', 5, 0, 14, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(21, 'CamEmpP', ' Camaron Empanizado Pequeño', 'Cmarones pelados y desvenados totalmente empanizados.', '25.00', 4, 0, 5, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(22, 'CamEmpG', 'Camaron Empanizado Pa´Compartir', 'Camarones pelados y desvenados totalmente empanizados, pa´Compartir con tus Quichelamigos', '60.00', 4, 0, 5, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(23, 'Quimon', 'Quichemon', 'Famoso Pan de la Casa, elaborado sobre Pan Chapata con Jamon, queso, tomate y cebolla, con el delicioso aderezo de la casa y lechuga, acompañado de Papas Crinkle.', '30.00', 12, 0, 4, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(24, 'Papo', 'Papotas', 'Delicosas Papotas para compartir solo o acompañado.', '20.00', 1, 0, 5, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(25, 'PapB', 'Papas con Barbacoa', 'Deliciosas Papas fritas con barbacoa.', '18.00', 4, 0, 5, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(26, 'TaCam 1', 'Tacos de Camaron (2 uni.)', 'Deliciosos tacos de Camaron con ajo y chile guaque, acompañado de pico de gallo.', '25.00', 2, 0, 9, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(27, 'TaCam2', 'Tacos de Camaron (3 uni.)', 'Deliciosos tacos de Camaron con ajo y chile guaque, acompañado de pico de gallo.', '35.00', 2, 0, 9, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(28, 'CalTl', 'Caldo Tlalpeño', 'Delicioso Caldo Mexicano, acompañado de picado de tomate, cebolla, cilantro y aguacate. ', '35.00', 1, 0, 7, 1, 0, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(29, 'CalTQ', 'Caldo Tlalpeño+Quichelada Gallo', 'Delicioso Caldo Mexicano, acompañado de picado de tomate, cebolla, cilantro y aguacate. ', '48', 1, 0, 7, 1, 0, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(30, 'TC', 'Tortilla con Chorizo', '2 tortillas con Chorizo sobre Guacamole.', '12.00', 1, 0, 9, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(31, 'TL', 'Tortilla con Longaniza', '2 tortillas con Longaniza sobre Guacamole.', '12.00', 2, 0, 9, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(32, 'TS', 'Tortilla Suprema', '2 tortillas con Chorizo y Longaniza sobre Guacamole, queso derretido y lechuga.', '20.00', 4, 0, 9, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(33, 'Tmx', 'Tortilla Mixta', '2 tortillas con Chorizo y Longaniza sobre Guacamole.', '16.00', 1, 0, 9, 1, 0, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(36, 'Tortilla mixta.', 'Tortilla Mixta de Chorizo y longaniza', 'tortillas con chorizo y longaniza', '16.00', 1, 0, 9, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(37, 'Concha25', 'Tablazo de Conchas', 'Tablazo', '25.00', 1, 0, 5, 1, 0, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(38, 'tabla30', 'Tablazo de Conchas 3', 'tablazo de 3', '30.00', 1, 0, 5, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(39, 'QueP', 'Quesadilla de Pollo', 'Quesadillas', '30.00', 1, 0, 8, 1, 0, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(40, 'QueC', 'Quesadilla de Carne', 'Quesadillas', '30.00', 6, 0, 8, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(41, 'PinC', 'Pincho de Carne', 'Pincho', '15.00', 4, 0, 5, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(42, 'PinP', 'Pincho de Pollo', 'Pincho', '15.00', 1, 0, 5, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(43, 'PinMx', 'Pincho Mixto (Carne y Pollo)', 'Pincho', '15.00', 1, 0, 5, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(44, 'ChoPa', 'Choripapas', 'Papas Fritas con Chorizo', '22.00', 1, 0, 5, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(45, 'Band', 'Banderillas', 'Salchicha empanizada', '10.00', 1, 0, 5, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(46, 'Nac', 'Nachos con Carne y Queso', 'Nachos con carne y queso', '20.00', 4, 0, 5, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(47, 'PiP', 'Pizza personal de 1 ingrediente', 'Pizza', '25.00', 11, 0, 6, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(48, 'PiPG', 'Pizza Personal de 1 ingrediente con Coca Cola 12onz.', 'Pizza', '30.00', 1, 0, 6, 2, 0, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(49, 'PipQ', 'Pizza Personal de 1 ingrediente con Quichelada Gallo', 'Pizza', '38.00', 2, 0, 6, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(50, 'InEx', 'Ingrediente Extra de Pizza', 'Pizza', '5.00', 1, 0, 6, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(51, 'Quesox', 'Queso Extra para Pizza', 'Pizza', '15.00', 1, 0, 6, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(52, 'PiM', 'Pizza Mediana de 1 Ingrediente', 'Pizza', '60.00', 1, 0, 6, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(53, 'PiG', 'Pizza Grande de 1 Ingrediente', 'Pizza', '75.00', 2, 0, 6, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(54, 'PiMCh', 'Pizza Mediana Chorilonga', 'Pizza', '65.00', 1, 0, 6, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(55, 'PiGCh', 'Pizza Grande Chorilonga', 'Pizza', '80.00', 1, 0, 6, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(56, 'PiMPi', 'Pizza Mediana Pizzerola', 'Pizza', '70.00', 2, 0, 6, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(57, 'PiGPi', 'Pizza Grande Pizzerola', 'Pizza', '90.00', 2, 0, 6, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(58, 'PiMJ', 'Pizza Mediana de Jalamon', 'Jalapeño y Jamon', '65.00', 1, 0, 6, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(59, 'PiGJ', 'Pizza Grande Jalamon', 'Jalapeño y Jamon', '80.00', 1, 0, 6, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(60, 'CevP', 'Ceviche Pequeño', 'Ceviches', '26.00', 2, 0, 15, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(61, 'CevPM', 'Ceviche Pequeño Mixto ', 'Ceviches', '32.00', 1, 0, 15, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(62, 'CevM', 'Ceviche Mediano', 'Ceviches', '36.00', 1, 0, 15, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(63, 'CevMxM', 'Ceviche Mediano Mixto', 'Ceviches', '42.00', 2, 0, 15, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(64, 'CevG', 'Ceviche Grande', 'Ceviches', '46.00', 1, 0, 15, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(65, 'CevGMx', 'Ceviche Grande Mixto', 'Ceviches', '52.00', 1, 0, 15, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(66, 'Coro', 'Corona 12 onz.', 'Cerveza', '16.00', 408, 120, 19, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(67, 'ModVi', 'Modelo Vidrio 12 onz', 'Cerveza', '16.00', 157, 30, 19, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(68, 'ModLa', 'Modelo Lata 12 onz.', 'Cerveza', '14.00', 331, 120, 19, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(69, 'Pep', 'Pepsi 12 onz', 'Gaseosa', '10.00', 65, 12, 20, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 3.00),
(70, '7', '7up 12 onz.', 'Gaseosa', '10.00', 375, 48, 20, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(71, 'Grap', 'Grapette 12 onz.', 'Gaseosa', '10.00', 49, 12, 20, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(72, 'Mir', 'Mirinda 12 onz.', 'Gaseosa', '10.00', 0, 12, 20, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(74, 'Gat', 'Gatorade 12onz.', 'Bebida', '12.00', 54, 12, 20, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(75, 'GB12', 'Gallo Botella 12onz.', 'Cerveza', '14.00', 648, 300, 19, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(76, 'GL12', 'Gallo Lata 12onz.', 'Cerveza', '14.00', 169, 150, 19, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(77, 'Cab12', 'Cabro Extra Botella 12onz.', 'Cerveza', '14.00', 423, 120, 19, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(78, 'CabR12', 'Cabro Reserva 12onz.', 'Cerveza', '20.00', 120, 45, 19, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(79, 'Hei12', 'Heineken 12onz.', 'Cerveza', '20.00', 66, 45, 19, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(80, 'DD12', 'Dorada Draft 12onz.', 'Cerveza', '16.00', 127, 45, 19, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(81, 'Min12', 'Mineral 12onz.', 'Gaseosa', '10.00', 143, 50, 20, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(82, 'Bac12', 'Bacardi 12onz.', 'licor', '18.00', 111, 35, 19, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(83, 'MC12', 'Monte Carlo 12onz.', 'Cerveza', '20.00', 82, 45, 19, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(84, 'LC', 'Litro Cabro', 'Cerveza', '30.00', 152, 25, 19, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(85, 'LG', 'Litro Gallo', 'Cerveza', '30.00', 206, 25, 19, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(86, 'CC12', 'Coca Cola 12onz.', 'Gaseosa', '10.00', 197, 80, 20, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(87, 'QG1', 'Quichelada Gallo 12onz.', 'Cerveza', '18.00', 221, 0, 21, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(88, 'QG2', 'Quichelada de Gallo Oferta', 'Cerveza', '35.00', 1, 0, 17, 1, 0, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(89, 'QM1', 'Quichelada Modelo lata 12onz.', 'Cerveza', '18.00', 28, 0, 21, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(90, 'QM2', 'Quichelada Modelo Oferta', 'Cerveza', '35.00', 1, 0, 17, 1, 0, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(91, 'QC1', 'Quichelada Cabro Extra 12onz.', 'Cerveza', '18.00', 94, 0, 21, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(92, 'QC2', 'Quichelada Cabro Extra Oferta 12onz.', 'Cerveza', '35.00', 3, 0, 17, 1, 0, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(93, 'QCo1', 'Quichelada Corona 12onz.', 'Cerveza', '20.00', 31, 0, 21, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(94, 'QCo2', 'Quichelada Corono Oferta 12onz.', 'Cerveza', '38.00', 1, 0, 4, 1, 0, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(95, 'QMC1', 'Quichelada Monte Carlo 12onz.', 'Cerveza', '25.00', 2, 0, 21, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(98, 'QMC2', 'Quichelada Monte Carlo Oferta 12onz.', 'Cerveza', '45.00', 1, 0, 17, 1, 0, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(99, 'QDD1', 'Quichelada Dorada Draft 12onz.', 'Cerveza', '20.00', 2, 0, 21, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(100, 'QDD2', 'Quichelada Dorada Draft Oferta 12onz.', 'Cerveza', '38.00', 1, 0, 17, 1, 0, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(101, 'QCR1', 'Quichelada Cabro Reserva 12onz.', 'Cerveza', '25.00', 6, 0, 21, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(102, 'QCR2', 'Quichelada Cabro Reserva Oferta 12onz.', 'Cerveza', '45.00', 1, 0, 17, 1, 0, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(103, 'Men', 'Mentirosa', 'Quichelada Mineral', '15.00', 24, 0, 21, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(104, 'PiM1', 'Picosita Modelo lata 12onz.', 'Cerveza', '18.00', 13, 0, 21, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(105, 'PiM2', 'Picosita Modelo Lata 12onz. Oferta', 'Cerveza', '35.00', 1, 0, 17, 1, 0, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(106, 'PiG1', 'Picosita Gallo 12onz.', 'Cerveza', '18.00', 10, 0, 21, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(107, 'PiG2', 'Picosita Gallo Lata 12onz. Oferta', 'Cerveza', '35.00', 1, 0, 17, 1, 0, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(108, 'CaCE1', 'Cachuda Cabro Extra 12onz.', 'Cerveza', '18.00', 1, 0, 21, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(109, 'CaCE2', 'Cachuda Cabro Extra Oferta 12onz.', 'Cerveza', '35.00', 1, 0, 17, 1, 0, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(110, 'CaCo1', 'Cachuda Corona 12onz.', 'Cerveza', '20.00', 1, 0, 21, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(111, 'CaCo2', 'Cachuda Corona 12onz. Oferta', 'Cerveza', '38.00', 1, 0, 17, 1, 0, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(112, 'Tek1', 'Tequila simple', 'Trago', '15.00', 21, 0, 13, 3, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(113, 'Tek2', 'Tequila Doble', 'Trago', '25.00', 19, 0, 13, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(114, 'Lev1', 'Levantamuertos simple', 'Trago', '6.00', 1, 0, 13, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(115, 'Lev2', 'Levantamuertos + Tequila', 'Trago', '10.00', 6, 0, 13, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(116, 'TW1', 'Whisky 1 onz. ', 'Trago', '25.00', 1, 0, 13, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(117, 'TW2', 'Whisky 2 onz.', 'Trago', '45.00', 1, 0, 13, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(118, 'TJ1', 'Jack Daniels 1 onz.', 'Trago', '35.00', 1, 0, 13, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(119, 'TJ2', 'Jack Daniels 2 onz.', 'Trago', '65.00', 1, 0, 13, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(120, 'Cafe', 'Cafe', 'cafe', '10.00', 3, 0, 18, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(121, 'Té', 'Té', 'Te', '10.00', 3, 0, 18, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(122, '1/8T', '1/8 Tamarindo', 'licor', '15.00', 15, 25, 12, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(123, '1/8J', '1/8 Jamaica', 'licor', '15.00', 0, 12, 12, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(124, '1/8Q', '1/8 Quetzalteca', 'licor', '15.00', 26, 12, 12, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(125, '1/8mora', '1/8 de Mora', 'licor', '15.00', 571, 45, 12, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(126, 'BotVe', 'Botella Venado Light', 'licor', '90', 65, 24, 12, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(127, '1/2V', '1/2 Venado light', 'licor', '55.00', 53, 48, 12, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(128, 'CAF', 'Quichelada Gallo y Cabro Oferta', 'Cerveza', '35.00', 1, 0, 10, 1, 0, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(130, 'xlB', 'Botella XL Piña y Coco+3 Gaseosa', 'licor', '100.00', 1, 6, 12, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(131, 'QuichGOferta', 'Quichelada Gallo Oferta 12 onz.', 'Cerveza', '35.00', 1, 0, 17, 1, 0, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(132, 'Pulmon1', 'Pulmon de Quezalteca', 'Licor blanco', '110.00', 18, 12, 12, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(133, '1/8L', '1/8 Limonada', 'licor 1/8', '15.00', 62, 24, 12, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(134, '1/2 pul', '1/2 Pulmon de Quezalteca', 'licor', '65.00', 26, 12, 12, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(135, 'AGup', 'Agua Pura', 'Agua', '10.00', 11, 12, 20, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(136, 'Lim', 'Limonada', 'Natural', '12.00', 4, 0, 20, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(137, 'TOst', 'Tostadas de Camarón', 'Tostadas con Camaron', '15.00', 2, 0, 5, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(138, 'PAPSup', 'Papas Supremas', 'Papas preparadas', '20.00', 3, 0, 5, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(139, 'JackB', 'Botella Jack Daniel\'s ', 'licor', '400.00', 8, 6, 12, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(140, 'WyNe', 'Botella Whisky Etiqueta Negra', 'licor', '600.00', 0, 6, 12, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(141, 'Zac', 'Botella Ron Zacapa', 'licor', '600.00', 5, 6, 12, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(142, 'WhiRo', 'Botella Whisky Etiqueta Roja', 'licor', '250.00', 5, 6, 12, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(143, '1/2WR', '1/2 Whisky Etiqueta Roja', 'licor', '150.00', 5, 6, 12, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(144, 'JirG', 'Jirafa Quichelada de Gallo', 'Cerveza', '150.00', 3, 0, 24, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(145, 'JirC ', 'Jirafa Quichelada Cabro', 'Cerveza', '150.00', 4, 0, 24, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(146, 'JirCoro', 'Jirafa Quichelada de Corona', 'Cerveza', '165.00', 1, 0, 24, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(147, 'JirM', 'Jirafa Quichelada de Modelo', 'Cerveza', '150.00', 9, 0, 24, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(148, 'JirCab', 'Jirafa de Cabro', 'Cerveza', '110.00', 8, 0, 24, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(149, 'JirGallo', 'Jirafa de Gallo', 'Cerveza', '110.00', 9, 0, 24, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(150, 'Cig', 'Cigarros 2x5QTZ', 'Cancer', '5.00', 1, 0, 23, 1, 0, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(151, 'coW', 'Coca Cola 12onz (Botella)', 'Gaseosa', '0.00', 14, 0, 22, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(152, '7d54', '7up (Botella)', 'Gaseosa', '0.00', 3, 0, 22, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(153, 'AGp1', 'Agua Pura (Botella)', 'Gaseosa', '0.00', 1, 0, 22, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(154, 'MinB', 'Mineral (Botella)', 'Gaseosa', '0.00', 9, 0, 22, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(155, 'CigCa', 'Cajetilla de Cigarro', 'Cancer', '40.00', 1, 0, 23, 4, 0, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(156, 'Chaja', 'Chajalele (Simarrona)', 'Morir', '12.00', 2, 0, 21, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(157, 'V8P', 'V8 Preparado', 'Jugo', '15.00', 2, 0, 21, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(158, '54151', 'Porción Extra de Tortilla', 'tortilla', '1.00', 1, 0, 9, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(159, 'BoqMoll', 'Mollejas (Boquitas)', 'Bocas', '0.00', 5, 0, 22, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(160, 'BoqNac', 'Nachos con Salsa, Carne y Queso', 'Bocas', '0.00', 2, 0, 22, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(161, 'BoqPA', 'Papas Fritas (Boquitas)', 'Bocas', '0.00', 2, 0, 22, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(162, 'BoqPaS', 'Papas Supremas (Boquitas)', 'Bocas', '0.00', 2, 0, 22, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(163, 'BoqPaB', 'Papas con Barbacoa (Boquitas)', 'Bocas', '0.00', 2, 0, 22, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(164, 'BoqAl', 'Alitas (Boquitas)', 'Bocas', '0.00', 1, 0, 22, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(165, 'BoqMx', 'Plato Mixto de Boquitas (Bocas)', 'Bocas', '0.00', 1, 0, 22, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(166, 'BoqT', 'Tostadas con Camaron (Boquitas)', 'Bocas', '0.00', 1, 0, 22, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(167, 'BoqPo', 'Papotas (Boquitas)', 'Bocas', '0.00', 1, 0, 22, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(168, 'BoqCeb', 'Aros de Cebolla (Boquitas)', 'Bocas', '0.00', 1, 0, 22, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(169, 'BoqCH', 'Choripapas (Boquitas)', 'Bocas', '0.00', 1, 0, 22, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(170, 'MinBo', 'Mirinda 12 onz. (Botella)', 'Gaseosa', '0.00', 1, 0, 22, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(171, 'mascf', 'Mashita Modelo 12onz.', 'Gaseosa', '20.00', 1, 0, 21, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(172, 'Bucha', 'Botella Buchanan\'s 12 años', 'licor', '500', 5, 6, 12, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(173, 'Ron12', '1/2 Ron Botran 12 años', 'licor', '120.00', 7, 6, 12, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(174, 'BotRon', 'Botella Ron Botran 12 años', 'licor', '160.00', 6, 6, 12, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(175, 'Mup', 'Muppet', 'licor', '20.00', 1, 0, 13, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(176, 'MashG', 'Mashita Gallo 12onz.', 'Cerveza', '20.00', 2, 0, 21, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(177, 'Cuba', 'Cubata 12onz.', 'licor', '15.00', 18, 24, 19, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(178, 'VIP', 'VIP 12onz.', 'licor', '18.00', 42, 24, 19, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(179, 'PiEsp', 'Pizza Personal de Especialidad', 'comida', '30.00', 1, 0, 6, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(180, 'chelnod', 'Chelada Modelo Lata 12 onz.', 'Cerveza', '15.00', 1, 0, 21, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(181, 'RB', 'Red Bull ', 'energizante', '25.00', 47, 24, 20, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(182, 'Jag', 'Jagger (2 x Q80.00)', 'licor 1/8', '80.00', 6, 0, 13, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(183, 'QUH', 'Quichelada de Heineken 12onz.', 'Cerveza', '25.00', 1, 0, 21, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(184, 'chg', 'Chelada Gallo Botella 12onz.', 'Cerveza', '15.00', 1, 0, 21, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(185, 'TaCoChi', 'Tacos de Cochinita (3 tacos)', 'Tacos', '30.00', 1, 0, 9, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(186, '1/8NaPe', '1/8 Naranja y Pepita', 'licor', '15.00', 395, 48, 12, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(187, 'Limonp', 'Preparado de Limon', 'preparado', '5.00', 3, 0, 20, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(188, '1/8sd', '1/8 Naranja y Pepita Prep. 7up', 'licor', '25.00', 4, 0, 13, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(189, '1/8fsdlknf', '1/8 Naranja y Pepita Prep. Mineral', 'licor', '25.00', 1, 0, 13, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(190, 'OldBot', 'Botella Old Parr 12 años', 'licor', '500.00', 7, 6, 12, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(191, 'BotSomer', 'Botella Something Special (whisky)', 'licor', '250.00', 1, 6, 12, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(192, '1/2SOW', '1/2 Something Special (whisky)', 'licor', '150.00', 2, 6, 12, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(193, 'Todt', 'Porción extra de tostadas', 'Comida', '5.00', 1, 0, 15, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(194, 'habsf', '1/8 Tamarindo Preparado', 'licor', '25.00', 1, 0, 13, 3, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(195, 'sf', '1/8 Limon Preparado', 'licor', '25.00', 1, 0, 13, 3, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(196, 'Chelcab', 'Chelada Cabro Extra 12 onz.', 'Cerveza', '15.00', 1, 0, 21, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(197, 'Extrac', 'Ingrediente extra', 'Comida', '5.00', 2, 0, 5, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(198, 'Agaud', 'Vaso extra Agua Pura', 'Gaseosa', '5.00', 1, 0, 20, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(199, '1/2XLm', '1/2 XL Manzana & Limon', 'Licor', '60.00', 22, 12, 12, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(200, 'TELoc', 'Tablazo Tequiloco ', 'tequila', '60.00', 1, 0, 13, 3, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(201, 'Cias', 'Cajetilla de Cigarros', 'cigarro', '45.00', 1, 0, 23, 3, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(202, 'Cheladd', 'Chelada Dorada Draft', 'Cerveza ', '20.00', 1, 0, 21, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(203, 'chelmin', 'Chelada Mineral', 'Cerveza', '15.00', 1, 0, 21, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(204, 'Mcocs', 'Cubetazo Modelo Vidrio', 'Cerveza', '80.00', 1, 0, 24, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(205, 'cdscdv', 'Cubetazo Corona', 'Cerveza', '80.00', 2, 0, 24, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(206, 'dsad', 'Cubetazo de Cabro Extra', 'sdf', '75.00', 2, 0, 24, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(207, 'Cervefb', 'Cubetazo Gallo 12 onz. (Sin bocas)', 'Cerveza', '65.00', 2, 0, 24, 1, 0, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(208, 'Bfjdu', 'Cubetazo Cabro sin Bocas', 'Bf', '65.00', 2, 0, 24, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(209, 'Hfjd', 'Cubetazo Gallo ', 'Cevr', '75.00', 2, 0, 24, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(210, 'bhg', 'Pulmon Mora ', 'licor', '125.00', 16, 24, 12, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(211, 'dfsjnf', 'Pulmon Naranja y Pepita', 'sfb', '125.00', 39, 24, 12, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(212, 'fv', 'Botella XL Manzana Verde y Limon', 'Licor', '110.00', 28, 24, 12, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(213, 'Bdhf', 'Chancletazo', 'licor', '30.00', 1, 0, 24, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(214, 'Bdhfjg', 'Cantarazo (5 Octavos)', 'Licor', '90.00', 1, 0, 24, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(215, 'Jdjf', 'Cantarazo (10 Octavos)', 'licor', '170.00', 1, 0, 24, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(216, 'Bfjfjdk', 'Grappete (Botella)', 'Agua', '0.00', 1, 0, 22, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(217, 'Hdhf6f6', 'Mirinda (Botella)', 'Agua', '0.00', 1, 0, 22, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(218, 'sdhsbdfuhbf', 'Peltrito', 'dhjg', '25.00', 1, 0, 24, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(219, 'Bdjfun', 'Picosita Modelo (evento)', 'Cerveza', '50.00', 1, 0, 24, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(220, 'Jdjxk', 'Chelada Corona', 'Cerveza', '20.00', 1, 0, 21, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(221, 'mnfsdnjkhwvgjfd ngsvdjf', 'Caldo de Marisco Oferta', 'comida', '55.00', 1, 0, 14, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(222, 'Bfhfi', 'Ceviche pequeño Oferta', 'Hfjx', '35.00', 1, 0, 15, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(224, 'Uenz', 'Ceviche Mediano Oferta', 'comida', '45.00', 1, 0, 15, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(225, 'Fjkns', 'Ceviche Grande Oferta', 'comida', '55.00', 1, 0, 15, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(226, 'Jdjdj', 'Pepsi 12 onz ( botella)', 'Bx', '0.00', 1, 0, 22, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(228, 'Jaggerb', '1/2 jagger ', 'energizante', '300.00', 4, 4, 12, 3, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(229, 'Hdjxin', 'Red bull o Adrenalina (botella)', 'Agua', '0.00', 1, 0, 22, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(230, 'Jfkxkn', '1/2 tequila Jose Cuervo', 'licor', '150.00', 9, 6, 12, 3, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(231, 'Hdu', 'Jarra de Sangria', 'Gaseosa', '0.00', 1, 0, 22, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(232, 'dsfnmbjkf', 'Botella Jagger', 'Licor', '500.00', 1, 6, 12, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(233, 'nbuygl', '1/2 Jack Daniel\'s', 'Licor', '250.00', 6, 6, 12, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(234, 'kfjgbio', '1/5 Ron 12 años', 'Licor', '75.00', 8, 6, 12, 1, 1, 1, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(235, 'dewfv', 'V8 Preparado Extra', 'Licor', '5.00', 1, 0, 13, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(236, 'Jfiins', 'Combo amigos: Pizza + Mollejas + Papas fritas', 'Hf', '150.00', 1, 0, 24, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(237, 'Jdjfb', 'Quichelada gallo (combo)', 'Bfj', '0.00', 1, 0, 22, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(238, 'Fjxus', 'Litro cabro (combo)', 'D', '0.00', 1, 0, 22, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(240, 'Tfug', 'Litro Gallo (combo)', 'Gj', '0.00', 1, 0, 22, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(241, 'Cydki', 'Pizza personal combo gaseosa', 'Fj', '30.00', 1, 0, 24, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(242, 'Gkie', 'Pizza personal combo Quichelada', 'licor', '40.00', 1, 0, 24, 2, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00),
(243, 'Jekxkwn', 'Chelada Cabro Reserva', 'Cerveza', '25.00', 1, 0, 21, 1, 1, 0, 0, 0, 'image_default.jpg', 0, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_asociados`
--

CREATE TABLE `productos_asociados` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `producto_asociado` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos_asociados`
--

INSERT INTO `productos_asociados` (`id`, `producto_id`, `producto_asociado`, `cantidad`) VALUES
(23, 33, 30, 1),
(24, 33, 31, 1),
(25, 29, 75, 1),
(29, 88, 75, 2),
(34, 90, 68, 2),
(36, 92, 77, 2),
(38, 94, 66, 2),
(44, 98, 83, 2),
(45, 100, 80, 2),
(47, 102, 78, 2),
(50, 105, 68, 2),
(52, 107, 76, 2),
(55, 109, 77, 2),
(57, 111, 66, 2),
(63, 128, 75, 1),
(64, 128, 77, 1),
(67, 130, 70, 3),
(68, 131, 75, 2),
(69, 87, 75, 1),
(70, 89, 68, 1),
(71, 91, 77, 1),
(72, 95, 83, 1),
(73, 93, 66, 1),
(74, 99, 80, 1),
(75, 101, 78, 1),
(76, 103, 81, 1),
(77, 104, 68, 1),
(78, 106, 76, 1),
(79, 108, 77, 1),
(80, 110, 66, 1),
(91, 153, 135, 1),
(92, 154, 81, 1),
(97, 156, 81, 1),
(98, 148, 84, 3),
(99, 149, 85, 3),
(100, 144, 85, 2),
(101, 144, 75, 1),
(102, 145, 77, 1),
(103, 145, 84, 2),
(104, 146, 66, 7),
(105, 147, 68, 7),
(106, 171, 68, 1),
(107, 176, 76, 1),
(108, 180, 68, 1),
(109, 182, 181, 1),
(110, 183, 79, 1),
(111, 184, 75, 1),
(112, 13, 14, 1),
(113, 15, 14, 1),
(114, 16, 14, 1),
(115, 16, 12, 1),
(116, 16, 15, 1),
(117, 16, 11, 1),
(118, 18, 17, 2),
(119, 32, 30, 1),
(120, 32, 31, 1),
(121, 48, 86, 1),
(122, 49, 75, 1),
(125, 152, 70, 1),
(126, 151, 86, 1),
(127, 188, 186, 1),
(128, 188, 70, 1),
(129, 189, 81, 1),
(130, 189, 186, 1),
(131, 194, 70, 1),
(132, 194, 122, 1),
(133, 195, 133, 1),
(134, 195, 70, 1),
(135, 196, 77, 1),
(136, 202, 80, 1),
(137, 203, 81, 1),
(142, 206, 77, 5),
(144, 207, 75, 5),
(145, 208, 77, 5),
(148, 217, 72, 1),
(149, 216, 71, 1),
(152, 219, 68, 3),
(153, 220, 66, 1),
(155, 205, 66, 5),
(156, 204, 67, 5),
(157, 209, 75, 5),
(158, 226, 69, 1),
(159, 229, 181, 1),
(160, 237, 75, 1),
(161, 238, 84, 1),
(162, 240, 85, 1),
(163, 243, 78, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_insumos`
--

CREATE TABLE `productos_insumos` (
  `id` int(11) NOT NULL,
  `insumo_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos_insumos`
--

INSERT INTO `productos_insumos` (`id`, `insumo_id`, `producto_id`, `cantidad`) VALUES
(7, 1, 10, 150),
(8, 2, 10, 1),
(9, 2, 9, 1),
(10, 3, 9, 200);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_unidades_medidas`
--

CREATE TABLE `productos_unidades_medidas` (
  `id` int(11) NOT NULL,
  `unidad_medida_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `precio` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos_unidades_medidas`
--

INSERT INTO `productos_unidades_medidas` (`id`, `unidad_medida_id`, `producto_id`, `cantidad`, `estado`, `precio`) VALUES
(1, 1, 69, 1, 1, 2.00),
(2, 2, 69, 12, 1, 24.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `nit` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `contacto` varchar(45) DEFAULT NULL,
  `tel_contacto` varchar(45) DEFAULT NULL,
  `banco` varchar(45) DEFAULT NULL,
  `no_cuenta` varchar(45) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre`, `nit`, `direccion`, `telefono`, `email`, `contacto`, `tel_contacto`, `banco`, `no_cuenta`, `estado`) VALUES
(1, 'Distribuidora Fesun', '1002020', 'miramar d-14', '45444222', 'fesun.servicios@fesun.com.co', 'Juan Perez', '9656545', '', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `ruta` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `descripcion`, `ruta`) VALUES
(1, 'admin', 'todas las funciones', 'dashboard'),
(2, 'cajero', 'algunas funciones', 'caja/apertura_cierre'),
(3, 'Vendedor', 'Acceso algunas funciones', 'movimientos/ordenes'),
(4, 'mesero', 'Toma de Ordenes', 'movimientos/ordenes'),
(5, 'Cocinero', 'Cocinero', 'pedidos/cocina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

CREATE TABLE `subcategorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `subcategorias`
--

INSERT INTO `subcategorias` (`id`, `nombre`, `estado`) VALUES
(1, 'Bebidas', 1),
(2, 'Comida', 1),
(3, 'Tragos', 1),
(4, 'Cigarrillos', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjetas`
--

CREATE TABLE `tarjetas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tarjetas`
--

INSERT INTO `tarjetas` (`id`, `nombre`) VALUES
(1, 'Visa'),
(2, 'Master Card');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cliente`
--

CREATE TABLE `tipo_cliente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_cliente`
--

INSERT INTO `tipo_cliente` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Persona ', NULL),
(2, 'Empresa', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_comprobante`
--

CREATE TABLE `tipo_comprobante` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `igv` int(11) DEFAULT NULL,
  `serie` varchar(45) DEFAULT NULL,
  `predeterminado` tinyint(1) NOT NULL,
  `numero_inicial` int(11) NOT NULL,
  `limite` int(11) NOT NULL,
  `solicitar_nit` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_comprobante`
--

INSERT INTO `tipo_comprobante` (`id`, `nombre`, `cantidad`, `igv`, `serie`, `predeterminado`, `numero_inicial`, `limite`, `solicitar_nit`) VALUES
(1, 'Factura', 0, 18, '001', 0, 1, 10000, 0),
(2, 'Ticket', 11431, 0, '001', 1, 1, 1000, 0),
(3, 'Boleta', 0, NULL, '003', 0, 1, 10000, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`id`, `nombre`, `cantidad`) VALUES
(1, 'DPI', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades_medidas`
--

CREATE TABLE `unidades_medidas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `unidades_medidas`
--

INSERT INTO `unidades_medidas` (`id`, `nombre`) VALUES
(1, 'Unidad'),
(2, 'Paquete'),
(3, 'Caja'),
(4, 'Gramos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombres` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `imagen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `telefono`, `email`, `username`, `password`, `rol_id`, `estado`, `imagen`) VALUES
(1, 'Gary', 'Cano', '42956492', 'info@wilsonicx.com', 'gcano', '77debaf86247c137797372b599fced1c8e730c3f', 1, 1, ''),
(2, 'Javier', 'Bol', '41039872', 'jb@quicheladas.com', 'jb', '572c893d2b86941b57c29ca8cfeb73265dc25f98', 1, 1, ''),
(3, 'Leonel', 'Bol', '55555555', 'leo@quicheladas.com', 'leo', '785b73decb616a0ee81705d9409da7d25bfc6f3e', 2, 1, ''),
(4, 'Yaquelin', 'Flores', '41025675', 'yaquelin@quicheladas.com', 'wakiz', '7267dd68f963b1f330f0297e473c6b6a1ad69c6b', 1, 1, ''),
(5, 'yony brondy', 'mamani fuentes', '45645342', 'yonybrondy17@gmail.com', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 1, 'avatar04.png'),
(6, 'Chepe', 'Ozuna', '007', '', 'Chepe', 'cfa1150f1787186742a9a884b73a43d8cf219f9b', 3, 0, ''),
(7, 'Sergio', 'Chavez', '53481294', 'terrazachvezsergiomanuel98@gmail.com', 'Sergio', '1e237baabaf3b176d854ea26dbe07d4d4ec93cb1', 3, 0, ''),
(8, 'Luis', 'Lopez', '49481176', 'm', 'Flash', '8d5004c9c74259ab775f63f7131da077814a7636', 3, 0, ''),
(9, 'Quicheladas', 'Quiche', '77360392', '.', 'Quicheladas', '400b46960f4f5a3b29e574631c104a1e12e20f87', 1, 0, ''),
(16, 'Quichelada', 'Descuento', '77360392', 'mm', 'Quiche', '33e10c0032913b742da5681bb1ded9af2b841625', 1, 0, ''),
(22, 'Quichela', 'Bol Flores', '7779', 'ad', 'Desc.', '33e10c0032913b742da5681bb1ded9af2b841625', 1, 0, ''),
(25, 'Chepe Barra', 'Gomez', '54381288', 'chpe@gmail.com', 'Chepe1', '2a5286a255078214898e37c99288c4a74ff98858', 2, 1, ''),
(26, 'Protovo', 'Solutions', '444444', 'protovo@gmail.com', 'protovo', '94bab13876a90ea363a3090d995e7e3f44fd6655', 4, 0, ''),
(29, 'Danis', 'Danis1,2', '911', 'Quiche-ladas-01@outlook.com', 'Danis', '7d45f2f7f6f105dad5b14f499a026149b54e3c97', 4, 1, ''),
(30, 'Pancha', 'Manqirue', '454545', 'panchaq@gmail.com', 'pancha', '2480537f877495277a3eaf0709e3979cd683fe2b', 5, 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `subtotal` varchar(45) DEFAULT NULL,
  `igv` varchar(45) DEFAULT NULL,
  `descuento` varchar(45) DEFAULT NULL,
  `total` varchar(45) DEFAULT NULL,
  `tipo_comprobante_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `num_documento` varchar(45) DEFAULT NULL,
  `serie` varchar(45) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  `caja_id` int(11) NOT NULL,
  `monto_efectivo` double(10,2) NOT NULL,
  `monto_tarjeta` double(10,2) NOT NULL,
  `monto_credito` double(10,2) NOT NULL,
  `tipo_pago` int(11) NOT NULL,
  `tarjeta_id` int(11) DEFAULT NULL,
  `hora` varchar(20) NOT NULL,
  `pedido_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `fecha`, `subtotal`, `igv`, `descuento`, `total`, `tipo_comprobante_id`, `cliente_id`, `usuario_id`, `num_documento`, `serie`, `estado`, `caja_id`, `monto_efectivo`, `monto_tarjeta`, `monto_credito`, `tipo_pago`, `tarjeta_id`, `hora`, `pedido_id`) VALUES
(10, '2019-04-27', '150.00', '0.00', '0.00', '150.00', 2, 1, 5, '011381', '001', 1, 1, 150.00, 0.00, 0.00, 1, 0, '12:46 PM', 10),
(11, '2019-04-27', '218.00', '0.00', '0.00', '218.00', 2, 1, 5, '011382', '001', 1, 2, 218.00, 0.00, 0.00, 1, 0, '20:44 PM', 11),
(12, '2019-04-28', '218.00', '0.00', '0.00', '218.00', 2, 92, 5, '011383', '001', 1, 3, 218.00, 0.00, 0.00, 1, 0, '10:14 AM', 12),
(13, '2019-04-28', '150.00', '0.00', '0.00', '150.00', 2, 88, 5, '011384', '001', 1, 4, 150.00, 0.00, 0.00, 1, 0, '', 0),
(14, '2019-04-28', '218.00', '0.00', '0.00', '218.00', 2, 1, 5, '011385', '001', 1, 5, 218.00, 0.00, 0.00, 1, 0, '10:39 AM', 13),
(15, '2019-04-28', '150.00', '0.00', '0.00', '150.00', 2, 1, 5, '011386', '001', 1, 6, 150.00, 0.00, 0.00, 1, 0, '10:41 AM', 14),
(16, '2019-04-28', '180.00', '0.00', '0.00', '180.00', 2, 1, 5, '011387', '001', 1, 7, 180.00, 0.00, 0.00, 1, 0, '10:49 AM', 15),
(17, '2019-04-28', '218.00', '0.00', '0.00', '218.00', 2, 1, 5, '011388', '001', 1, 8, 218.00, 0.00, 0.00, 1, 0, '10:52 AM', 16),
(18, '2019-04-28', '218.00', '0.00', '0.00', '218.00', 2, 1, 5, '011389', '001', 1, 9, 218.00, 0.00, 0.00, 1, 0, '12:44 PM', 17),
(19, '2019-04-28', '80.00', '0.00', '0.00', '80.00', 2, 92, 5, '011390', '001', 1, 9, 80.00, 0.00, 0.00, 1, 0, '20:24 PM', 18),
(20, '2019-04-28', '128.00', '0.00', '0.00', '128.00', 2, 1, 5, '011391', '001', 1, 10, 128.00, 0.00, 0.00, 1, 0, '21:56 PM', 19),
(21, '2019-04-28', '218.00', '0.00', '0.00', '218.00', 2, 1, 5, '011392', '001', 1, 11, 218.00, 0.00, 0.00, 1, 0, '22:02 PM', 20),
(22, '2019-04-28', '150.00', '0.00', '0.00', '150.00', 2, 1, 5, '011393', '001', 1, 11, 0.00, 150.00, 0.00, 2, 1, '22:07 PM', 21),
(23, '2019-04-28', '158.00', '0.00', '0.00', '158.00', 2, 1, 5, '011394', '001', 1, 12, 158.00, 0.00, 0.00, 1, 0, '22:46 PM', 22),
(24, '2019-04-28', '110.00', '0.00', '0.00', '110.00', 2, 1, 5, '011395', '001', 1, 19, 110.00, 0.00, 0.00, 1, 0, '', 0),
(25, '2019-04-30', '80.00', '0.00', '0.00', '80.00', 2, 1, 5, '011396', '001', 1, 20, 80.00, 0.00, 0.00, 1, 0, '20:16 PM', 28),
(26, '2019-04-30', '75.00', '0.00', '0.00', '75.00', 2, 1, 5, '011397', '001', 1, 20, 75.00, 0.00, 0.00, 1, 0, '20:16 PM', 29),
(27, '2019-04-30', '158.00', '0.00', '0.00', '158.00', 2, 1, 5, '011398', '001', 1, 20, 158.00, 0.00, 0.00, 1, 0, '20:17 PM', 30),
(28, '2019-04-30', '193.00', '0.00', '0.00', '193.00', 2, 1, 5, '011399', '001', 1, 20, 193.00, 0.00, 0.00, 1, 0, '20:17 PM', 31),
(29, '2019-04-30', '188.00', '0.00', '0.00', '188.00', 2, 1, 5, '011400', '001', 1, 20, 188.00, 0.00, 0.00, 1, 0, '20:17 PM', 32),
(30, '2019-04-30', '218.00', '0.00', '0.00', '218.00', 2, 1, 5, '011401', '001', 1, 20, 218.00, 0.00, 0.00, 1, 0, '20:18 PM', 23),
(31, '2019-04-30', '128.00', '0.00', '0.00', '128.00', 2, 1, 5, '011402', '001', 1, 20, 128.00, 0.00, 0.00, 1, 0, '22:10 PM', 33),
(32, '2019-04-30', '128.00', '0.00', '0.00', '128.00', 2, 1, 5, '011403', '001', 1, 20, 128.00, 0.00, 0.00, 1, 0, '22:11 PM', 34),
(33, '2019-05-06', '68.00', '0.00', '0.00', '68.00', 2, 1, 5, '011404', '001', 1, 20, 68.00, 0.00, 0.00, 1, 0, '20:22 PM', 38),
(34, '2019-05-06', '35.00', '0.00', '0.00', '35.00', 2, 89, 5, '011405', '001', 1, 20, 35.00, 0.00, 0.00, 1, 0, '20:32 PM', 38),
(35, '2019-05-06', '20.00', '0.00', '0.00', '20.00', 2, 89, 5, '011406', '001', 1, 20, 20.00, 0.00, 0.00, 1, 0, '20:32 PM', 39),
(36, '2019-05-06', '110.00', '0.00', '0.00', '110.00', 2, 96, 5, '011407', '001', 1, 20, 110.00, 0.00, 0.00, 1, 0, '20:33 PM', 24),
(37, '2019-05-06', '95.00', '0.00', '0.00', '95.00', 2, 95, 5, '011408', '001', 1, 20, 95.00, 0.00, 0.00, 1, 0, '20:33 PM', 25),
(38, '2019-05-06', '218.00', '0.00', '0.00', '218.00', 2, 96, 5, '011409', '001', 1, 20, 218.00, 0.00, 0.00, 1, 0, '20:34 PM', 26),
(39, '2019-05-06', '80.00', '0.00', '0.00', '80.00', 2, 96, 5, '011410', '001', 1, 20, 80.00, 0.00, 0.00, 1, 0, '20:34 PM', 27),
(40, '2019-05-06', '158.00', '0.00', '0.00', '158.00', 2, 97, 5, '011411', '001', 1, 20, 158.00, 0.00, 0.00, 1, 0, '20:35 PM', 35),
(41, '2019-05-06', '158.00', '0.00', '0.00', '158.00', 2, 97, 5, '011412', '001', 1, 20, 158.00, 0.00, 0.00, 1, 0, '20:35 PM', 36),
(42, '2019-05-06', '218.00', '0.00', '0.00', '218.00', 2, 100, 5, '011413', '001', 1, 20, 218.00, 0.00, 0.00, 1, 0, '20:35 PM', 37),
(43, '2019-05-10', '349.00', '0.00', '0.00', '349.00', 2, 88, 5, '011414', '001', 1, 20, 349.00, 0.00, 0.00, 1, 0, '22:09 PM', 44),
(44, '2019-05-10', '349.00', '0.00', '0.00', '349.00', 2, 88, 5, '011415', '001', 1, 20, 349.00, 0.00, 0.00, 1, 0, '22:12 PM', 45),
(45, '2019-05-10', '328.00', '0.00', '0.00', '328.00', 2, 90, 5, '011416', '001', 1, 20, 328.00, 0.00, 0.00, 1, 0, '23:00 PM', 46),
(46, '2019-05-10', '328.00', '0.00', '0.00', '328.00', 2, 90, 5, '011417', '001', 1, 20, 328.00, 0.00, 0.00, 1, 0, '23:37 PM', 47),
(47, '2019-05-10', '328.00', '0.00', '0.00', '328.00', 2, 88, 5, '011418', '001', 1, 20, 328.00, 0.00, 0.00, 1, 0, '23:50 PM', 48),
(48, '2019-05-10', '328.00', '0.00', '0.00', '328.00', 2, 88, 5, '011419', '001', 1, 20, 328.00, 0.00, 0.00, 1, 0, '23:53 PM', 49),
(49, '2019-05-11', '328.00', '0.00', '0.00', '328.00', 2, 89, 5, '011420', '001', 1, 20, 328.00, 0.00, 0.00, 1, 0, '00:00 AM', 50),
(50, '2019-05-11', '328.00', '0.00', '0.00', '328.00', 2, 90, 5, '011421', '001', 1, 20, 328.00, 0.00, 0.00, 1, 0, '00:01 AM', 51),
(51, '2019-05-11', '328.00', '0.00', '0.00', '328.00', 2, 90, 5, '011422', '001', 1, 20, 328.00, 0.00, 0.00, 1, 0, '00:14 AM', 52),
(52, '2019-05-11', '343.00', '0.00', '0.00', '343.00', 2, 89, 5, '011423', '001', 1, 20, 343.00, 0.00, 0.00, 1, 0, '12:09 PM', 53),
(53, '2019-05-11', '358.00', '0.00', '0.00', '358.00', 2, 92, 5, '011424', '001', 1, 20, 358.00, 0.00, 0.00, 1, 0, '12:14 PM', 54),
(54, '2019-05-11', '328.00', '0.00', '0.00', '328.00', 2, 89, 5, '011425', '001', 1, 20, 328.00, 0.00, 0.00, 1, 0, '12:28 PM', 55),
(55, '2019-05-11', '343.00', '0.00', '0.00', '343.00', 2, 88, 5, '011426', '001', 1, 20, 343.00, 0.00, 0.00, 1, 0, '12:30 PM', 56),
(56, '2019-05-11', '349.00', '0.00', '0.00', '349.00', 2, 0, 5, '011427', '001', 1, 20, 349.00, 0.00, 0.00, 1, 0, '13:20 PM', 57),
(57, '2019-05-11', '341.00', '0.00', '0.00', '341.00', 2, 90, 5, '011428', '001', 1, 20, 341.00, 0.00, 0.00, 1, 0, '13:21 PM', 58),
(58, '2019-05-11', '178.00', '0.00', '5.00', '173.00', 2, 89, 5, '011429', '001', 1, 20, 173.00, 0.00, 0.00, 1, 0, '13:33 PM', 59),
(59, '2019-05-11', '80.00', '0.00', '5.00', '75.00', 2, 88, 5, '011430', '001', 1, 20, 75.00, 0.00, 0.00, 1, 0, '13:38 PM', 60),
(60, '2019-05-11', '328.00', '0.00', '0.00', '328.00', 2, 88, 5, '011431', '001', 1, 20, 328.00, 0.00, 0.00, 1, 0, '13:40 PM', 61);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ajustes`
--
ALTER TABLE `ajustes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tipo_cliente_idx` (`tipo_cliente_id`),
  ADD KEY `fk_tipo_documento_idx` (`tipo_documento_id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuraciones`
--
ALTER TABLE `configuraciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuraciones_cupones`
--
ALTER TABLE `configuraciones_cupones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `correos`
--
ALTER TABLE `correos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cuentas_cobrar`
--
ALTER TABLE `cuentas_cobrar`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cupones_generados`
--
ALTER TABLE `cupones_generados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detalle_compra_compra_idx` (`compra_id`),
  ADD KEY `fk_detalle_compra_producto_idx` (`producto_id`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_venta_detalle_idx` (`venta_id`),
  ADD KEY `fk_producto_detalle_idx` (`producto_id`);

--
-- Indices de la tabla `extras`
--
ALTER TABLE `extras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `insumos`
--
ALTER TABLE `insumos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_productos_notificaciones_idx` (`producto_id`);

--
-- Indices de la tabla `orden_producto_extra`
--
ALTER TABLE `orden_producto_extra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos_mesa`
--
ALTER TABLE `pedidos_mesa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_menus_idx` (`menu_id`),
  ADD KEY `fk_rol_idx` (`rol_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`),
  ADD UNIQUE KEY `codigo_UNIQUE` (`codigo`),
  ADD KEY `fk_categoria_producto_idx` (`categoria_id`);

--
-- Indices de la tabla `productos_asociados`
--
ALTER TABLE `productos_asociados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos_insumos`
--
ALTER TABLE `productos_insumos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos_unidades_medidas`
--
ALTER TABLE `productos_unidades_medidas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`);

--
-- Indices de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tarjetas`
--
ALTER TABLE `tarjetas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_cliente`
--
ALTER TABLE `tipo_cliente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`);

--
-- Indices de la tabla `tipo_comprobante`
--
ALTER TABLE `tipo_comprobante`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`);

--
-- Indices de la tabla `unidades_medidas`
--
ALTER TABLE `unidades_medidas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `fk_rol_usuarios_idx` (`rol_id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario_venta_idx` (`usuario_id`),
  ADD KEY `fk_cliente_venta_idx` (`cliente_id`),
  ADD KEY `fk_tipo_comprobante_venta_idx` (`tipo_comprobante_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ajustes`
--
ALTER TABLE `ajustes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `configuraciones`
--
ALTER TABLE `configuraciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `configuraciones_cupones`
--
ALTER TABLE `configuraciones_cupones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `correos`
--
ALTER TABLE `correos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cuentas_cobrar`
--
ALTER TABLE `cuentas_cobrar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cupones_generados`
--
ALTER TABLE `cupones_generados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT de la tabla `extras`
--
ALTER TABLE `extras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `insumos`
--
ALTER TABLE `insumos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `orden_producto_extra`
--
ALTER TABLE `orden_producto_extra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `pedidos_mesa`
--
ALTER TABLE `pedidos_mesa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT de la tabla `productos_asociados`
--
ALTER TABLE `productos_asociados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT de la tabla `productos_insumos`
--
ALTER TABLE `productos_insumos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `productos_unidades_medidas`
--
ALTER TABLE `productos_unidades_medidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tarjetas`
--
ALTER TABLE `tarjetas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_cliente`
--
ALTER TABLE `tipo_cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_comprobante`
--
ALTER TABLE `tipo_comprobante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `unidades_medidas`
--
ALTER TABLE `unidades_medidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `caja`
--
ALTER TABLE `caja`
  ADD CONSTRAINT `caja_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `fk_tipo_cliente` FOREIGN KEY (`tipo_cliente_id`) REFERENCES `tipo_cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tipo_documento` FOREIGN KEY (`tipo_documento_id`) REFERENCES `tipo_documento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD CONSTRAINT `fk_detalle_compra_compra` FOREIGN KEY (`compra_id`) REFERENCES `compras` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_compra_producto` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `fk_producto_detalle` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_venta_detalle` FOREIGN KEY (`venta_id`) REFERENCES `ventas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `fk_productos_notificaciones` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_categoria_producto` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
