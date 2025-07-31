<?php
session_start();
include("../conexao/conexao.php");
include("../models/Consultas.php");
$id = isset($_GET['id']) ? $_GET['id'] : 0;

$consulta = new Consultas($conexao);
$usuario = $consulta->getUsuario($id);
$func = $consulta->getFuncionarioId($id);
$pedido = $consulta->getPedidosForGerencia($func['id']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Gerenciar Pedidos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f9f5ed] w-full min-h-screen flex flex-col items-center justify-between">
<header class=" p-4 flex items-center justify-between w-full h-[50%] bg-[#b22222] text-white ">
    <div>
        <span class="bg-[#367588] ml-8 rounded-full px-4 py-2 mr-8"><?= substr($usuario['nome'], 0, 1) ?></span>
    </div>
    <div class="flex gap-4">
        <a class="text-2xl underline" href="gerenciar_estoque.php?id=<?=$usuario['id']?>">Gerenciar Estoque</a>
        <a class="text-2xl underline" href="gerenciar_caixa.php?id=<?=$usuario['id']?>">Gerenciar Caixa</a>
        <a class="text-2xl underline" href="logout.php">Sair</a>
    </div>
</header>
<main class="flex w-[90%] flex-col justify-center items-center bg-[#f9f5ed]">
    <h2 class="text-2xl font-bold text-[#556b2f]">Histórico de pedidos</h2>
    <table class="table-auto w-full border border-gray-300 text-sm mt-4">
        <thead class="bg-gray-100">
        <tr>
            <th class="border px-4 py-2">Id</th>
            <th class="border px-4 py-2">Status</th>
            <th class="border px-4 py-2">Entrega</th>
            <th class="border px-4 py-2">Frete</th>
            <th class="border px-4 py-2">Total</th>
            <th class="border px-4 py-2">Ações</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($pedido as $ped):?>
            <tr class="hover:bg-gray-50">
                <td class="border px-4 py-2"><?=$ped['id']?></td>
                <td class="border px-4 py-2"><?=$ped['status']?></td>
                <td class="border px-4 py-2"><?=$ped['tipo_entrega']?></td>
                <td class="border px-4 py-2"><?=$ped['frete']?></td>
                <td class="border px-4 py-2"><?=$ped['total']?></td>
                <td class="border px-4 py-2 max-w-[50px]">
                    <a class="underline text-blue-500" href="atualizar_status.php?id=<?=$ped['id']?>&userId=<?=$usuario['id']?>">Atualizar Status</a>
                    <button class="underline ml-2 text-blue-500" onclick="exibir('itens<?=$ped['id']?>')">Exibir itens</button>
                </td>
            </tr>
            <tr id="itens<?=$ped['id']?>" class="hidden">
                <td colspan="6">
                    <table class="table-auto w-full border border-gray-300 text-sm mt-4">
                        <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2">Itens</th>
                            <th class="border px-4 py-2">Quantidade</th>
                            <th class="border px-4 py-2">Tamanho</th>
                            <th class="border px-4 py-2">Borda</th>
                            <th class="border px-4 py-2">Ml</th>
                            <th class="border px-4 py-2">Observação</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $itens = $consulta->getItem_pedido($ped['id']);?>
                        <?php foreach ($itens as $it):?>
                            <tr>
                                <td class="border px-4 py-2 text-center"><?=$it['nome'] ?: '-'?></td>
                                <td class="border px-4 py-2 text-center"><?=$it['quantidade'] ?: '-'?></td>
                                <td class="border px-4 py-2 text-center"><?=$it['tamanho'] ?: '-'?></td>
                                <td class="border px-4 py-2 text-center"><?=$it['borda'] ?: '-'?></td>
                                <td class="border px-4 py-2 text-center"><?=$it['ml'] ?: '-'?></td>
                                <td class="border px-4 py-2 text-center"><?=$it['observacao'] ?: '-'?></td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</main>

<footer class="bg-[#367588] text-white text-center p-4 w-full py-8 mt-60">
    <p>&copy; 2025 Pizzaria Anjos. Todos os direitos reservados.</p>
</footer>
<script>
    function exibir(id) {
        document.getElementById(id).classList.toggle('hidden');
    }
</script>
</body>
</html>
