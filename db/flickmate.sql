-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2023 at 12:36 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flickmate`
--

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `mid` int(11) NOT NULL,
  `mname` varchar(250) NOT NULL,
  `mdes` varchar(1024) NOT NULL,
  `mrating` float NOT NULL,
  `mtlink` varchar(1024) NOT NULL,
  `mdir` varchar(100) NOT NULL,
  `mlang` varchar(100) NOT NULL,
  `msd` date NOT NULL,
  `med` date NOT NULL,
  `mpos` varchar(500) NOT NULL,
  `mssp` double NOT NULL DEFAULT 0,
  `mgsp` double NOT NULL DEFAULT 0,
  `mpsp` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`mid`, `mname`, `mdes`, `mrating`, `mtlink`, `mdir`, `mlang`, `msd`, `med`, `mpos`, `mssp`, `mgsp`, `mpsp`) VALUES
(11, 'Leo', 'Leo is an upcoming Indian Tamil-language action thriller film directed by Lokesh Kanagaraj, who co-wrote it with Rathna Kumar and Deeraj Vaidy. It is the third film in the Lokesh Cinematic Universe, and is produced by S. S. Lalit Kumar of Seven Screen Studio while Jagadish Palanisamy serves as co-producer.', 5, 'https://www.youtube.com/embed/qN3wfuPYTI4', 'Lokesh Kanagaraj', 'TAMIL', '2023-09-22', '2023-10-30', 'https://m.media-amazon.com/images/M/MV5BM2Y4MzQ3NmUtOWQ5My00YTFjLTkzNDMtNzliODQ5NTFmZjg3XkEyXkFqcGdeQXVyMTUyNjIwMDEw._V1_FMjpg_UY728_.jpg', 120, 150, 200),
(13, 'Malaikottai', 'Malaikottai Vaaliban is an upcoming Indian Malayalam-language period western action film directed by Lijo Jose Pellissery and written by P. S. Rafeeque. It was produced by John & Mary Creative, along with Century Films, Maxlab Cinemas and Entertainments, Yoodlee Films, and Amen Movie Monastery.', 8, 'https://www.youtube.com/embed/R7yc_FegczU', 'Lijo Jose Pellissery', 'MALAYALAM', '2024-01-01', '2024-01-30', 'https://m.media-amazon.com/images/M/MV5BMGMxYjczNjktMTZlYi00NWU0LWFmNGEtYTBhMDJkNmJmZjhlXkEyXkFqcGdeQXVyMjkxNzQ1NDI@._V1_FMjpg_UY720_.jpg', 120, 150, 200),
(14, 'Kannur Squad', 'A police officer and his team face a challenging journey across the country to catch a criminal gang. He leads them toward triumph amid professional uncertainties.', 8, 'https://www.youtube.com/embed/j7uWUMd_ItE', 'Roby Varghese Raj', 'MALAYALAM', '2023-12-01', '2023-12-30', 'https://i0.wp.com/www.socialnews.xyz/wp-content/uploads/2023/09/19/f6xapejbuaa9zoc8522441.jpg', 90, 110, 170),
(15, 'Dunki', 'Four friends from a village in Punjab share a common dream: to go to England. Their problem is that they have neither the visa nor the ticket. A soldier promises to take them to the land of their dreams.', 9, 'https://www.youtube.com/embed/LOzucm1jbzs', 'Rajkumar Hirani', 'HINDI', '2024-02-01', '2024-02-29', 'https://m.media-amazon.com/images/M/MV5BMzQ0NDRhNmItYzllYS00NDdlLTk0YTctZDQ5YmFkYjdkNDcyXkEyXkFqcGdeQXVyNTYwMzA0MTM@._V1_FMjpg_UY420_.jpg', 120, 150, 200),
(16, 'Ajayante Randam Moshanam', 'Set in the Northern Kerala in 1900, 1950 and 1990, Three generations of heroes Maniyan, Kunjikelu and Ajayan, try to protect the most important treasure of the Land.', 8, 'https://www.youtube.com/embed/TWQjWLwY9ZE', 'Jithin Lal', 'MALAYALAM', '2024-03-01', '2024-03-31', 'https://m.media-amazon.com/images/M/MV5BNjllMGI0NjMtZmMxOC00NTViLThmMGItNGIyN2QyMzFlZTAyXkEyXkFqcGdeQXVyMjkxNzQ1NDI@._V1_FMjpg_UX986_.jpg', 140, 170, 220);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `pid` int(255) NOT NULL,
  `ptprice` int(255) NOT NULL,
  `s1` varchar(255) NOT NULL,
  `s2` varchar(255) DEFAULT NULL,
  `s3` varchar(255) DEFAULT NULL,
  `s4` varchar(255) DEFAULT NULL,
  `s5` varchar(255) DEFAULT NULL,
  `s6` varchar(255) DEFAULT NULL,
  `s7` varchar(255) DEFAULT NULL,
  `s8` varchar(255) DEFAULT NULL,
  `s9` varchar(255) DEFAULT NULL,
  `s10` varchar(255) DEFAULT NULL,
  `uID` int(255) NOT NULL,
  `pdate` date NOT NULL DEFAULT current_timestamp(),
  `psdate` date NOT NULL,
  `pstime` varchar(255) NOT NULL,
  `mid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `signin`
--

CREATE TABLE `signin` (
  `uID` int(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pnumber` varchar(255) NOT NULL,
  `fpoints` int(255) DEFAULT 50,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `uID` (`uID`),
  ADD KEY `payment_ibfk_1` (`mid`);

--
-- Indexes for table `signin`
--
ALTER TABLE `signin`
  ADD PRIMARY KEY (`uID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `pid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `signin`
--
ALTER TABLE `signin`
  MODIFY `uID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `movies` (`mId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
