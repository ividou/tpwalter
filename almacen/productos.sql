-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-09-2024 a las 16:44:34
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `almacen`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Categoria` varchar(50) NOT NULL,
  `Marca` varchar(50) NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `Nombre`, `Categoria`, `Marca`, `Precio`, `stock`, `descripcion`) VALUES
(1, 'GeForce GTX 1650', 'Tarjeta Gráfica', 'Nvidia', '250.99', 10, 'Tarjeta gráfica de 4GB ideal para gaming'),
(2, 'Ryzen 5 1600', 'Procesador', 'AMD', '150.50', 5, 'Procesador de 6 núcleos con 12 hilos para alto rendimiento'),
(3, 'Asus ROG Strix B450-F', 'Placa Madre', 'Asus', '120.75', 8, 'Placa madre con soporte para procesadores Ryzen'),
(4, 'Deepcool DA600W', 'Fuente de Poder', 'Deepcool', '65.90', 15, 'Fuente de poder 80 Plus Bronze de 600W'),
(5, 'Kingston A400 240GB', 'Almacenamiento', 'Kingston', '45.00', 20, 'Disco SSD de 240GB ideal para aumentar la velocidad del sistema'),
(6, 'HyperX Fury 8GB DDR4', 'Memoria RAM', 'HyperX', '39.99', 12, 'Módulo de memoria RAM DDR4 de 8GB para gaming'),
(7, 'Corsair K95 RGB', 'Teclado', 'Corsair', '199.99', 4, 'Teclado mecánico con retroiluminación RGB'),
(8, 'Razer DeathAdder Elite', 'Mouse', 'Razer', '69.99', 10, 'Mouse óptico para gaming con 16,000 DPI'),
(9, 'MSI MPG Z490 Gaming Plus', 'Placa Madre', 'MSI', '159.99', 6, 'Placa madre con soporte para procesadores Intel de décima generación'),
(10, 'Gigabyte P650B 80 Plus Bronze', 'Fuente de Poder', 'Gigabyte', '75.50', 10, 'Fuente de poder certificada 80 Plus Bronze de 650W'),
(11, 'WD Blue 1TB', 'Almacenamiento', 'Western Digital', '50.00', 18, 'Disco duro de 1TB para almacenamiento masivo'),
(12, 'Intel Core i5-10400F', 'Procesador', 'Intel', '179.99', 9, 'Procesador de 6 núcleos y 12 hilos para gaming y productividad'),
(13, 'G.Skill Ripjaws V 16GB DDR4', 'Memoria RAM', 'G.Skill', '89.99', 7, 'Kit de memoria RAM DDR4 de 16GB para alto rendimiento'),
(14, 'Noctua NH-D15', 'Refrigeración', 'Noctua', '99.95', 3, 'Enfriador de CPU de alto rendimiento con doble ventilador'),
(15, 'Samsung 970 EVO Plus 500GB', 'Almacenamiento', 'Samsung', '99.99', 14, 'SSD NVMe de 500GB para velocidades de lectura/escritura ultra rápidas'),
(16, 'Asus TUF Gaming X570-Plus', 'Placa Madre', 'Asus', '189.99', 6, 'Placa madre con soporte para procesadores Ryzen de tercera generación'),
(17, 'Cooler Master Hyper 212', 'Refrigeración', 'Cooler Master', '34.99', 11, 'Enfriador de CPU asequible para entusiastas del PC'),
(18, 'Crucial MX500 1TB', 'Almacenamiento', 'Crucial', '89.99', 12, 'SSD de 1TB para almacenamiento de alto rendimiento'),
(19, 'Razer BlackWidow Elite', 'Teclado', 'Razer', '169.99', 5, 'Teclado mecánico para gaming con iluminación Chroma RGB'),
(20, 'Logitech G502 Hero', 'Mouse', 'Logitech', '49.99', 9, 'Mouse gaming con sensor de 16,000 DPI y pesos ajustables'),
(21, 'Thermaltake Smart 600W', 'Fuente de Poder', 'Thermaltake', '59.99', 13, 'Fuente de poder con certificación 80 Plus de 600W'),
(22, 'EVGA GeForce RTX 3070', 'Tarjeta Gráfica', 'EVGA', '499.99', 4, 'Tarjeta gráfica de gama alta con 8GB de VRAM'),
(23, 'AMD Ryzen 7 3700X', 'Procesador', 'AMD', '299.99', 7, 'Procesador de 8 núcleos y 16 hilos para gaming y productividad'),
(24, 'Asus ROG Strix Z490-E', 'Placa Madre', 'Asus', '229.99', 3, 'Placa madre con soporte para procesadores Intel de décima generación'),
(25, 'Gigabyte Aorus 650W', 'Fuente de Poder', 'Gigabyte', '79.99', 10, 'Fuente de poder certificada 80 Plus Bronze de 650W'),
(26, 'Seagate Barracuda 2TB', 'Almacenamiento', 'Seagate', '69.99', 16, 'Disco duro de 2TB para almacenamiento de grandes volúmenes de datos'),
(27, 'Corsair Vengeance LPX 32GB DDR4', 'Memoria RAM', 'Corsair', '149.99', 4, 'Kit de memoria RAM DDR4 de 32GB para alto rendimiento'),
(28, 'Asus ROG Strix RTX 3080', 'Tarjeta Gráfica', 'Asus', '799.99', 2, 'Tarjeta gráfica de gama ultra alta con 10GB de VRAM'),
(29, 'Intel Core i9-10900K', 'Procesador', 'Intel', '529.99', 3, 'Procesador de 10 núcleos para entusiastas y creadores de contenido'),
(30, 'MSI B550 Tomahawk', 'Placa Madre', 'MSI', '149.99', 6, 'Placa madre con soporte para procesadores Ryzen de tercera generación'),
(31, 'Antec NeoECO 650W', 'Fuente de Poder', 'Antec', '69.99', 8, 'Fuente de poder certificada 80 Plus Bronze de 650W'),
(32, 'Samsung 860 EVO 500GB', 'Almacenamiento', 'Samsung', '74.99', 15, 'SSD SATA de 500GB con gran relación calidad-precio'),
(33, 'HyperX Alloy FPS Pro', 'Teclado', 'HyperX', '89.99', 7, 'Teclado mecánico compacto para gaming profesional'),
(34, 'NZXT Kraken X63', 'Refrigeración', 'NZXT', '149.99', 4, 'Enfriador líquido AIO con soporte RGB para CPU'),
(35, 'WD Black SN750 1TB', 'Almacenamiento', 'Western Digital', '129.99', 5, 'SSD NVMe de 1TB para entusiastas del PC'),
(36, 'Logitech MX Master 3', 'Mouse', 'Logitech', '99.99', 6, 'Mouse ergonómico para productividad y gaming ligero'),
(37, 'Corsair RM750x 750W', 'Fuente de Poder', 'Corsair', '124.99', 9, 'Fuente de poder certificada 80 Plus Gold de 750W'),
(38, 'Crucial Ballistix 16GB DDR4', 'Memoria RAM', 'Crucial', '79.99', 10, 'Kit de memoria RAM DDR4 de 16GB para gaming y multitarea'),
(39, 'Asus ROG Swift PG279Q', 'Monitor', 'Asus', '599.99', 3, 'Monitor gaming de 27 pulgadas con resolución WQHD y 165Hz'),
(40, 'MSI MPG Sekira 500X', 'Gabinete', 'MSI', '159.99', 2, 'Gabinete ATX con iluminación RGB y soporte para refrigeración líquida');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
