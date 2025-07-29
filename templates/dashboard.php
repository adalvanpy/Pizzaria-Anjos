<?php
session_start();
include("../conexao/conexao.php");
include("../models/Consultas.php");
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$model = new Consultas($conexao);
$usuario = $model->getUsuario($id);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="w-full h-full">
<header class=" p-4 flex items-center justify-between w-full bg-black text-white ">
<div>
    <span>Bem vindo <?=$usuario['nome']?></span>
</div>
<div>
    <a href="fazer_pedido.php">Fazer pedido</a>
    <a href="meus_pedidos.php?id=<?=$usuario['id']?>">Meus Pedidos</a>
    <a href="logout.php">Sair</a>
</div>
</header>
<main>

</main>
</body>
</html>