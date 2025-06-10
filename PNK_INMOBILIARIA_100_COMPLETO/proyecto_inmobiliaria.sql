-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-06-2025 a las 04:13:09
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
-- Base de datos: `proyecto_inmobiliaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_propiedad`
--

CREATE TABLE `imagenes_propiedad` (
  `id_imagen` int(11) NOT NULL,
  `id_propiedad` int(11) NOT NULL,
  `ruta_imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedades`
--

CREATE TABLE `propiedades` (
  `id_propiedad` int(11) NOT NULL,
  `tipo_propiedad` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `banos` int(11) NOT NULL,
  `dormitorios` int(11) NOT NULL,
  `area_total` decimal(10,2) NOT NULL,
  `area_construida` decimal(10,2) NOT NULL,
  `precio_clp` int(11) NOT NULL,
  `precio_uf` decimal(10,2) NOT NULL,
  `fecha_publicacion` date NOT NULL,
  `solicita_visita` tinyint(1) NOT NULL,
  `bodega` tinyint(1) NOT NULL,
  `estacionamiento` int(11) NOT NULL,
  `logia` int(11) NOT NULL,
  `cocina_amoblada` int(11) NOT NULL,
  `antejardin` int(11) NOT NULL,
  `patio_trasero` int(11) NOT NULL,
  `piscina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `rut` varchar(12) NOT NULL,
  `nombre_completo` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `correo` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `sexo` enum('Masculino','Femenino','Otro') NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `archivo_certificado` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `imagenes_propiedad`
--
ALTER TABLE `imagenes_propiedad`
  ADD PRIMARY KEY (`id_imagen`),
  ADD KEY `id_propiedad` (`id_propiedad`);

--
-- Indices de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD PRIMARY KEY (`id_propiedad`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `imagenes_propiedad`
--
ALTER TABLE `imagenes_propiedad`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  MODIFY `id_propiedad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `imagenes_propiedad`
--
ALTER TABLE `imagenes_propiedad`
  ADD CONSTRAINT `imagenes_propiedad_ibfk_1` FOREIGN KEY (`id_propiedad`) REFERENCES `propiedades` (`id_propiedad`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- Insertar usuario administrador
INSERT INTO usuarios (rut, nombre_completo, fecha_nacimiento, correo, password, sexo, telefono, archivo_certificado)
VALUES ('11111111-1', 'Administrador', '1990-01-01', 'admin@example.com', '$2b$12$XmPtSPutz4Lm/fWV2a23ouV0ozFBSZ3hkqqc4LMzDek1vqBRFIXh2', 'Masculino', '912345678', 'certificado_admin.pdf');