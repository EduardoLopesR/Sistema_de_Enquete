<?php
session_start();
require_once 'conexao.php';

$voto = $_POST['voto'] ?? '';

if ($voto=$_POST['voto']=='sim'){

 $sql = "UPDATE enquete SET quant_votos_sim = quant_votos_sim + 1 WHERE id = 1";
 $query = mysqli_query($conexao, $sql);
}
if ($voto=$_POST['voto']=='nao'){

 $sql = "UPDATE enquete SET quant_votos_nao = quant_votos_nao + 1 WHERE id = 1";
 $query = mysqli_query($conexao, $sql);
}
$conexao -> close();


?>
<h1>Seu voto foi registrado!</h1>