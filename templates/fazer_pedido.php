<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
include("conexao.php");
include("models/Consultas.php");

$model = new Consultas($conexao);

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $usuarioc = $model->getUsuarioTipo('comum');
    $cliente = $model->getCliente($usuarioc['id']);
    $usuariof = $model->getUsuarioTipo('admin');
    $func = $model->getFuncionarioId($usuariof['id']);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $entrega = $_POST['tipo_entrega'];
    $status = 'Pendente';
    $frete = 0.00;
    $hora = date('Y-m-d H:i:s');
    $total = 0.00;

    if ($entrega === 'Delivery') {
        $frete = $_POST['frete'];
        $total += $frete;
    }

    $sql_pdd = "INSERT INTO pedido(cliente_id, funcionario_id, status, endereco_entrega, tipo_entrega, frete, hora, total, telefone)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql_pdd);
    $stmt->bind_param(
        "iisssdsds",
        $cliente['id'],
        $func['id'],
        $status,
        $cliente['endereco'],
        $entrega,
        $frete,
        $hora,
        $total,
        $cliente['telefone']
    );

    if ($stmt->execute()) {
        echo "Pedido criado com sucesso!";
        $pedido_id = $stmt->insert_id;
        header("location: add_itens.php?pedido_id=$pedido_id");
    } else {
        echo "Erro ao criar pedido!";
    }
}
}

$conexao->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
</head>
<body>
<header>
</header>
<main>
    <form method="post" action="fazer_pedido.php">
        <select name="tipo_entrega" id="tipo_entrega">
            <option value="Delivery">Delivery</option>
            <option value="Retirar no local">Retirar no local</option>
            <option value="Consumir no local">Consumir no local</option>
        </select>
        <input type="number" class="hidden" name="frete" value="5.00">
        <button type="submit">Criar Pedido</button>
    </form>
</main>
</body>
</html>

