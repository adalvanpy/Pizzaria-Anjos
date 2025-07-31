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
<body class="bg-[#f9f5ed] min-h-screen flex flex-col items-center">
<header class="w-full bg-[#b22222] text-white p-4 flex items-center justify-between">
    <span class="bg-[#367588] ml-8 rounded-full px-4 py-2"><?= substr($usuario['nome'], 0, 1) ?></span>
<div class="flex gap-4">
    <a class="mr-8 text-2xl underline" href="logout.php">Sair</a>
</div>
</header>
<main class="w-full flex-grow p-8">
    <div class=" w-[29%] flex items-center justify-end">
        <p class="text-3xl text-[#556b2f] animate-bounce"><span class="text-[#b22222]">Bem vindo(a)</span> <?=$usuario['nome']?></p>
    </div>
    <div class="gap-6 p-6 w-full  flex justify-center items-center">
        <div class=" w-[25%] bg-white shadow-md rounded-2xl p-6 text-center hover:shadow-xl transition">
            <h3 class="text-xl font-bold text-[#b22222] mb-2">🍕 Fazer Pedido</h3>
            <p class="text-gray-600">Monte sua pizza do jeitinho que quiser e receba quentinha na sua casa!</p>
            <a href="fazer_pedido.php?id=<?=$usuario['id']?>"class="mt-4 inline-block bg-[#b22222] text-white px-4 py-2 rounded hover:bg-red-700">Pedir agora</a>
        </div>

        <div class="  w-[25%] bg-white shadow-md rounded-2xl p-6 text-center hover:shadow-xl transition">
            <h3 class="text-xl font-bold text-[#b22222] mb-2">📦 Meus Pedidos</h3>
            <p class="text-gray-600">Acompanhe o status dos seus pedidos e veja seu histórico completo.</p>
            <a href="meus_pedidos.php?id=<?=$usuario['id']?>" class="mt-4 inline-block bg-[#b22222] text-white px-4 py-2 rounded hover:bg-red-700">Ver pedidos</a>
        </div>

        <div class="  w-[25%] bg-white shadow-md rounded-2xl p-6 text-center hover:shadow-xl transition">
            <h3 class="text-xl font-bold text-[#b22222] mb-2">❤️ Preferências</h3>
            <p class="text-gray-600">Salve suas pizzas favoritas e peça novamente com um clique!</p>
            <a href="#" class="mt-4 inline-block bg-[#b22222] text-white px-4 py-2 rounded hover:bg-red-700">Ver favoritas</a>
        </div>
    </div>

</main>
<footer class="w-full bg-[#367588] text-white text-center p-8">
    <p>&copy; 2025 Pizzaria Anjos. Todos os direitos reservados.</p>
</footer>
</body>
</html>