<?php
include("../conexao/conexao.php");
include("../models/Deletar.php");
$id = $_GET["id"];
$id_user = $_GET["id_user"];
$deletar = new Deletar($conexao);

$deletar->delete_Item_Pedido($id);
header("Location: deletar_pedido.php?id=$id&id_user=$id_user");

?>