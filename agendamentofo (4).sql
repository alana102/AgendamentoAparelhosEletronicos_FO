-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 21/12/2023 às 13:57
-- Versão do servidor: 10.4.22-MariaDB
-- Versão do PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `agendamentofo`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tab_agendamento`
--

CREATE TABLE `tab_agendamento` (
  `agen_id` int(5) NOT NULL,
  `agen_idtipo` int(2) NOT NULL,
  `agen_idequip` int(2) NOT NULL,
  `agen_prof` varchar(75) NOT NULL,
  `agen_data` varchar(25) NOT NULL,
  `agen_idaulainicio` int(2) NOT NULL,
  `agen_idaulafim` int(2) NOT NULL,
  `agen_obs` varchar(255) DEFAULT NULL,
  `agen_status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tab_agendamento`
--

INSERT INTO `tab_agendamento` (`agen_id`, `agen_idtipo`, `agen_idequip`, `agen_prof`, `agen_data`, `agen_idaulainicio`, `agen_idaulafim`, `agen_obs`, `agen_status`) VALUES
(1, 1, 1, 'Francisca Auricelia da Silva Menezes Tavares', '15/12/2023', 1, 2, '', 'Concluído'),
(2, 1, 1, 'Herberth Pincer Uchoa', '15/12/2023', 4, 5, '', 'Concluído'),
(3, 6, 6, 'Diana Fernandes Lima', '15/12/2023', 1, 5, '', 'Concluído'),
(5, 1, 4, 'Isaias Rodrigues Cruz', '19/12/2023', 2, 5, NULL, 'Concluído'),
(8, 1, 1, 'Aldenia Soares Almeida', '19/12/2023', 1, 2, '', 'Concluído'),
(13, 1, 1, 'Aldenia Soares Almeida', '20/12/2023', 1, 2, '', 'Pendente'),
(15, 1, 1, 'Aldenia Soares Almeida', '20/12/2023', 6, 7, '', 'Pendente'),
(18, 1, 2, 'Diana Fernandes Lima', '21/12/2023', 1, 2, '', 'Agendado'),
(20, 1, 3, 'Fagner Menezes Castro', '20/12/2023', 5, 6, '', 'Pendente'),
(21, 6, 6, 'Francisca Marcia Gabrielle Alves Freitas', '20/12/2023', 6, 7, 'Não vou poder devolver o datashow assim que me aula acabar, pois tenho uma consulta. Ele ficará na sala dos professores', 'Pendente'),
(22, 1, 3, 'Hiandra Ramos Pereira', '20/12/2023', 2, 2, '676yft', 'Pendente'),
(23, 1, 2, 'Francisca Marcia Gabrielle Alves Freitas', '20/12/2023', 1, 4, '', 'Pendente'),
(27, 1, 1, 'Francisca Marcia Gabrielle Alves Freitas', '21/12/2023', 8, 9, '', 'Agendado'),
(31, 1, 3, 'Maria Gaciele Freitas Siva', '21/12/2023', 6, 7, NULL, 'Agendado'),
(33, 1, 5, 'Francisca Marcia Gabrielle Alves Freitas', '23/12/2023', 3, 4, NULL, 'Agendado'),
(34, 1, 5, 'Francisca Marcia Gabrielle Alves Freitas', '23/12/2023', 1, 2, '', 'Agendado'),
(35, 1, 5, 'Paulo Jeferson Silva Ribeiro', '22/12/2023', 1, 2, '', 'Agendado'),
(36, 6, 6, 'Paulo Jeferson Silva Ribeiro', '21/12/2023', 2, 3, '', 'Agendado');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tab_aulas`
--

CREATE TABLE `tab_aulas` (
  `aula_id` int(2) NOT NULL,
  `aula_nome` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `tab_aulas`
--

INSERT INTO `tab_aulas` (`aula_id`, `aula_nome`) VALUES
(1, '1ª aula'),
(2, '2ª aula'),
(3, '3ª aula'),
(4, '4ª aula'),
(5, '5ª aula'),
(6, '6ª aula'),
(7, '7ª aula'),
(8, '8ª aula'),
(9, '9ª aula');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tab_equipamento`
--

CREATE TABLE `tab_equipamento` (
  `equ_id` int(2) NOT NULL,
  `equ_tipoid` int(2) NOT NULL,
  `equ_nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tab_equipamento`
--

INSERT INTO `tab_equipamento` (`equ_id`, `equ_tipoid`, `equ_nome`) VALUES
(1, 1, 'Nº 1'),
(2, 1, 'Nº 2'),
(3, 1, 'Nº 3'),
(4, 1, 'Nº 4'),
(5, 1, 'Nº 5'),
(6, 6, 'Laboratório de Informática'),
(7, 6, 'Biblioteca');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tab_equitipo`
--

CREATE TABLE `tab_equitipo` (
  `tipo_id` int(2) NOT NULL,
  `tipo_nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `tab_equitipo`
--

INSERT INTO `tab_equitipo` (`tipo_id`, `tipo_nome`) VALUES
(1, 'Datashow'),
(6, 'Espaço da escola');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tab_user`
--

CREATE TABLE `tab_user` (
  `usu_id` int(2) NOT NULL,
  `usu_nome` varchar(50) NOT NULL,
  `usu_email` varchar(50) NOT NULL,
  `usu_login` varchar(25) NOT NULL,
  `usu_senha` varchar(100) NOT NULL,
  `usu_nivel` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `tab_user`
--

INSERT INTO `tab_user` (`usu_id`, `usu_nome`, `usu_email`, `usu_login`, `usu_senha`, `usu_nivel`) VALUES
(1, 'Administrador', 'admin@gmail.com', 'admin', '123', 1),
(2, 'Aldenia Soares Almeida', 'aldenia@gmail.com', 'aldenia', '123', 2),
(3, 'Diana Fernandes Lima', 'diana@gmail.com', 'diana', '123', 2),
(4, 'Fabiane Lourenço Silva', 'fabiane@gmail.com', 'fabiane', '123', 2),
(5, 'Fagner Menezes Castro', 'fagner@gmail.com', 'fagner', '123', 2),
(6, 'Francisca Auricelia da Silva Menezes Tavares', 'auricelia@gmail.com', 'auricelia', '123', 2),
(7, 'Francisca Andressa Alves Marreiro', 'andressa@gmail.com', 'andressa', '123', 2),
(8, 'Francisca Marcia Gabrielle Alves Freitas', 'marcia@gmail.com', 'marcia', '123', 2),
(9, 'Francisco Danilo Martins Sousa', 'danilo@gmail.com', 'danilo', '123', 2),
(10, 'Francisco Geilson Marcolino de Sousa', 'marcolino@gmail.com', 'marcolino', '123', 2),
(11, 'Herberth Pincer Uchoa', 'herberth@gmail.com', 'herberth', '123', 2),
(12, 'Hiandra Ramos Pereira', 'hiandra@gmail.com', 'hiandra', '123', 2),
(13, 'Ila Maria Vascoscelos Cruz', 'ila@gmail.com', 'ila', '123', 2),
(14, 'Isaias Rodrigues Cruz', 'isaias@gmail.com', 'isaias', '123', 2),
(15, 'Jaqueline Teixeira Lopes', 'jaqueline@gmail.com', 'jaqueline', '123', 2),
(16, 'Maria Gaciele Freitas Siva', 'gaciele@gmail.com', 'gaciele', '123', 2),
(17, 'Maria Grette Alves Rodrigues', 'grette@gmail.com', 'grette', '123', 2),
(18, 'Maria Ivaneidiane Sousa Colares', 'ivaneidiane@gmail.com', 'ivaneidiane', '123', 2),
(19, 'Maria Mônica Freitas Braga', 'monica@gmail.com', 'monica', '123', 2),
(20, 'Mayara Gomes Oliveira', 'mayara@gmail.com', 'mayara', '123', 2),
(21, 'Michele Barros de Sousa', 'michele@gmail.com', 'michele', '123', 2),
(22, 'Patrícia Laurindo Costa', 'patricia@gmail.com', 'patricia', '123', 2),
(23, 'Paulo Jeferson Silva Ribeiro', 'jeferson@gmail.com', 'jeferson', '123', 2),
(24, 'Renata Gabriella Lopes Fernandes', 'renata@gmail.com', 'renata', '123', 2),
(25, 'Rosemare Guimarães Cruz', 'rosemare@gmail.com', 'rosemare', '123', 2),
(26, 'Veronica Moudiany Martins Barbosa', 'veronica@gmail.com', 'veronica', '123', 2),
(27, 'Raynnara Uchoa Magalhães', 'raynnara@gmail.com', 'raynnara', '123', 2),
(28, 'Manuel Agapito de Sousa Neto', 'manuel@gmail.com', 'manuel', '123', 2),
(29, 'Francisca Herbenia Amorim da Silva', 'herbenia@gmail.com', 'herbenia', '123', 2),
(30, 'Rayane Mendonça Lopes', 'rayane@gmail.com', 'rayane', '123', 2),
(31, 'Luan Martins Abreu', 'luan@gmail.com', 'luan', '123', 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tab_agendamento`
--
ALTER TABLE `tab_agendamento`
  ADD PRIMARY KEY (`agen_id`),
  ADD KEY `agen_idtipo` (`agen_idtipo`),
  ADD KEY `agen_idequip` (`agen_idequip`),
  ADD KEY `agen_idaulainicio` (`agen_idaulainicio`),
  ADD KEY `agen_idaulafim` (`agen_idaulafim`);

--
-- Índices de tabela `tab_aulas`
--
ALTER TABLE `tab_aulas`
  ADD PRIMARY KEY (`aula_id`);

--
-- Índices de tabela `tab_equipamento`
--
ALTER TABLE `tab_equipamento`
  ADD PRIMARY KEY (`equ_id`),
  ADD KEY `equ_tipoid` (`equ_tipoid`);

--
-- Índices de tabela `tab_equitipo`
--
ALTER TABLE `tab_equitipo`
  ADD PRIMARY KEY (`tipo_id`);

--
-- Índices de tabela `tab_user`
--
ALTER TABLE `tab_user`
  ADD PRIMARY KEY (`usu_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tab_agendamento`
--
ALTER TABLE `tab_agendamento`
  MODIFY `agen_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `tab_aulas`
--
ALTER TABLE `tab_aulas`
  MODIFY `aula_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `tab_equipamento`
--
ALTER TABLE `tab_equipamento`
  MODIFY `equ_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tab_equitipo`
--
ALTER TABLE `tab_equitipo`
  MODIFY `tipo_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `tab_user`
--
ALTER TABLE `tab_user`
  MODIFY `usu_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tab_agendamento`
--
ALTER TABLE `tab_agendamento`
  ADD CONSTRAINT `tab_agendamento_ibfk_1` FOREIGN KEY (`agen_idtipo`) REFERENCES `tab_equipamento` (`equ_tipoid`),
  ADD CONSTRAINT `tab_agendamento_ibfk_2` FOREIGN KEY (`agen_idequip`) REFERENCES `tab_equipamento` (`equ_id`),
  ADD CONSTRAINT `tab_agendamento_ibfk_3` FOREIGN KEY (`agen_idaulainicio`) REFERENCES `tab_aulas` (`aula_id`),
  ADD CONSTRAINT `tab_agendamento_ibfk_4` FOREIGN KEY (`agen_idaulafim`) REFERENCES `tab_aulas` (`aula_id`);

--
-- Restrições para tabelas `tab_equipamento`
--
ALTER TABLE `tab_equipamento`
  ADD CONSTRAINT `tab_equipamento_ibfk_1` FOREIGN KEY (`equ_tipoid`) REFERENCES `tab_equitipo` (`tipo_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
