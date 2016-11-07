--
-- Table structure for table `highscores`
--

CREATE TABLE IF NOT EXISTS `highscores` (
  `player` varchar(50) DEFAULT NULL,
  `score` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`player`)
);

--
-- data for table `highscores`
--

INSERT INTO `highscores` (`player`, `score`) VALUES
('GRL', '1000'),
('BHB', '200'),
('SBB', '150');
