CREATE DATABASE IF NOT EXISTS enquete;
USE enquete;

CREATE TABLE IF NOT EXISTS usuarios (
    usuario_id   INT AUTO_INCREMENT PRIMARY KEY,
    usuario_nome VARCHAR(255) NOT NULL UNIQUE,
    senha        VARCHAR(255) NOT NULL
);

DESC usuarios;

/* fluxo do sistemas */
/* cadastro.html → cadastro.php → INSERT no MySQL (tabela usuarios) */
/* login.html    → login.php    → SELECT + password_verify → enquete.html */