<?php
include("../conexao/conexao.php");
include("../models/Deletar.php");
$id = $_GET["id"];
$id_user = $_GET["id_user"];
$deletar = new Deletar($conexao);

$deletar->deletePedido($id);
header("Location: meus_pedidos.php?id=" . $id_user);
?>
