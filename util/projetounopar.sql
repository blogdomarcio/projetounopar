-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 01-Maio-2016 às 22:15
-- Versão do servidor: 5.6.22-log
-- PHP Version: 5.5.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projetounopar`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidade`
--

CREATE TABLE `cidade` (
  `id_cidade` int(11) NOT NULL,
  `nome_cidade` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cidade`
--

INSERT INTO `cidade` (`id_cidade`, `nome_cidade`) VALUES
(1, 'Itapetinga'),
(2, 'Itororo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` varchar(100) NOT NULL,
  `user_agent` varchar(300) DEFAULT NULL,
  `last_activity` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `timestamp`, `user_data`, `user_agent`, `last_activity`) VALUES
('d17133a354834e893caa29b54a708e8e', '::1', 0, '', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36', '1461941993');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `codusuario` int(11) NOT NULL,
  `nomeusuario` varchar(100) NOT NULL,
  `emailusuario` varchar(45) NOT NULL,
  `ativadousuario` char(1) NOT NULL,
  `senhausuario` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`codusuario`, `nomeusuario`, `emailusuario`, `ativadousuario`, `senhausuario`) VALUES
(2, 'Paulo Anderson Rocha', 'pa@uol.com', 'S', '123'),
(3, 'Claudio Marcio Silva Rocha', 'blogdomarcio@live.com', 'N', '9be8596a567e3c7bd21f817c6571369cca1f4b0d91aae0d17c4221ac1c8206157dfbbd5e8193a07cbe5a4236c00e265b5566566b3308207e56e6225268e7a86bQGCwN7On0Nr+YYelCI5zW1+7+j32WCnMhnfQ1g6TFYo='),
(4, 'Centro Educacional e Cultura Noralice Gusmao', 'jairacoutocruz@hotmail.com', 'S', 'b4367a42434222c078a93069b3452a973f96142a0e9ccf9166b2f6d527deb6a5960fbab0ba2f12f44924449ba8b9ef522a31f213ef8c58072ac711745239daf3ankeeISI02rE39WmyduWyyFNyCxQ+lRkn9Hj9gXCJkw='),
(6, 'Jorge', 'contatos@osossegodamamae.com.br', 'N', '3a83309955516d439ca1baea271c2ed551c5d9e9434108ae19dfbc72f15a9ed3308647a03e45b20a3da7ce6f9c30148d396eb14ba0ed86a01dee9450f1d6671120zm8xwfq3jlgXI9G39GCbRTJ2Zw6CZ/a8GXyHvv27U=');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cidade`
--
ALTER TABLE `cidade`
  ADD PRIMARY KEY (`id_cidade`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`codusuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `codusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
