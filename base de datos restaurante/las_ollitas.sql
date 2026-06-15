-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-06-2026 a las 22:16:19
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `las_ollitas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloqueos_ip`
--

CREATE TABLE `bloqueos_ip` (
  `id` int(11) NOT NULL,
  `ip` varchar(45) NOT NULL,
  `intentos` int(11) DEFAULT 0,
  `bloqueado_hasta` datetime DEFAULT NULL,
  `tiempo_bloqueo` int(11) DEFAULT 5
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `activo`) VALUES
(1, 'sopas', 1),
(3, 'segundos', 1),
(4, 'bebidas', 1),
(5, 'platos especiales', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id_config` int(11) NOT NULL,
  `nombre_restaurante` varchar(100) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `horario` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id_config`, `nombre_restaurante`, `direccion`, `telefono`, `horario`, `email`) VALUES
(1, 'Las Ollitas', 'La Paz - Bolivia', '77777777', '08:00 AM - 10:00 PM', 'lasollitas@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galeria`
--

CREATE TABLE `galeria` (
  `id` int(11) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `fecha_subida` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `galeria`
--

INSERT INTO `galeria` (`id`, `imagen`, `titulo`, `fecha_subida`) VALUES
(1, 'ollitas.jpg', NULL, NULL),
(5, 'entrada.png', NULL, NULL),
(6, 'salon.png', NULL, NULL),
(7, 'salon2.png', NULL, NULL),
(8, 'salon3.png', NULL, NULL),
(9, 'salon4.png', NULL, NULL),
(10, 'bebidas.png', NULL, NULL),
(11, 'baño.png', NULL, NULL),
(12, 'cocina.png', NULL, NULL),
(13, 'milanesa_pollo.jpg', 'milanesa de pollo', '2026-06-02 17:00:22'),
(15, 'MILANESA NAPOLITANA.jpg', 'milanesa de pollo napolitana', '2026-06-02 17:37:28'),
(17, 'chicharron de pollo.jpg', 'chicharron de pollo', '2026-06-10 10:56:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `asunto` varchar(150) DEFAULT NULL,
  `mensaje` text DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id`, `nombre`, `correo`, `asunto`, `mensaje`, `fecha`) VALUES
(1, 'jorge', 'yorch@gmail.com', NULL, 'muy buena la comida', '2026-05-18 21:58:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platos`
--

CREATE TABLE `platos` (
  `id` int(11) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `platos`
--

INSERT INTO `platos` (`id`, `categoria_id`, `nombre`, `descripcion`, `precio`, `imagen`) VALUES
(1, 5, 'chairo (FINES DE SEMANA)', 'sopa de charque, chuño, mote, papa y verduras', 12.00, 'chairo.jpg'),
(2, 4, 'JARRA MOCOCHINCHI', 'MOCOCHINCHI', 10.00, 'JARRAMOCOCHINCHI.jpg'),
(3, 3, 'sajta (ALMUERZO)', 'pollo, tunta, papa y sarza', 15.00, 'sajta.jpg'),
(4, 5, 'pique macho (fin de semana)', 'papa frita, carne, chorizo, salchicha, queso, huevo, tomate, cebolla locoto en rodajas(opcional)  ', 35.00, 'pique macho.jpg'),
(5, 4, 'JARRA DE LIMON', 'LIMONADA', 10.00, 'LIMONADAJARRA.jpg'),
(6, 4, 'COCACOLA', 'COCA PERSONAL', 2.50, 'COCACOLAPERSONAL.jpg'),
(7, 4, 'COCACOLA', 'COCA COLA DE 500ML.', 5.00, 'COCACOLA500.jpg'),
(8, 4, 'COCACOLA', 'COCA COLA DE 1.5 LITROS', 12.00, 'COCACOLA1.5LITROS.jpg'),
(9, 4, 'COCA COLA', 'COCA COLA DE 2 LITROS', 15.00, 'COCACOLA 2LITROS.jpg'),
(10, 4, 'FANTA', 'FANATA PERSONAL', 2.50, 'FANTAPERSONAL.jpg'),
(11, 4, 'FANTA', 'FANTA 500CC.', 5.00, 'FANTA500CC.jpg'),
(12, 4, 'FANTA', 'FANTA 1.5 LITROS', 12.00, 'FANTA1.5LITROS.jpg'),
(13, 4, 'FANTA GUARANA', 'FANTA 2 LITROS', 15.00, 'FANTA2LITROS.jpg'),
(14, 4, 'FRUTALL', 'FRUTAL PERSONAL ', 4.00, 'FRUTALLPERSONAL.jpg'),
(15, 4, 'FRUTALL', 'FRUTALL 1 LITRO', 15.00, 'FRUTALLLITRO.jpg'),
(16, 4, 'SPRITE', 'SPRITE PERSONAL', 2.50, 'SPRITEPERSONAL.jpg'),
(17, 4, 'SPRITE', 'SPRITE 500ML.', 5.00, 'SPRITE500CC..jpg'),
(18, 4, 'SPRITE', 'SPRITE 1.5 LITROS', 12.00, 'SPRITE1.5LITROS.jpg'),
(19, 5, 'MANI (FINES DE SEMANA)', 'SOPA DE MACARRONES CON MANI Y COSTILLAS', 12.00, 'SOPAMANI.jpg'),
(20, 3, 'FALSO CONEJO (ALMUERZO)', 'GUISO CON CARNE APANADA, FIDEO Y PAPA', 16.00, 'FALSOCONEJO.jpg'),
(21, 1, 'SOPA DE TRIGO (ALMUERZO)', 'SOPA CON TRIGO Y VERDURAS(SOLO SOPA)', 8.00, 'SOPATRIGO.jpg'),
(22, 1, 'SOPA DE ARROZ (ALMUERZO)', 'SOPA DE ARROZ CON VERDURA Y COSTILLA DE RES(SOLO SOPA)', 8.00, 'SOPA ARROZ.jpg'),
(23, 5, 'CHICHARRON DE CERDO (fines de semana)', 'CERDO, MOTE, CHUÑO, PAPA ', 30.00, 'CHICHARRONCERDO.jpg'),
(24, 5, 'LECHON (fines de semana)', 'CHANCHO, PAPA, CAMOTE POSTRE(AL HORNO) Y ENSALADA DE LECHUGA', 30.00, 'LECHONALHORNO.jpg'),
(30, 5, 'milanesa de pollo napolitana (fines de semana)', 'arroz, papa frita, ensalada, apanado de pollo con jamón y queso', 20.00, 'MILANESA NAPOLITANA.jpg'),
(32, 3, 'chicharron de pollo', 'pollo, papa y mote', 15.00, 'chicharron de pollo.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE `promociones` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `promociones`
--

INSERT INTO `promociones` (`id`, `titulo`, `descripcion`, `fecha_inicio`, `fecha_fin`, `imagen`) VALUES
(1, 'platos especiales fines de semana ', 'TRES PLATOS ESPECIALES Y COCA COLA GRATIS POR 90 BS', '2026-06-10', '2026-06-12', 'promocion.jpg'),
(2, 'CARNES A LA PARRILLA', 'VARIEDAD ALMUERZOS A LA PARRILLA (POLLO, CARNE, CHORIZO).', '2026-05-22', '2026-05-31', 'PARRILLA.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `personas` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `estado` varchar(30) DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `nombre`, `telefono`, `personas`, `fecha`, `hora`, `estado`) VALUES
(1, 'eddy maldonado', '73083208', 4, '2026-05-20', '13:00:00', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `intentos` int(11) DEFAULT 0,
  `bloqueado_hasta` datetime DEFAULT NULL,
  `tiempo_bloqueo` int(11) DEFAULT 5
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`, `token`, `intentos`, `bloqueado_hasta`, `tiempo_bloqueo`) VALUES
(1, 'eddy', '$2y$10$a.J/miTHn0iyg3N/xELFleZ1rNdHvHZZ8E4hri9gHqsJ.xxshU/FG', 'cea7b4d8e535ff0637736c2ed75831b9', 0, NULL, 5),
(2, 'erberto', '$2y$10$hEXZvwOZ4vrDxjKuZX6p6..oQhwSDCZRGaFUmESSHHZPRCvr0xwJG', '99a4f339301b526faac1d3d115d0ed78', 0, NULL, 5),
(3, 'rocio', '$2y$10$WlGvHljNEK0nCznNi8cTduEx92EvMeQs276T4N5R3U2sUgNW/.OHy', '36ca119a1d685762116268a2a1447d44', 0, NULL, 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bloqueos_ip`
--
ALTER TABLE `bloqueos_ip`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id_config`);

--
-- Indices de la tabla `galeria`
--
ALTER TABLE `galeria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `platos`
--
ALTER TABLE `platos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bloqueos_ip`
--
ALTER TABLE `bloqueos_ip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id_config` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `galeria`
--
ALTER TABLE `galeria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `platos`
--
ALTER TABLE `platos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `promociones`
--
ALTER TABLE `promociones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `platos`
--
ALTER TABLE `platos`
  ADD CONSTRAINT `platos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
