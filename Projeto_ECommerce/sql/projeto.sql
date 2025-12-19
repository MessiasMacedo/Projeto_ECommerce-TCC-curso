-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04/12/2025 às 04:17
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
-- Banco de dados: `projeto`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `avaliacao`
--

CREATE TABLE `avaliacao` (
  `id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `nota` int(11) NOT NULL,
  `comentario` text DEFAULT NULL,
  `aprovado` tinyint(1) DEFAULT 0,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `avaliacao`
--

INSERT INTO `avaliacao` (`id`, `produto_id`, `nota`, `comentario`, `aprovado`, `id_usuario`) VALUES
(1, 1, 5, 'Mouse com ótima resposta e iluminação bem forte. O sensor é muito preciso nos jogos.', 1, 8),
(2, 1, 4, 'Produto muito bom, porém o cabo poderia ser um pouco mais flexível.', 1, 8),
(3, 2, 5, 'Switches muito confortáveis e som agradável. Excelente para digitação e jogos.', 1, 8),
(4, 2, 4, 'Construção sólida, mas achei ele um pouco barulhento para uso noturno.', 1, 8),
(5, 3, 5, 'Som muito imersivo e grave forte. Consegui ouvir passos no jogo com muita clareza.', 1, 8),
(6, 3, 4, 'Microfone bom, mas poderia ter um pouco mais de volume.', 1, 8),
(7, 4, 5, 'Material excelente, o mouse desliza com muita leveza. Tamanho perfeito.', 1, 8),
(8, 4, 4, 'Borda costurada muito boa, só demora um pouco para desamassar quando novo.', 1, 8),
(9, 5, 5, 'Imagem bem nítida e foco rápido. Ideal para reuniões e stream.', 1, 8),
(10, 5, 4, 'A qualidade é boa, mas senti falta de ajuste automático de luz.', 1, 8),
(11, 6, 5, 'Processador extremamente rápido, rodou tudo sem esforço. Ótimo custo-benefício.', 1, 7),
(12, 6, 4, 'Esquenta um pouco, recomendo usar com um bom cooler.', 1, 7),
(13, 7, 5, 'Roda todos os meus jogos em alta qualidade, desempenho excelente pelo preço.', 1, 7),
(14, 7, 4, 'Um pouco ruidosa em full load, mas nada demais.', 1, 7),
(15, 8, 5, 'Aumentou muito a velocidade do meu PC. Ótimo para multitarefas.', 1, 7),
(16, 8, 4, 'Funciona perfeitamente, só achei o dissipador um pouco alto.', 1, 7),
(17, 9, 5, 'Boot do Windows ficou absurdamente rápido. Vale cada centavo.', 1, 7),
(18, 9, 4, 'Velocidade ótima, mas o armazenamento poderia ser um pouco maior.', 1, 7),
(19, 10, 5, 'Fonte silenciosa e estável. Meu PC ficou mais seguro.', 1, 7),
(20, 10, 4, 'Cabo poderia ser um pouco mais longo, mas funciona muito bem.', 1, 7),
(21, 1, 1, 'ruim', 0, 7),
(22, 1, 1, 'ruim', 1, 7),
(23, 1, 1, 'HORRIVELL', 1, 7),
(24, 3, 1, 'ruim', 1, 7),
(25, 3, 1, 'HORRIVEL', 1, 6);

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `criado_em` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `carrinho`
--

INSERT INTO `carrinho` (`id`, `cliente_id`, `criado_em`) VALUES
(5, 7, '2025-11-30 01:17:02'),
(8, 7, '2025-11-30 03:52:15'),
(9, 7, '2025-11-30 17:54:37'),
(10, 7, '2025-11-30 20:34:00'),
(11, 7, '2025-11-30 22:17:43'),
(12, 7, '2025-12-01 15:54:41'),
(15, 7, '2025-12-01 23:51:25'),
(18, 7, '2025-12-02 14:07:30');

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrinhoitem`
--

CREATE TABLE `carrinhoitem` (
  `carrinho_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL DEFAULT 1,
  `preco_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `carrinhoitem`
--

INSERT INTO `carrinhoitem` (`carrinho_id`, `produto_id`, `quantidade`, `preco_unitario`) VALUES
(5, 3, 5, 149.90),
(8, 2, 1, 199.90),
(9, 3, 16, 149.90),
(10, 3, 7, 149.90),
(11, 3, 11, 149.90),
(12, 3, 7, 149.90),
(15, 3, 1, 149.90),
(18, 3, 5, 149.90);

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`id`, `nome`) VALUES
(1, 'Periférico'),
(2, 'Hardware');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cupom`
--

CREATE TABLE `cupom` (
  `id` int(11) NOT NULL,
  `codigo` varchar(30) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `valido_de` date NOT NULL,
  `valido_ate` date NOT NULL,
  `ativo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cupom`
--

INSERT INTO `cupom` (`id`, `codigo`, `tipo`, `valor`, `valido_de`, `valido_ate`, `ativo`) VALUES
(1, 'DESCONTO10', 'percentual', 10.00, '2025-01-01', '2025-12-31', 1),
(2, 'FRETEGRATIS', 'fixo', 20.00, '2025-11-15', '2025-12-15', 1),
(3, 'PROMO5', 'percentual', 5.00, '2025-02-01', '2025-04-30', 1),
(4, 'CUPOM20', 'percentual', 20.00, '2025-03-01', '2025-03-31', 0),
(5, 'VALE30', 'fixo', 30.00, '2025-01-10', '2025-05-10', 1),
(6, 'SUPER15', 'percentual', 15.00, '2025-04-01', '2025-10-01', 1),
(7, 'MEGADESCONTO50', 'fixo', 50.00, '2025-05-01', '2025-12-31', 1),
(8, 'VIP25', 'percentual', 25.00, '2025-02-20', '2025-08-20', 0),
(9, 'FIRSTBUY', 'percentual', 12.00, '2025-01-01', '2025-12-31', 1),
(10, 'OUTLET40', 'fixo', 40.00, '2025-06-01', '2025-07-01', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cupomcategoria`
--

CREATE TABLE `cupomcategoria` (
  `cupom_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `endereco`
--

CREATE TABLE `endereco` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `estoquemovimento`
--

CREATE TABLE `estoquemovimento` (
  `id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `tipo_movimento` varchar(20) NOT NULL,
  `descricao` text DEFAULT NULL,
  `data_hora` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `historico`
--

CREATE TABLE `historico` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `telefone` varchar(30) NOT NULL,
  `cep` varchar(20) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `complemento` varchar(150) DEFAULT NULL,
  `estado` varchar(50) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `frete` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `tipo_pagamento` varchar(50) NOT NULL,
  `data_pedido` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `historico`
--

INSERT INTO `historico` (`id`, `nome`, `email`, `cpf`, `telefone`, `cep`, `endereco`, `numero`, `bairro`, `complemento`, `estado`, `cidade`, `subtotal`, `frete`, `total`, `tipo_pagamento`, `data_pedido`) VALUES
(1, '', '', '', '', '', '', '', '', '', 'SP', '', 899.90, 0.00, 899.90, 'credito', '2025-11-27 19:51:10'),
(2, '', 'h@gmail.com', '', '', '18010', '', '', '', '', 'SP', '', 899.90, 0.00, 899.90, 'credito', '2025-11-28 05:57:23'),
(3, '', 'h@gmail.com', '', '', '18010', '', '', '', '', 'SP', '', 899.90, 0.00, 899.90, 'credito', '2025-11-28 06:00:29'),
(4, '', 'a@gmail.com', '', '', '', '', '', '', '', 'BA', '', 899.90, 0.00, 899.90, 'credito', '2025-11-28 06:01:25'),
(5, '', 'h@gmail.com', '', '', '', '', '', '', '', 'MT', '', 899.90, 0.00, 899.90, 'credito', '2025-11-28 06:04:03'),
(6, '', 'h@gmail.com', '', '', '18010', '', '', '', '', 'SP', '', 899.90, 0.00, 899.90, 'credito', '2025-11-28 06:08:26'),
(7, '', 'teste@gmail.com', '', '', '', '', '', '', '', 'SP', '', 199.90, 0.00, 199.90, 'credito', '2025-11-29 03:20:58'),
(8, '', 'teste@gmail.com', '', '', '', '', '', '', '', 'SP', '', 199.90, 0.00, 199.90, 'credito', '2025-11-29 03:22:44'),
(11, '', '', '', '', '', '', '', '', '', 'SC', '', 149.90, 0.00, 149.90, 'credito', '2025-11-29 03:59:42'),
(12, '', '', '', '', '', '', '', '', '', 'SC', '', 149.90, 0.00, 149.90, 'credito', '2025-11-29 04:07:24'),
(13, '', '', '', '', '', '', '', '', '', 'SC', '', 149.90, 0.00, 149.90, 'credito', '2025-11-29 04:07:40'),
(14, '', '', '', '', '', '', '', '', '', 'SP', '', 149.90, 0.00, 149.90, 'credito', '2025-11-29 04:07:50'),
(15, '', '', '', '', '', '', '', '', '', 'SC', '', 149.90, 0.00, 149.90, 'credito', '2025-11-29 04:08:13'),
(17, '', 'teste1@gmail.com', '', '', '', '', '', '', '', 'SC', '', 149.90, 0.00, 149.90, 'debito', '2025-11-29 04:13:52'),
(18, '', 'teste1@gmail.com', '', '', '', '', '', '', '', 'SC', '', 149.90, 0.00, 149.90, 'debito', '2025-11-29 04:28:14'),
(19, '', 'teste1@gmail.com', '', '', '', '', '', '', '', 'SC', '', 149.90, 0.00, 149.90, 'credito', '2025-11-29 04:28:19'),
(20, '', 'teste1@gmail.com', '', '', '', '', '', '', '', 'SC', '', 149.90, 0.00, 149.90, 'credito', '2025-11-29 04:33:48'),
(21, '', 'teste1@gmail.com', '', '', '', '', '', '', '', 'SC', '', 149.90, 0.00, 149.90, 'credito', '2025-11-29 04:38:38'),
(22, '', '', '', '', '', '', '', '', '', 'SC', '', 149.90, 0.00, 149.90, 'credito', '2025-11-29 04:38:46'),
(23, '', '', '', '', '', '', '', '', '', 'SC', '', 149.90, 0.00, 149.90, 'credito', '2025-11-29 04:47:23'),
(24, '', '', '', '', '', '', '', '', '', 'SC', '', 149.90, 0.00, 149.90, 'credito', '2025-11-29 04:54:40'),
(25, '', '', '', '', '', '', '', '', '', 'SP', '', 149.90, 0.00, 149.90, 'credito', '2025-11-29 04:58:18'),
(26, '', 'teste@gmail.com', '', '', '', '', '', '', '', 'SC', '', 199.90, 0.00, 199.90, 'credito', '2025-11-29 05:10:06'),
(27, '', '', '', '', '', '', '', '', '', '', '', 149.90, 0.00, 149.90, 'credito', '2025-11-29 18:52:45'),
(28, '', '', '', '', '', '', '', '', '', 'SP', '', 149.90, 0.00, 149.90, 'credito', '2025-11-29 18:53:19'),
(29, '', 'teste@gmail.com', '', '', '', '', '', '', '', 'SP', '', 199.90, 0.00, 199.90, 'debito', '2025-11-29 20:25:02'),
(30, '', '', '', '', '', '', '', '', '', 'SC', '', 149.90, 0.00, 149.90, 'credito', '2025-11-30 03:46:16'),
(31, '', 'ju@gmail.com', '', '', '', '', '', '', '', 'SC', '', 149.90, 0.00, 149.90, 'credito', '2025-11-30 05:06:35'),
(32, '', 'ju@gmail.com', '', '', '', '', '', '', '', 'SC', '', 149.90, 0.00, 149.90, 'credito', '2025-11-30 05:15:26'),
(33, '', '', '', '', '', '', '', '', '', '', '', 149.90, 0.00, 149.90, 'credito', '2025-11-30 05:47:01'),
(34, '', '', '', '', '', '', '', '', '', '', '', 149.90, 0.00, 149.90, 'debito', '2025-11-30 05:56:24'),
(35, '', '', '', '', '', '', '', '', '', '', '', 149.90, 0.00, 149.90, 'credito', '2025-11-30 05:58:25'),
(36, '', '', '', '', '', '', '', '', '', '', '', 1049.30, 0.00, 944.37, 'credito', '2025-11-30 23:41:56'),
(37, '', '', '', '', '', '', '', '', '', '', '', 1049.30, 0.00, 944.37, 'debito', '2025-11-30 23:54:19'),
(38, '', '', '', '', '', '', '', '', '', '', '', 1049.30, 0.00, 944.37, 'credito', '2025-12-01 00:03:06'),
(39, '', '', '', '', '', '', '', '', '', '', '', 1049.30, 0.00, 944.37, 'debito', '2025-12-01 00:07:44'),
(40, '', '', '', '', '', '', '', '', '', '', '', 1349.10, 0.00, 1214.19, 'credito', '2025-12-01 01:18:48'),
(41, '', '', '', '', '', '', '', '', '', '', '', 749.50, 0.00, 674.55, 'debito', '2025-12-01 19:12:50'),
(42, '', '', '', '', '', '', '', '', '', '', '', 749.50, 0.00, 749.50, 'credito', '2025-12-01 19:36:39'),
(43, '', '', '', '', '', '', '', '', '', '', '', 0.00, 0.00, 0.00, 'credito', '2025-12-02 02:33:30'),
(44, '', '', '', '', '', '', '', '', '', '', '', 0.00, 0.00, 0.00, 'credito', '2025-12-02 02:35:21'),
(45, '', '', '', '', '', '', '', '', '', '', '', 0.00, 0.00, 0.00, 'credito', '2025-12-02 03:57:31'),
(46, '', '', '', '', '', '', '', '', '', '', '', 0.00, 0.00, 0.00, 'credito', '2025-12-02 03:58:09'),
(47, '', '', '', '', '', '', '', '', '', '', '', 0.00, 0.00, 0.00, 'credito', '2025-12-02 04:01:33'),
(48, '', '', '', '', '', '', '', '', '', '', '', 0.00, 0.00, 0.00, 'credito', '2025-12-02 04:53:40'),
(49, '', '', '', '', '', '', '', '', '', '', '', 749.50, 0.00, 749.50, 'credito', '2025-12-02 17:17:13'),
(50, '', '', '', '', '', '', '', '', '', '', '', 199.90, 0.00, 199.90, 'credito', '2025-12-02 18:25:50'),
(51, '', '', '', '', '', '', '', '', '', '', '', 199.90, 0.00, 199.90, 'credito', '2025-12-02 18:27:00'),
(52, '', '', '', '', '', '', '', '', '', '', '', 149.90, 0.00, 149.90, 'debito', '2025-12-02 20:12:31'),
(53, '', '', '', '', '', '', '', '', '', '', '', 1499.90, 0.00, 1499.90, 'credito', '2025-12-02 22:16:04'),
(54, 'julia', 'julia@gmail.com', '12332112312', '11234234512', '12332321', 'rua seila das quantas', '22', 'itaquera', 'torre 4 ap 77', 'SP', 'São Paulo', 1499.90, 0.00, 1499.90, 'debito', '2025-12-02 22:27:41'),
(55, 'Hugo', 'hgg@gmail.com', '12345678910', '11990413761', '12345678', 'Rua aline', '11', 'Ferraz', 'cima', 'SP', 'São Paulo', 1499.90, 0.00, 1499.90, 'credito', '2025-12-02 22:34:39'),
(56, 'Hugo', 'hgg@gmail.com', '12345678910', '11990413761', '12345678', 'Rua aline', '11', 'Ferraz', 'cima', 'SP', 'São Paulo', 1499.90, 0.00, 1499.90, 'debito', '2025-12-02 22:38:02'),
(57, 'Hugo', 'hgg@gmail.com', '12345678910', '11990413761', '12345678', 'Rua aline', '11', 'Ferraz', 'cima', 'SP', 'São Paulo', 1499.90, 0.00, 1499.90, 'debito', '2025-12-02 22:38:22'),
(58, 'hugo', 'hghg@gmail.com', '13212323131', '11909899831', '22312321', 'Rua Aline', '11', 'Do limoeiro', 'cima', 'SP', 'São Paulo', 149.90, 0.00, 149.90, 'credito', '2025-12-03 00:15:00'),
(59, 'heliaquim', 'teste1@gmail.com', '51643563840', '11917394250', '08246080', 'rua estavam ', '250', 'sp', '8', 'SP', 'sp', 199.90, 0.00, 199.90, 'debito', '2025-12-03 00:43:54'),
(60, 'hugo', 'ju@gmail.com', '12345678912', '11999999991', '18010123', 'Rua do meio', '12', 'Do limoeiro', 'cima', 'SP', 'São Paulo', 599.60, 0.00, 599.60, 'credito', '2025-12-03 19:46:30'),
(61, 'hugo', 'ju@gmail.com', '12345678909', '11999999991', '18010123', 'Rua do meio', '12', 'do', 'cima', 'SP', 'São Paulo', 949.40, 0.00, 949.40, 'credito', '2025-12-03 19:48:36'),
(62, 'hugo', 'ju@gmail.com', '12345678901', '11999999991', '18010123', 'Rua do meio', '12', 'Do Limoeiro', 'cima', 'SP', 'São Paulo', 539.60, 0.00, 485.64, 'credito', '2025-12-04 02:41:13'),
(63, 'hugo', 'ju@gmail.com', '12345678901', '11999999991', '18010123', 'Rua do meio', '12', 'Itaquera', 'cima', 'SP', 'São Paulo', 0.00, 0.00, 134.91, 'credito', '2025-12-04 02:44:38');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido`
--

CREATE TABLE `pedido` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `endereco_id` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `desconto` decimal(10,2) DEFAULT 0.00,
  `frete` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `situacao` varchar(20) NOT NULL,
  `criado_em` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidoitem`
--

CREATE TABLE `pedidoitem` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco_unitario` decimal(10,2) NOT NULL,
  `nome_peoduto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `perfil`
--

CREATE TABLE `perfil` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `sku` varchar(12) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `preco` decimal(10,2) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `id_subcategoria` int(11) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `img2` varchar(255) DEFAULT NULL,
  `estoque_atual` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`id`, `sku`, `nome`, `descricao`, `preco`, `categoria_id`, `id_subcategoria`, `img`, `img2`, `estoque_atual`) VALUES
(1, 'PER-001', 'Mouse Gamer RGB', 'Mouse com 7200 DPI e iluminação RGB.', 89.90, 1, 11, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRgQVjNa0h494wiMTxCtaQ_Xh5uqItC-K-LmA&s', 'https://images.kabum.com.br/produtos/fotos/sync_mirakl/515082/Mouse-Gamer-Redragon-Com-Fio-USB-7200-Dpi-ptico-LED-RGB-Preto_1713753119_gg.jpg', 100),
(2, 'PER-002', 'Teclado Mecânico', 'Teclado mecânico com switches Blue.', 199.90, 1, 10, '/Projeto_ECommerce/web/public/img/teclado.jpg', 'https://media.pichau.com.br/media/catalog/product/cache/2f958555330323e505eba7ce930bdf27/k/5/k565r-2-pt-blue2.jpg', 100),
(3, 'PER-003', 'Headset Surround', 'Headset com som surround 7.1.', 149.90, 1, 12, 'https://m.media-amazon.com/images/I/61LZIENMgtL.jpg', 'https://m.media-amazon.com/images/I/61JrL-ay34L._AC_UF894,1000_QL80_.jpg', 100),
(4, 'PER-004', 'Mousepad Grande', 'Mousepad gamer antiderrapante XXL.', 39.90, 1, 16, 'https://images.kabum.com.br/produtos/fotos/magalu/183607/xlarge/Mouse-Pad-Gamer-Trust_1763600065.jpg', 'https://m.media-amazon.com/images/I/51mGBVqEZIL._AC_UF894,1000_QL80_.jpg', 100),
(5, 'PER-005', 'Webcam Full HD', 'Webcam 1080p para chamadas e stream.', 119.90, 1, 15, 'https://m.media-amazon.com/images/I/61gpJAcAQIL.jpg', 'https://cdn.shoppub.io/cdn-cgi/image/w=1000,h=1000,q=80,f=auto/oficinadosbits/media/uploads/produtos/foto/hvcxwrvm/file.png', 100),
(6, 'HARD-001', 'Processador Ryzen 5', 'Processador 6 núcleos e 12 threads.', 899.90, 2, 2, 'https://images.kabum.com.br/produtos/fotos/520368/processador-amd-ryzen-5-5600gt-3-6-ghz-4-6ghz-max-turbo-cache-4mb-6-nucleos-12-threads-am4-100-100001488box_1708024586_gg.jpg', 'https://cdn.awsli.com.br/2500x2500/1882/1882647/produto/257222505/processador-amd-ryzen-5-5600gt-36ghz-46ghz-turbo-6-cores-12-threads-cooler-wrait-i7ym0zgjbm.jpg', 100),
(7, 'HARD-002', 'Placa de Vídeo GTX 1660', 'Placa de vídeo 6GB GDDR5.', 1499.90, 2, 6, 'https://waz.vtexassets.com/arquivos/ids/207116-800-auto?v=637158152455930000&width=800&height=auto&aspect=true', 'https://waz.vtexassets.com/arquivos/ids/207116-800-auto?v=637158152455930000&width=800&height=auto&aspect=true', 100),
(8, 'HARD-003', 'Memória RAM 16GB', 'Memória DDR4 3200MHz.', 279.90, 2, 3, 'https://m.media-amazon.com/images/I/715QXNdKxiL._AC_UF1000,1000_QL80_.jpg', 'https://www.kingstonstore.com.br/cdn/shop/files/KFBL1_7fd4a4ca-14cf-4306-a4c9-adb5a5bce979.jpg?v=1733173354', 100),
(9, 'HARD-004', 'SSD 480GB', 'SSD SATA 480GB alta velocidade.', 199.90, 2, 4, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRuH2MFq_UMfEIdcobWHPhvt02C8kFRh3nEKw&s', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS_Wvz59g6wx_i2DM29zH_TDnqOW8hY6X5BMA&s', 100),
(10, 'HARD-005', 'Fonte 600W', 'Fonte 600W certificação 80 Plus.', 249.90, 2, 7, 'https://lojaibyte.vteximg.com.br/arquivos/ids/429342-1200-1200/fonte-gamemax-gs600-600w-80-plus-white-pfc-ativo-com-cabo-preto-01-min.jpg?v=638531307389530000', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS_M-MR508q-KTeCgcMoX42hUhQGCGtHRjdqA&s', 100);

-- --------------------------------------------------------

--
-- Estrutura para tabela `subcategoria`
--

CREATE TABLE `subcategoria` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `subcategoria`
--

INSERT INTO `subcategoria` (`id`, `nome`) VALUES
(1, 'Placa-mãe'),
(2, 'Processador'),
(3, 'Memória RAM'),
(4, 'SSD'),
(5, 'HD'),
(6, 'Placa de Vídeo'),
(7, 'Fonte'),
(8, 'Gabinete'),
(9, 'Monitor'),
(10, 'Teclado'),
(11, 'Mouse'),
(12, 'Headset'),
(13, 'Cooler'),
(14, 'Water Cooler'),
(15, 'Webcam'),
(16, 'Mousepad ');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarioperfil`
--

CREATE TABLE `usuarioperfil` (
  `administrador_id` int(11) NOT NULL,
  `perfil_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `telefone` int(20) DEFAULT NULL,
  `tipo` enum('cliente','admin') NOT NULL,
  `data_cadastro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `telefone`, `tipo`, `data_cadastro`) VALUES
(1, 'Messias', 'messias@gmail.com', '$2y$10$XJNNy3xZoaVJVXb/EnKnH.Y90aQ4UkzjqPaMCBdV2kYzrsU2yiNNC', 2147483647, 'cliente', '2025-11-21 13:52:29'),
(2, 'b', 'b@gmail.com', '$2y$10$8z3Ljcu4oRN27vb7P.VVUed3Lc8rhc1Q3XgG.k1cNfiU629W6q5FC', 2147483647, 'cliente', '2025-11-21 14:03:49'),
(3, 'hugo', 'h@gmail.com', '$2y$10$WIORgzvEasbfCjuiLACmc.vJfDYx6cKX/vW3BDlX/tSbkJ7/VUFcK', 2147483647, 'cliente', '2025-11-28 13:02:49'),
(5, 'Teste', 'teste@gmail.com', '$2y$10$/gnO/iQFIMSnJaIcMTpVmeOEggB4KQP0PjlDW5zb9SVQDhvPhfROi', 2147483647, 'cliente', '2025-11-28 13:20:49'),
(6, 'Teste', 'teste1@gmail.com', '$2y$10$7T.KgnLLFTINjTYB/WGBaOFwuHV7w0VJ4TTUybaCun.chwm2ygbRW', 2147483647, 'cliente', '2025-11-28 13:22:06'),
(7, 'julia', 'ju@gmail.com', '$2y$10$q2LN5SuUctMtMqS8eCYvWuK4aLUwvttvhaTEu4yssGl4Opm9pTvTm', 2147483647, 'cliente', '2025-11-29 15:32:30'),
(8, 'arthur', 'aaaa@gmail.com', '$2y$10$v6yOn79P0aeyKV6pWEGERO18M/XsRrvypQkD7EsOHdCGVQhQ0fVA2', 2147483647, 'cliente', '2025-11-29 16:22:33'),
(9, 'hugoo', 'hg@gmail.com', '$2y$10$APIVB5zQYdx7iD1cGsDmtugNJ1Le1fKC3I4Qg3QqbMpILvL1YqS3G', 2147483647, 'cliente', '2025-11-29 16:49:11');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produto_id` (`produto_id`),
  ADD KEY `FK_usuario` (`id_usuario`);

--
-- Índices de tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Índices de tabela `carrinhoitem`
--
ALTER TABLE `carrinhoitem`
  ADD PRIMARY KEY (`carrinho_id`,`produto_id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `cupom`
--
ALTER TABLE `cupom`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Índices de tabela `cupomcategoria`
--
ALTER TABLE `cupomcategoria`
  ADD PRIMARY KEY (`cupom_id`,`categoria_id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Índices de tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Índices de tabela `estoquemovimento`
--
ALTER TABLE `estoquemovimento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Índices de tabela `historico`
--
ALTER TABLE `historico`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `endereco_id` (`endereco_id`);

--
-- Índices de tabela `pedidoitem`
--
ALTER TABLE `pedidoitem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Índices de tabela `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `fk_produto_subcategoria` (`id_subcategoria`);

--
-- Índices de tabela `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarioperfil`
--
ALTER TABLE `usuarioperfil`
  ADD PRIMARY KEY (`administrador_id`,`perfil_id`),
  ADD KEY `perfil_id` (`perfil_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `cupom`
--
ALTER TABLE `cupom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `estoquemovimento`
--
ALTER TABLE `estoquemovimento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `historico`
--
ALTER TABLE `historico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pedidoitem`
--
ALTER TABLE `pedidoitem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `subcategoria`
--
ALTER TABLE `subcategoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD CONSTRAINT `FK_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `fk_pedido_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuario_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuarios_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `fk_endereco_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `fk_produto_subcategoria` FOREIGN KEY (`id_subcategoria`) REFERENCES `subcategoria` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
