<?php
session_start();
include_once("conexao.php");
include("models/Consultas.php");
$pedido_id = isset($_GET['pedido_id'])?(int)$_GET['pedido_id'] : 0;
$model = new Model($conexao);
$usuario = $model->getUsuarioTipo('admin');
$func = $model->getFuncionarioId($usuario['id']);
$pedido = $model->getPedido($pedido_id);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $metodo = $_POST['metodo'];
    $troco = $_POST['troco'];
    $status = "Pendente";
    if($metodo !== 'Dinheiro'){
        $troco = 0.00;
    }
    $sql = "INSERT INTO pagamento(pedido_id, funcionario_id,metodo,valor,troco,data_pagamento,status_pagamento) VALUES(?,?,?,?,?,?,?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("iisddss",$pedido_id,$func,$metodo,$pedido['total'],$troco,$pedido['hora'],$status);
    $stmt->execute();
    header("location: meus_pedidos.php");
    $stmt->close();

}
$conexao->close();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Pagamento</title>
</head>
<body>
<header>

</header>
<main>
    <div>
        <table>
            <thead>
            <tr>
                <th rowspan="2">ID</th>
                <th rowspan="2">Endereco de entrega</th>
                <th rowspan="2">Tipo entrega</th>
                <th rowspan="2">Frete</th>
                <th rowspan="2">Total</th>
            </tr>
            </thead>
            <tbody>
                 <tr>
                     <td><?=$pedido['id']?></td>
                     <td><?=$pedido['endereco_entrega']?></td>
                     <td><?=$pedido['tipo_entrega']?></td>
                     <td><?=$pedido['frete']?></td>
                     <td><?=$pedido['total']?></td>
                 </tr>
            </tbody>
        </table>
    </div>
    <form class="border" method="POST" action="pagamento.php?pedido_id=<?=$pedido_id?>">
        <select name="metodo" id="metodo">
            <option value="Pix"> Pix </option>
            <option value="Dinheiro"> Dinheiro </option>
            <option value="Cartão"> Cartão </option>
        </select>
        <input type="number" name="troco" id="troco" placeholder="Troco">
        <button type="submit">Finalizar Pedido</button>
    </form>
</main>
<footer>

</footer>
</body>
</html>