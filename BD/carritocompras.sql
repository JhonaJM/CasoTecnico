-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-01-2023 a las 15:15:55
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `carritocompras`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `IdCategoria` int(11) NOT NULL,
  `NombreCategoria` varchar(100) NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaModificacion` datetime DEFAULT NULL,
  `IdEstado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`IdCategoria`, `NombreCategoria`, `FechaCreacion`, `FechaModificacion`, `IdEstado`) VALUES
(3, 'TECNOLOGIA', '2023-01-24 03:58:44', NULL, 1),
(4, 'HOGAR', '2023-01-24 03:58:44', NULL, 1),
(7, 'CELULARES', '2023-01-25 01:21:40', NULL, 1),
(8, 'MODA HOMBRE', '2023-01-25 01:21:40', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `IdCompra` int(11) NOT NULL,
  `NumeroCompra` varchar(10) NOT NULL,
  `FechaCompra` datetime NOT NULL,
  `Moneda` varchar(3) NOT NULL,
  `TotalCompra` decimal(18,4) NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaModificacion` datetime DEFAULT NULL,
  `IdEstado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`IdCompra`, `NumeroCompra`, `FechaCompra`, `Moneda`, `TotalCompra`, `FechaCreacion`, `FechaModificacion`, `IdEstado`) VALUES
(4, '0000000001', '2023-01-25 00:00:00', 'SOL', '2330.0000', '2023-01-25 00:00:00', NULL, 1),
(5, '0000000002', '2023-01-25 00:00:00', 'SOL', '5900.0000', '2023-01-25 00:00:00', NULL, 1),
(6, '0000000003', '2023-01-16 00:00:00', 'SOL', '5900.0000', '2023-01-25 00:00:00', NULL, 1),
(7, '0000000004', '2023-01-25 00:00:00', 'SOL', '5900.0000', '2023-01-25 00:00:00', NULL, 1),
(8, '0000000005', '2023-01-25 00:00:00', 'SOL', '1590.0000', '2023-01-25 00:00:00', NULL, 1),
(17, '0000000006', '2023-01-25 00:00:00', 'SOL', '780.0000', '2023-01-25 00:00:00', NULL, 1),
(18, '0000000007', '2023-01-25 00:00:00', 'SOL', '140.0000', '2023-01-25 00:00:00', NULL, 1),
(19, '0000000008', '2023-01-25 00:00:00', 'SOL', '140.0000', '2023-01-25 00:00:00', NULL, 1),
(20, '0000000009', '2023-01-25 00:00:00', 'SOL', '140.0000', '2023-01-25 00:00:00', NULL, 1),
(21, '0000000010', '2023-01-25 00:00:00', 'SOL', '140.0000', '2023-01-25 00:00:00', NULL, 1),
(22, '0000000011', '2023-01-25 00:00:00', 'SOL', '6900.0000', '2023-01-25 00:00:00', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compradetalle`
--

CREATE TABLE `compradetalle` (
  `IdCompraDetalle` int(11) NOT NULL,
  `IdCompra` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `IdMarca` int(11) NOT NULL,
  `IdCategoria` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Precio` decimal(10,0) NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaModificacion` datetime DEFAULT NULL,
  `IdEstado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `compradetalle`
--

INSERT INTO `compradetalle` (`IdCompraDetalle`, `IdCompra`, `IdProducto`, `IdMarca`, `IdCategoria`, `Cantidad`, `Precio`, `FechaCreacion`, `FechaModificacion`, `IdEstado`) VALUES
(6, 17, 10, 3, 4, 1, '700', '2023-01-25 00:00:00', NULL, 1),
(7, 17, 8, 4, 8, 2, '40', '2023-01-25 00:00:00', NULL, 1),
(8, 18, 1, 1, 3, 2, '70', '2023-01-25 00:00:00', NULL, 1),
(9, 19, 1, 1, 3, 2, '70', '2023-01-25 00:00:00', NULL, 1),
(10, 20, 1, 1, 3, 2, '70', '2023-01-25 00:00:00', NULL, 1),
(11, 21, 1, 1, 3, 2, '70', '2023-01-25 00:00:00', NULL, 1),
(12, 22, 5, 3, 7, 3, '2300', '2023-01-25 00:00:00', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correlativo`
--

CREATE TABLE `correlativo` (
  `IdCorrelativo` int(11) NOT NULL,
  `NombreTabla` varchar(100) NOT NULL,
  `Numero` bigint(20) NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `IdEstado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `correlativo`
--

INSERT INTO `correlativo` (`IdCorrelativo`, `NombreTabla`, `Numero`, `FechaCreacion`, `IdEstado`) VALUES
(1, 'COMPRAS', 12, '2023-01-25 03:07:54', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `IdEstado` int(11) NOT NULL,
  `NombreEstado` varchar(100) NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`IdEstado`, `NombreEstado`, `FechaCreacion`, `FechaModificacion`) VALUES
(1, 'ACTIVO', '2023-01-24 03:58:23', NULL),
(2, 'ANULADO', '2023-01-24 03:58:23', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `IdMarca` int(11) NOT NULL,
  `NombreMarca` varchar(100) NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaModificacion` datetime DEFAULT NULL,
  `IdEstado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`IdMarca`, `NombreMarca`, `FechaCreacion`, `FechaModificacion`, `IdEstado`) VALUES
(1, 'LOGITECH', '2023-01-24 03:59:14', NULL, 1),
(2, 'XIAOMI', '2023-01-24 03:59:14', NULL, 1),
(3, 'SANSUNG', '2023-01-25 01:22:57', NULL, 1),
(4, 'INDEX', '2023-01-25 01:22:57', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `IdProducto` int(11) NOT NULL,
  `IdCategoria` int(11) NOT NULL,
  `IdMarca` int(11) NOT NULL,
  `NombreProducto` varchar(100) NOT NULL,
  `Stock` int(11) NOT NULL,
  `Moneda` varchar(3) NOT NULL,
  `Precio` decimal(18,0) NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaModificacion` datetime DEFAULT NULL,
  `IdEstado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`IdProducto`, `IdCategoria`, `IdMarca`, `NombreProducto`, `Stock`, `Moneda`, `Precio`, `FechaCreacion`, `FechaModificacion`, `IdEstado`) VALUES
(1, 3, 1, 'MOUSE', 94, 'SOL', '70', '2023-01-24 03:59:54', NULL, 1),
(2, 4, 2, 'OLLA ARROCERA', 45, 'SOL', '110', '2023-01-24 03:59:54', NULL, 1),
(3, 3, 2, 'MONITOR', 98, 'SOL', '750', '2023-01-24 04:01:01', NULL, 1),
(4, 4, 2, 'HORNO MICROONDAS', 0, 'SOL', '200', '2023-01-24 04:01:01', NULL, 1),
(5, 7, 3, 'SANDUNG J50', 97, 'SOL', '2300', '2023-01-25 01:23:45', NULL, 1),
(6, 8, 4, 'POLO ELEGANTE', 200, 'SOL', '50', '2023-01-25 01:23:45', NULL, 1),
(7, 7, 2, 'REDMI POCO X3', 10, 'SOL', '1004', '2023-01-25 01:38:55', NULL, 1),
(8, 8, 4, 'JEAN S', 7, 'SOL', '40', '2023-01-25 01:38:55', NULL, 1),
(9, 3, 3, 'LAPTOP ASUS ', 39, 'SOL', '5200', '2023-01-25 01:40:13', NULL, 1),
(10, 4, 3, 'LAVADORA ', 1, 'SOL', '700', '2023-01-25 01:40:13', NULL, 1),
(11, 4, 2, 'LAMPARA', 1, 'SOL', '150', '2023-01-25 01:41:26', NULL, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`IdCategoria`),
  ADD KEY `IdEstado` (`IdEstado`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`IdCompra`),
  ADD KEY `IdEstado` (`IdEstado`);

--
-- Indices de la tabla `compradetalle`
--
ALTER TABLE `compradetalle`
  ADD PRIMARY KEY (`IdCompraDetalle`),
  ADD KEY `IdCompra` (`IdCompra`),
  ADD KEY `IdProducto` (`IdProducto`),
  ADD KEY `IdMarca` (`IdMarca`),
  ADD KEY `IdCategoria` (`IdCategoria`),
  ADD KEY `IdEstado` (`IdEstado`);

--
-- Indices de la tabla `correlativo`
--
ALTER TABLE `correlativo`
  ADD PRIMARY KEY (`IdCorrelativo`),
  ADD KEY `ix_estado` (`IdEstado`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`IdEstado`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`IdMarca`),
  ADD KEY `IdEstado` (`IdEstado`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`IdProducto`),
  ADD KEY `IdCategoria` (`IdCategoria`,`IdMarca`,`IdEstado`),
  ADD KEY `IdMarca` (`IdMarca`),
  ADD KEY `IdEstado` (`IdEstado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `IdCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `IdCompra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `compradetalle`
--
ALTER TABLE `compradetalle`
  MODIFY `IdCompraDetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `correlativo`
--
ALTER TABLE `correlativo`
  MODIFY `IdCorrelativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `IdEstado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `IdMarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `IdProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `categoria_ibfk_1` FOREIGN KEY (`IdEstado`) REFERENCES `estado` (`IdEstado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`IdEstado`) REFERENCES `estado` (`IdEstado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `compradetalle`
--
ALTER TABLE `compradetalle`
  ADD CONSTRAINT `compradetalle_ibfk_1` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`IdProducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compradetalle_ibfk_2` FOREIGN KEY (`IdMarca`) REFERENCES `marca` (`IdMarca`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compradetalle_ibfk_3` FOREIGN KEY (`IdEstado`) REFERENCES `estado` (`IdEstado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compradetalle_ibfk_4` FOREIGN KEY (`IdCategoria`) REFERENCES `categoria` (`IdCategoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compradetalle_ibfk_5` FOREIGN KEY (`IdCompra`) REFERENCES `compra` (`IdCompra`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `marca`
--
ALTER TABLE `marca`
  ADD CONSTRAINT `marca_ibfk_1` FOREIGN KEY (`IdEstado`) REFERENCES `estado` (`IdEstado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`IdMarca`) REFERENCES `marca` (`IdMarca`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`IdEstado`) REFERENCES `estado` (`IdEstado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`IdCategoria`) REFERENCES `categoria` (`IdCategoria`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
