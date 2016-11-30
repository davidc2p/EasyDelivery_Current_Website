-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 22, 2016 at 03:46 AM
-- Server version: 5.1.57
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `a6586795_ED`
--

-- --------------------------------------------------------

--
-- Table structure for table `configuration`
--

CREATE TABLE `configuration` (
  `baseLatitude` float NOT NULL,
  `baseLongitude` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `configuration`
--


-- --------------------------------------------------------

--
-- Table structure for table `Customers`
--

CREATE TABLE `Customers` (
  `id` bigint(20) NOT NULL,
  `Name` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `Address` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `Latitude` float NOT NULL,
  `Longitude` float NOT NULL,
  `CreationDate` datetime NOT NULL,
  `Email` varchar(200) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `Customers`
--


-- --------------------------------------------------------

--
-- Table structure for table `Deliveries`
--

CREATE TABLE `Deliveries` (
  `ID` bigint(20) NOT NULL,
  `Description` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `DriverID` int(11) NOT NULL,
  `VehicleID` int(11) NOT NULL,
  `DateCreated` datetime NOT NULL,
  `DateCompleted` datetime NOT NULL,
  `isDriverBeginning` tinyint(1) NOT NULL,
  `DateInitiated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `Deliveries`
--


-- --------------------------------------------------------

--
-- Table structure for table `DeliveryLine`
--

CREATE TABLE `DeliveryLine` (
  `DeliveryID` bigint(20) NOT NULL,
  `LineID` int(11) NOT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `Distance` float DEFAULT NULL,
  `CumulativeDistance` float DEFAULT NULL,
  `TimeinSec` bigint(20) DEFAULT NULL,
  `CumulativeTimeinSec` bigint(20) DEFAULT NULL,
  `DateCompleted` datetime DEFAULT NULL,
  PRIMARY KEY (`DeliveryID`,`LineID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `DeliveryLine`
--


-- --------------------------------------------------------

--
-- Table structure for table `DriverRoute`
--

CREATE TABLE `DriverRoute` (
  `DriverID` int(11) NOT NULL,
  `DeliveryID` int(11) NOT NULL,
  `PositionID` int(11) NOT NULL,
  `Latitude` float DEFAULT NULL,
  `Longitude` float DEFAULT NULL,
  `DistanceFromPrevious` float DEFAULT NULL,
  `DateCreated` datetime DEFAULT NULL,
  `Speed` float DEFAULT NULL,
  `LineID` int(11) DEFAULT NULL,
  PRIMARY KEY (`DriverID`,`DeliveryID`,`PositionID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `DriverRoute`
--


-- --------------------------------------------------------

--
-- Table structure for table `Drivers`
--

CREATE TABLE `Drivers` (
  `ID` int(11) NOT NULL,
  `Description` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `Address` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `Longitude` float DEFAULT NULL,
  `Latitude` float DEFAULT NULL,
  `Email` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `Picture` binary(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `Drivers`
--


-- --------------------------------------------------------

--
-- Table structure for table `Vehicles`
--

CREATE TABLE `Vehicles` (
  `ID` bigint(20) NOT NULL,
  `Description` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `Picture` binary(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `Vehicles`
--