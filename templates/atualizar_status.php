<?php
session_start();
include ("../conexao/conexao.php");
include ("../models/Editar.php");
include ("../models/Consultas.php");
$id = isset($_GET['id']) ? $_GET['id'] : 0;

$consulta = new Consultas($conexao);
$editar = new Editar($conexao);

$status = $consulta->getPedido($id);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_POST['userId'] ?? 0;
    $editar->atualizarStatus($id, $_POST['status'],$userId);
    exit;
}


?>
<!DOCTYPE html>
<html>
<head>
    <title>Editar Status</title>
</head>
<body>
<header>

</header>
<main>
    <form method="post" action="atualizar_status.php?id=<?=$status['id']?>">
        <input type="hidden" name="userId" value="<?= $_GET['userId'] ?>">
        <select name="status" id="status">
            <option selected><?=$status['status']?></option>
            <option value="Em preparo">Em preparo</option>
            <option value="Saindo para entrega">Saindo para entrega</option>
            <option value="Entregue">Entregue</option>
            <option value="Pronto para o consumo">Pronto para o consumo</option>
            <option value="Pronto para retirada">Pronto para reirada</option>
            <option value="Concluido">Concluido</option>
        </select>
        <button type="submit">Atualizar</button>
    </form>
</main>
<footer>

</footer>
</body>
</html>
