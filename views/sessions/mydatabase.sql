-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 27, 2019 at 05:40 PM
-- Server version: 5.7.23
-- PHP Version: 7.1.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: 'mydatabase'
--

-- --------------------------------------------------------

--
-- Table structure for table 'events'
--


CREATE TABLE 'events' (
  'date' date NOT NULL,
  'details' text NOT NULL,
  'name' text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE 'events'
  ADD PRIMARY KEY ('date');





--
-- Dumping data for table 'products'
--



-- --------------------------------------------------------

--
-- Table structure for table 'product_sessions'
--



-- --------------------------------------------------------

--
-- Table structure for table 'sessions'
--



-- --------------------------------------------------------

--
-- Table structure for table 'session_closes'
--



-- --------------------------------------------------------

--
-- Table structure for table 'users'
--

-- CREATE TABLE 'users' (
--   'id' int(11) NOT NULL,
--   'username' varchar(100) NOT NULL,
--   'email' varchar(100) NOT NULL,
--   'password' varchar(300) NOT NULL,
--   'role' int(11) NOT NULL DEFAULT '1',
--   'reset_code' varchar(20) NOT NULL,
--   'CF' varchar(16) NOT NULL,
--   'nome' varchar(20) NOT NULL,
--   'cognome' varchar(20) NOT NULL,
--   'telefono' varchar(20) NOT NULL,
--   'nazione' varchar(20) NOT NULL,
--   'provincia' varchar(20) NOT NULL,
--   'citta' varchar(20) NOT NULL,
--   'CAP' varchar(20) NOT NULL,
--   'via' varchar(20) NOT NULL,
--   'numero_civico' varchar(20) NOT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table 'users'
--

-- INSERT INTO 'users' ('id', 'nome', 'cognome', 'email', 'role', 'CF',  'phone_number', 'nation', 'province', 'city', 'CAP', 'street', 'house_number') VALUES
-- (1, '', '', 3, '', '', '', '', '', '', '', '', '');

--

--


--
-- Indexes for table 'users'
--
-- ALTER TABLE 'users'
--   ADD PRIMARY KEY ('id'),
--   ADD UNIQUE KEY 'CF' ('CF');
  

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table 'products'
--


--
-- AUTO_INCREMENT for table 'product_sessions'
--


--
-- AUTO_INCREMENT for table 'sessions'
--


--
-- AUTO_INCREMENT for table 'session_closes'
--


--
-- AUTO_INCREMENT for table 'users'
--
-- ALTER TABLE 'users'
--   MODIFY 'id' int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
