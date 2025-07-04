-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Lug 04, 2025 alle 22:29
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scuolaguida`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `avviso`
--

CREATE TABLE `avviso` (
  `num_avviso` int(11) NOT NULL,
  `avviso` text NOT NULL,
  `data_creazione` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `avviso`
--

INSERT INTO `avviso` (`num_avviso`, `avviso`, `data_creazione`) VALUES
(1, 'Domani 3/05/2025 sarà chiuso.', '2025-05-07 00:14:02'),
(2, 'salve volevo comunicare che il giorno 07/05/2025 verrà il medico per fare le visite alle ore 19:00.', '2025-05-07 00:14:06'),
(6, 'Nuovo avviso', '2025-07-04 16:34:02'),
(35, 'La scuola guida resterà chiusa il 15 agosto per festività', '2025-07-04 16:10:12');

-- --------------------------------------------------------

--
-- Struttura della tabella `insegnante`
--

CREATE TABLE `insegnante` (
  `codiceFiscale` char(16) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `cognome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `data_creazione` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `insegnante`
--

INSERT INTO `insegnante` (`codiceFiscale`, `nome`, `cognome`, `email`, `telefono`, `password`, `data_creazione`) VALUES
('lucalucaluca2000', 'luca', 'lala', 'luca@gmail.com', '3334446667', '$2y$10$BuQKuAMsbSirhY//kQPomeqvfKTOtpLGuhsY6ZioNsK/C8b9G4P1K', '2025-05-02 22:32:03');

-- --------------------------------------------------------

--
-- Struttura della tabella `orari`
--

CREATE TABLE `orari` (
  `id` int(11) NOT NULL,
  `giorno` varchar(20) NOT NULL,
  `orari` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `orari`
--

INSERT INTO `orari` (`id`, `giorno`, `orari`) VALUES
(1, 'Lunedì', '8:00/12:00 - 13:00/17:00'),
(2, 'Martedì', ''),
(3, 'Mercoledì', '9:00/11:00 - 14:00/18:00'),
(4, 'Giovedì', ''),
(5, 'Venerdì', '8:00/10:00 - 13:00/19:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `patente`
--

CREATE TABLE `patente` (
  `num_patente` int(11) NOT NULL,
  `patente` varchar(5) NOT NULL,
  `mezzi` varchar(255) DEFAULT NULL,
  `eta` varchar(100) DEFAULT NULL,
  `veicolo` varchar(255) DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `info` text DEFAULT NULL,
  `orari` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `patente`
--

INSERT INTO `patente` (`num_patente`, `patente`, `mezzi`, `eta`, `veicolo`, `foto`, `info`, `orari`) VALUES
(1, 'A', 'Motocicli senza limiti di cilindrata', '24 anni (oppure 20 anni con 2 anni di patente A2)', 'Honda CB650R, Yamaha MT-07', ' ', 'informazioni piu avanti', 'Lun 12:00/13:00 - Mer 16:00/17:00'),
(2, 'A1', 'Motocicli fino a 125cc', '16', 'Yamaha YBR 125', ' ', 'informazioni piu avanti', 'Lun 13:00/14:00 - Mer 17:00/18:00'),
(3, 'B', 'Autoveicoli fino a 3.500 kg', '18', 'Volkswagen Polo', ' ', 'informazioni piu avanti', 'Lun 14:00/16:00 - Mer 14:00/16:00 - Ven 8:00/10:00'),
(4, 'B+E', 'Veicoli con rimorchio pesante', '18', 'Ford Transit con carrello', ' ', 'informazioni piu avanti', 'Lun 8:00/10:00 - Ven 14:00/16:00'),
(5, 'C', 'autocarri sopra i 3.500 kg', '21', 'Iveco Eurocargo', ' ', 'informazioni piu avanti', 'Lun 10:00/12:00 - Ven  13:00/14:00'),
(6, 'D', 'Autobus con più di 9 posti', '24', 'Iveco Crossway', ' ', 'informazioni piu avanti', 'Ven 16:00/19:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `patenti_utente`
--

CREATE TABLE `patenti_utente` (
  `codiceFiscale` char(16) NOT NULL,
  `patente` varchar(5) NOT NULL,
  `num_guide` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `patenti_utente`
--

INSERT INTO `patenti_utente` (`codiceFiscale`, `patente`, `num_guide`) VALUES
('annaannaanna2000', 'B+E', 0),
('niconiconico2000', 'A', 2),
('niconiconico2000', 'C', 3),
('simonsimonsimon5', 'A', 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `prenotazione`
--

CREATE TABLE `prenotazione` (
  `num_prenotazione` int(11) NOT NULL,
  `codiceFiscale` char(16) DEFAULT NULL,
  `patente` varchar(5) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `ora` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `prenotazione`
--

INSERT INTO `prenotazione` (`num_prenotazione`, `codiceFiscale`, `patente`, `data`, `ora`) VALUES
(1, 'annaannaanna2000', 'A', '2025-05-13', '14:00:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `codiceFiscale` char(16) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `cognome` varchar(100) CHARACTER SET armscii8 COLLATE armscii8_general_ci DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `data_creazione` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`codiceFiscale`, `nome`, `cognome`, `password`, `data_creazione`) VALUES
('annaannaanna2000', 'nzico', 'anna', '1234', '2025-05-08 19:41:40'),
('niconiconico2000', 'nico', 'ni', '1234', '2025-05-08 13:44:08'),
('simonsimonsimon5', 'sim', 'lazzari', '1234', '2025-05-08 12:36:18');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `avviso`
--
ALTER TABLE `avviso`
  ADD PRIMARY KEY (`num_avviso`);

--
-- Indici per le tabelle `insegnante`
--
ALTER TABLE `insegnante`
  ADD PRIMARY KEY (`codiceFiscale`);

--
-- Indici per le tabelle `orari`
--
ALTER TABLE `orari`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `patente`
--
ALTER TABLE `patente`
  ADD PRIMARY KEY (`num_patente`),
  ADD UNIQUE KEY `patente` (`patente`);

--
-- Indici per le tabelle `patenti_utente`
--
ALTER TABLE `patenti_utente`
  ADD PRIMARY KEY (`codiceFiscale`,`patente`),
  ADD KEY `patente` (`patente`);

--
-- Indici per le tabelle `prenotazione`
--
ALTER TABLE `prenotazione`
  ADD PRIMARY KEY (`num_prenotazione`),
  ADD KEY `codiceFiscale` (`codiceFiscale`),
  ADD KEY `prenotazione_ibfk_2` (`patente`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`codiceFiscale`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `avviso`
--
ALTER TABLE `avviso`
  MODIFY `num_avviso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT per la tabella `orari`
--
ALTER TABLE `orari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `patente`
--
ALTER TABLE `patente`
  MODIFY `num_patente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT per la tabella `prenotazione`
--
ALTER TABLE `prenotazione`
  MODIFY `num_prenotazione` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `patenti_utente`
--
ALTER TABLE `patenti_utente`
  ADD CONSTRAINT `patenti_utente_ibfk_1` FOREIGN KEY (`codiceFiscale`) REFERENCES `utente` (`codiceFiscale`) ON DELETE CASCADE,
  ADD CONSTRAINT `patenti_utente_ibfk_2` FOREIGN KEY (`patente`) REFERENCES `patente` (`patente`) ON DELETE CASCADE;

--
-- Limiti per la tabella `prenotazione`
--
ALTER TABLE `prenotazione`
  ADD CONSTRAINT `prenotazione_ibfk_1` FOREIGN KEY (`codiceFiscale`) REFERENCES `utente` (`codiceFiscale`),
  ADD CONSTRAINT `prenotazione_ibfk_2` FOREIGN KEY (`patente`) REFERENCES `patente` (`patente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
