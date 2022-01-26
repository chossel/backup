-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 26 jan 2022 om 09:50
-- Serverversie: 10.4.17-MariaDB
-- PHP-versie: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `excellenttaste`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestelling`
--

CREATE TABLE `bestelling` (
  `ID` int(11) NOT NULL,
  `Reservering_ID` int(11) NOT NULL,
  `Menuitem_ID` int(11) NOT NULL,
  `Aantal` int(11) NOT NULL,
  `Geserveerd` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gerechtcategorien`
--

CREATE TABLE `gerechtcategorien` (
  `ID` int(11) NOT NULL,
  `Code` varchar(3) NOT NULL,
  `Naam` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gerechtsoorten`
--

CREATE TABLE `gerechtsoorten` (
  `ID` int(11) NOT NULL,
  `Code` varchar(3) NOT NULL,
  `Naam` varchar(20) NOT NULL,
  `Gerechtcategorie_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klanten`
--

CREATE TABLE `klanten` (
  `ID` int(11) NOT NULL,
  `Naam` varchar(20) NOT NULL,
  `Telefoon` varchar(11) NOT NULL,
  `Email` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `menuitems`
--

CREATE TABLE `menuitems` (
  `ID` int(11) NOT NULL,
  `Code` varchar(4) NOT NULL,
  `Naam` varchar(30) NOT NULL,
  `Gerechtsoort_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reserveringen`
--

CREATE TABLE `reserveringen` (
  `ID` int(11) NOT NULL,
  `Tafl` int(11) NOT NULL,
  `Datum` date NOT NULL,
  `Tijd` time NOT NULL,
  `Klant_ID` int(11) NOT NULL,
  `Aantal` int(11) NOT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT 1,
  `Datum_toegevoegd` timestamp NOT NULL DEFAULT current_timestamp(),
  `Aantal_K` int(11) NOT NULL DEFAULT 0,
  `Allergieen` text NOT NULL,
  `Opmerkingen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bestelling`
--
ALTER TABLE `bestelling`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Reservering_ID` (`Reservering_ID`),
  ADD KEY `Menuitem_ID` (`Menuitem_ID`);

--
-- Indexen voor tabel `gerechtcategorien`
--
ALTER TABLE `gerechtcategorien`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Code` (`Code`);

--
-- Indexen voor tabel `gerechtsoorten`
--
ALTER TABLE `gerechtsoorten`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Code` (`Code`),
  ADD KEY `Gerechtcategorie_ID` (`Gerechtcategorie_ID`);

--
-- Indexen voor tabel `klanten`
--
ALTER TABLE `klanten`
  ADD PRIMARY KEY (`ID`);

--
-- Indexen voor tabel `menuitems`
--
ALTER TABLE `menuitems`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Code` (`Code`),
  ADD KEY `Gerechtsoort_ID` (`Gerechtsoort_ID`);

--
-- Indexen voor tabel `reserveringen`
--
ALTER TABLE `reserveringen`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Datum` (`Datum`),
  ADD UNIQUE KEY `Tijd` (`Tijd`),
  ADD KEY `Klant_ID` (`Klant_ID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bestelling`
--
ALTER TABLE `bestelling`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `gerechtcategorien`
--
ALTER TABLE `gerechtcategorien`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `gerechtsoorten`
--
ALTER TABLE `gerechtsoorten`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `klanten`
--
ALTER TABLE `klanten`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `menuitems`
--
ALTER TABLE `menuitems`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `reserveringen`
--
ALTER TABLE `reserveringen`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `bestelling`
--
ALTER TABLE `bestelling`
  ADD CONSTRAINT `bestelling_ibfk_1` FOREIGN KEY (`Reservering_ID`) REFERENCES `reserveringen` (`ID`),
  ADD CONSTRAINT `bestelling_ibfk_2` FOREIGN KEY (`Menuitem_ID`) REFERENCES `menuitems` (`ID`);

--
-- Beperkingen voor tabel `gerechtsoorten`
--
ALTER TABLE `gerechtsoorten`
  ADD CONSTRAINT `gerechtsoorten_ibfk_1` FOREIGN KEY (`Gerechtcategorie_ID`) REFERENCES `gerechtcategorien` (`ID`);

--
-- Beperkingen voor tabel `menuitems`
--
ALTER TABLE `menuitems`
  ADD CONSTRAINT `menuitems_ibfk_1` FOREIGN KEY (`Gerechtsoort_ID`) REFERENCES `gerechtsoorten` (`ID`);

--
-- Beperkingen voor tabel `reserveringen`
--
ALTER TABLE `reserveringen`
  ADD CONSTRAINT `reserveringen_ibfk_1` FOREIGN KEY (`Klant_ID`) REFERENCES `klanten` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
