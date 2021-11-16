-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 07 Sty 2021, 18:45
-- Wersja serwera: 10.4.13-MariaDB
-- Wersja PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `strona`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `bufor_k`
--

CREATE TABLE `bufor_k` (
  `id` int(11) NOT NULL,
  `id_ksiazki` int(11) NOT NULL,
  `id_uzytkownika` int(11) NOT NULL,
  `tytul` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `autor` varchar(100) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `gatunek` int(11) NOT NULL,
  `wydawnictwo` varchar(200) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `zdjecie` int(11) NOT NULL,
  `data_dodania` date NOT NULL,
  `opis` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `bufor_k`
--

INSERT INTO `bufor_k` (`id`, `id_ksiazki`, `id_uzytkownika`, `tytul`, `autor`, `gatunek`, `wydawnictwo`, `zdjecie`, `data_dodania`, `opis`) VALUES
(2, 8, 1, '1', '1', 3, '1', 1, '2020-12-10', '1'),
(3, 9, 1, '2', '2', 3, '2', 2, '2020-12-10', '2'),
(4, 9, 1, '2', '2', 3, '2', 2, '2020-12-10', '2'),
(5, 15, 1, '1', '1', 3, '1', 1, '2020-12-11', '1'),
(6, 15, 1, '1', '1', 3, '1', 1, '2020-12-11', '1'),
(7, 15, 1, '1', '1', 3, '1', 1, '2020-12-11', '1'),
(8, 15, 1, '1', '1', 3, '1', 1, '2020-12-11', '1');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `gatunek`
--

CREATE TABLE `gatunek` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `gatunek`
--

INSERT INTO `gatunek` (`id`, `nazwa`) VALUES
(1, 'biografia'),
(2, 'biznes-ekonomia'),
(3, 'fantastyka'),
(4, 'kryminal'),
(5, 'kuchnia'),
(6, 'literatura faktu'),
(7, 'lektury szkolne/powiesci naukowe'),
(8, 'inne');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ksiazka`
--

CREATE TABLE `ksiazka` (
  `id` int(11) NOT NULL,
  `id_uzytkownika` int(11) NOT NULL,
  `tytul` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `autor` varchar(100) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `gatunek` int(11) NOT NULL,
  `wydawnictwo` varchar(200) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `zdjecie` int(11) NOT NULL,
  `data_dodania` date NOT NULL,
  `opis` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `ksiazka`
--

INSERT INTO `ksiazka` (`id`, `id_uzytkownika`, `tytul`, `autor`, `gatunek`, `wydawnictwo`, `zdjecie`, `data_dodania`, `opis`) VALUES
(15, 1, '1', '1', 3, '1', 1, '2020-12-11', '1');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `imie` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `mail` varchar(100) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `haslo` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `lbpremium` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `imie`, `nazwisko`, `mail`, `haslo`, `lbpremium`) VALUES
(1, 'Mateusz', 'Solarczyk', 'matsolarczyk@wp.pl', 'panmateusz', 5),
(4, 'Patryk', 'Szczepański', 'patryk.szepanski@wp.pl', 'panpatryk', 5),
(5, 'Karolina', 'Kolcun', 'karolina.kolcun@wp.pl', 'panikarolina', 5),
(6, 'Karol', 'Sroka', 'karol.sroka@wp.pl', 'pankarol', 2),
(7, 'Ewa', 'Solarczyk', 'ewa.solarczyk@wp.pl', 'paniewa', 5),
(8, 'jacek', 'Kowalski', 'nazwa@poczta.pl', 'haslo123', 5),
(10, 'Marek', 'Rydzyk', 'marek@poczta.pl', 'panamrek', 5),
(11, 'damian', 'kalemba', 'kalemba@damian.pl', 'pandamian', 5),
(12, 'damian', 'antoniow', 'damian@antoniow.pl', 'pandamian', 5);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wymiany`
--

CREATE TABLE `wymiany` (
  `id_wymiany` int(11) NOT NULL,
  `id_pozyczajacego` int(11) NOT NULL,
  `id_oddajacej` int(11) NOT NULL,
  `id_ksiazki` int(11) NOT NULL,
  `data` date NOT NULL,
  `status` varchar(20) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `wymiany`
--

INSERT INTO `wymiany` (`id_wymiany`, `id_pozyczajacego`, `id_oddajacej`, `id_ksiazki`, `data`, `status`) VALUES
(67, 1, 1, 15, '2020-12-11', 'czeka na wysyłke');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `bufor_k`
--
ALTER TABLE `bufor_k`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `gatunek`
--
ALTER TABLE `gatunek`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `ksiazka`
--
ALTER TABLE `ksiazka`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gatunek` (`gatunek`),
  ADD KEY `id_uzytkownika` (`id_uzytkownika`),
  ADD KEY `id` (`id`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indeksy dla tabeli `wymiany`
--
ALTER TABLE `wymiany`
  ADD PRIMARY KEY (`id_wymiany`),
  ADD KEY `id_pozyczajacego` (`id_pozyczajacego`),
  ADD KEY `id_oddajacej` (`id_oddajacej`),
  ADD KEY `id_ksiazki` (`id_ksiazki`),
  ADD KEY `id_ksiazki_2` (`id_ksiazki`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `bufor_k`
--
ALTER TABLE `bufor_k`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `gatunek`
--
ALTER TABLE `gatunek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `ksiazka`
--
ALTER TABLE `ksiazka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT dla tabeli `wymiany`
--
ALTER TABLE `wymiany`
  MODIFY `id_wymiany` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `ksiazka`
--
ALTER TABLE `ksiazka`
  ADD CONSTRAINT `ksiazka_ibfk_1` FOREIGN KEY (`gatunek`) REFERENCES `gatunek` (`id`),
  ADD CONSTRAINT `ksiazka_ibfk_2` FOREIGN KEY (`id_uzytkownika`) REFERENCES `uzytkownicy` (`id`);

--
-- Ograniczenia dla tabeli `wymiany`
--
ALTER TABLE `wymiany`
  ADD CONSTRAINT `wymiany_ibfk_1` FOREIGN KEY (`id_pozyczajacego`) REFERENCES `uzytkownicy` (`id`),
  ADD CONSTRAINT `wymiany_ibfk_2` FOREIGN KEY (`id_oddajacej`) REFERENCES `uzytkownicy` (`id`),
  ADD CONSTRAINT `wymiany_ibfk_3` FOREIGN KEY (`id_ksiazki`) REFERENCES `ksiazka` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
