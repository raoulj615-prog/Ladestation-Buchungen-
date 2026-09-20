-- phpMyAdmin SQL Dump
-- VoltReserve - SQL-Dump für die Abgabe

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `meine_db`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `stations`
--

CREATE TABLE `stations` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `power_kw` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `price_kwh` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Daten für Tabelle `stations`
--

INSERT INTO `stations` (`id`, `name`, `power_kw`, `type`, `price_kwh`) VALUES
(1, 'Säule 1 - Friedberg Süd', 11, 'Typ 2 AC', 0.45),
(2, 'Säule 2 - Campus Friedberg', 22, 'Typ 2 AC', 0.49),
(3, 'Säule 3 - Schnelllader A5', 150, 'CCS DC', 0.69);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `station_id` int(11) NOT NULL,
  `license_plate` varchar(20) NOT NULL,
  `start_time` datetime NOT NULL,
  `duration_hours` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Indizes für Tabelle `stations`
--

ALTER TABLE `stations`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für Tabelle `users`
--

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indizes für Tabelle `bookings`
--

ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `station_id` (`station_id`),
  ADD KEY `fk_bookings_user` (`user_id`);

-- --------------------------------------------------------

--
-- AUTO_INCREMENT für Tabelle `stations`
--

ALTER TABLE `stations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `users`
--

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `bookings`
--

ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------

--
-- Constraints für Tabelle `bookings`
--

ALTER TABLE `bookings`
  ADD CONSTRAINT `fk_bookings_station`
    FOREIGN KEY (`station_id`) REFERENCES `stations` (`id`)
    ON DELETE CASCADE,
  ADD CONSTRAINT `fk_bookings_user`
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
    ON DELETE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;