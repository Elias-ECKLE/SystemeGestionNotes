-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 16 mai 2021 à 15:28
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `systeme_notes_etudiants2`
--

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `numEtudiant` varchar(10) COLLATE latin1_general_cs NOT NULL COMMENT 'matricule de l etudiant',
  `nom` varchar(50) COLLATE latin1_general_cs NOT NULL COMMENT 'nom',
  `prenom` varchar(50) COLLATE latin1_general_cs NOT NULL COMMENT 'prenom',
  `mail` varchar(50) COLLATE latin1_general_cs NOT NULL COMMENT 'mail',
  PRIMARY KEY (`numEtudiant`),
  KEY `mail` (`mail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs COMMENT='Attributs etudiant';

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`numEtudiant`, `nom`, `prenom`, `mail`) VALUES
('ETD001', 'EITEL', 'Hugo', 'h.eitel@ludus-academie.com'),
('ETD002', 'KUNZ', 'Quentin', 'q.kunz@ludus-academie.com'),
('ETD003', 'ZUMKIR', 'Jeffrey', 'j.zumkir@ludus-academie.com'),
('ETD004', 'BOHNERT', 'Alexandre', 'a.bohnert@ludus-academie.com'),
('ETD005', 'SCHWARTZ', 'Marine', 'm.schwartz@ludus-academie.com'),
('ETD006', 'CHOURY', 'Alaé', 'a.choury@ludus-academie.com'),
('ETD007', 'WILHEIM', 'Stéphane', 's.wilheim@ludus-academie.com'),
('ETD008', 'ECKLE', 'Elias', 'e.eckle@ludus-academie.com'),
('ETD009', 'MUSK', 'Elon', 'e.musk@ludus-academie.com');

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `mail` varchar(50) COLLATE latin1_general_cs NOT NULL COMMENT 'mail',
  `psswd` int(4) NOT NULL,
  `profil` varchar(50) COLLATE latin1_general_cs NOT NULL COMMENT 'profil soit étudiant soit prof',
  PRIMARY KEY (`mail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs COMMENT='Attributs etudiant ludus';

--
-- Déchargement des données de la table `login`
--

INSERT INTO `login` (`mail`, `psswd`, `profil`) VALUES
('a.bohnert@ludus-academie.com', 2223, 'etudiant'),
('a.choury@ludus-academie.com', 2221, 'etudiant'),
('e.eckle@ludus-academie.com', 1112, 'etudiant'),
('e.musk@ludus-academie.com', 9999, 'etudiant'),
('g.madembo@ludus-academie.com', 343, 'professeur'),
('h.eitel@ludus-academie.com', 432, 'etudiant'),
('j.poignard@ludus-academie.com', 4446, 'professeur'),
('j.zumkir@ludus-academie.com', 341, 'etudiant'),
('m.besmond@ludus-academie.com', 343, 'professeur'),
('m.schwartz@ludus-academie.com', 926, 'etudiant'),
('n.lehmann@ludus-academie.com', 65, 'professeur'),
('n.valentin@ludus-academie.com', 1234, 'professeur'),
('q.kunz@ludus-academie.com', 2345, 'etudiant'),
('s.wilheim@ludus-academie.com', 65, 'etudiant');

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

DROP TABLE IF EXISTS `matiere`;
CREATE TABLE IF NOT EXISTS `matiere` (
  `numMatiere` varchar(10) COLLATE latin1_general_cs NOT NULL COMMENT 'numero matiere',
  `libelleMatiere` varchar(50) COLLATE latin1_general_cs NOT NULL COMMENT 'nom de la matiere',
  `numProf` varchar(10) COLLATE latin1_general_cs NOT NULL COMMENT 'matricule de l etudiant',
  PRIMARY KEY (`numMatiere`),
  KEY `numProf` (`numProf`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs COMMENT='Attributs etudiant ludus';

--
-- Déchargement des données de la table `matiere`
--

INSERT INTO `matiere` (`numMatiere`, `libelleMatiere`, `numProf`) VALUES
('LKD001', 'Programmation', 'PRF001'),
('LKD002', 'GameDesign', 'PRF002'),
('LKD003', 'Web', 'PRF003'),
('LKD004', 'Anglais', 'PRF004'),
('LKD005', 'Japonais', 'PRF005');

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE IF NOT EXISTS `note` (
  `idNote` varchar(10) COLLATE latin1_general_cs NOT NULL,
  `sujetNote` varchar(50) COLLATE latin1_general_cs NOT NULL COMMENT 'theme de la note sur lequel les eleves sont interroges',
  `valeurNote` int(11) NOT NULL,
  `coeffNote` int(11) NOT NULL,
  `numEtudiant` varchar(10) COLLATE latin1_general_cs NOT NULL COMMENT 'matricule de l etudiant',
  `numMatiere` varchar(10) COLLATE latin1_general_cs NOT NULL COMMENT 'numero matiere',
  PRIMARY KEY (`idNote`),
  KEY `numEtudiant` (`numEtudiant`),
  KEY `numMatiere` (`numMatiere`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs COMMENT='Attributs des notes';

--
-- Déchargement des données de la table `note`
--

INSERT INTO `note` (`idNote`, `sujetNote`, `valeurNote`, `coeffNote`, `numEtudiant`, `numMatiere`) VALUES
('N0001', 'examenF2', 18, 2, 'ETD001', 'LKD001'),
('N0002', 'examenF2', 7, 2, 'ETD002', 'LKD001'),
('N0003', 'examenF2', 12, 2, 'ETD003', 'LKD001'),
('N0004', 'examenF2', 17, 2, 'ETD004', 'LKD001'),
('N0005', 'examenF2', 6, 2, 'ETD005', 'LKD001'),
('N0006', 'examenF2', 13, 2, 'ETD006', 'LKD001'),
('N0007', 'examenF2', 19, 2, 'ETD007', 'LKD001'),
('N0008', 'examenF2', 19, 2, 'ETD008', 'LKD001'),
('N0009', 'projet_unreal', 12, 2, 'ETD001', 'LKD001'),
('N0010', 'projet_unreal', 10, 2, 'ETD002', 'LKD001'),
('N0011', 'projet_unreal', 5, 2, 'ETD003', 'LKD001'),
('N0012', 'projet_unreal', 7, 2, 'ETD004', 'LKD001'),
('N0013', 'projet_unreal', 13, 2, 'ETD005', 'LKD001'),
('N0014', 'projet_unreal', 20, 2, 'ETD006', 'LKD001'),
('N0015', 'projet_unreal', 17, 2, 'ETD007', 'LKD001'),
('N0016', 'projet_unreal', 11, 2, 'ETD008', 'LKD001'),
('N0017', 'SQL_BOM', 2, 1, 'ETD001', 'LKD003'),
('N0018', 'SQL_BOM', 2, 1, 'ETD002', 'LKD003'),
('N0019', 'SQL_BOM', 2, 1, 'ETD003', 'LKD003'),
('N0020', 'SQL_BOM', 2, 1, 'ETD004', 'LKD003'),
('N0021', 'SQL_BOM', 2, 1, 'ETD005', 'LKD003'),
('N0022', 'SQL_BOM', 2, 1, 'ETD006', 'LKD003'),
('N0023', 'SQL_BOM', 5, 1, 'ETD007', 'LKD003'),
('N0024', 'SQL_BOM', 3, 1, 'ETD008', 'LKD003'),
('N0025', 'Level_Design', 16, 1, 'ETD001', 'LKD002'),
('N0026', 'Level_Design', 18, 1, 'ETD002', 'LKD002'),
('N0027', 'Level_Design', 20, 1, 'ETD003', 'LKD002'),
('N0028', 'Level_Design', 19, 1, 'ETD004', 'LKD002'),
('N0029', 'Level_Design', 15, 1, 'ETD005', 'LKD002'),
('N0030', 'Level_Design', 20, 1, 'ETD006', 'LKD002'),
('N0031', 'Level_Design', 14, 1, 'ETD007', 'LKD002'),
('N0032', 'Level_Design', 20, 1, 'ETD008', 'LKD002'),
('N0033', 'projet_unity', 19, 2, 'ETD001', 'LKD002'),
('N0034', 'projet_unity', 16, 2, 'ETD002', 'LKD002'),
('N0035', 'projet_unity', 16, 2, 'ETD003', 'LKD002'),
('N0036', 'projet_unity', 16, 2, 'ETD004', 'LKD002'),
('N0037', 'projet_unity', 16, 2, 'ETD005', 'LKD002'),
('N0038', 'projet_unity', 16, 2, 'ETD006', 'LKD002'),
('N0039', 'projet_unity', 16, 2, 'ETD007', 'LKD002'),
('N0040', 'projet_unity', 16, 2, 'ETD008', 'LKD002'),
('N0041', 'cover_letter', 9, 1, 'ETD001', 'LKD004'),
('N0042', 'cover_letter', 12, 1, 'ETD002', 'LKD004'),
('N0043', 'cover_letter', 14, 1, 'ETD004', 'LKD004'),
('N0044', 'cover_letter', 9, 1, 'ETD006', 'LKD004'),
('N0045', 'cover_letter', 16, 1, 'ETD008', 'LKD004'),
('N0046', 'speech', 14, 1, 'ETD003', 'LKD004'),
('N0047', 'speech', 15, 1, 'ETD005', 'LKD004'),
('N0048', 'speech', 11, 1, 'ETD007', 'LKD004'),
('N0049', 'arigato', 19, 1, 'ETD001', 'LKD005'),
('N0050', 'arigato', 20, 1, 'ETD002', 'LKD005'),
('N0051', 'arigato', 18, 1, 'ETD006', 'LKD005'),
('N0052', 'arigato', 20, 1, 'ETD008', 'LKD005'),
('N0054', 'arigato', 17, 1, 'ETD005', 'LKD005'),
('N0055', 'SQL_OMAPIZZA', 20, 1, 'ETD003', 'LKD003'),
('N0056', 'arigato', 20, 1, 'ETD009', 'LKD005'),
('N0057', 'evaluation_politesse', 18, 1, 'ETD008', 'LKD005'),
('N0058', 'Level_Design', 20, 1, 'ETD009', 'LKD002'),
('N0059', 'examenF2', 20, 1, 'ETD009', 'LKD001'),
('N0060', 'SQL_BOM', 20, 1, 'ETD009', 'LKD003');

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

DROP TABLE IF EXISTS `professeur`;
CREATE TABLE IF NOT EXISTS `professeur` (
  `numProf` varchar(10) COLLATE latin1_general_cs NOT NULL COMMENT 'matricule de l etudiant',
  `nom` varchar(50) COLLATE latin1_general_cs NOT NULL COMMENT 'nom',
  `prenom` varchar(50) COLLATE latin1_general_cs NOT NULL COMMENT 'prenom',
  `mail` varchar(50) COLLATE latin1_general_cs NOT NULL COMMENT 'mail',
  PRIMARY KEY (`numProf`),
  KEY `mail` (`mail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs COMMENT='Attributs etudiant';

--
-- Déchargement des données de la table `professeur`
--

INSERT INTO `professeur` (`numProf`, `nom`, `prenom`, `mail`) VALUES
('PRF001', 'LEHMANN', 'Nicolas', 'n.lehmann@ludus-academie.com'),
('PRF002', 'VALENTIN', 'Nicolas', 'n.valentin@ludus-academie.com'),
('PRF003', 'MADEMBO', 'Grâce', 'g.madembo@ludus-academie.com'),
('PRF004', 'POIGNARD', 'Jessica', 'j.poignard@ludus-academie.com'),
('PRF005', 'BESMOND', 'Marine', 'm.besmond@ludus-academie.com');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `etudiant_ibfk_1` FOREIGN KEY (`mail`) REFERENCES `login` (`mail`);

--
-- Contraintes pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD CONSTRAINT `matiere_ibfk_1` FOREIGN KEY (`numProf`) REFERENCES `professeur` (`numProf`);

--
-- Contraintes pour la table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `note_ibfk_1` FOREIGN KEY (`numEtudiant`) REFERENCES `etudiant` (`numEtudiant`),
  ADD CONSTRAINT `note_ibfk_2` FOREIGN KEY (`numMatiere`) REFERENCES `matiere` (`numMatiere`);

--
-- Contraintes pour la table `professeur`
--
ALTER TABLE `professeur`
  ADD CONSTRAINT `professeur_ibfk_1` FOREIGN KEY (`mail`) REFERENCES `login` (`mail`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
