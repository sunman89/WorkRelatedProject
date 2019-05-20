--
-- Table structure for table `products`
--
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `productType` set('Necklace', 'Bracelet', 'Charms', 'Misc') NOT NULL,
  `description` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `filePath` varchar(255) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `thumbfilename` varchar(255) NOT NULL,
  `thumbfilePath` varchar(255) NOT NULL,
  `filename2` varchar(255),
  `filePath2` varchar(255),
  `filename3` varchar(255),
  `filePath3` varchar(255),
  PRIMARY KEY (`id`)
);