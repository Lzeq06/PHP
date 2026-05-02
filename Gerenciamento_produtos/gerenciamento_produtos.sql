-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02/05/2026 às 15:52
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
-- Banco de dados: `gerenciamento_produtos`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `valor_compra` decimal(10,2) NOT NULL,
  `valor_venda` decimal(10,2) NOT NULL,
  `estoque` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `descricao`, `categoria`, `valor_compra`, `valor_venda`, `estoque`, `created_at`, `updated_at`) VALUES
(5, 'Notebook Dell Inspiron', 'Informática', 3200.00, 4199.00, 8, '2026-04-27 21:06:44', '2026-04-27 21:11:31'),
(6, 'Mouse Logitech M221', 'Periféricos', 85.00, 129.00, 45, '2026-04-27 21:06:44', '2026-04-27 21:11:31'),
(7, 'Teclado Mecânico Redragon', 'Periféricos', 135.00, 219.00, 30, '2026-04-27 21:06:44', '2026-04-27 21:11:31'),
(8, 'Fone de Ouvido JBL', 'Acessórios', 180.00, 279.00, 25, '2026-04-27 21:06:44', '2026-04-27 21:11:31'),
(9, 'Monitor LG 24\"', 'Informática', 850.00, 1199.00, 10, '2026-04-27 21:06:44', '2026-04-27 21:11:31'),
(10, 'Impressora HP DeskJet', 'Informática', 450.00, 679.00, 7, '2026-04-27 21:06:44', '2026-04-27 21:11:31'),
(11, 'Cabo HDMI 2m', 'Acessórios', 25.00, 45.00, 80, '2026-04-27 21:06:44', '2026-04-27 21:11:31'),
(12, 'Webcam Logitech C920', 'Periféricos', 320.00, 449.00, 15, '2026-04-27 21:06:44', '2026-04-27 21:11:31'),
(13, 'SSD Kingston 480GB', 'Informática', 220.00, 329.00, 2, '2026-04-27 21:06:44', '2026-04-27 21:11:31'),
(14, 'Notebook Lenovo IdeaPad', 'Informática', 2100.00, 2899.00, 15, '2026-04-27 21:09:03', '2026-04-27 21:11:31'),
(15, 'iPhone 13 128GB', 'Eletrônicos', 3200.00, 4299.00, 6, '2026-04-27 21:09:03', '2026-04-27 21:11:31'),
(16, 'Samsung Galaxy A54', 'Eletrônicos', 1450.00, 1999.00, 18, '2026-04-27 21:09:03', '2026-04-27 21:11:31'),
(17, 'Headset Gamer HyperX', 'Periféricos', 180.00, 299.00, 35, '2026-04-27 21:09:03', '2026-04-27 21:11:31'),
(18, 'Cadeira Gamer ThunderX', 'Acessórios', 650.00, 899.00, 9, '2026-04-27 21:09:03', '2026-04-27 21:11:31'),
(19, 'Carregador Turbo Samsung', 'Acessórios', 45.00, 79.00, 60, '2026-04-27 21:09:03', '2026-04-27 21:11:31'),
(20, 'Placa de Vídeo RTX 3060', 'Informática', 1850.00, 2499.00, 4, '2026-04-27 21:09:03', '2026-04-27 21:11:31'),
(21, 'Memória RAM 16GB DDR4', 'Informática', 180.00, 259.00, 40, '2026-04-27 21:09:03', '2026-04-27 21:11:31'),
(22, 'HD Externo 1TB Seagate', 'Informática', 280.00, 399.00, 22, '2026-04-27 21:09:03', '2026-04-27 21:11:31'),
(23, 'Smart TV LG 43\"', 'Eletrônicos', 1850.00, 2399.00, 7, '2026-04-27 21:09:03', '2026-04-27 21:11:31'),
(24, 'Caixa de Som JBL Flip 6', 'Eletrônicos', 420.00, 579.00, 14, '2026-04-27 21:09:03', '2026-04-27 21:11:31'),
(25, 'Mochila para Notebook', 'Acessórios', 95.00, 149.00, 25, '2026-04-27 21:09:03', '2026-04-27 21:11:31'),
(26, 'Mousepad Gamer RGB', 'Periféricos', 55.00, 89.00, 50, '2026-04-27 21:09:03', '2026-04-27 21:11:31'),
(27, 'Roteador TP-Link Archer', 'Eletrônicos', 220.00, 329.00, 12, '2026-04-27 21:09:03', '2026-04-27 21:11:31'),
(28, 'Power Bank 20000mAh', 'Acessórios', 85.00, 139.00, 38, '2026-04-27 21:09:03', '2026-04-27 21:11:31'),
(29, 'Impressora Multifuncional Epson', 'Informática', 680.00, 899.00, 5, '2026-04-27 21:09:03', '2026-04-27 21:11:31'),
(30, 'Tablet Samsung Galaxy Tab', 'Eletrônicos', 980.00, 1349.00, 11, '2026-04-27 21:09:03', '2026-04-27 21:11:31'),
(31, 'Teclado sem fio Logitech', 'Periféricos', 120.00, 179.00, 28, '2026-04-27 21:09:03', '2026-04-27 21:11:31'),
(32, 'Monitor Curvo 27\" Samsung', 'Informática', 1250.00, 1699.00, 2, '2026-04-27 21:09:03', '2026-04-27 21:20:06'),
(34, 'teste def', 'Eletrônicos', 39.00, 50.68, 100, '2026-04-27 21:19:33', '2026-04-27 21:24:52'),
(35, 'Notebook Acer Aspire 5', 'Informática', 2450.00, 3199.00, 14, '2026-04-27 21:26:32', '2026-04-27 21:26:32'),
(36, 'Samsung Galaxy S23', 'Eletrônicos', 3800.00, 4999.00, 9, '2026-04-27 21:26:32', '2026-04-27 21:26:32'),
(37, 'Fone Bluetooth Sony WH-1000XM5', 'Acessórios', 950.00, 1399.00, 22, '2026-04-27 21:26:32', '2026-04-27 21:26:32'),
(38, 'Impressora Brother Laser', 'Informática', 780.00, 1099.00, 6, '2026-04-27 21:26:32', '2026-04-27 21:26:32'),
(39, 'Mouse Gamer Razer DeathAdder', 'Periféricos', 220.00, 349.00, 31, '2026-04-27 21:26:32', '2026-04-27 21:26:32'),
(40, 'HD SSD 1TB NVMe Kingston', 'Informática', 380.00, 549.00, 18, '2026-04-27 21:26:32', '2026-04-27 21:26:32'),
(41, 'Smartwatch Xiaomi Mi Band 8', 'Eletrônicos', 140.00, 229.00, 45, '2026-04-27 21:26:32', '2026-04-27 21:26:32'),
(42, 'Caixa de Som Portátil Anker', 'Eletrônicos', 280.00, 399.00, 27, '2026-04-27 21:26:32', '2026-04-27 21:26:32'),
(43, 'Suporte Ergonômico para Monitor', 'Acessórios', 85.00, 139.00, 40, '2026-04-27 21:26:32', '2026-04-27 21:26:32'),
(44, 'Teclado Mecânico Corsair K55', 'Periféricos', 280.00, 399.00, 16, '2026-04-27 21:26:32', '2026-04-27 21:26:32'),
(45, 'Câmera Webcam 1080p Logitech', 'Periféricos', 380.00, 529.00, 12, '2026-04-27 21:26:32', '2026-04-27 21:26:32'),
(46, 'Bateria Externa Baseus 30000mAh', 'Acessórios', 180.00, 269.00, 33, '2026-04-27 21:26:32', '2026-04-27 21:26:32'),
(47, 'Roteador Wi-Fi 6 TP-Link', 'Eletrônicos', 320.00, 449.00, 19, '2026-04-27 21:26:32', '2026-04-27 21:26:32'),
(48, 'Monitor Gamer 27\" AOC 144Hz', 'Informática', 980.00, 1399.00, 8, '2026-04-27 21:26:32', '2026-04-27 21:26:32'),
(49, 'Mala para Notebook 15.6\"', 'Acessórios', 110.00, 169.00, 25, '2026-04-27 21:26:32', '2026-04-27 21:26:32'),
(50, 'teste 32', 'Eletrônicos', 45.00, 72.00, 40, '2026-04-27 21:29:29', '2026-04-27 21:29:29');

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas`
--

CREATE TABLE `vendas` (
  `id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `data_venda` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `vendas`
--

INSERT INTO `vendas` (`id`, `produto_id`, `quantidade`, `valor_total`, `data_venda`) VALUES
(1, 32, 2, 3398.00, '2026-04-27 21:20:06');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `vendas`
--
ALTER TABLE `vendas`
  ADD CONSTRAINT `vendas_ibfk_1` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
