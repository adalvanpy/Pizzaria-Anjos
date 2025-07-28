<?php
session_start();
include "../conexao/conexao.php";
include("../models/Consultas.php");
$model = new Consultas($conexao);
    $usuario = $model->getUsuarioTipo('admin');
    $pizza = $model->getPizza();
    $bebida = $model->getBebidass();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Gerenciar estoque</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="w-full h-full bg-[#f9f5ed] flex flex-col items-center justify-center">
<header class=" mt-4 p-4 flex items-center justify-between w-[90%] h-[50%] bg-white/50 shadow shadow-orange-300 text-black ">
    <div>
        <span>Bem vindo <?=$usuario['nome']?></span>
    </div>
    <div>
        <a>Gerenciar Pedidos</a>
        <a href="logout.php">Sair</a>
    </div>
</header>
<main class="flex w-[90%] border flex-col justify-center items-center bg-[#f9f5ed]">
 <h2 class="text-2xl m-4">Pizzas tamanho Pequena</h2>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 w-full p-6">
        <?php foreach($pizza as $row): ?>
            <?php if($row['tamanho'] === 'Pequena'): ?>
                <div class="bg-white shadow p-3 rounded text-sm flex flex-col">
                    <h2 class="font-semibold mb-2 text-base"><?=$row['nome']?></h2>
                    <p class="text-green-500 font-semibold text-sm"><?=$row['estoque']?></p>
                    <img src="../fotos/<?=$row['foto']?>" alt="<?=$row['nome']?>" class="w-full h-44 object-cover mb-2 rounded">
                    <p><span class="text-sm font-bold">Preço R$</span><?=$row['preco']?></p>
                    <p class="text-sm">Borda:<?=$row['borda']?></p>
                    <p class="mt-1 mb-2 text-xs">Ingredientes: <?=$row['igredientes']?></p>
                    <a href="editar_pizza.php?id=<?=$row['id']?>" class="mt-auto bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded shadow self-start">ATUALIZAR</a>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <h2>Bebidas</h2>
    <p>Sucos</p>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 w-full p-6">
        <?php foreach($bebida as $beb): ?>
        <?php if($beb['tipo'] === 'Suco'): ?>
          <div class="bg-white shadow p-3 rounded text-sm flex flex-col">
              <h2><?=$beb['nome']?></h2>
              <p class="text-green-500 font-semibold text-sm"><?=$beb['estoque']?></p>
              <img src="../fotos/<?=$beb['foto']?>" alt="<?=$beb['nome']?>" class="w-full h-44 object-cover mb-2 rounded">
              <p><span class="text-sm font-bold">Preço R$</span><?=$beb['preco']?></p>
              <p><?=$beb['ml']?></p>
              <a href="editar_bebida.php?id=<?=$beb['id']?>" class="mt-auto bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded shadow self-start">ATUALIZAR</a>
          </div>
        <?php endif;?>
        <?php endforeach;?>
    </div>
</main>
<footer class="bg-white/50 text-black text-center p-4 w-[90%] h-[50%] shadow shadow-orange-300 mt-60">
    <p>&copy; 2025 Pizzaria Anjos. Todos os direitos reservados.</p>
</footer>
</body>
</html>
