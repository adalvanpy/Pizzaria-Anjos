<?php
session_start();
include ("../conexao/conexao.php");
include("../models/Consultas.php");
$pedido_id = isset($_GET['pedido_id'])?(int)$_GET['pedido_id'] : 0;
$model = new Consultas($conexao);

$pizzas = $model->getPizza();
$bebidas = $model->getBebidass();



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pizzas      = $_POST['pizzas'] ?? [];
    $bebidas     = $_POST['bebidas'] ?? [];
    $quantidadep = $_POST['quantidadep'] ?? [];
    $quantidadeb = $_POST['quantidadeb'] ?? [];
    $observacao  = $_POST['observacao'] ?? '';
    $precop      = $_POST['precop'] ?? [];
    $precob      = $_POST['precob'] ?? [];

    $subtotal = 0.00;

    foreach ($pizzas as $pzz) {
        $qtd = isset($quantidadep[$pzz]) ? (int)$quantidadep[$pzz] : 0;
        if ($qtd <= 0) continue;
        $prc = isset($precop[$pzz]) ? (float)$precop[$pzz] : 0.0;

        $sql_add = "INSERT INTO itens_pedido(id_pedido, id_pizza, id_bebida, quantidade, observacao, subtotal) VALUES (?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conexao, $sql_add);
        $id_bebida = NULL;
        $subtotal += $prc * $qtd;
        $stmt->bind_param("iiiisd", $pedido_id, $pzz, $id_bebida, $qtd, $observacao, $subtotal);
        $stmt->execute();
    }

    foreach ($bebidas as $beb) {
        $qtd = isset($quantidadeb[$beb]) ? (int)$quantidadeb[$beb] : 0;
        if ($qtd <= 0) continue;
        $prc = isset($precob[$beb]) ? (float)$precob[$beb] : 0.0;

        $sql_add = "INSERT INTO itens_pedido(id_pedido, id_pizza, id_bebida, quantidade, observacao, subtotal) VALUES (?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conexao, $sql_add);
        $id_pizza = NULL;
        $subtotal = $prc * $qtd;
        $stmt->bind_param("iiiisd", $pedido_id, $id_pizza, $beb, $qtd, $observacao, $subtotal);
        $stmt->execute();
    }
    $sql_p = "UPDATE pedido SET total = total + $subtotal WHERE id = $pedido_id";
    mysqli_query($conexao, $sql_p);
    header("Location: pagamento.php?pedido_id=$pedido_id");
    exit();

}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Adcionar itens</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="w-full min-h-screen bg-[#f9f5ed] flex flex-col items-center justify-between">
<header class=" p-4 flex items-center justify-between w-full h-[50%] bg-white/50 text-black ">
    <a>Meus Pedidos</a>
    <a>Sair</a>
</header>
<main class="flex w-[90%] border flex-col justify-center items-center bg-[#f9f5ed]">
    <form method="post" action="add_itens.php?pedido_id=<?=$pedido_id?>" class="w-full border">
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 w-full p-6">
            <?php foreach($pizzas as $pizza): ?>
                <div class="bg-white shadow p-4 rounded text-sm flex flex-col">
                    <p class="font-semibold mb-2 text-base"><?=$pizza['nome']?></p>
                    <img src="../fotos/<?=$pizza['foto']?>" alt="<?=$pizza['nome']?>" class="w-full h-44 object-cover mb-2 rounded">
                    <p>Tamanho: <?=$pizza['tamanho']?></p>
                    <p class="text-sm font-bold">R$ <?=$pizza['preco']?></p>
                    <p class="text-sm"><?=$pizza['borda']?></p>
                    <div class="flex items-center justify-between w-full h-full">
                        <input onchange="mostrarInputP(this)" type="checkbox" class="scale-[2.5] mt-4 ml-2"  name="pizzas[]" value="<?= $pizza['id'] ?>">
                        <input id="inputp<?=$pizza['id']?>" class=" p-2 mt-4 w-[20%] h-8 border border-black  hidden rounded" type="number" name="quantidadep[<?= $pizza['id'] ?>]" value="1">
                        <input type="hidden" name="precop[<?= $pizza['id'] ?>]" value="<?= $pizza['preco'] ?>">
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 w-full p-6">
        <?php foreach($bebidas as $bebida): ?>
            <div class="bg-white shadow p-4 rounded text-sm flex flex-col">
                <p class="font-semibold mb-2 text-base"><?=$bebida['nome']?></p>
                <img src="../fotos/<?=$bebida['foto']?>" alt="<?=$bebida['nome']?>" class="w-full h-44 object-cover mb-2 rounded">
                <p><?=$bebida['ml']?></p>
                <p class="text-sm font-bold">R$ <?=$bebida['preco']?></p>
                <div class="flex items-center justify-between w-full h-full">
                   <input onchange="mostrarInputB(this)" class="scale-[2.5] mt-4 ml-2" type="checkbox" name="bebidas[]" value="<?= $bebida['id'] ?>">
                   <input id="inputb<?=$bebida['id']?>" type="number" name="quantidadeb[<?= $bebida['id'] ?>]" class=" p-2 mt-4 w-[20%] h-8 border border-black  hidden rounded"  value="1">
                   <input type="hidden" name="precob[<?= $bebida['id'] ?>]" value="<?= $bebida['preco'] ?>">
                </div>
            </div>
        <?php endforeach; ?>
        </div>
        <div class="flex flex-col items-center w-full">
            <textarea class="w-[50%] h-20 p-2 border rounded mt-4" name="observacao" placeholder="Alguma observação?"></textarea>
            <button class="w-[50%] border rounded bg-blue-500 mt-4 text-white p-2" type="submit">Adicionar</button>
        </div>
    </form>
</main>
<footer>

</footer>
<script>
    function mostrarInputP(checkbox) {
        const input = document.getElementById('inputp' + checkbox.value);
        input.classList.toggle('hidden', !checkbox.checked);
        input.classList.toggle('block', checkbox.checked);
    }
    function mostrarInputB(checkbox) {
        const input = document.getElementById('inputb' + checkbox.value);
        input.classList.toggle('hidden', !checkbox.checked);
        input.classList.toggle('block', checkbox.checked);
    }

</script>
</body>
</html>

