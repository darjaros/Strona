-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 01 Lut 2018, 13:02
-- Wersja serwera: 10.1.29-MariaDB
-- Wersja PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `pai_jaros`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE `categories` (
  `Id` int(11) NOT NULL,
  `Sub_Id` int(11) DEFAULT NULL,
  `Name` varchar(150) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Zrzut danych tabeli `categories`
--

INSERT INTO `categories` (`Id`, `Sub_Id`, `Name`) VALUES
(1, 2, 'Pizza'),
(2, 2, 'Kebab'),
(3, 2, 'Pierogi');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `Id` int(11) NOT NULL,
  `Categories_Id` int(11) DEFAULT NULL,
  `Name` varchar(150) COLLATE utf8_bin NOT NULL,
  `Description` text COLLATE utf8_bin NOT NULL,
  `Img` varchar(150) COLLATE utf8_bin NOT NULL,
  `minimg` varchar(150) COLLATE utf8_bin NOT NULL,
  `alt` varchar(150) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`Id`, `Categories_Id`, `Name`, `Description`, `Img`, `minimg`, `alt`) VALUES
(1, 3, 'Pierogi ruskie', 'Składniki:', 'images/ruskie.jpg', 'images/min/ruskie.jpg', 'Pierogi ruskie'),
(2, 2, 'Kebab Rollo', 'Składniki:', 'images/rollo.jpg', 'images/min/rollo.jpg', 'Kebab Rollo'),
(3, 1, 'Pizza Margerita', 'Składniki:', 'images/margerita.jpg', 'images/min/margerita.jpg', 'Pizza Margerita');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sub`
--

CREATE TABLE `sub` (
  `ID` int(11) NOT NULL,
  `Name` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `HavingCategories` tinyint(1) NOT NULL DEFAULT '1',
  `Content` longtext COLLATE utf8_bin,
  `Admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Zrzut danych tabeli `sub`
--

INSERT INTO `sub` (`ID`, `Name`, `HavingCategories`, `Content`, `Admin`) VALUES
(1, 'Strona głowna', 0, 'echo \'<h3>Strona głowna</h3>\' . PHP_EOL;\r\n			\r\necho \'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam tempor sem vitae nisl imperdiet, auctor semper massa ornare. Nulla cursus semper leo, a iaculis arcu accumsan ac. Suspendisse molestie cursus ex ac eleifend. Fusce sagittis quam ipsum, sit amet lacinia mi tincidunt quis. Donec vitae faucibus purus, a dictum tortor. Nulla sed eros at nibh sodales dapibus. Pellentesque blandit metus et mauris cursus consequat. Fusce magna sem, pellentesque sit amet mauris ut, blandit dapibus mauris. Nam tortor mi, aliquet aliquet maximus eget, vestibulum ac mi. Sed tellus purus, commodo sed ullamcorper at, sollicitudin in velit. Suspendisse potenti. Vestibulum consequat nibh ac sagittis efficitur. Donec vehicula tincidunt enim, vel mollis velit luctus a. Aenean in mollis lor\'. PHP_EOL;\r\n', 0),
(2, 'Menu', 1, '	$cat_id = isset($_POST[\'cat_id\']) ? (int)$_POST[\'cat_id\'] : 1;\r\n	$sql = \'SELECT `Id`,`Name`, `Description`, `Img` , `Minimg`, `Alt`\r\n			FROM `products` \r\n			WHERE `Categories_id` = \' . $cat_id .\r\n			\' ORDER BY `Id`\';\r\n	$wynik = mysqli_query($polaczenie, $sql);\r\n	if (mysqli_num_rows($wynik) > 0) {\r\n		while (($produkt = @mysqli_fetch_array($wynik))) {\r\n			echo \'<h3>\' . $produkt[\'Name\'] . \'</h3>\' ;\r\n			echo \'<a href=\"\'.$produkt[\'Img\'] .  \'\" data-lightbox=\"example-set\" data-title=\"Model 1\"><img class=\"example-image\" src=\"\'. $produkt[\'Minimg\']. \'\" alt=\"\' . $produkt[\'Alt\'].\'\"/></a>\';\r\n			echo \'<p>\' . $produkt[\'Description\'] . \'</p>\' . PHP_EOL;\r\n	}}', 0),
(3, 'Kontakt', 0, 'echo \'<h3>Kontakt</h3>\' . PHP_EOL;\r\n			\r\necho \'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam tempor sem vitae nisl imperdiet, auctor semper massa ornare. Nulla cursus semper leo, a iaculis arcu accumsan ac. Suspendisse molestie cursus ex ac eleifend. Fusce sagittis quam ipsum, sit amet lacinia mi tincidunt quis. Donec vitae faucibus purus, a dictum tortor. Nulla sed eros at nibh sodales dapibus. Pellentesque blandit metus et mauris cursus consequat. Fusce magna sem, pellentesque sit amet mauris ut, blandit dapibus mauris. Nam tortor mi, aliquet aliquet maximus eget, vestibulum ac mi. Sed tellus purus, commodo sed ullamcorper at, sollicitudin in velit. Suspendisse potenti. Vestibulum consequat nibh ac sagittis efficitur. Donec vehicula tincidunt enim, vel mollis velit luctus a. Aenean in mollis lor\'. PHP_EOL;', 0),
(4, 'SQL', 0, '', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(30) COLLATE utf8_bin NOT NULL,
  `userEmail` varchar(60) COLLATE utf8_bin NOT NULL,
  `userPass` varchar(255) COLLATE utf8_bin NOT NULL,
  `Admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`userId`, `userName`, `userEmail`, `userPass`, `Admin`) VALUES
(1, 'Admin', 'aa@aa.aa', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Sub_Id` (`Sub_Id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Categories_ID` (`Categories_Id`) USING BTREE;

--
-- Indexes for table `sub`
--
ALTER TABLE `sub`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `categories`
--
ALTER TABLE `categories`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `sub`
--
ALTER TABLE `sub`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`Sub_Id`) REFERENCES `sub` (`ID`);

--
-- Ograniczenia dla tabeli `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`Categories_Id`) REFERENCES `categories` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
