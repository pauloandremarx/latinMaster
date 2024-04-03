-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 02/04/2024 às 14:51
-- Versão do servidor: 8.0.31
-- Versão do PHP: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `latin_master`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(300) DEFAULT NULL,
  `autor` varchar(150) DEFAULT NULL,
  `area` varchar(50) DEFAULT NULL,
  `conteudo` longtext,
  `description` varchar(200) DEFAULT NULL,
  `banner` varchar(150) DEFAULT NULL,
  `thumb` varchar(150) DEFAULT NULL,
  `published` tinyint DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lingua` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `slider`
--

DROP TABLE IF EXISTS `slider`;
CREATE TABLE IF NOT EXISTS `slider` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `legenda` varchar(100) DEFAULT NULL,
  `legenda_eng` varchar(100) DEFAULT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  `ordem` tinyint DEFAULT '1',
  `ativo` tinyint DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `imagem_mobile` varchar(100) DEFAULT NULL,
  `imagem_ingles` varchar(100) DEFAULT NULL,
  `imagem_mobile_ingles` varchar(100) DEFAULT NULL,
  `legenda_esp` varchar(200) DEFAULT NULL,
  `imagem_espanhol` varchar(200) DEFAULT NULL,
  `imagem_mobile_espanhol` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(65) NOT NULL,
  `email` varchar(84) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirmation_key` varchar(150) NOT NULL,
  `is_confirmation` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
