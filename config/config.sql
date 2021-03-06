create database pequia;

CREATE TABLE `usuarios` (
  `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `endereco` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `telefone` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `sexo` varchar(1) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `produtos` (
  `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `titulo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `subtitulo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `localFoto` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `tag1` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `tag2` varchar(35) COLLATE utf8_unicode_ci,
  `tag3` varchar(35) COLLATE utf8_unicode_ci,
  `tag4` varchar(35) COLLATE utf8_unicode_ci,
  `tag5` varchar(35) COLLATE utf8_unicode_ci,
  `id_usuario_publicacao` int(11),
  `qtd_estoque` int(11),
  `preco_venda` DECIMAL(10, 2),
  `data_publicacao` TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `vendas` (
  `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `id_cliente` int(11),
  `descricao` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `data_criacao` TIMESTAMP,
  `fechada` boolean,
  `vl_total` DECIMAL(10, 2)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `vendas_itens` (
  `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `id_venda` int(11),
  `quantidade` int(11),
  `id_produto` int(11), 
  `vl_total` DECIMAL(10, 2)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

insert into  `usuarios` ( `nome`,  `login`,    `endereco` ,  `telefone` ,  `senha` ,  `email`,  `sexo`, `tipo`) 
                  value (  'Carlos',  'carlos',  'casa' ,  '6663356' ,  '827ccb0eea8a706c4c34a16891f84e7b' ,  'lala@gmail.com',  'M','ADMINISTADOR');