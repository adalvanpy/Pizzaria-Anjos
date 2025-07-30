<?php
session_start();
include("../conexao/conexao.php");
include("../models/Consultas.php");
include("../models/Editar.php");
$id = $_GET["id"] ?? 0;
$consulta = new Consultas($conexao);
$editar = new Editar($conexao);
$usuario = $consulta->getUsuario($id);
$func = $consulta->getFuncionarioId($id);
$pag = $consulta->getPagamentos($func['id']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Greneciar Caixa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f9f5ed] w-full min-h-screen flex flex-col items-center justify-between">
<header class=" p-4 flex items-center justify-between w-full h-[50%] bg-[#b22222] text-white ">
    <div>
        <span>Bem vindo <?=$usuario['nome']?></span>
    </div>
    <div class="flex gap-4">
        <a href="gerenciar_estoque.php?id=<?=$usuario['id']?>">Gerenciar Estoque</a>
        <a href="gerenciar_pedidos.php?id=<?=$usuario['id']?>">Gerenciar Pedidos</a>
        <a href="logout.php">Sair</a>
    </div>
</header>
<main  class=" flex w-[90%] flex-col justify-center items-center">
    <h2 class="text-2xl font-bold text-[#556b2f]">Histórico de pagamentos</h2>
    <table class="table-auto w-full border border-gray-300 text-sm mt-4">
        <thead class="bg-gray-100 text-left">
        <tr>
            <th colspan="2" class="border px-2 py-2">Id</th>
            <th colspan="2" class="border px-2 py-2">Pedido</th>
            <th colspan="2" class="border px-2 py-2">Método</th>
            <th colspan="2" class="border px-2 py-2">Valor</th>
            <th colspan="2" class="border px-2 py-2">Troco</th>
            <th colspan="2" class="border px-2 py-2">Data pagamento</th>
            <th colspan="2" class="border px-2 py-2">Status pagamento</th>
            <th colspan="2" class="border px-2 py-2">Ações</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($pag as $p): ?>
            <tr class="hover:bg-gray-50">
                <td colspan="2" class="border px-2 py-1"><?=$p['id']?></td>
                <td colspan="2" class="border px-2 py-1"><?=$p['pedido_id']?></td>
                <td colspan="2" class="border px-2 py-1"><?=$p['metodo']?></td>
                <td colspan="2" class="border px-2 py-1"><?=$p['valor']?></td>
                <td colspan="2" class="border px-2 py-1"><?=$p['troco']?></td>
                <td colspan="2" class="border px-2 py-1"><?=$p['data_pagamento']?></td>
                <td colspan="2" class="border px-2 py-1"><?=$p['status_pagamento']?></td>
                <td colspan="2" class="border px-2 py-1 text-blue-500 underline text-center">
                    <?php if ($p['status_pagamento'] == 'Pendente'): ?>
                    <a href="atualizar_status_pagamento.php?id=<?=$p['id']?>&userId=<?=$usuario['id']?>">Atualizar Status</a>
                    <?php else: ?>
                    <p class="text-black inline-block"> - </p>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</main>
<footer class="bg-[#556b2f] text-white text-center p-4 w-full py-8 mt-60">
    <p>&copy; 2025 Pizzaria Anjos. Todos os direitos reservados.</p>
</footer>
</body>
</html>
