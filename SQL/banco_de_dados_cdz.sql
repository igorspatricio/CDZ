-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 16-Jan-2022 às 15:56
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `banco de dados cdz`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `categoria` varchar(30) NOT NULL,
  PRIMARY KEY (`categoria`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`categoria`) VALUES
('Action figure'),
('Álbum'),
('Brinquedo'),
('Card'),
('Figurinha'),
('Gibi'),
('HQ'),
('Manga');

-- --------------------------------------------------------

--
-- Estrutura da tabela `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `nomeArquivo` varchar(100) NOT NULL,
  `descricao` varchar(300) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `diretorio` varchar(300) NOT NULL,
  PRIMARY KEY (`nomeArquivo`,`usuario`),
  KEY `fk_login` (`usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `item`
--

INSERT INTO `item` (`nomeArquivo`, `descricao`, `usuario`, `categoria`, `diretorio`) VALUES
('Rato', 'Rato do zodiaco', 'igorwd', 'hominhos', 'imgs/igorwd/Rato.png'),
('Teste', 'Grande dia!', 'igorts', 'manga', 'imgs/igorts/Teste.png'),
('Teste2', 'Uma descriÃ§Ã£o aqui...Uma descriÃ§Ã£o aqui...Uma descriÃ§Ã£o aqui...Uma descriÃ§Ã£o aqui...Uma descriÃ§Ã£o aqui...Uma descriÃ§Ã£o aqui...Uma descriÃ§Ã£o aqui...Uma descriÃ§Ã£o aqui... ', 'igorts', 'brinquedo', 'imgs/igorts/Teste2.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `apelido` varchar(100) NOT NULL,
  `login` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  PRIMARY KEY (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`apelido`, `login`, `senha`) VALUES
('seya312', 'igorrts', '$2y$10$3r9fzDaVPJxKNGOTK7KxeGiJzfDkoGRV4DZ8QLfhS8BtSz0p9aEG'),
('Igor', 'igorts', '$2y$10$oFmfdNZ5rzuUJD308pI4peWOSrqO3sZkn/t6Y8Z0dJ8EMBuphL1Uy'),
('Seya123', 'igorwd', '$2y$10$njK6o/hVKibE6TF2NXsz/.H7PnxEdad/Qa0k4ewP.XJnaY4ELBWi6'),
('Novo', 'teste', '$2y$10$QzB0dslSISe3.YwK40VwJepbB57/3ZGcTvjuJuX/M/T9FbW2sKGzK');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
