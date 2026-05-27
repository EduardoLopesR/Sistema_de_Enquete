<?php
session_start();
require_once 'conexao.php';

// Verifica se está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../Páginas/login.html");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$voto = $_GET['voto'] ?? '';

if ($voto === 'sim' || $voto === 'nao') {

    // Verifica se já votou
    $stmt = $conexao->prepare(
        "SELECT id FROM votos WHERE usuario_id = :uid AND enquete_id = 1"
    );
    $stmt->execute([':uid' => $usuario_id]);

    if ($stmt->fetch()) {
        echo "<p>Você já votou nesta enquete.</p>";
        exit;
    }
    // Registra o voto na enquete
    $coluna = $voto === 'sim' ? 'quant_votos_sim' : 'quant_votos_nao';
    $stmt = $conexao->prepare(
        "UPDATE enquete SET $coluna = $coluna + 1 WHERE id = 1"
    );
    $stmt->execute();
    // Registra que esse usuário já votou
    $stmt = $conexao->prepare(
        "INSERT INTO votos (usuario_id, enquete_id) VALUES (:uid, 1)"
    );
    $stmt->execute([':uid' => $usuario_id]);

    echo "<h1>Seu voto foi registrado!</h1>";
    echo "<p><a href='enquete.html'>Ver resultado</a></p>";
} else {
    echo "<p>Voto inválido.</p>";
}
?>