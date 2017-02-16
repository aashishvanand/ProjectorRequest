# ProjectorRequest

SQL stmts

CREATE DATABASE IF NOT EXISTS `projector` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `projector`;

CREATE TABLE `login` (
  `staffcode` varchar(5) NOT NULL,
  `password` varchar(50) NOT NULL,
  `department` varchar(5) NOT NULL,
  `admin` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `projector` (
  `id` int(11) NOT NULL,
  `projectorname` varchar(30) NOT NULL,
  `department` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `aero.projector` (
  `sno` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `date` date NOT NULL,
  `hour` int(2) NOT NULL,
  `staffcode` varchar(5) NOT NULL,
  `requesttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `projector` varchar(25) NOT NULL,
  `department` varchar(5) NOT NULL,
  `year` varchar(3) NOT NULL,
  `section` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1

CREATE TABLE `auto.projector` (
  `sno` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `date` date NOT NULL,
  `hour` int(2) NOT NULL,
  `staffcode` varchar(5) NOT NULL,
  `requesttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `projector` varchar(25) NOT NULL,
  `department` varchar(5) NOT NULL,
  `year` varchar(3) NOT NULL,
  `section` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1

CREATE TABLE `btech.projector` (
  `sno` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `date` date NOT NULL,
  `hour` int(2) NOT NULL,
  `staffcode` varchar(5) NOT NULL,
  `requesttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `projector` varchar(25) NOT NULL,
  `department` varchar(5) NOT NULL,
  `year` varchar(3) NOT NULL,
  `section` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1

CREATE TABLE `bmed.projector` (
  `sno` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `date` date NOT NULL,
  `hour` int(2) NOT NULL,
  `staffcode` varchar(5) NOT NULL,
  `requesttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `projector` varchar(25) NOT NULL,
  `department` varchar(5) NOT NULL,
  `year` varchar(3) NOT NULL,
  `section` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1

CREATE TABLE `chem.projector` (
  `sno` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `date` date NOT NULL,
  `hour` int(2) NOT NULL,
  `staffcode` varchar(5) NOT NULL,
  `requesttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `projector` varchar(25) NOT NULL,
  `department` varchar(5) NOT NULL,
  `year` varchar(3) NOT NULL,
  `section` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1

CREATE TABLE `civil.projector` (
  `sno` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `date` date NOT NULL,
  `hour` int(2) NOT NULL,
  `staffcode` varchar(5) NOT NULL,
  `requesttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `projector` varchar(25) NOT NULL,
  `department` varchar(5) NOT NULL,
  `year` varchar(3) NOT NULL,
  `section` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1

CREATE TABLE `ece.projector` (
  `sno` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `date` date NOT NULL,
  `hour` int(2) NOT NULL,
  `staffcode` varchar(5) NOT NULL,
  `requesttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `projector` varchar(25) NOT NULL,
  `department` varchar(5) NOT NULL,
  `year` varchar(3) NOT NULL,
  `section` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1


CREATE TABLE `eee.projector` (
  `sno` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `date` date NOT NULL,
  `hour` int(2) NOT NULL,
  `staffcode` varchar(5) NOT NULL,
  `requesttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `projector` varchar(25) NOT NULL,
  `department` varchar(5) NOT NULL,
  `year` varchar(3) NOT NULL,
  `section` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1


CREATE TABLE `it.projector` (
  `sno` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `date` date NOT NULL,
  `hour` int(2) NOT NULL,
  `staffcode` varchar(5) NOT NULL,
  `requesttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `projector` varchar(25) NOT NULL,
  `department` varchar(5) NOT NULL,
  `year` varchar(3) NOT NULL,
  `section` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1


CREATE TABLE `mtrcs.projector` (
  `sno` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `date` date NOT NULL,
  `hour` int(2) NOT NULL,
  `staffcode` varchar(5) NOT NULL,
  `requesttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `projector` varchar(25) NOT NULL,
  `department` varchar(5) NOT NULL,
  `year` varchar(3) NOT NULL,
  `section` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1

CREATE TABLE `hd.projector` (
  `sno` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `date` date NOT NULL,
  `hour` int(2) NOT NULL,
  `staffcode` varchar(5) NOT NULL,
  `requesttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `projector` varchar(25) NOT NULL,
  `department` varchar(5) NOT NULL,
  `year` varchar(3) NOT NULL,
  `section` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1


CREATE TABLE `pe.projector` (
  `sno` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `date` date NOT NULL,
  `hour` int(2) NOT NULL,
  `staffcode` varchar(5) NOT NULL,
  `requesttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `projector` varchar(25) NOT NULL,
  `department` varchar(5) NOT NULL,
  `year` varchar(3) NOT NULL,
  `section` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1


CREATE TABLE `edc.projector` (
  `sno` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `date` date NOT NULL,
  `hour` int(2) NOT NULL,
  `staffcode` varchar(5) NOT NULL,
  `requesttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `projector` varchar(25) NOT NULL,
  `department` varchar(5) NOT NULL,
  `year` varchar(3) NOT NULL,
  `section` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1


CREATE TABLE `mba.projector` (
  `sno` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `date` date NOT NULL,
  `hour` int(2) NOT NULL,
  `staffcode` varchar(5) NOT NULL,
  `requesttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `projector` varchar(25) NOT NULL,
  `department` varchar(5) NOT NULL,
  `year` varchar(3) NOT NULL,
  `section` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1

CREATE TABLE `mca.projector` (
  `sno` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `date` date NOT NULL,
  `hour` int(2) NOT NULL,
  `staffcode` varchar(5) NOT NULL,
  `requesttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `projector` varchar(25) NOT NULL,
  `department` varchar(5) NOT NULL,
  `year` varchar(3) NOT NULL,
  `section` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1

CREATE TABLE `cse.projector` (
  `sno` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `date` date NOT NULL,
  `hour` int(2) NOT NULL,
  `staffcode` varchar(5) NOT NULL,
  `requesttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `projector` varchar(25) NOT NULL,
  `department` varchar(5) NOT NULL,
  `year` varchar(3) NOT NULL,
  `section` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1

CREATE TABLE `mech.projector` (
  `sno` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `date` date NOT NULL,
  `hour` int(2) NOT NULL,
  `staffcode` varchar(5) NOT NULL,
  `requesttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `projector` varchar(25) NOT NULL,
  `department` varchar(5) NOT NULL,
  `year` varchar(3) NOT NULL,
  `section` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1

