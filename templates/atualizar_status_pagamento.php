<?php
session_start();
include("../conexao/conexao.php");
include("../models/Consultas.php");
include("../models/Editar.php");

$id = $_GET['id'] ?? 0;
$editar = new Editar($conexao);
$consulta = new Consultas($conexao);

$status = $consulta->getPagamentoId($id);
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $userId = $_POST['userId'] ?? 0;
    $editar->atualizarStatusPagamento($id, $_POST['status'], $userId);

}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Atualizar status pagamento</title>
</head>
<body>
<header>

</header>
<main>
    <form method="post" action="atualizar_status_pagamento.php?id=<?=$status['id']?>">
        <input type="hidden" name="userId" value="<?=$_GET['userId']?>">
        <select name="status" id="status">
            <option value="" selected> <?=$status['status_pagamento']?></option>
            <option value="Pago">Pago</option>
        </select>
        <button type="submit">Atualizar</button>
    </form>
</main>
<footer>

</footer>
</body>
</html>
