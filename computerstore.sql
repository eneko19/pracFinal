-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 18-02-2018 a las 22:52:52
-- Versión del servidor: 5.7.19
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `computerstore`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `brand`
--

DROP TABLE IF EXISTS `brand`;
CREATE TABLE IF NOT EXISTS `brand` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(32) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `brand`
--

INSERT INTO `brand` (`ID`, `NAME`) VALUES
(1, 'Samsung'),
(2, 'Asus'),
(3, 'Acer'),
(4, 'Logitech'),
(5, 'Tacens Mars'),
(6, 'HP'),
(7, 'Razer'),
(8, 'MSI'),
(9, 'Intel'),
(10, 'AMD'),
(11, 'Sapphire'),
(12, 'Gigabyte'),
(13, 'Zotac'),
(14, 'Crucial'),
(15, 'Kingston'),
(16, 'G.Skill'),
(17, 'Corsair'),
(18, 'Lenovo'),
(19, 'Medion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(32) NOT NULL,
  `PARENTCATEGORY` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `PARENTCATEGORY` (`PARENTCATEGORY`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`ID`, `NAME`, `PARENTCATEGORY`) VALUES
(1, 'Componentes', NULL),
(2, 'Perifericos', NULL),
(3, 'Procesadores', 1),
(4, 'Gráficas', 1),
(5, 'MemoriaRAM', 1),
(10, 'Monitores', 2),
(14, 'Teclado', 2),
(15, 'Ratones', 2),
(16, 'Placas Base', 1),
(17, 'Ordenadores', NULL),
(18, 'Portatiles', 17),
(19, 'PCSobremesa', 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `URL` varchar(256) NOT NULL,
  `PRODUCT` int(11) NOT NULL,
  PRIMARY KEY (`URL`,`PRODUCT`),
  KEY `PRODUCT` (`PRODUCT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `image`
--

INSERT INTO `image` (`URL`, `PRODUCT`) VALUES
('img/intel-i5-6600k-3-5ghz.jpg', 5),
('img/ryzen7-wof-3d-rt-facing.jpg', 7),
('img/MSI-GeForce-GTX-1050Ti-4GB.jpg', 9),
('img/g-skill-ripjaws.jpg', 12),
('img/asus.jpg', 14),
('img/msi-clutch-gm60.jpg', 18),
('img/UX310UA-FC488T.jpg', 19),
('img/pcde.jpg', 36);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `PAYMENTINFO` enum('PAID','PENDING','REJECTED') NOT NULL DEFAULT 'PENDING',
  `STATUS` enum('RECEIVED','PROCESSING','SHIPPED','ONDELIVERY','DELIVERED','CANCELED','RETURNED') NOT NULL DEFAULT 'RECEIVED',
  `SHIPPINGADDRESS` varchar(256) NOT NULL,
  `USER` varchar(32) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `USER` (`USER`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `order`
--

INSERT INTO `order` (`ID`, `DATE`, `PAYMENTINFO`, `STATUS`, `SHIPPINGADDRESS`, `USER`) VALUES
(98, '2018-02-18 21:16:01', 'PAID', 'RECEIVED', '', 'user'),
(100, '2018-02-18 23:43:52', 'PAID', 'RECEIVED', '', 'user'),
(101, '2018-02-18 23:49:02', 'PAID', 'RECEIVED', '', 'user'),
(102, '2018-02-18 23:50:49', 'PENDING', 'RECEIVED', '', 'user');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orderitem`
--

DROP TABLE IF EXISTS `orderitem`;
CREATE TABLE IF NOT EXISTS `orderitem` (
  `ORDERLINE` int(11) NOT NULL,
  `ORDER` int(11) NOT NULL,
  `PRODUCT` int(11) NOT NULL,
  `QUANTITY` int(11) NOT NULL DEFAULT '1',
  `PRICE` decimal(6,2) NOT NULL,
  PRIMARY KEY (`ORDERLINE`,`ORDER`),
  KEY `ORDER` (`ORDER`),
  KEY `PRODUCT` (`PRODUCT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `orderitem`
--

INSERT INTO `orderitem` (`ORDERLINE`, `ORDER`, `PRODUCT`, `QUANTITY`, `PRICE`) VALUES
(1, 98, 5, 1, '156.00'),
(1, 100, 7, 1, '269.00'),
(1, 101, 7, 1, '269.00'),
(1, 102, 9, 1, '184.00'),
(2, 98, 7, 1, '269.00'),
(2, 101, 9, 1, '184.00'),
(3, 101, 12, 1, '210.00'),
(4, 102, 12, 1, '210.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(50) NOT NULL,
  `STOCK` int(11) DEFAULT '0',
  `PRICE` decimal(6,2) NOT NULL,
  `SPONSORED` enum('Y','N') DEFAULT 'N',
  `SHORTDESCRIPTION` varchar(128) DEFAULT NULL,
  `LONGDESCRIPTION` varchar(1024) DEFAULT NULL,
  `BRAND` int(11) NOT NULL,
  `CATEGORY` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `BRAND` (`BRAND`),
  KEY `CATEGORY` (`CATEGORY`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`ID`, `NAME`, `STOCK`, `PRICE`, `SPONSORED`, `SHORTDESCRIPTION`, `LONGDESCRIPTION`, `BRAND`, `CATEGORY`) VALUES
(1, 'MSI B250M Bazooka', 2, '73.00', 'N', 'CABEZALES DE VENTILACIÓN COMPLETAMENTE CONTROLABLEShhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh', 'Las placas base MSI te permiten administrar velocidades y temperaturas para todos los ventiladores de tu sistema y CPU, dándote un control total para configurar un sistema fresco y silencioso. Los cabezales del ventilador se colocan convenientemente con los disipadores de CPU más populares del mercado.', 8, 16),
(2, 'Gigabyte GA-Z270-HD3P', 5, '115.00', 'N', 'Te presentamos la Gigabyte Z270-HD3P, una placa base con Socket Intel 1151 y chipset Z270.', 'Compatible con procesadores de 7ª y 6ª Generación Intel® Core™\r\n\r\n', 12, 16),
(3, 'Gigabyte GA-AB350-GAMING 3', 3, '105.00', 'N', 'Te presentamos la Gigabyte GA-AB350-GAMING 3, una placa base con socket AMD AM4 y chipset B350.', 'AM4 Socket:\r\nAMD Ryzen™ processor', 12, 16),
(4, 'Intel Core I7-7700K 4.2GHz BOX', 5, '292.00', 'N', 'Procesador Intel Core I7-7700K 4.2GHz BOX', 'Market segment Desktop\r\nFamily Intel Core i7\r\nModel number i7-7700K\r\nFrequency 4200 MHz', 9, 3),
(5, 'Intel Core i5-7400 3.0GHz BOX', 4, '156.00', 'Y', 'Procesador Intel Core i5-7400 3.0GHz BOX', 'Market segment	Desktop\r\nFamily Intel Core i5\r\nModel number ? i5-7400\r\nFrequency ? 3000 MHz\r\nTurbo frequency	3500 MHz ', 9, 3),
(6, 'AMD Ryzen 5 1600 3.2GHZ BOX', 4, '189.00', 'N', 'Procesador AMD Ryzen 5 1600 3.2GHZ BOX', 'Familia de procesador: AMD Ryzen 5\r\nFrecuencia del procesador: 3,2 GHz\r\nNúmero de núcleos de procesador: 6', 10, 3),
(7, 'AMD RYZEN 7 1700 3.7GHZ BOX', 5, '269.00', 'Y', 'Procesador AMD RYZEN 7 1700 3.7GHZ BOX', 'Family AMD Ryzen 7\r\nModel number  1700\r\nFrequency  3000 MHz', 10, 3),
(8, 'Gigabyte GeForce GTX 1050Ti 4GB ', 4, '185.00', 'N', 'Gigabyte GeForce GTX 1050Ti OC WindForce 4GB GDDR5', 'Te presentamos la Gigabyte GeForce GTX 1050Ti OC Windforce , una gráfica con 4Gb GDDR5, VR Ready y sistema de ventilación Windforce.', 12, 4),
(9, 'MSI GeForce GTX 1050Ti 4GB ', 5, '184.00', 'Y', 'MSI GeForce GTX 1050Ti GAMING X 4GB GDDR5', 'Te presentamos la GTX 1050Ti Gaming X, una gráfica con 4GB GDDR5 y VR Ready', 8, 4),
(10, 'Sapphire Nitro+ Radeon RX 570 8GB OC GDDR5', 2, '389.00', 'N', 'Te presentamos la tarjeta gráfica Sapphire Nitro+ Radeon RX 570 8GB GDDR5. ', 'Construida sobre la arquitectura Polaris a prueba de futuro, la tarjeta gráfica SAPPHIRE NITRO + Radeon ™ RX 570 reproduce tus favoritos a 1080p y más allá, desde los últimos juegos de eSports y MOBA hasta los títulos AAA más populares y de gran intensidad gráfica. La evolución del proceso FinFET 14 ha permitido a la nueva serie RX 500 alcanzar mayores relojes que las generaciones anteriores.', 11, 4),
(11, 'Kingston HyperX Fury Black DDR4 2400 PC4-19200 4GB', 6, '46.00', 'N', 'Kingston HyperX Fury Black DDR4 2400 PC4-19200 4GB CL15', 'HyperX® FURY DDR4 reconoce automáticamente la plataforma a la que se conecta y realiza el overclock a la máxima frecuencia publicada, hasta 2666 MHz, para una funcionalidad plug-and-play perfecta. ', 15, 5),
(12, 'G.Skill Ripjaws V Red DDR4 3000 PC4-24000 16GB ', 4, '210.00', 'Y', 'G.Skill Ripjaws V Red DDR4 3000 PC4-24000 16GB 2x8GB CL15', 'La nueva gama G.Skill Ripjaws V ofrece soluciones para un rendimiento increíble. Estos kits optimizar el rendimiento de las plataformas de nueva generación, con la ventaja añadida un alto potencial de overclocking. ', 16, 5),
(13, 'Acer V226HQL 21.5\" LED', 7, '89.00', 'Y', 'Los monitores de la serie V6 incorporan las tecnologías Acer eColor', 'Estos resistentes monitores también disponen de una amplia variedad de puertos para que pueda conectar distintos tipos de dispositivos al mismo tiempo. Además, incorporan funciones respetuosas con el medio ambiente para ahorrar energía y costes.', 3, 10),
(14, 'ASUS VX248H 24\" LED', 7, '178.00', 'Y', 'Conectividad y altavoces ocultos\r\n', 'Este monitor incluye dos puertos HDMI y un D-sub para conectar todo tipo de dispositivos externos, como reproductores Blu-ray, DVD, etc., y disfrutar de contenidos multimedia de calidad sin necesidad de emplear un sistema de sonido externo.', 2, 10),
(15, 'Logitech Desktop MK120', 8, '18.00', 'N', 'Una combinación resistente, cómoda, elegante y sencilla a la vez. ', 'Una combinación resistente, cómoda, elegante y sencilla a la vez. Con un teclado plano equipado con teclas silenciosas en una distribución estándar, teclas F de tamaño normal y teclado numérico. ', 4, 2),
(16, 'Tacens Mars Gaming MK4 ', 7, '39.00', 'N', 'Tacens Mars Gaming MK4 Teclado Mecánico Gaming RGB Switch Blue\r\n', 'Pensado para los gamers más exigentes, el MK4 es el primer teclado totalmente mecánico de Mars Gaming, con switches rojo y azul para ajustarse a los gustos de los gamers y tecnología profesional con anti ghosting total.', 5, 14),
(17, 'Logitech Wireless Mouse M185 Azul', 8, '13.00', 'N', 'Sencillo y fiable ratón inalámbrico de fácil conexión.', 'Conexión inalámbrica fiable \r\nSin retrasos ni interrupciones. El minúsculo receptor inalámbrico proporciona una conexión de confianza.', 4, 15),
(18, 'MSI Clutch GM60 ', 10, '99.00', 'Y', 'MSI Clutch GM60 Ratón Gaming 10800DPI Negro RGB', 'Cuando se trata de esos momentos decisivos en el juego, necesitas el accesorio correcto para atrapar la victoria. La serie de mouse GAMING MSI Clutch utiliza los mejores componentes para asegurar que puedas confiar en este mouse. ¡Para que cuando llegue el momento, estés preparado con Clutch!', 8, 15),
(19, 'Lenovo Essential V110-15ISK', 5, '365.00', 'Y', 'Lenovo Essential V110-15ISK Intel Core i3-6006U/4GB/500GB/15.6', 'Te presentamos el portátil Essential V110-15ISK de Lenovo. Con su teclado que mejora el sistema, procesadores y tarjeta gráfica de vanguardia y fiabilidad integrada, el Lenovo V110 puede ayudar a tu empresa hoy y en el futuro. Ligero de peso y bajo de precio, este portátil de 15.6\" tiene un moderno diseño y una pantalla que facilita el trabajo tanto en interiores como en exteriores. Existen opciones de extensión de la garantía y del soporte.', 18, 18),
(28, 'Lenovo Ideapad 320-15ISK ', 5, '429.00', 'N', 'Lenovo Ideapad 320-15ISK Intel Core i3-6006U/4GB/500GB/15.6\"', 'Te presentamos el Ideapad 320-15ISK de Lenovo. Un ordenador portátil con procesador Intel Core i3, 4GB de memoria RAM, 500 GB de disco duro.', 18, 18),
(29, 'MSI GL62M 7RDX-1655XES', 8, '999.00', 'N', 'MSI GL62M 7RDX-1655XES Intel Core i7-7700HQ/8GB/1TB +256 SSD/GTX 1050/15.6\"', 'Te presentamos el portátil GL62M 7RDX-1656XES de MSI. Prepárate para sentir todo el poder del juego con este potente ordenador portátil de MSI. Un portátil Gaming dotado con un procesador Intel Core i7, 8GB de RAM, 1TB de almacenamiento con un disco duro SSD de 256GB, y todo bajo una potente gráfica NVIDIA GeForce GTX 1050 4GB GDDR5.', 8, 18),
(30, 'HP 15-BS512NS', 5, '604.00', 'N', 'HP 15-BS512NS Intel Core i5-7200U/8GB/256GB SSD/15.6\"', 'Realiza todas las tareas diarias con éxito utilizando un portátil elegante creado para mantenerte conectado, el HP 15-BS512NS, así como para llevar a cabo tus actividades habituales. Con un rendimiento fiable y una batería de larga duración puedes navegar, transmitir datos y mantenerte en contacto con lo que más te preocupa de forma sencilla.', 6, 18),
(31, 'HP Notebook 250 G6 ', 7, '479.00', 'N', 'HP Notebook 250 G6 Intel Core i3-6006U/8GB/128GB SSD/15.6\"', 'Afronta todas tus tareas diarias con un portátil asequible que viene equipado con todas las características que necesitas. Obtén toda la potencia que deseas con el portátil HP Notebook 250 G6.', 6, 18),
(32, 'HP Pavilion Desktop 570-P066NS ', 6, '509.00', 'N', 'HP Pavilion Desktop 570-P066NS AMD A10-9700/12GB/1TB', 'Mientras que el desarrollo de otras torres ha sido detenido, HP ha revolucionado esta categoría. Desde su diseño atractivo y ahorrador de espacio, hasta su pleno rendimiento y fiabilidad, este HP Pavilion 570-p066ns es lo mejor que ha pasado en el campo de las torres en más de 20 años.\r\n\r\nPotencia y rendimiento para un entretenimiento de primera clase, juegos y experiencia multitarea.\r\n\r\n', 6, 19),
(33, 'Medion Erazer ', 6, '819.00', 'N', 'Medion Erazer X57 Intel Core i5-6400/16GB/1TB+120GB SSD/GeForce GTX 1060 3G', 'El MEDION ERAZER X57 contiene un procesador Intel Core i5-6400 con una frecuencia de 2.7 GHz. Así, los juegos más populares y actuales pueden desplegar toda su gama de píxeles creando una experiencia incomparable con un número máximo de detalles y altas tasas de imágenes. ', 19, 19),
(34, 'MSI Trident 3 VR7RC-027EU', 7, '1299.00', 'N', 'MSI Trident 3 VR7RC-027EU Intel Core i7-7700/8GB/1TB+256 SSD/GTX1060', 'VERDADERO PC GAMING LIGERO Y COMPACTO\r\nIr a una LAN-party, casa de un amigo o simplemente tener la posibilidad de llevarlo allá donde quieras. El Trident 3 únicamente pesa 3.17 KG y entra en la mayoría de mochilas. Lleva allá donde quieras el verdadero rendimiento.', 8, 19),
(35, 'MSI Trident 3 7RB-074EU ', 6, '799.00', 'N', 'MSI Trident 3 7RB-074EU Intel Core i5-7400/8GB/1TB/GTX1050Ti', 'El ordenador de alto rendimiento extremo y diseño compacto, conoce el Trident 3. Con un nivel de rendimiento que encaja con las necesidades de cualquier gamer. \r\n\r\nRedefiniendo el tamaño de los ordenadores de sobremesa con el MSI Trident 3 .\r\n\r\nVERDADERO PC GAMING LIGERO Y COMPACTO\r\n\r\nIr a una LAN-party, casa de un amigo o simplemente tener la posibilidad de llevarlo allá donde quieras. El Trident 3 únicamente pesa 3.17 KG y entra en la mayoría de mochilas. Lleva allá donde quieras el verdadero rendimiento.', 8, 19),
(36, 'HP 260-P103NS ', 0, '349.00', 'Y', 'HP 260-P103NS Intel Core i3-6100T/4GB/1TB', 'Supera tu día de trabajo con el almacenamiento ampliado, el procesador Intel® o AMD, un diseño más pequeño y la fiabilidad probada de esta torre HP rediseñada. Encontrar una torre asequible con el rendimiento que necesitas y la marca en la que confías ahora es más fácil.\r\n\r\nPotencia y rendimiento para un entretenimiento de primera clase, juegos y experiencia multitarea.', 6, 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promotion`
--

DROP TABLE IF EXISTS `promotion`;
CREATE TABLE IF NOT EXISTS `promotion` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DISCOUNTPERCENTAGE` int(2) NOT NULL,
  `STARTDATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ENDDATE` datetime DEFAULT NULL,
  `PRODUCT` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `PRODUCT` (`PRODUCT`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `promotion`
--

INSERT INTO `promotion` (`ID`, `DISCOUNTPERCENTAGE`, `STARTDATE`, `ENDDATE`, `PRODUCT`) VALUES
(1, 25, '2018-02-11 15:34:14', '2018-09-07 00:00:00', 5),
(2, 50, '2018-02-11 15:34:14', '2018-10-25 19:22:18', 7),
(3, 10, '2018-02-11 15:34:14', '2018-09-06 04:11:06', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `USERNAME` varchar(32) NOT NULL,
  `PASSWORD` varchar(32) NOT NULL,
  `CREATIONDATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `NAME` varchar(50) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `ADDRESS` varchar(100) NOT NULL,
  `POSTALCODE` varchar(5) NOT NULL,
  PRIMARY KEY (`USERNAME`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`USERNAME`, `PASSWORD`, `CREATIONDATE`, `NAME`, `EMAIL`, `ADDRESS`, `POSTALCODE`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', '2018-01-31 00:06:35', 'Eneko Gallego Gomez', 'eneko.gallego19@gmail.com', 'C/Albatros nº9/11', '07181'),
('user', 'ee11cbb19052e40b07aac0ca060c23ee', '2018-02-17 21:57:51', 'Username', 'user.prueba@gmail.com', 'user', '12345');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `CATEGORY_ibfk_1` FOREIGN KEY (`PARENTCATEGORY`) REFERENCES `category` (`ID`);

--
-- Filtros para la tabla `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `IMAGE_ibfk_1` FOREIGN KEY (`PRODUCT`) REFERENCES `product` (`ID`);

--
-- Filtros para la tabla `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `ORDER_ibfk_1` FOREIGN KEY (`USER`) REFERENCES `user` (`USERNAME`);

--
-- Filtros para la tabla `orderitem`
--
ALTER TABLE `orderitem`
  ADD CONSTRAINT `ORDERITEM_ibfk_1` FOREIGN KEY (`ORDER`) REFERENCES `order` (`ID`),
  ADD CONSTRAINT `ORDERITEM_ibfk_2` FOREIGN KEY (`PRODUCT`) REFERENCES `product` (`ID`);

--
-- Filtros para la tabla `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `PRODUCT_ibfk_1` FOREIGN KEY (`BRAND`) REFERENCES `brand` (`ID`),
  ADD CONSTRAINT `PRODUCT_ibfk_2` FOREIGN KEY (`CATEGORY`) REFERENCES `category` (`ID`);

--
-- Filtros para la tabla `promotion`
--
ALTER TABLE `promotion`
  ADD CONSTRAINT `PROMOTION_ibfk_1` FOREIGN KEY (`PRODUCT`) REFERENCES `product` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
