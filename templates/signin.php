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
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="w-full min-h-screen bg-[#f9f5ed] flex flex-col items-center justify-between">
<header class=" p-4 flex items-center justify-between w-full h-[50%] bg-white/50 text-black ">
    <a>Inicio</a>
</header>
<main class="flex w-[90%] flex-col justify-center items-center bg-[#f9f5ed]">
    <img src="../fotos/pzz.png" class="w-40 h-40" >
    <form class="border bg-white/50 flex w-[40%] h-[40%] p-8 flex-col items-center justify-center gap-4 rounded shadow-lg shadow-orange-300"method="post" action="signin.php">
        <input class="border p-2 w-80 rounded"  type="text" name="nome" placeholder="Seu nome" required>
        <input class="border p-2 w-80 rounded"  type="email" name="email" placeholder="Seu email">
        <input class="border p-2 w-80 rounded"  type="text" name="senha" placeholder="Sua senha">
        <input class="border p-2 w-80 rounded"  type="text" name="fone" placeholder="Seu telefone">
        <input class="border p-2 w-80 rounded"  type="text" name="endereco" placeholder="Seu endereço">
        <button class="border bg-blue-300 w-80 p-2 rounded"  type="submit">Cadastrar</button>
    </form>
    <p class="mt-4 ">Ja tem uma conta? <a class="underline text-blue-500" href="login.php">Entre</a></p>
</main>
<footer class="bg-white/50 text-black text-center p-4 w-full py-8 mt-60">
    <p>&copy; 2025 Pizzaria Anjos. Todos os direitos reservados.</p>
</footer>
</body>
</html>
