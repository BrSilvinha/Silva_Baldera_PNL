-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-10-2024 a las 15:42:05
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
-- Base de datos: `denuncias_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `denuncias`
--

CREATE TABLE `denuncias` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `ubicacion` varchar(150) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `ciudadano` varchar(100) NOT NULL,
  `telefono_ciudadano` varchar(15) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `denuncias`
--

INSERT INTO `denuncias` (`id`, `titulo`, `descripcion`, `ubicacion`, `estado`, `ciudadano`, `telefono_ciudadano`, `fecha_registro`) VALUES
(1, 'Bache en calle principal', 'Un bache grande en la intersección de la avenida principal con la calle 5.', 'Calle Lora y Cordero 33', 'Pendiente', 'Juan Pérez', '555-1234', '2024-10-10 05:00:00'),
(2, 'Recolección de basura retrasada', 'La recolección de basura en mi zona no se ha hecho desde hace una semana.', 'Calle Junin 1045', 'En proceso', 'María López', '555-5678', '2024-10-11 05:00:00'),
(3, 'Árbol caído en parque', 'Un árbol se ha caído en el parque central y bloquea el paso.', 'Calle Balta 514', 'Resuelto', 'Pedro Sánchez', '555-8765', '2024-10-12 05:00:00'),
(4, 'Luminaria rota', 'La farola de la esquina está rota y la calle está muy oscura.', 'Calle Arica 113', 'Pendiente', 'Ana Torres', '555-4321', '2024-10-12 05:00:00'),
(5, 'Basura acumulada en parque', 'Hay basura acumulada cerca de los juegos infantiles en el parque San Martín.', 'Calle Leoncio Prado 172', 'En proceso', 'Carlos Gómez', '555-0000', '2024-10-13 05:00:00'),
(6, 'Desperfecto en semáforo', 'El semáforo de la avenida principal está en rojo permanentemente, causando confusión.', 'Avenida Principal y Calle 3', 'Pendiente', 'Lucía Martínez', '555-1357', '2024-10-14 05:00:00'),
(7, 'Fugas de agua', 'Hay una fuga de agua en la calle que está causando inundaciones en la acera.', 'Calle de la Esperanza 87', 'En proceso', 'Javier Ruiz', '555-2468', '2024-10-15 05:00:00'),
(8, 'Invasión de terrenos públicos', 'Un grupo de personas ha comenzado a construir en un terreno público cerca de mi casa.', 'Calle Libertad 230', 'Pendiente', 'Estefanía Quispe', '555-3690', '2024-10-16 05:00:00'),
(9, 'Caminos intransitables', 'Los caminos de tierra en el barrio están llenos de piedras y son difíciles de transitar.', 'Barrio Los Olivos', 'Resuelto', 'Fernando Castro', '555-2589', '2024-10-17 05:00:00'),
(10, 'Mascotas abandonadas', 'Hay varias mascotas abandonadas en la calle, se necesita ayuda para rescatarlas.', 'Calle Los Ángeles 315', 'En proceso', 'Sara Velasco', '555-6543', '2024-10-18 05:00:00'),
(11, 'Falta de señalización', 'No hay señales de tránsito en la nueva intersección, lo que está causando accidentes.', 'Calle Nueva y Avenida 2', 'Pendiente', 'Raúl Mendoza', '555-7890', '2024-10-19 05:00:00'),
(19, 'sfsdfs', 'dfsdfs', 'sdfsdf', 'En proceso', 'werwer', '234234', '2024-10-30 14:38:28');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `denuncias`
--
ALTER TABLE `denuncias`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `denuncias`
--
ALTER TABLE `denuncias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
