<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
include("../conexao/conexao.php");
include("../models/Cadastro.php");
include("../models/Consultas.php");

$id = $_GET['id'] ?? 0;
$pedir = new Cadastro($conexao);
$buscar = new Consultas($conexao);
$user = $buscar->getUsuario($id);
$cl = $buscar->getCliente($user['id']);
$admin = $buscar->getAdmin('admin');
$func = $buscar->getFuncionarioId($admin['id']);

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $hora = date("Y-m-d H:i:s");
    $tipo_entrega = $_POST['tipo_entrega'] ?? '';
    $frete = 0.00;

    if ($tipo_entrega === 'Delivery') {
        $frete = $_POST['frete'] ?? 0.00;
    }

    $status = 'Pendente';
    $total = $frete;

    $pedir->criarPedido(
        $cl['id'] ?? '?',
        $func['id'],
        $status,
        $cl['endereco'] ?? '?',
        $tipo_entrega,
        $frete,
        $hora,
        $total,
            $cl['telefone'] ?? '?',
        $user['id']
    );
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f9f5ed] min-h-screen flex flex-col items-center">
<header class="w-full bg-[#b22222] text-white p-4 flex items-center justify-between">
    <span class="ml-8">Seja bem bindo(a) <?=$user['nome']?></span>
    <div class="flex gap-4 mr-8">
        <a href="meus_pedidos.php?id=<?=$user['id']?>">Meus Pedidos</a>
        <a href="logout.php">Sair</a>
    </div>
</header>
<main class="w-full flex-grow p-8">
    <form class="w-full flex flex-col items-center justify-center" method="post" action="fazer_pedido.php?id=<?=$id?>">
        <h2 class="text-3xl text-[#556b2f]">Escolha o seu tipo de entrega</h2>
        <div class="mt-4">
            <select class="border p-2 w-60 rounded" name="tipo_entrega" id="tipo_entrega">
                <option  value="Delivery">Delivery</option>
                <option value="Retirar no local">Retirar no local</option>
                <option value="Consumir no local">Consumir no local</option>
            </select>
            <input type="number" class="hidden" name="frete" value="5.00">
            <button class="underline text-[#556b2f]" type="submit">Criar Pedido</button>
        </div>
    </form>
</main>
<footer class="w-full bg-[#556b2f] text-white text-center p-8">
    <p>&copy; 2025 Pizzaria Anjos. Todos os direitos reservados.</p>
</footer>
</body>
</html>

