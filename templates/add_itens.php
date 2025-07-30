<?php
session_start();
include("../conexao/conexao.php");
include("../models/Cadastro.php");
include("../models/Consultas.php");
include("../models/Editar.php");
$id = $_GET['id_pedido'] ?? 0;
$userId = $_GET['user_id'] ?? 0;
$busca = new Consultas($conexao);
$add = new Cadastro($conexao);
$total = new Editar($conexao);
$itens = $busca->getItens();
$nome = $busca->getUsuario($userId);

$subtotal = 0.00;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $itens_selecionados = $_POST['itens'] ?? [];
    $quantidade = $_POST['quantidade'] ?? [];
    $precos = $_POST['preco'] ?? [];
    $observacao = $_POST['observacao'] ?? '';

    foreach ($itens_selecionados as $item_id) {
        $qtd = (int)($quantidade[$item_id] ?? 1);
        $preco = (float)($precos[$item_id] ?? 0);
        $subtotal += $preco * $qtd;

        $add->criarItemPedido($id, $item_id, $qtd, $observacao, $preco * $qtd);
    }
    $total->atualizarTotal($id, $subtotal);
    header("Location: ../templates/pagamento.php?id_pedido=$id&user_id=$userId");
    exit();
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Adcionar itens</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f9f5ed] min-h-screen flex flex-col items-center">
<header class="w-full bg-[#b22222] text-white p-4 flex gap-4 items-center justify-start">
    <span class="ml-8">Seja bem vindo(a) <?=$nome['nome']?></span>
</header>
<main class="w-full flex-grow p-8">
    <form method="post" action="add_itens.php?id_pedido=<?= $id ?>&user_id=<?=$userId?>" class="w-full">
        <div class="p-6">
            <h2 class="text-xl font-bold mb-2">Pizzas</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                <?php foreach($itens as $item): ?>
                    <?php if($item['tipo'] == 'Pizza'): ?>
                        <div class="bg-white shadow p-4 rounded text-sm flex flex-col">
                            <p class="font-semibold mb-2 text-base"><?= $item['nome'] ?></p>
                            <img src="../fotos/<?= $item['foto'] ?>" alt="<?= $item['nome'] ?>" class="w-full h-44 object-cover mb-2 rounded">
                            <p>Tamanho: <?= $item['tamanho'] ?></p>
                            <p class="text-sm font-bold">R$ <?= $item['preco'] ?></p>
                            <p class="text-sm"><?= $item['borda'] ?></p>
                            <div class="flex items-center justify-between w-full h-full">
                                <input type="checkbox" class="scale-[2.5] mt-4 ml-2" name="itens[]" value="<?= $item['id'] ?>">
                                <input  class="p-2 mt-4 w-[20%] h-8 border border-black rounded" type="number" name="quantidade[<?= $item['id'] ?>]" value="1">
                                <input type="hidden" name="preco[<?= $item['id'] ?>]" value="<?= $item['preco'] ?>">
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <h2 class="text-xl font-bold my-4">Bebidas</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                <?php foreach($itens as $item): ?>
                    <?php if($item['tipo'] == 'Bebida'): ?>
                        <div class="bg-white shadow p-4 rounded text-sm flex flex-col">
                            <p class="font-semibold mb-2 text-base"><?= $item['nome'] ?></p>
                            <img src="../fotos/<?= $item['foto'] ?>" alt="<?= $item['nome'] ?>" class="w-full h-44 object-cover mb-2 rounded">
                            <p><?= $item['ml'] ?></p>
                            <p class="text-sm font-bold">R$ <?= $item['preco'] ?></p>
                            <div class="flex items-center justify-between w-full h-full">
                                <input class="scale-[2.5] mt-4 ml-2" type="checkbox" name="itens[]" value="<?= $item['id'] ?>">
                                <input type="number" name="quantidade[<?= $item['id'] ?>]" class="p-2 mt-4 w-[20%] h-8 border border-black rounded" value="1">
                                <input type="hidden" name="preco[<?= $item['id'] ?>]" value="<?= $item['preco'] ?>">
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="flex flex-col items-center w-full">
            <textarea class="w-[50%] h-20 p-2 border rounded mt-4" name="observacao" placeholder="Alguma observação?"></textarea>
            <button class="w-[50%] border rounded bg-blue-500 mt-4 text-white p-2" type="submit">Adicionar</button>
        </div>

    </form>
</main>

<footer class="w-full bg-[#556b2f] text-white text-center p-8">
    <p>&copy; 2025 Pizzaria Anjos. Todos os direitos reservados.</p>
</footer>
<script>
</script>
</body>
</html>

