<?php
session_start();
require_once 'conexao.php';

function cadastrarUsuario($conexao) {
    $usuario = $_POST['usuario_nome'] ?? '';
    $senha   = $_POST['senha'] ?? '';

    if (empty($usuario) || empty($senha)) {
        echo "<p>Preencha todos os campos.</p>";
        return;
    }

    // Verifica se usuário já existe
    $stmt = $conexao->prepare("SELECT usuario_id FROM usuarios WHERE usuario_nome = :nome");
    $stmt->execute([':nome' => $usuario]);
    if ($stmt->fetch()) {
        echo "<p>Usuário já existe.</p>";
        return;
    }
    
    $stmt = $conexao->prepare("INSERT INTO usuarios (usuario_nome, senha) VALUES (:nome, :senha)");
    $stmt->execute([':nome' => $usuario, ':senha' => $senha]);

    echo "<h3>Usuário cadastrado com sucesso! ID: " . $conexao->lastInsertId() . "</h3>";
    echo "<p><a href='../Páginas/login.html'>Faça login</a></p>";
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    cadastrarUsuario($conexao);
} else {
    echo "<h3>Acesso inválido.</h3>";
}
?>