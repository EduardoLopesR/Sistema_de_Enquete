<?php
session_start();
require_once 'conexao.php';

// Verifica se está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../Páginas/login.html");
    exit;
}

$stmt = $conexao->prepare(
    "SELECT pergunta, quant_votos_sim, quant_votos_nao FROM enquete WHERE id = 1"
);
$stmt->execute();
$enquete = $stmt->fetch(PDO::FETCH_ASSOC);

$sim  = $enquete['quant_votos_sim'];
$nao  = $enquete['quant_votos_nao'];
$total = $sim + $nao;

// Calcula porcentagem evitando divisão por zero
$pct_sim = $total > 0 ? round(($sim / $total) * 100) : 0;
$pct_nao = $total > 0 ? round(($nao / $total) * 100) : 0;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
    <link rel="stylesheet" href="../Styles/enquete.css">
</head>
<body>
    <h1>Resultado da Enquete</h1>
    <h3><?= $enquete['pergunta'] ?></h3>

    <p>Total de votos: <strong><?= $total ?></strong></p>

    <p> SIM: <strong><?= $sim ?> votos (<?= $pct_sim ?>%)</strong></p>
    <div class="barra">
        <div class="barra-sim" style="width: <?= $pct_sim ?>%"><?= $pct_sim ?>%</div>
    </div>

    <p> NÃO: <strong><?= $nao ?> votos (<?= $pct_nao ?>%)</strong></p>
    <div class="barra">
        <div class="barra-nao" style="width: <?= $pct_nao ?>%"><?= $pct_nao ?>%</div>
    </div>

    <br>
    <a href="enquete.html">Voltar</a>
</body>
</html>