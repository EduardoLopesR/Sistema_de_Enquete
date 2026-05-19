<?php
session_start();

function cadastrarUsuario() {
    $usuario = $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';

    $_SESSION['usuario'] = $usuario;
    $_SESSION['senha'] = $senha;

    echo "<h3>Usuário cadastrado com sucesso!</h3>";
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    cadastrarUsuario();
} else {
    echo "<h3>Acesso inválido.</h3>";
    echo "<p>Por favor, acesse o formulário de cadastro.</p>";
}
?>