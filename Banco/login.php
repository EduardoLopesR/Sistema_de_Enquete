<?php
session_start();
require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_POST['usuario'] ?? '';
    $senha   = $_POST['senha'] ?? '';

    $stmt = $conexao->prepare(
        "SELECT usuario_id, usuario_nome, senha FROM usuarios WHERE usuario_nome = :nome"
    );
    $stmt->execute([':nome' => $usuario]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $senha === $user['senha']) {
        $_SESSION['usuario_id']   = $user['id'];
        $_SESSION['usuario_nome'] = $user['usuario_nome'];
        header("Location: ../Páginas/enquete.html");
        exit;
    } else {
        echo "<p>Usuário ou senha incorretos.</p>";
    }
}
?>