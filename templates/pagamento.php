<?php
session_start();
include_once("../conexao/conexao.php");
include("../models/Consultas.php");
include("../models/Cadastro.php");
include("../models/Editar.php");
$id_pedido = $_GET['id_pedido'] ?? 0;
$id = $_GET['user_id'] ?? 0;
$model = new Consultas($conexao);
$criar = new Cadastro($conexao);
$att = new Editar($conexao);
$userC = $model->getUsuario($id);
$usuario = $model->getAdmin('admin');
$func = $model->getFuncionarioId($usuario['id']);
$pedido = $model->getPedido($id_pedido);
$statusP = 'Finalizado';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $metodo = $_POST['metodo'];
    $troco = $_POST['troco'];
    $status = "Pendente";
    if($metodo !== 'Dinheiro'){
        $troco = 0.00;
    }
    $criar->criarPagamento
    ($id_pedido,
        $func['id'],
        $metodo,
        $pedido['total'],
        $troco,
        $pedido['hora'],
        $status
    );
    $att->editarStatusP($id_pedido,$statusP);

    header("location: ../templates/meus_pedidos.php?id=$id");


}
$conexao->close();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Pagamento</title>
</head>
<body class="bg-[#f9f5ed] min-h-screen flex flex-col items-center">
<header class="w-full bg-[#b22222] text-white p-4 flex items-center gap-4 justify-start">
    <span class="bg-[#367588] ml-8 rounded-full px-4 py-2 mr-8"><?= substr($userC['nome'], 0, 1) ?></span>
</header>
<main class="w-full flex-grow p-8">
    <div class="flex flex-col items-center justify-center w-full h-full">
        <h2 class="text-3xl text-[#556b2f]">Detalhes do Pedido</h2>
        <table class="mt-4">
            <thead>
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Endereco de entrega</th>
                <th class="border px-4 py-2">Tipo entrega</th>
                <th class="border px-4 py-2">Frete</th>
                <th class="border px-4 py-2">Total</th>
            </tr>
            </thead>
            <tbody>
                 <tr>
                     <td class="border px-4 py-2"><?=$pedido['id']?></td>
                     <td class="border px-4 py-2"><?=$pedido['endereco_entrega']?></td>
                     <td class="border px-4 py-2"><?=$pedido['tipo_entrega']?></td>
                     <td class="border px-4 py-2"><?=$pedido['frete']?></td>
                     <td class="border px-4 py-2"><?=$pedido['total']?></td>
                 </tr>
            </tbody>
        </table>
    </div>
    <h2 class="text-2xl text-[#556b2f] text-center mt-4">Selecione sua forma de pagamento</h2>
    <form class="flex items-center gap-2 justify-center mt-4 flex-col" method="POST" action="pagamento.php?id_pedido=<?=$id_pedido?>&user_id=<?=$id?>">
        <select onchange="exibirTroco()" class="border w-80 px-4 py-2" name="metodo" id="metodo">
            <option value="Pix"> Pix </option>
            <option value="Dinheiro"> Dinheiro </option>
            <option value="Cartão"> Cartão </option>
        </select>
        <input class="border w-80 px-4 py-2 hidden" type="number" name="troco" id="troco" placeholder="Troco">
        <div class="flex items-center justify-center gap-4">
            <button class=" rounded bg-blue-500 text-white w-50 px-4 py-2" type="submit">Finalizar Pedido</button>
            <a class="rounded bg-red-500 text-white w-50 px-4 py-2" href="deletar_item_pedido.php?id=<?=$id_pedido?>&id_user=<?=$id?>">Cancelar Pedido</a>
        </div>
    </form>
</main>
<footer class="w-full bg-[#367588] text-white text-center p-8">
    <p>&copy; 2025 Pizzaria Anjos. Todos os direitos reservados.</p>
</footer>
<script>
    function exibirTroco(){
        const valor = document.getElementById('metodo').value;
        if(valor == 'Dinheiro'){
            document.getElementById('troco').classList.remove('hidden');
        }
        else{
            document.getElementById('troco').classList.add('hidden');
        }
    }
</script>
</body>
</html>