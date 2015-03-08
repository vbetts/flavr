-- phpMyAdmin SQL Dump
-- version 4.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Dec 12, 2014 at 11:15 PM
-- Server version: 5.5.38
-- PHP Version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `flavr`
--

-- --------------------------------------------------------

--
-- Table structure for table `Ingredients`
--

CREATE TABLE `Ingredients` (
`id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `Ingredients`
--

INSERT INTO `Ingredients` (`id`, `name`) VALUES
(7, 'bread'),
(8, 'butter'),
(9, 'eggplant'),
(10, 'cheese'),
(11, 'tomato'),
(12, 'garlic'),
(13, 'milk');

-- --------------------------------------------------------

--
-- Table structure for table `LinkIngRec`
--

CREATE TABLE `LinkIngRec` (
  `idIng` int(11) NOT NULL,
  `idRec` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `LinkIngRec`
--

INSERT INTO `LinkIngRec` (`idIng`, `idRec`) VALUES
(7, 2),
(8, 2),
(9, 3),
(10, 3),
(11, 3),
(12, 3);

-- --------------------------------------------------------

--
-- Table structure for table `Recipes`
--

CREATE TABLE `Recipes` (
`id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `rText` text NOT NULL,
  `meat` tinyint(1) NOT NULL DEFAULT '0',
  `veg` tinyint(1) NOT NULL DEFAULT '0',
  `flex` tinyint(1) NOT NULL DEFAULT '0',
  `gfree` tinyint(1) NOT NULL DEFAULT '0',
  `breakfast` tinyint(1) NOT NULL DEFAULT '0',
  `lunch` tinyint(1) NOT NULL DEFAULT '0',
  `dinner` tinyint(1) NOT NULL DEFAULT '0',
  `dessert` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `Recipes`
--

INSERT INTO `Recipes` (`id`, `name`, `rText`, `meat`, `veg`, `flex`, `gfree`, `breakfast`, `lunch`, `dinner`, `dessert`) VALUES
(2, 'Toast', '2 tsp butter \r\n2 slices bread. \r\nToast bread, apply butter, eat.', 0, 1, 0, 0, 1, 1, 1, 1),
(3, 'eggplant parm', '1 cup cheese\r\n1 eggplant\r\ntomato sauce\r\ngarlic\r\n\r\nBroil eggplant, place in baking pan. Add garlic to sauce. Apply sauce and cheese to eggplant. Bake. Eat.', 0, 0, 1, 1, 0, 0, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Ingredients`
--
ALTER TABLE `Ingredients`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `LinkIngRec`
--
ALTER TABLE `LinkIngRec`
 ADD PRIMARY KEY (`idIng`,`idRec`), ADD KEY `idRec_FK` (`idRec`);

--
-- Indexes for table `Recipes`
--
ALTER TABLE `Recipes`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `rTitle` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Ingredients`
--
ALTER TABLE `Ingredients`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `Recipes`
--
ALTER TABLE `Recipes`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `LinkIngRec`
--
ALTER TABLE `LinkIngRec`
ADD CONSTRAINT `idIng_FK` FOREIGN KEY (`idIng`) REFERENCES `Ingredients` (`id`),
ADD CONSTRAINT `idRec_FK` FOREIGN KEY (`idRec`) REFERENCES `Recipes` (`id`);
