<?php
session_start();
include "conexao.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);
    $fone = $_POST["fone"];
    $endereco = $_POST["endereco"];

    $sql_user = "INSERT INTO  usuario (nome, email, senha, tipo) VALUES (?,?,?,'comum')";
    $stmt_user = mysqli_prepare($conexao, $sql_user);
    $stmt_user->bind_param("sss", $nome, $email, $senha);
    $stmt_user->execute();
    $usuario_id = $stmt_user->insert_id;

    $sql_clt = "INSERT INTO cliente (usuario_id, telefone, endereco) VALUES (?,?,?)";
    $stmt_clt = mysqli_prepare($conexao, $sql_clt);
    $stmt_clt->bind_param("iss", $usuario_id, $fone, $endereco);
    if($stmt_clt->execute()) {
        echo "Cadastro realizado com sucesso!";
        header("location: login.php");
    }
    else{
        echo "Erro ao realizar o cadastro!" . mysqli_error($conexao);
    }
}
$conexao->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Signin</title>
</head>
<body>
<header>

</header>
<main>
    <form method="post" action="signin.php">
        <input type="text" name="nome" placeholder="Seu nome" required>
        <input type="email" name="email" placeholder="Seu email">
        <input type="text" name="senha" placeholder="Sua senha">
        <input type="text" name="fone" placeholder="Seu telefone">
        <input type="text" name="endereco" placeholder="Seu endereço">
        <button type="submit">Cadastrar</button>
    </form>
</main>
</body>
</html>
