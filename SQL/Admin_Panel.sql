-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Creato il: Apr 14, 2023 alle 10:04
-- Versione del server: 5.7.34
-- Versione PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Admin_Panel`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `agenda`
--

CREATE TABLE `agenda` (
  `id` int(11) NOT NULL,
  `dataIns` date NOT NULL,
  `dataScad` date NOT NULL,
  `textMess` text NOT NULL,
  `autore` text NOT NULL,
  `titolo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `agenda`
--

INSERT INTO `agenda` (`id`, `dataIns`, `dataScad`, `textMess`, `autore`, `titolo`) VALUES
(8, '2023-03-31', '2023-04-09', 'prova', 'Prova Root', 'prova'),
(9, '2023-03-31', '2023-04-09', 'dsda', 'Prova Root', 'prova 2'),
(10, '2023-03-31', '2023-04-02', 'prova 3', 'Prova Root', 'prova 3'),
(11, '2023-03-31', '2023-05-07', 'prova 4', 'Prova Root', 'prova 4'),
(12, '2023-03-31', '2023-03-02', 'ffsfds', 'Prova Root', 'fds'),
(13, '2023-03-31', '2023-04-01', 'prova 5', 'Prova Root', 'prova 5'),
(14, '2023-03-31', '2023-04-02', 'prova 6', 'Prova Root', 'prova 6'),
(15, '2023-03-31', '2023-04-04', 'prova 7', 'Prova Root', 'prova 7'),
(16, '2023-04-03', '2023-04-04', 'jbdakbjkdfask', 'Rocchini Alessia', 'Consegnare foglio'),
(17, '2023-04-03', '2023-04-03', 'Scadenza oggi', 'Rocchini Alessia', 'Scadenza oggi'),
(18, '2023-04-03', '2023-04-03', 'cca', 'Rocchini Alessia', 'Ciao a tutti'),
(19, '2023-04-03', '2023-04-05', 'kfdanfdlsfn', 'Prova Root', 'Prova scadenza'),
(20, '2023-04-11', '2023-04-11', 'Prova', 'Prova Root', 'Prova Scadenza');

-- --------------------------------------------------------

--
-- Struttura della tabella `allenatore`
--

CREATE TABLE `allenatore` (
  `id` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `grado_fipav` int(1) NOT NULL,
  `cod_cartellino` int(11) NOT NULL,
  `qualifica` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `campionato`
--

CREATE TABLE `campionato` (
  `id` int(11) NOT NULL,
  `nome` int(11) NOT NULL,
  `fascia_inizio` int(4) NOT NULL,
  `fascia_fine` int(4) NOT NULL,
  `girone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `categoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `categorie`
--

INSERT INTO `categorie` (`id`, `categoria`) VALUES
(1, 'GIOCATORE'),
(2, 'DIRIGENTE'),
(3, 'ALLENATORE'),
(4, 'PRESIDENTE'),
(5, 'SEGRETERIA'),
(6, 'DIRETTORE TECNICO'),
(7, 'DIRETTORE SPORTIVO'),
(8, 'MEDICO');

-- --------------------------------------------------------

--
-- Struttura della tabella `certificato`
--

CREATE TABLE `certificato` (
  `id` int(11) NOT NULL,
  `numeroCertificato` varchar(255) NOT NULL,
  `dataEsame` date NOT NULL,
  `dataScadenza` date NOT NULL,
  `dottore` varchar(255) NOT NULL,
  `struttura` varchar(255) NOT NULL,
  `id_tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `certificato`
--

INSERT INTO `certificato` (`id`, `numeroCertificato`, `dataEsame`, `dataScadenza`, `dottore`, `struttura`, `id_tipo`) VALUES
(1, '07625FIWE90', '2023-03-07', '2024-03-07', 'Rossi Alberto', 'Diagnosi in Tempo', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `contatto`
--

CREATE TABLE `contatto` (
  `id` int(11) NOT NULL,
  `prefissoCell` varchar(3) NOT NULL,
  `cellulare` varchar(10) NOT NULL,
  `fisso` varchar(10) DEFAULT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `contatto`
--

INSERT INTO `contatto` (`id`, `prefissoCell`, `cellulare`, `fisso`, `email`) VALUES
(1, '39', '3911803593', NULL, 'teriaca.mattia@gmail.com'),
(2, '39', '3477534508', NULL, 'prova@example.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `dati_Societa`
--

CREATE TABLE `dati_Societa` (
  `partita_iva` varchar(11) NOT NULL,
  `nome_legale` varchar(255) NOT NULL,
  `id_contatti` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `dati_Societa`
--

INSERT INTO `dati_Societa` (`partita_iva`, `nome_legale`, `id_contatti`) VALUES
('59218690416', 'Savino del Bene Volley', 100);

-- --------------------------------------------------------

--
-- Struttura della tabella `dirigente`
--

CREATE TABLE `dirigente` (
  `id` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `codice_tesseramento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `documento`
--

CREATE TABLE `documento` (
  `id` int(11) NOT NULL,
  `numero_documento` varchar(255) NOT NULL,
  `scadenza` date NOT NULL,
  `id_tipologia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `documento`
--

INSERT INTO `documento` (`id`, `numero_documento`, `scadenza`, `id_tipologia`) VALUES
(1, 'CA47678MU', '2027-08-13', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `genitore`
--

CREATE TABLE `genitore` (
  `id` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `ruolo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `gioca`
--

CREATE TABLE `gioca` (
  `id_giocatore` int(11) NOT NULL,
  `id_squadra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `gioca`
--

INSERT INTO `gioca` (`id_giocatore`, `id_squadra`) VALUES
(1, 6),
(2, 7);

-- --------------------------------------------------------

--
-- Struttura della tabella `giocatore`
--

CREATE TABLE `giocatore` (
  `id` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_certificato` int(11) NOT NULL,
  `num_maglia` int(2) NOT NULL DEFAULT '0',
  `ruolo` text,
  `url_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `giocatore`
--

INSERT INTO `giocatore` (`id`, `id_persona`, `id_certificato`, `num_maglia`, `ruolo`, `url_img`) VALUES
(1, 1, 1, 16, 'alzatore', '01'),
(2, 2, 0, 3, 'Libero', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `partita`
--

CREATE TABLE `partita` (
  `cod_partita` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `orario` time NOT NULL,
  `luogo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `persona`
--

CREATE TABLE `persona` (
  `cod_utente` int(11) NOT NULL,
  `cod_fiscale` varchar(16) NOT NULL,
  `cognome` text NOT NULL,
  `nome` text NOT NULL,
  `id_sesso` int(11) NOT NULL,
  `id_titolo` int(11) NOT NULL,
  `data_nascita` date NOT NULL,
  `luogo_nascita` text NOT NULL,
  `provinciaNascita` varchar(2) NOT NULL,
  `nazione_nascita` text NOT NULL,
  `dataCreazione` date DEFAULT NULL,
  `id_contatti` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_residenza` int(11) NOT NULL,
  `id_documento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `persona`
--

INSERT INTO `persona` (`cod_utente`, `cod_fiscale`, `cognome`, `nome`, `id_sesso`, `id_titolo`, `data_nascita`, `luogo_nascita`, `provinciaNascita`, `nazione_nascita`, `dataCreazione`, `id_contatti`, `id_categoria`, `id_residenza`, `id_documento`) VALUES
(1, 'TRCMTT04P13D612R', 'Teriaca', 'Mattia', 1, 1, '2004-09-13', 'Firenze', 'FI', 'Italia', '2023-04-01', 1, 1, 1, 1),
(2, 'SZPMGR26C41E968Y', 'Szpilewicz', 'Margarita', 0, 0, '2000-01-03', 'Maropati', '', 'Italia', NULL, 2, 1, 0, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `residenza`
--

CREATE TABLE `residenza` (
  `id` int(11) NOT NULL,
  `tipologia` varchar(255) NOT NULL,
  `indirizzo` varchar(255) NOT NULL,
  `civico` int(11) NOT NULL,
  `citta` varchar(255) NOT NULL,
  `cap` int(11) NOT NULL,
  `provincia` varchar(2) NOT NULL,
  `nazione` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `residenza`
--

INSERT INTO `residenza` (`id`, `tipologia`, `indirizzo`, `civico`, `citta`, `cap`, `provincia`, `nazione`) VALUES
(1, 'Via', 'Alfredo Contini', 7, 'Sesto Fiorentino', 50019, 'FI', 'Italia');

-- --------------------------------------------------------

--
-- Struttura della tabella `sesso`
--

CREATE TABLE `sesso` (
  `id` int(11) NOT NULL,
  `sesso` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `sesso`
--

INSERT INTO `sesso` (`id`, `sesso`) VALUES
(1, 'Maschio'),
(2, 'Femmina');

-- --------------------------------------------------------

--
-- Struttura della tabella `squadra`
--

CREATE TABLE `squadra` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `ID_stagioneSportiva` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `squadra`
--

INSERT INTO `squadra` (`id`, `nome`, `ID_stagioneSportiva`) VALUES
(1, 'Volley S3 I livello', 1),
(2, 'Volley S3 II livello', 1),
(3, 'Under 13', 1),
(4, 'Under 15', 1),
(5, 'Under 17', 1),
(6, 'Under 19', 1),
(7, 'Serie D', 1),
(8, 'Serie C', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `stagioniSportive`
--

CREATE TABLE `stagioniSportive` (
  `id` int(11) NOT NULL,
  `annoInizio` int(4) NOT NULL,
  `annoFine` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `stagioniSportive`
--

INSERT INTO `stagioniSportive` (`id`, `annoInizio`, `annoFine`) VALUES
(1, 2022, 2023);

-- --------------------------------------------------------

--
-- Struttura della tabella `tipologiaDocumento`
--

CREATE TABLE `tipologiaDocumento` (
  `id` int(11) NOT NULL,
  `tipologia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `tipologiaDocumento`
--

INSERT INTO `tipologiaDocumento` (`id`, `tipologia`) VALUES
(1, 'Carta Identità Digitale'),
(2, 'Carta Identità Cartacea'),
(3, 'Passaporto'),
(4, 'Patente di Guida'),
(5, 'Altro...');

-- --------------------------------------------------------

--
-- Struttura della tabella `tipologieCertificato`
--

CREATE TABLE `tipologieCertificato` (
  `id` int(11) NOT NULL,
  `tipologia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `tipologieCertificato`
--

INSERT INTO `tipologieCertificato` (`id`, `tipologia`) VALUES
(1, 'Agonistico >40'),
(2, 'Agonistico <40'),
(3, 'Non agonistico');

-- --------------------------------------------------------

--
-- Struttura della tabella `titolo`
--

CREATE TABLE `titolo` (
  `id` int(11) NOT NULL,
  `titolo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `titolo`
--

INSERT INTO `titolo` (`id`, `titolo`) VALUES
(1, 'Sig.'),
(2, 'Sig. ra'),
(3, 'Avv.'),
(4, 'Dott.'),
(5, 'Dr.'),
(6, 'Dott. ssa'),
(7, 'Ing.'),
(8, 'Prof.'),
(9, 'Sig. na');

-- --------------------------------------------------------

--
-- Struttura della tabella `userData`
--

CREATE TABLE `userData` (
  `id` int(11) NOT NULL,
  `nome` text NOT NULL,
  `cognome` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `userData`
--

INSERT INTO `userData` (`id`, `nome`, `cognome`, `email`, `password`) VALUES
(1, 'Root', 'Prova', 'admin@root.com', 'adminRoot'),
(2, 'Daniel', 'Vinari', 'vinaridaniel@gmail.com', 'admin'),
(3, 'Alessia', 'Rocchini', 'alessia.rocchini@gmail.com', 'admin');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `allenatore`
--
ALTER TABLE `allenatore`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `campionato`
--
ALTER TABLE `campionato`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `certificato`
--
ALTER TABLE `certificato`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `contatto`
--
ALTER TABLE `contatto`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `dati_Societa`
--
ALTER TABLE `dati_Societa`
  ADD PRIMARY KEY (`partita_iva`);

--
-- Indici per le tabelle `dirigente`
--
ALTER TABLE `dirigente`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `genitore`
--
ALTER TABLE `genitore`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `gioca`
--
ALTER TABLE `gioca`
  ADD PRIMARY KEY (`id_giocatore`,`id_squadra`);

--
-- Indici per le tabelle `giocatore`
--
ALTER TABLE `giocatore`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `partita`
--
ALTER TABLE `partita`
  ADD PRIMARY KEY (`cod_partita`);

--
-- Indici per le tabelle `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`cod_utente`,`cod_fiscale`);

--
-- Indici per le tabelle `residenza`
--
ALTER TABLE `residenza`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `sesso`
--
ALTER TABLE `sesso`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `squadra`
--
ALTER TABLE `squadra`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `stagioniSportive`
--
ALTER TABLE `stagioniSportive`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `tipologiaDocumento`
--
ALTER TABLE `tipologiaDocumento`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `tipologieCertificato`
--
ALTER TABLE `tipologieCertificato`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `titolo`
--
ALTER TABLE `titolo`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `userData`
--
ALTER TABLE `userData`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT per la tabella `allenatore`
--
ALTER TABLE `allenatore`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `campionato`
--
ALTER TABLE `campionato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `certificato`
--
ALTER TABLE `certificato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `contatto`
--
ALTER TABLE `contatto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `dirigente`
--
ALTER TABLE `dirigente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `documento`
--
ALTER TABLE `documento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `genitore`
--
ALTER TABLE `genitore`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `giocatore`
--
ALTER TABLE `giocatore`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `persona`
--
ALTER TABLE `persona`
  MODIFY `cod_utente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `residenza`
--
ALTER TABLE `residenza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `sesso`
--
ALTER TABLE `sesso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `squadra`
--
ALTER TABLE `squadra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `stagioniSportive`
--
ALTER TABLE `stagioniSportive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `tipologiaDocumento`
--
ALTER TABLE `tipologiaDocumento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `tipologieCertificato`
--
ALTER TABLE `tipologieCertificato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `titolo`
--
ALTER TABLE `titolo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT per la tabella `userData`
--
ALTER TABLE `userData`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
