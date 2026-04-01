-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10/03/2026 às 21:23
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `folha_pagto`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_funcionarios`
--

CREATE TABLE `tb_funcionarios` (
  `N_Registro` int(11) NOT NULL,
  `Nome_Funcionario` varchar(100) DEFAULT NULL,
  `data_admissao` date DEFAULT NULL,
  `cargo` varchar(50) DEFAULT NULL,
  `qtde_salarios` decimal(10,2) DEFAULT NULL,
  `salario_bruto` decimal(10,2) DEFAULT NULL,
  `inss` decimal(10,2) DEFAULT NULL,
  `salario_liquido` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_funcionarios`
--

INSERT INTO `tb_funcionarios` (`N_Registro`, `Nome_Funcionario`, `data_admissao`, `cargo`, `qtde_salarios`, `salario_bruto`, `inss`, `salario_liquido`) VALUES
(123456, 'Luara', '2026-03-09', 'Estagiário', 1.00, 1621.00, 121.58, 1499.43),
(456789, 'Fulano', '2026-01-15', 'Analista', 3.00, 4863.00, 680.82, 4182.18);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_funcionarios`
--
ALTER TABLE `tb_funcionarios`
  ADD PRIMARY KEY (`N_Registro`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
