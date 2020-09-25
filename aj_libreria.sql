SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: `aj_libreria`
--

CREATE DATABASE aj_libreria;
USE aj_libreria;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_autor`
--

CREATE TABLE `tbl_autor` (
  `aut_id` int(11) NOT NULL,
  `aut_nombres` varchar(30) NOT NULL,
  `aut_apellidos` varchar(30) DEFAULT NULL,
  `aut_estado_registro` tinyint(1) NOT NULL,
  `aut_fhr` datetime DEFAULT NULL,
  `aut_fhm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_autor`
--

INSERT INTO `tbl_autor` (`aut_id`, `aut_nombres`, `aut_apellidos`, `aut_estado_registro`, `aut_fhr`, `aut_fhm`) VALUES
(1, 'Zsuzsa', 'Bánk', 1, '2020-09-20 16:21:54', '2020-09-21 03:27:44'),
(2, 'Paulo', 'Coelho', 1, '2020-09-20 16:22:09', '2020-09-21 03:35:23'),
(3, 'Gabriela', 'Mistral', 1, '2020-09-20 16:22:23', '2020-09-21 03:46:07'),
(4, 'Pablo', 'Neruda', 1, '2020-09-20 16:22:39', '2020-09-21 03:46:26'),
(5, 'Ramón', 'Andrés', 1, '2020-09-21 03:22:00', '2020-09-21 03:28:48'),
(7, 'Joseph', 'Roth', 1, '2020-09-21 03:29:24', '2020-09-21 03:29:24'),
(8, 'Gabriel', 'García Márquez', 1, '2020-09-21 03:31:45', '2020-09-21 03:31:45'),
(9, 'Julio', 'Verne', 1, '2020-09-21 03:41:36', '2020-09-21 03:41:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_autor_libro`
--

CREATE TABLE `tbl_autor_libro` (
  `aul_id` int(11) NOT NULL,
  `aul_aut_id` int(11) NOT NULL,
  `aul_lib_id` int(11) NOT NULL,
  `aul_estado_registro` tinyint(1) NOT NULL,
  `aul_fhr` datetime DEFAULT NULL,
  `aul_fhm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_autor_libro`
--

INSERT INTO `tbl_autor_libro` (`aul_id`, `aul_aut_id`, `aul_lib_id`, `aul_estado_registro`, `aul_fhr`, `aul_fhm`) VALUES
(3, 1, 2, 0, '2020-09-20 16:23:37', '2020-09-21 05:09:24'),
(18, 4, 1, 1, '2020-09-20 23:23:13', '2020-09-21 03:49:39'),
(19, 1, 1, 1, '2020-09-20 23:38:29', '2020-09-21 03:51:30'),
(20, 2, 1, 1, '2020-09-20 23:38:29', '2020-09-21 03:51:30'),
(21, 3, 1, 1, '2020-09-20 23:38:29', '2020-09-21 03:51:30'),
(22, 1, 5, 1, '2020-09-21 03:28:06', '2020-09-21 03:51:30'),
(23, 7, 7, 1, '2020-09-21 03:30:22', '2020-09-21 03:51:30'),
(24, 5, 6, 1, '2020-09-21 03:30:57', '2020-09-21 03:51:30'),
(25, 8, 2, 1, '2020-09-21 03:34:08', '2020-09-21 05:09:24'),
(26, 2, 4, 1, '2020-09-21 03:37:57', '2020-09-21 03:51:30'),
(27, 9, 8, 1, '2020-09-21 03:42:29', '2020-09-21 03:51:30'),
(28, 9, 9, 1, '2020-09-21 03:45:13', '2020-09-21 03:51:30'),
(29, 3, 10, 1, '2020-09-21 03:48:33', '2020-09-21 03:51:30'),
(30, 4, 11, 1, '2020-09-21 03:50:47', '2020-09-21 03:51:30'),
(31, 1, 12, 1, '2020-09-21 05:09:57', '2020-09-21 05:09:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_configuracion`
--

CREATE TABLE `tbl_configuracion` (
  `con_id` int(11) NOT NULL,
  `con_nombre` varchar(30) NOT NULL,
  `con_descripcion` varchar(100) DEFAULT NULL,
  `con_valor_texto` longtext DEFAULT NULL,
  `con_valor_numerico` decimal(19,4) DEFAULT NULL,
  `con_estado_registro` tinyint(1) NOT NULL,
  `con_fhr` datetime DEFAULT NULL,
  `con_fhm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_configuracion`
--

INSERT INTO `tbl_configuracion` (`con_id`, `con_nombre`, `con_descripcion`, `con_valor_texto`, `con_valor_numerico`, `con_estado_registro`, `con_fhr`, `con_fhm`) VALUES
(3, 'DESCUENTO-IND', NULL, 'Gabriela Mistral', '50.0000', 1, '2020-09-22 17:45:31', '2020-09-22 22:56:55'),
(6, 'DESCUENTO', NULL, NULL, '0.0000', 1, '2020-09-22 22:50:18', '2020-09-22 22:59:18'),
(7, 'ADICIONAL', NULL, NULL, '0.0000', 1, '2020-09-22 22:50:18', '2020-09-22 22:59:18'),
(8, 'DESCUENTO-IND', NULL, 'Zsuzsa Bánk', '10.0000', 1, '2020-09-22 22:54:13', '2020-09-22 22:54:13'),
(13, 'DESCUENTO-IND', NULL, 'Paulo Coelho', '10.0000', 1, '2020-09-22 22:59:18', '2020-09-22 22:59:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_editorial`
--

CREATE TABLE `tbl_editorial` (
  `edi_id` int(11) NOT NULL,
  `edi_nombre` varchar(50) NOT NULL,
  `edi_estado_registro` tinyint(1) NOT NULL,
  `edi_fhr` datetime DEFAULT NULL,
  `edi_fhm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_editorial`
--

INSERT INTO `tbl_editorial` (`edi_id`, `edi_nombre`, `edi_estado_registro`, `edi_fhr`, `edi_fhm`) VALUES
(1, 'Aguilar', 1, '2020-09-09 18:23:40', '2020-09-13 04:41:39'),
(2, 'Akal', 1, '2020-09-09 18:46:03', '2020-09-09 23:04:32'),
(6, 'Acantilado', 1, '2020-09-09 18:04:13', '2020-09-13 04:40:16'),
(7, 'Alba', 1, '2020-09-09 18:05:39', '2020-09-09 23:05:39'),
(8, 'Alfaguara', 1, '2020-09-09 23:06:25', '2020-09-09 23:06:25'),
(9, 'Alianza', 1, '2020-09-09 23:06:33', '2020-09-09 23:06:33'),
(10, 'Almadía', 1, '2020-09-09 23:06:41', '2020-09-09 23:06:41'),
(11, 'Anagrama', 1, '2020-09-09 23:06:48', '2020-09-09 23:06:48'),
(12, 'Alpha Decay', 1, '2020-09-09 23:06:55', '2020-09-09 23:06:55'),
(13, 'Ariel', 1, '2020-09-09 23:07:02', '2020-09-09 23:07:02'),
(14, 'Atalanta', 1, '2020-09-09 23:07:08', '2020-09-09 23:07:08'),
(15, 'Caja Negra', 1, '2020-09-09 23:07:15', '2020-09-09 23:07:15'),
(16, 'Cátedra', 1, '2020-09-09 23:07:37', '2020-09-09 23:07:37'),
(17, 'Crítica', 1, '2020-09-09 23:07:42', '2020-09-09 23:07:42'),
(18, 'Debolsillo', 1, '2020-09-09 23:07:48', '2020-09-09 23:07:48'),
(19, 'Fondo de Cultura Económica', 1, '2020-09-09 23:07:58', '2020-09-09 23:07:58'),
(20, 'Galaxia Gutenberg', 1, '2020-09-09 23:08:03', '2020-09-09 23:08:03'),
(21, 'Gallo Nero', 1, '2020-09-09 23:08:08', '2020-09-09 23:08:08'),
(22, 'Gredos', 1, '2020-09-09 23:08:14', '2020-09-09 23:08:14'),
(23, 'Gustavo Gili', 1, '2020-09-09 23:08:19', '2020-09-09 23:08:19'),
(24, 'Herder', 1, '2020-09-09 23:08:24', '2020-09-09 23:08:24'),
(25, 'Impedimenta', 1, '2020-09-09 23:08:31', '2020-09-09 23:08:31'),
(26, 'Joaquín Mortiz', 1, '2020-09-09 23:08:37', '2020-09-09 23:08:37'),
(27, 'La esfera de los libros', 1, '2020-09-09 23:08:43', '2020-09-09 23:08:43'),
(28, 'Library of America', 1, '2020-09-09 23:08:52', '2020-09-09 23:08:52'),
(29, 'Lumen', 1, '2020-09-09 23:08:57', '2020-09-09 23:08:57'),
(30, 'Nevsky', 1, '2020-09-09 23:09:03', '2020-09-09 23:09:03'),
(31, 'Olañeta', 1, '2020-09-09 23:09:08', '2020-09-09 23:09:08'),
(32, 'Paidós', 1, '2020-09-09 23:09:12', '2020-09-09 23:09:12'),
(33, 'Penguin Books', 1, '2020-09-09 23:09:18', '2020-09-09 23:09:18'),
(34, 'Phaidon', 1, '2020-09-09 23:09:24', '2020-09-09 23:09:24'),
(35, 'Planeta', 1, '2020-09-09 23:09:30', '2020-09-09 23:09:30'),
(36, 'Plaza y Janés', 1, '2020-09-09 23:09:37', '2020-09-09 23:09:37'),
(37, 'RM', 1, '2020-09-09 23:09:41', '2020-09-09 23:09:41'),
(38, 'Sajalín', 1, '2020-09-09 23:09:47', '2020-09-09 23:09:47'),
(39, 'Salamandra', 1, '2020-09-09 23:09:52', '2020-09-09 23:09:52'),
(40, 'Satori', 1, '2020-09-09 23:09:58', '2020-09-09 23:09:58'),
(41, 'Seix Barral', 1, '2020-09-09 23:10:03', '2020-09-09 23:10:03'),
(42, 'Sexto Piso', 1, '2020-09-09 23:10:08', '2020-09-09 23:10:08'),
(43, 'Siglo XXI', 1, '2020-09-09 23:10:13', '2020-09-09 23:10:13'),
(44, 'Siruela', 1, '2020-09-09 23:10:17', '2020-09-09 23:10:17'),
(45, 'Taschen', 1, '2020-09-09 23:10:22', '2020-09-09 23:10:22'),
(46, 'Taurus', 1, '2020-09-09 23:10:29', '2020-09-09 23:10:29'),
(47, 'Trotta', 1, '2020-09-09 23:10:33', '2020-09-09 23:10:33'),
(48, 'Tusquets', 1, '2020-09-09 23:10:39', '2020-09-09 23:10:39'),
(49, 'Urano', 1, '2020-09-09 23:10:44', '2020-09-09 23:10:44'),
(50, 'Valdemar', 1, '2020-09-09 23:10:49', '2020-09-09 23:10:49'),
(51, 'HarperCollins', 1, '2020-09-09 23:12:22', '2020-09-09 23:12:22'),
(52, 'Grijalbo', 1, '2020-09-09 23:12:49', '2020-09-09 23:12:49'),
(53, 'Sudamericana', 1, '2020-09-09 23:13:11', '2020-09-09 23:13:11'),
(54, 'Hetzel', 1, '2020-09-21 03:40:58', '2020-09-21 03:40:58'),
(55, 'Instituto de las Españas', 1, '2020-09-21 03:49:10', '2020-09-21 03:49:10'),
(56, 'Nascimento', 1, '2020-09-21 03:51:04', '2020-09-21 03:51:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_libro`
--

CREATE TABLE `tbl_libro` (
  `lib_id` int(11) NOT NULL,
  `lib_isbn` varchar(20) NOT NULL,
  `lib_titulo` varchar(100) NOT NULL,
  `lib_anio_publicacion` char(5) NOT NULL,
  `lib_precio` decimal(19,4) DEFAULT NULL,
  `lib_edi_id` int(11) NOT NULL,
  `lib_estado_registro` tinyint(1) NOT NULL,
  `lib_fhr` datetime DEFAULT NULL,
  `lib_fhm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_libro`
--

INSERT INTO `tbl_libro` (`lib_id`, `lib_isbn`, `lib_titulo`, `lib_anio_publicacion`, `lib_precio`, `lib_edi_id`, `lib_estado_registro`, `lib_fhr`, `lib_fhm`) VALUES
(1, '978-84-03-51937-4', 'La felicidad en el trabajo', '2020', NULL, 1, 1, '2020-09-12 19:54:24', '2020-09-13 04:16:31'),
(2, '978-14-81518-45-1', 'Cien años de soledad', '2015', NULL, 53, 1, '2020-09-12 19:24:47', '2020-09-21 03:34:47'),
(4, '958-614-618-9', 'El alquimista', '1988', '15.0000', 35, 1, '2020-09-13 03:51:59', '2020-09-21 03:37:56'),
(5, '978-84-17902-44-5', 'Los días luminosos', '2020', NULL, 6, 1, '2020-09-20 21:58:50', '2020-09-21 03:27:18'),
(6, '978-84-17902-39-1', 'Filosofía y consuelo de la música', '2020', NULL, 6, 1, '2020-09-20 22:12:37', '2020-09-21 03:30:57'),
(7, '978-84-17346-71-3', 'Años de hotel Postales de la Europa de entreguerras', '2020', NULL, 6, 1, '2020-09-20 22:13:27', '2020-09-21 03:30:22'),
(8, '978-1511727617', 'Viaje al centro de la Tierra', '1864', NULL, 54, 1, '2020-09-21 03:42:29', '2020-09-21 03:42:29'),
(9, '9788477480105', 'Veinte mil leguas de viaje submarino', '1869', NULL, 54, 1, '2020-09-21 03:45:12', '2020-09-21 03:45:12'),
(10, '9788423910021', 'Desolación', '1922', '20.0000', 55, 1, '2020-09-21 03:48:33', '2020-09-21 05:10:48'),
(11, '9788437624662', 'Veinte poemas de amor y una canción desesperada', '1924', NULL, 56, 1, '2020-09-21 03:50:47', '2020-09-21 03:51:30'),
(12, '5216564', 'TEST', '2020', NULL, 12, 1, '2020-09-21 05:09:57', '2020-09-21 05:09:57');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_autor`
--
ALTER TABLE `tbl_autor`
  ADD PRIMARY KEY (`aut_id`);

--
-- Indices de la tabla `tbl_autor_libro`
--
ALTER TABLE `tbl_autor_libro`
  ADD PRIMARY KEY (`aul_id`),
  ADD KEY `fk_autor_libro_autor` (`aul_aut_id`),
  ADD KEY `fk_autor_libro_libro` (`aul_lib_id`);

--
-- Indices de la tabla `tbl_configuracion`
--
ALTER TABLE `tbl_configuracion`
  ADD PRIMARY KEY (`con_id`);

--
-- Indices de la tabla `tbl_editorial`
--
ALTER TABLE `tbl_editorial`
  ADD PRIMARY KEY (`edi_id`);

--
-- Indices de la tabla `tbl_libro`
--
ALTER TABLE `tbl_libro`
  ADD PRIMARY KEY (`lib_id`),
  ADD KEY `fk_libro_editorial` (`lib_edi_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_autor`
--
ALTER TABLE `tbl_autor`
  MODIFY `aut_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tbl_autor_libro`
--
ALTER TABLE `tbl_autor_libro`
  MODIFY `aul_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `tbl_configuracion`
--
ALTER TABLE `tbl_configuracion`
  MODIFY `con_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tbl_editorial`
--
ALTER TABLE `tbl_editorial`
  MODIFY `edi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `tbl_libro`
--
ALTER TABLE `tbl_libro`
  MODIFY `lib_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_autor_libro`
--
ALTER TABLE `tbl_autor_libro`
  ADD CONSTRAINT `fk_autor_libro_autor` FOREIGN KEY (`aul_aut_id`) REFERENCES `tbl_autor` (`aut_id`),
  ADD CONSTRAINT `fk_autor_libro_libro` FOREIGN KEY (`aul_lib_id`) REFERENCES `tbl_libro` (`lib_id`);

--
-- Filtros para la tabla `tbl_libro`
--
ALTER TABLE `tbl_libro`
  ADD CONSTRAINT `fk_libro_editorial` FOREIGN KEY (`lib_edi_id`) REFERENCES `tbl_editorial` (`edi_id`);
COMMIT;
