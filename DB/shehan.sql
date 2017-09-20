-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2017 at 02:03 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shehan`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `idcategory` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`idcategory`, `name`) VALUES
(1, 'Type'),
(2, 'Tube');

-- --------------------------------------------------------

--
-- Table structure for table `cheque`
--

CREATE TABLE `cheque` (
  `idcheque` int(11) NOT NULL,
  `chequeno` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `bank` varchar(45) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `realizing_date` datetime DEFAULT NULL,
  `added_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `added_by` varchar(45) DEFAULT NULL,
  `idinvoice` int(11) NOT NULL,
  `idcustomer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `idcustomer` int(11) NOT NULL,
  `vehicleno` varchar(45) DEFAULT NULL,
  `contactno` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `grn`
--

CREATE TABLE `grn` (
  `idgrn` int(11) NOT NULL,
  `issued_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `totoal_amount` double DEFAULT '0',
  `paid_amount` double DEFAULT '0',
  `balance` double DEFAULT '0',
  `issued_by` varchar(45) DEFAULT NULL,
  `discount` double DEFAULT '0',
  `idproduct` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `grnregistry`
--

CREATE TABLE `grnregistry` (
  `idgrnregistry` int(11) NOT NULL,
  `qty` int(11) DEFAULT '0',
  `unit_price` double DEFAULT '0',
  `idgrn` int(11) NOT NULL,
  `idproduct` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `idinvoice` int(11) NOT NULL,
  `payment_method` varchar(45) DEFAULT NULL,
  `total` double DEFAULT '0',
  `balance` double DEFAULT '0',
  `issued_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `issued_by` varchar(45) DEFAULT NULL,
  `idcustomer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='		';

-- --------------------------------------------------------

--
-- Table structure for table `invoiceregistry`
--

CREATE TABLE `invoiceregistry` (
  `idinvoiceregistry` int(11) NOT NULL,
  `qty` int(10) DEFAULT NULL,
  `unit_price` int(10) DEFAULT NULL,
  `idinvoice` int(11) NOT NULL,
  `idproduct` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `idproduct` int(11) NOT NULL,
  `itemcode` varchar(100) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `available_qty` int(10) DEFAULT '0',
  `reorder_level` int(10) DEFAULT NULL,
  `idcategory` int(10) NOT NULL,
  `idsupplier` int(11) NOT NULL,
  `unit_price` double DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`idproduct`, `itemcode`, `description`, `available_qty`, `reorder_level`, `idcategory`, `idsupplier`, `unit_price`) VALUES
(1, '123-12343-B43', 'Brigestone type', 1000, 2, 1, 1, 1000),
(2, '2342-BRIG-5343', 'Brigestone tube', 500, 2, 2, 1, 500);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `idsupplier` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `contactno` varchar(15) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `active_status` int(10) DEFAULT '1',
  `company_discount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`idsupplier`, `name`, `contactno`, `address`, `active_status`, `company_discount`) VALUES
(1, 'Chathuri Mahanayake', '10775783380', 'No 45, Main Rd, Colombo', 1, 10),
(2, 'Brian Oshada', '0145122255', 'No e4, Main Rd, CNegombo', 1, 20),
(3, 'Test', '123123123', 'Testing', 0, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`idcategory`);

--
-- Indexes for table `cheque`
--
ALTER TABLE `cheque`
  ADD PRIMARY KEY (`idcheque`),
  ADD KEY `fk_cheque_invoice1_idx` (`idinvoice`),
  ADD KEY `fk_cheque_customer1_idx` (`idcustomer`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`idcustomer`);

--
-- Indexes for table `grn`
--
ALTER TABLE `grn`
  ADD PRIMARY KEY (`idgrn`),
  ADD KEY `fk_grn_product1_idx` (`idproduct`);

--
-- Indexes for table `grnregistry`
--
ALTER TABLE `grnregistry`
  ADD PRIMARY KEY (`idgrnregistry`),
  ADD KEY `fk_grnregistry_grn1_idx` (`idgrn`),
  ADD KEY `fk_grnregistry_product1_idx` (`idproduct`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`idinvoice`),
  ADD KEY `fk_invoice_customer1_idx` (`idcustomer`);

--
-- Indexes for table `invoiceregistry`
--
ALTER TABLE `invoiceregistry`
  ADD PRIMARY KEY (`idinvoiceregistry`),
  ADD KEY `fk_invoiceregistry_invoice1_idx` (`idinvoice`),
  ADD KEY `fk_invoiceregistry_product1_idx` (`idproduct`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`idproduct`),
  ADD KEY `fk_product_category_idx` (`idcategory`),
  ADD KEY `fk_product_supplier1_idx` (`idsupplier`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`idsupplier`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `idcategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `idcustomer` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `grnregistry`
--
ALTER TABLE `grnregistry`
  MODIFY `idgrnregistry` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `idproduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `idsupplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cheque`
--
ALTER TABLE `cheque`
  ADD CONSTRAINT `fk_cheque_customer1` FOREIGN KEY (`idcustomer`) REFERENCES `customer` (`idcustomer`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cheque_invoice1` FOREIGN KEY (`idinvoice`) REFERENCES `invoice` (`idinvoice`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `grn`
--
ALTER TABLE `grn`
  ADD CONSTRAINT `fk_grn_product1` FOREIGN KEY (`idproduct`) REFERENCES `product` (`idproduct`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `grnregistry`
--
ALTER TABLE `grnregistry`
  ADD CONSTRAINT `fk_grnregistry_grn1` FOREIGN KEY (`idgrn`) REFERENCES `grn` (`idgrn`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_grnregistry_product1` FOREIGN KEY (`idproduct`) REFERENCES `product` (`idproduct`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `fk_invoice_customer1` FOREIGN KEY (`idcustomer`) REFERENCES `customer` (`idcustomer`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `invoiceregistry`
--
ALTER TABLE `invoiceregistry`
  ADD CONSTRAINT `fk_invoiceregistry_invoice1` FOREIGN KEY (`idinvoice`) REFERENCES `invoice` (`idinvoice`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_invoiceregistry_product1` FOREIGN KEY (`idproduct`) REFERENCES `product` (`idproduct`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_category` FOREIGN KEY (`idcategory`) REFERENCES `category` (`idcategory`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_product_supplier1` FOREIGN KEY (`idsupplier`) REFERENCES `supplier` (`idsupplier`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
