-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2025 at 12:27 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sprzet_medyczny`
--

-- --------------------------------------------------------

--
-- Table structure for table `dostawcy`
--

CREATE TABLE `dostawcy` (
  `idDostawcy` int(11) NOT NULL,
  `nazwa` varchar(255) NOT NULL,
  `adres` varchar(255) NOT NULL,
  `telefon` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dostawcy`
--

INSERT INTO `dostawcy` (`idDostawcy`, `nazwa`, `adres`, `telefon`, `email`) VALUES
(1, 'ABC Electronics', 'ul. Elektronowa 1, Warszawa', '123456789', 'kontakt@abcelectronics.pl'),
(2, 'TechSupply', 'ul. Techniczna 15, Kraków', '987654321', 'info@techsupply.pl'),
(3, 'Komputronik', 'ul. Informatyczna 8, Wrocław', '456789123', 'support@komputronik.pl'),
(4, 'ITPro', 'ul. Sieciowa 12, Gdańsk', '789123456', 'biuro@itpro.pl'),
(5, 'GlobalTech', 'ul. Nowoczesna 20, Poznań', '321654987', 'sales@globaltech.pl');

-- --------------------------------------------------------

--
-- Table structure for table `lokalizacje`
--

CREATE TABLE `lokalizacje` (
  `idLokalizacji` int(11) NOT NULL,
  `nazwa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lokalizacje`
--

INSERT INTO `lokalizacje` (`idLokalizacji`, `nazwa`) VALUES
(1, 'Warszawa - Biuro Główne'),
(2, 'Kraków - Oddział'),
(3, 'Wrocław - Magazyn'),
(4, 'Gdańsk - Centrum Serwisowe'),
(5, 'Poznań - Filia');

-- --------------------------------------------------------

--
-- Table structure for table `producenci`
--

CREATE TABLE `producenci` (
  `idProducenta` int(11) NOT NULL,
  `nazwa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `producenci`
--

INSERT INTO `producenci` (`idProducenta`, `nazwa`) VALUES
(1, 'Dell'),
(2, 'HP'),
(3, 'Lenovo'),
(4, 'Asus'),
(5, 'Acer');

-- --------------------------------------------------------

--
-- Table structure for table `sprzety`
--

CREATE TABLE `sprzety` (
  `idSprzetu` int(11) NOT NULL,
  `numerInwentaryzacyjny` varchar(255) NOT NULL,
  `numerSeryjny` varchar(255) NOT NULL,
  `urzadzenie` int(11) NOT NULL,
  `producent` int(11) NOT NULL,
  `model` varchar(255) NOT NULL,
  `lokalizacja` int(11) NOT NULL,
  `dostawca` int(11) NOT NULL,
  `dataZakupu` date NOT NULL,
  `dataGwarancji` date NOT NULL,
  `dataPrzegladu` date NOT NULL,
  `wartoscBrutto` double NOT NULL,
  `status` int(11) NOT NULL,
  `zdjecie` longblob DEFAULT NULL,
  `uwagi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sprzety`
--

INSERT INTO `sprzety` (`idSprzetu`, `numerInwentaryzacyjny`, `numerSeryjny`, `urzadzenie`, `producent`, `model`, `lokalizacja`, `dostawca`, `dataZakupu`, `dataGwarancji`, `dataPrzegladu`, `wartoscBrutto`, `status`, `zdjecie`, `uwagi`) VALUES
(1, 'INV001', 'SN001', 1, 1, 'Inspiron 15', 1, 1, '2022-01-15', '2024-01-15', '2023-12-15', 3500.5, 1, NULL, 'Nowy laptop'),
(2, 'INV002', 'SN002', 2, 2, 'LaserJet 400', 2, 2, '2022-03-20', '2024-03-20', '2023-11-20', 1200, 1, NULL, 'Nowa drukarka'),
(3, 'INV003', 'SN003', 3, 3, 'ThinkServer TS150', 3, 3, '2021-10-01', '2023-10-01', '2023-08-01', 8000, 2, NULL, 'Serwer w użyciu'),
(4, 'INV004', 'SN004', 4, 4, 'ROG Swift PG259QNR', 4, 4, '2021-12-10', '2023-12-10', '2023-10-10', 4500.75, 3, NULL, 'Monitor w naprawie'),
(5, 'INV005', 'SN005', 5, 5, 'Acer H6517ST', 5, 5, '2022-06-15', '2024-06-15', '2023-12-15', 3200, 1, NULL, 'Projektor biurowy'),
(6, 'INV001', 'SN001', 1, 1, 'Inspiron 15', 1, 1, '2023-01-01', '2025-01-01', '2024-01-01', 3000, 1, NULL, 'Uwagi do sprzętu 1'),
(7, 'INV002', 'SN002', 2, 2, 'Pavilion 14', 2, 2, '2023-02-01', '2025-02-01', '2024-02-01', 4000, 2, NULL, 'Uwagi do sprzętu 2'),
(8, 'INV003', 'SN003', 3, 3, 'VivoBook 15', 3, 3, '2023-03-01', '2025-03-01', '2024-03-01', 3500, 3, NULL, 'Uwagi do sprzętu 3'),
(9, 'INV004', 'SN004', 4, 4, 'IdeaPad 3', 4, 4, '2023-04-01', '2025-04-01', '2024-04-01', 2500, 4, NULL, 'Uwagi do sprzętu 4'),
(10, 'INV005', 'SN005', 5, 5, 'Galaxy Tab S8', 5, 5, '2023-05-01', '2025-05-01', '2024-05-01', 5000, 5, NULL, 'Uwagi do sprzętu 5');

-- --------------------------------------------------------

--
-- Table structure for table `statusy`
--

CREATE TABLE `statusy` (
  `idStatusu` int(11) NOT NULL,
  `nazwa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `statusy`
--

INSERT INTO `statusy` (`idStatusu`, `nazwa`) VALUES
(1, 'Nowy'),
(2, 'Używany'),
(3, 'W naprawie'),
(4, 'Wycofany'),
(5, 'Zagubiony');

-- --------------------------------------------------------

--
-- Table structure for table `typy_zdarzen`
--

CREATE TABLE `typy_zdarzen` (
  `idTypu` int(11) NOT NULL,
  `nazwa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `typy_zdarzen`
--

INSERT INTO `typy_zdarzen` (`idTypu`, `nazwa`) VALUES
(1, 'Naprawa'),
(2, 'Przegląd techniczny'),
(3, 'Aktualizacja oprogramowania'),
(4, 'Awaria'),
(5, 'Reklamacja');

-- --------------------------------------------------------

--
-- Table structure for table `urzadzenia`
--

CREATE TABLE `urzadzenia` (
  `idUrzadzenia` int(11) NOT NULL,
  `nazwa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `urzadzenia`
--

INSERT INTO `urzadzenia` (`idUrzadzenia`, `nazwa`) VALUES
(1, 'Laptop'),
(2, 'Drukarka'),
(3, 'Serwer'),
(4, 'Monitor'),
(5, 'Projektor');

-- --------------------------------------------------------

--
-- Table structure for table `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `idUzytkownika` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `grupa_uzytkownika` enum('admin','user') NOT NULL DEFAULT 'user',
  `email` varchar(255) NOT NULL,
  `idLokalizacji` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`idUzytkownika`, `login`, `haslo`, `grupa_uzytkownika`, `email`, `idLokalizacji`) VALUES
(1, 'admin1', 'admin123', 'admin', 'admin1@firma.pl', 1),
(12, 'login1', '$2y$10$Cds5SGSiBh9vIlvqIts7Q.AJhnXG5wgYmHmL.skYgJO/34ZitEb2S', 'admin', 'login1@login1.login1', 1),
(13, 'login2', '$2y$10$SeZtO4hSP2T7wBKhikAb1eO8NhwKyxLPZRAYE1ZhbBItAWtF3lLSm', 'user', 'login1@login1.login2', 1),
(19, 'login3', '$2y$10$qcrL90LR6hb0LrrhfrH25ePZRXcBkKxcfGtc1WW4JwEI7udF9Dx.u', 'user', 'login3@login3.login3', 2),
(20, 'login5', '$2y$10$iDRgZqSKnUL2VrfZjc/cvuH.k2l4PvB0/nm2Za7ApRnVriToD9FtG', 'user', 'login5@gmail.com', 3),
(21, 'login6', '$2y$10$6N7HDY2Etm./n9Qk6aAPkepycFxpSWDdXezdMUUNK.FX0DaKjBdZ.', 'user', 'aosdhak@gmail.cpm', 5),
(22, 'login10', '$2y$10$4p9BS/kmyPtfS5nDa05K1Om72LdRbuCnygTLn9t/FppmfeEitJhVe', 'user', 'login10@gmail.com', 3);

-- --------------------------------------------------------

--
-- Table structure for table `zdarzenia`
--

CREATE TABLE `zdarzenia` (
  `idZdarzenia` int(11) NOT NULL,
  `dataRozpoczecia` date NOT NULL,
  `dataZakonczenia` date NOT NULL,
  `opisZdarzenia` varchar(255) NOT NULL,
  `zalacznik` varchar(255) DEFAULT NULL,
  `idTypu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zdarzenia`
--

INSERT INTO `zdarzenia` (`idZdarzenia`, `dataRozpoczecia`, `dataZakonczenia`, `opisZdarzenia`, `zalacznik`, `idTypu`) VALUES
(1, '2023-01-10', '2023-01-15', 'nic nie dziala', NULL, 1),
(2, '2023-02-05', '2023-02-10', 'wszystko sie rozwalilo', NULL, 2),
(3, '2023-03-01', '2023-03-03', 'nie wiem juz co sie dzieje', NULL, 3),
(4, '2023-04-20', '2023-04-25', 'wszystko to jest chore', NULL, 4),
(5, '2023-05-10', '2023-05-12', 'znowu to samo', NULL, 5),
(16, '2025-02-03', '2025-02-07', 'awaria to ten php', NULL, 4),
(17, '2025-02-03', '2025-02-06', 'aktualizujemy do testu', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `zdarzenie_sprzet`
--

CREATE TABLE `zdarzenie_sprzet` (
  `id` int(11) NOT NULL,
  `sprzet_id` int(11) NOT NULL,
  `zdarzenie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zdarzenie_sprzet`
--

INSERT INTO `zdarzenie_sprzet` (`id`, `sprzet_id`, `zdarzenie_id`) VALUES
(3, 2, 3),
(4, 3, 2),
(5, 5, 4),
(10, 6, 17),
(11, 8, 16),
(12, 1, 1),
(13, 1, 2),
(14, 1, 3),
(15, 1, 4),
(16, 1, 5),
(17, 1, 16),
(18, 1, 17);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dostawcy`
--
ALTER TABLE `dostawcy`
  ADD PRIMARY KEY (`idDostawcy`);

--
-- Indexes for table `lokalizacje`
--
ALTER TABLE `lokalizacje`
  ADD PRIMARY KEY (`idLokalizacji`);

--
-- Indexes for table `producenci`
--
ALTER TABLE `producenci`
  ADD PRIMARY KEY (`idProducenta`);

--
-- Indexes for table `sprzety`
--
ALTER TABLE `sprzety`
  ADD PRIMARY KEY (`idSprzetu`),
  ADD KEY `sprzety_urzadzenia_idUrzadzenia_fk` (`urzadzenie`),
  ADD KEY `sprzety_producenci_idProducenta_fk` (`producent`),
  ADD KEY `sprzety_lokalizacje_idLokalizacji_fk` (`lokalizacja`),
  ADD KEY `sprzety_dostawcy_idDostawcy_fk` (`dostawca`),
  ADD KEY `sprzety_statusy_idStatusu_fk` (`status`);

--
-- Indexes for table `statusy`
--
ALTER TABLE `statusy`
  ADD PRIMARY KEY (`idStatusu`);

--
-- Indexes for table `typy_zdarzen`
--
ALTER TABLE `typy_zdarzen`
  ADD PRIMARY KEY (`idTypu`);

--
-- Indexes for table `urzadzenia`
--
ALTER TABLE `urzadzenia`
  ADD PRIMARY KEY (`idUrzadzenia`);

--
-- Indexes for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`idUzytkownika`),
  ADD KEY `uzytkownicy_lokalizacje_idLokalizacji_fk` (`idLokalizacji`);

--
-- Indexes for table `zdarzenia`
--
ALTER TABLE `zdarzenia`
  ADD PRIMARY KEY (`idZdarzenia`),
  ADD KEY `zdarzenia_typy_zdarzen_idTypu_fk` (`idTypu`);

--
-- Indexes for table `zdarzenie_sprzet`
--
ALTER TABLE `zdarzenie_sprzet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `zdarzenie_sprzet_sprzety_idSprzetu_fk` (`sprzet_id`),
  ADD KEY `zdarzenie_sprzet_zdarzenia_idZdarzenia_fk` (`zdarzenie_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dostawcy`
--
ALTER TABLE `dostawcy`
  MODIFY `idDostawcy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lokalizacje`
--
ALTER TABLE `lokalizacje`
  MODIFY `idLokalizacji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `producenci`
--
ALTER TABLE `producenci`
  MODIFY `idProducenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sprzety`
--
ALTER TABLE `sprzety`
  MODIFY `idSprzetu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `statusy`
--
ALTER TABLE `statusy`
  MODIFY `idStatusu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `typy_zdarzen`
--
ALTER TABLE `typy_zdarzen`
  MODIFY `idTypu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `urzadzenia`
--
ALTER TABLE `urzadzenia`
  MODIFY `idUrzadzenia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `idUzytkownika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `zdarzenia`
--
ALTER TABLE `zdarzenia`
  MODIFY `idZdarzenia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `zdarzenie_sprzet`
--
ALTER TABLE `zdarzenie_sprzet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sprzety`
--
ALTER TABLE `sprzety`
  ADD CONSTRAINT `sprzety_dostawcy_idDostawcy_fk` FOREIGN KEY (`dostawca`) REFERENCES `dostawcy` (`idDostawcy`),
  ADD CONSTRAINT `sprzety_lokalizacje_idLokalizacji_fk` FOREIGN KEY (`lokalizacja`) REFERENCES `lokalizacje` (`idLokalizacji`),
  ADD CONSTRAINT `sprzety_producenci_idProducenta_fk` FOREIGN KEY (`producent`) REFERENCES `producenci` (`idProducenta`),
  ADD CONSTRAINT `sprzety_statusy_idStatusu_fk` FOREIGN KEY (`status`) REFERENCES `statusy` (`idStatusu`),
  ADD CONSTRAINT `sprzety_urzadzenia_idUrzadzenia_fk` FOREIGN KEY (`urzadzenie`) REFERENCES `urzadzenia` (`idUrzadzenia`);

--
-- Constraints for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD CONSTRAINT `uzytkownicy_lokalizacje_idLokalizacji_fk` FOREIGN KEY (`idLokalizacji`) REFERENCES `lokalizacje` (`idLokalizacji`);

--
-- Constraints for table `zdarzenia`
--
ALTER TABLE `zdarzenia`
  ADD CONSTRAINT `zdarzenia_typy_zdarzen_idTypu_fk` FOREIGN KEY (`idTypu`) REFERENCES `typy_zdarzen` (`idTypu`);

--
-- Constraints for table `zdarzenie_sprzet`
--
ALTER TABLE `zdarzenie_sprzet`
  ADD CONSTRAINT `zdarzenie_sprzet_sprzety_idSprzetu_fk` FOREIGN KEY (`sprzet_id`) REFERENCES `sprzety` (`idSprzetu`),
  ADD CONSTRAINT `zdarzenie_sprzet_zdarzenia_idZdarzenia_fk` FOREIGN KEY (`zdarzenie_id`) REFERENCES `zdarzenia` (`idZdarzenia`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
