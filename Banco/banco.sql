CREATE DATABASE minha_base_de_dados;
USE minha_base_de_dados;

CREATE TABLE perfis (
    usuario_id INT ,
    usuario_nome VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    PRIMARY KEY (usuario_id)
)