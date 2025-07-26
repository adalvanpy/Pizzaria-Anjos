<?php
session_start();
include "conexao.php";

if(isset($_SESSION["id"])){
    $id = $_SESSION["id"];

    $sql = "SELECT nome FROM usuario WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result && $result->num_rows > 0){
        $usuario = $result->fetch_assoc();
    } else {
        $usuario = null;
    }

    $sql2 = "SELECT telefone, endereco FROM cliente WHERE usuario_id = ?";
    $stmt2 = mysqli_prepare($conexao, $sql2);
    $stmt2->bind_param("i", $id);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    $cliente = $result2->fetch_assoc();
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="w-full h-full">
<header class=" p-4 flex items-center justify-between w-full h-[50%] bg-black text-white ">
<div>
    <span>Bem vindo <?=$usuario['nome']?></span>
</div>
<div>
    <a>Meus Pedidos</a>
    <a href="logout.php">Sair</a>
</div>
</header>
<main>

</main>
</body>
</html>