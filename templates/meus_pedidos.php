<?php
session_start();
include("../conexao/conexao.php");
include("../models/Consultas.php");

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$consulta = new Consultas($conexao);
$cliente = $consulta->getCliente($id);
$usuario = $consulta->getUsuario($id);
$pedido = $consulta->getPedidoId($cliente['id']);

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
        <span class=" ml-8 bg-[#367588] rounded-full px-4 py-2"><?= substr($usuario['nome'], 0, 1) ?></span>
    <div class="flex gap-4 mr-8">
        <a class="text-2xl underline" href="dashboard.php?id=<?=$usuario['id']?>">Dashboard</a>
        <a class="text-2xl underline" href="logout.php">Sair</a>
    </div>
</header>
<main class="w-full flex-grow p-8">
    <h2 class="text-2xl font-bold">Histórico de pedidos</h2>
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
            <td class="border px-4 py-2 text-center">
                <?Php if($ped['status'] === 'Finalizado'):?>
                <a class="underline text-blue-500">Cancelar</a>
                <?Php elseif ($ped['status'] === 'Concluido'):?>
                <a class="underline text-blue-500  ml-2">Excluir</a>
                <?Php else:?>
                <p> - </p>
                <?Php endif;?>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</main>
<footer class="w-full bg-[#367588] text-white text-center p-8">
    <p>&copy; 2025 Pizzaria Anjos. Todos os direitos reservados.</p>
</footer>
</body>
</html>

