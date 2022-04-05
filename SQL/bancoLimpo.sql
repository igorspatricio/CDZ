--Banco de dados CDZ

--Tabela Usuario

CREATE TABLE `usuario` (
  `apelido` varchar(100) NOT NULL,
  `login` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `usuario` ADD PRIMARY KEY (login);

CREATE TABLE item 
(
  nomeArquivo varchar(100) NOT NULL,
  descricao varchar(300)  NOT NULL,
  usuario varchar(100) NOT NULL,
  categoria varchar(100) NOT NULL,
  diretorio varchar(300) NOT NULL,
  CONSTRAINT fk_login FOREIGN KEY (usuario) REFERENCES usuario (login),
  PRIMARY KEY (nomeArquivo, usuario)
)
ALTER TABLE item ADD diretorio varchar(300) NOT NULL;

create table categoria
(
    categoria varchar(30),
    PRIMARY KEY (categoria)
)

