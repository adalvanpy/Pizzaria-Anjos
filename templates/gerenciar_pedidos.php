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
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="w-full min-h-screen bg-[#f9f5ed] flex flex-col items-center justify-between">
<header class=" p-4 flex items-center justify-between w-full h-[50%] bg-white/50 text-black ">
    <div>
        <span>Bem vindo <?=$usuario['nome']?></span>
    </div>
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php">Sair</a>
    </div>
</header>
<main class="flex w-[90%] flex-col justify-center items-center bg-[#f9f5ed]">
    <h2 class="text-2xl font-bold">Histórico de pedidos</h2>
    <table class="table-auto w-full border border-gray-300 text-sm mt-4">
        <thead class="bg-gray-100">
        <tr>
            <th class="border px-4 py-2">Id</th>
            <th class="border px-4 py-2">Status</th>
            <th class="border px-4 py-2">Entrega</th>
            <th class="border px-4 py-2">Frete</th>
            <th class="border px-4 py-2">Total</th>
            <th class="border px-4 py-2"></th>
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
                <td class="border px-4 py-2  max-w-[50px]">
                    <a class="underline text-blue-500">Atualizar Status</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</main>
<footer class="bg-white/50 text-black text-center p-4 w-full py-8 mt-60">
    <p>&copy; 2025 Pizzaria Anjos. Todos os direitos reservados.</p>
</footer>
</body>
</html>
