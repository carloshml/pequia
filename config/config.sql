create database pequia;

CREATE TABLE `usuarios` (
  `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `endereco` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `telefone` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
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
  `id_autor_publicacao` int(11),
  `data_publicacao` TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

insert into  `usuarios` ( `nome`,  `login`,    `endereco` ,  `telefone` ,  `senha` ,  `email`,  `sexo`) 
                  value (  'Carlos',  'carlos',  'casa' ,  '6663356' ,  '827ccb0eea8a706c4c34a16891f84e7b' ,  'lala@gmail.com',  'M');