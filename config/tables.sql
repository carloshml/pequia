CREATE DATABASE IF NOT EXISTS pequia DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE pequia;

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(50) COLLATE utf8_unicode_ci NOT NULL,
  `login` VARCHAR(50) COLLATE utf8_unicode_ci NOT NULL,
  `endereco` VARCHAR(80) COLLATE utf8_unicode_ci NOT NULL,
  `telefone` VARCHAR(35) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` VARCHAR(35) COLLATE utf8_unicode_ci NOT NULL,
  `senha` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` VARCHAR(40) COLLATE utf8_unicode_ci NOT NULL,
  `sexo` VARCHAR(1) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `produtos` (
  `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `titulo` VARCHAR(50) COLLATE utf8_unicode_ci NOT NULL,
  `subtitulo` VARCHAR(50) COLLATE utf8_unicode_ci NOT NULL,
  `localFoto` VARCHAR(80) COLLATE utf8_unicode_ci NOT NULL,
  `fileFoto` LONGBLOB,
  `descricao` VARCHAR(250) COLLATE utf8_unicode_ci NOT NULL,
  `tag1` VARCHAR(35) COLLATE utf8_unicode_ci NOT NULL,
  `tag2` VARCHAR(35) COLLATE utf8_unicode_ci,
  `tag3` VARCHAR(35) COLLATE utf8_unicode_ci,
  `tag4` VARCHAR(35) COLLATE utf8_unicode_ci,
  `tag5` VARCHAR(35) COLLATE utf8_unicode_ci,
  `id_usuario_publicacao` INT(11) UNSIGNED,
  `qtd_estoque` INT(11),
  `preco_venda` DECIMAL(10, 2),
  `data_publicacao` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT `fk_produto_usuario` FOREIGN KEY (`id_usuario_publicacao`) REFERENCES `usuarios` (`id`)
    ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `vendas` (
  `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `id_usuario` INT(11) UNSIGNED,
  `id_cliente` INT(11) UNSIGNED,
  `descricao` VARCHAR(250) COLLATE utf8_unicode_ci NOT NULL,
  `data_criacao` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `fechada` BOOLEAN DEFAULT FALSE,
  `vl_total` DECIMAL(10, 2),
  `status` VARCHAR(70) COLLATE utf8_unicode_ci,
  CONSTRAINT `fk_venda_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `usuarios` (`id`)
    ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `vendas_itens` (
  `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `id_venda` INT(11) UNSIGNED,
  `quantidade` INT(11),
  `id_produto` INT(11) UNSIGNED,
  `vl_total` DECIMAL(10, 2),
  CONSTRAINT `fk_item_venda` FOREIGN KEY (`id_venda`) REFERENCES `vendas` (`id`)
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_item_produto` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`)
    ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 👤 Seed admin user
INSERT INTO `usuarios` (`nome`, `login`, `endereco`, `telefone`, `senha`, `email`, `sexo`, `tipo`)
VALUES ('Carlos', 'carlos', 'casa', '6663356', '827ccb0eea8a706c4c34a16891f84e7b', 'lala@gmail.com', 'M', 'ADMINISTRADOR');