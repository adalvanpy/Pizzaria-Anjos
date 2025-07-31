<?php
session_start();
include "../conexao/conexao.php";
include("../models/Consultas.php");
$model = new Consultas($conexao);
$itens = $model->getItens();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Gerenciar estoque</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f9f5ed] w-full min-h-screen flex flex-col items-center justify-between">
<header class=" p-4 flex items-center justify-between w-full h-[50%] bg-[#b22222] text-white ">
    <div class="flex gap-4">
       <a href="../index.php" class="text-2xl underline">Inicio</a>
    </div>
</header>
<main class="flex w-[90%] flex-col justify-center items-center bg-[#f9f5ed]">
    <h2 class="text-2xl m-4 text-[#556b2f] font-bold animate-bounce">Pizzas</h2>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 w-full p-6">
        <?php foreach($itens as $row): ?>
            <?php if($row['tipo'] === 'Pizza'): ?>
                <div class="bg-white shadow p-3 rounded text-sm flex flex-col">
                    <h2 class="font-semibold mb-2 text-base"><?=$row['nome']?></h2>
                    <p class="text-green-500 font-semibold text-sm"><?=$row['estoque']?></p>
                    <img src="../fotos/<?=$row['foto']?>" alt="<?=$row['nome']?>" class="w-full h-44 object-cover mb-2 rounded">
                    <p><strong>Preço R$ </strong><?=$row['preco']?></p>
                    <p class="text-sm"><strong>Tamanho: </strong><?=$row['tamanho']?></p>
                    <p class="text-sm"><strong>Borda: </strong><?=$row['borda']?></p>
                    <p class="mb-2 text-sm"><strong>Ingredientes: </strong><?=$row['ingredientes']?></p>
                    <a href="login.php" class="mt-auto bg-[#367588] hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded shadow self-start">PEDIR</a>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <h2 class="text-2xl text-[#556b2f] m-4 font-bold animate-bounce">Bebidas</h2>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 w-full p-6">
        <?php foreach($itens as $beb): ?>
            <?php if($beb['tipo'] === 'Bebida'): ?>
                <div class="bg-white shadow p-3 rounded text-sm flex flex-col">
                    <h2 class="font-semibold mb-2 text-base"><?=$beb['nome']?></h2>
                    <p class="text-green-500 font-semibold text-sm"><?=$beb['estoque']?></p>
                    <img src="../fotos/<?=$beb['foto']?>" alt="<?=$beb['nome']?>" class="w-full h-44 object-cover mb-2 rounded">
                    <p><strong>Preço R$ </strong><?=$beb['preco']?></p>
                    <p><?=$beb['ml']?></p>
                    <a href="login.php" class="mt-auto bg-[#367588] hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded shadow self-start">PEDIR</a>
                </div>
            <?php endif;?>
        <?php endforeach;?>
    </div>
</main>
<footer class="bg-[#367588] text-white text-center p-4 w-full py-8 mt-60">
    <p>&copy; 2025 Pizzaria Anjos. Todos os direitos reservados.</p>
</footer>
</body>
</html>
