-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-11-2025 a las 02:38:29
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
-- Base de datos: `gestion_productos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `categoria`, `precio`, `stock`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(1, 'Laptop HP Pavilion 15', 'Computadoras', 749.99, 15, '2025-11-25 01:37:51', '2025-11-25 01:37:51'),
(2, 'Mouse Logitech G502', 'Accesorios', 49.99, 45, '2025-11-25 01:37:51', '2025-11-25 01:37:51'),
(3, 'Teclado Mecánico Razer BlackWidow', 'Accesorios', 129.99, 30, '2025-11-25 01:37:51', '2025-11-25 01:37:51'),
(4, 'Monitor LG 24\" Full HD', 'Monitores', 199.99, 20, '2025-11-25 01:37:51', '2025-11-25 01:37:51'),
(5, 'Auriculares Sony WH-1000XM4', 'Audio', 299.99, 12, '2025-11-25 01:37:51', '2025-11-25 01:37:51'),
(6, 'SSD Samsung 1TB', 'Almacenamiento', 89.99, 50, '2025-11-25 01:37:51', '2025-11-25 01:37:51'),
(7, 'Webcam Logitech C920', 'Accesorios', 79.99, 25, '2025-11-25 01:37:51', '2025-11-25 01:37:51'),
(8, 'Impresora HP LaserJet', 'Impresoras', 249.99, 8, '2025-11-25 01:37:51', '2025-11-25 01:37:51');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
