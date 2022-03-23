-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23-Mar-2022 às 04:15
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mentes_notaveis_test`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `public_place` varchar(50) NOT NULL,
  `place_number` varchar(10) NOT NULL,
  `zip_code` varchar(10) NOT NULL,
  `complement` varchar(30) DEFAULT NULL,
  `district` varchar(30) NOT NULL,
  `city` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `addresses`
--

INSERT INTO `addresses` (`id`, `public_place`, `place_number`, `zip_code`, `complement`, `district`, `city`) VALUES
(1, 'Avenida Brasil', '1234', '00010-000', 'Bem no centro da cidade', 'Centro', 1),
(2, 'Rua Governador Janio Quadros', '25', '00011-456', NULL, 'Vila Velha', 2),
(3, 'Alameda Maria Joaquina', '122-A', '11123-123', 'Casa da Frente', 'Jardim Ana Maria', 3),
(4, 'Rua Zélia Gatai', '2345', '11134-543', NULL, 'Jardim das Flores', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `state` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cities`
--

INSERT INTO `cities` (`id`, `name`, `state`) VALUES
(1, 'Ferraz de Vasconcelos', 1),
(2, 'Feira de Santana', 2),
(3, 'Sao Goncalo', 3),
(4, 'Uberlandia', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `states`
--

INSERT INTO `states` (`id`, `name`) VALUES
(1, 'Sao Paulo'),
(2, 'Bahia'),
(3, 'Rio de Janeiro'),
(4, 'Minas Gerais');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `address` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `address`) VALUES
(1, 'gustavo', 'gustavoalvesdasilva@outlook.com', '1234', 1),
(3, 'Paulo Ramos', 'paulo_ramos@gmail.com', '12344', 2),
(4, 'ana', 'ana@fatec.com', '111222', 4),
(6, 'Paul Washer', 'paul@uol.com.br', '12121', 4),
(9, 'Mariana', 'mariana@hotmail.com', '4567', 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cities_addresses` (`city`);

--
-- Índices para tabela `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_states_cities` (`state`);

--
-- Índices para tabela `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_addresses_users` (`address`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `fk_cities_addresses` FOREIGN KEY (`city`) REFERENCES `cities` (`id`);

--
-- Limitadores para a tabela `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `fk_states_cities` FOREIGN KEY (`state`) REFERENCES `states` (`id`);

--
-- Limitadores para a tabela `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_addresses_users` FOREIGN KEY (`address`) REFERENCES `addresses` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
