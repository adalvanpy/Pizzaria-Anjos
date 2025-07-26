<?php
session_start();
include "conexao.php";

$sql = "SELECT * FROM pizza";
$result = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Gerenciar estoque</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="w-full h-full">
<header class=" p-4 flex items-center justify-between w-full h-[50%] bg-black text-white ">
    <div>
        <span>Bem vindo <?=$usuario['nome']?></span>
    </div>
    <div>
        <a>Gerenciar Pedidos</a>
        <a href="logout.php">Sair</a>
    </div>
</header>
<main>
 <h2>Pizzas tamanho Pequena</h2>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 w-full p-6">
        <?php while($row = mysqli_fetch_array($result)):?>
        <?php if($row['tamanho'] === 'Pequena'):?>
        <div class="bg-white shadow p-3 rounded text-sm flex flex-col">
            <h2 class="font-semibold mb-2 text-base"><?=$row['nome']?></h2>
            <p class="text-green-500 font-semibold text-sm"><?=$row['estoque']?></p>
            <img src="fotos/<?=$row['foto']?>" alt="<?=$row['nome']?>" class="w-full h-44 object-cover mb-2 rounded">
            <p><span class="text-sm font-bold">Preço R$</span><?=$row['preco']?></p>
            <p class="text-sm">Borda:<?=$row['borda']?></p>
            <p class="mt-1 mb-2 text-xs">Ingredientes: <?=$row['igredientes']?></p>
            <a href="#" class="mt-auto bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded shadow self-start">ATUALIZAR</a>
        </div>
        <?php endif;?>
        <?php endwhile; ?>
    </div>
</main>
</body>
</html>
