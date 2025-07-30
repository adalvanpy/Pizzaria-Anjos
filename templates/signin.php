<?php
session_start();
include ("../conexao/conexao.php");
include ("../models/Consultas.php");
$consulta = new Consultas($conexao);

$emails = array_column($consulta->getEmails(), 'email');
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);
    $fone = $_POST["fone"];
    $endereco = $_POST["endereco"];
    if(in_array($email, $emails)){
      header("location: signin.php?erro=1");
      exit();
    }
    else{
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

}
$conexao->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Cadastre-se</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f9f5ed] min-h-screen flex flex-col items-center">
<header class="w-full bg-[#b22222] text-white p-4 flex items-center justify-start">
    <a class="text-2xl underline" href="../index.php">Inicio</a>
</header>
<main class="w-full flex-grow p-8">
    <div class="flex flex-col items-center justify-center w-full h-full">
    <img src="../fotos/pzz.png" class="w-40 h-40 animate-pulse" >
    <form class="border bg-white/50 flex w-[40%] h-[40%] p-8 flex-col items-center justify-center gap-4 rounded shadow-lg shadow-orange-300"method="post" action="signin.php">
        <input class="border p-2 w-80 rounded"  type="text" name="nome" placeholder="Seu nome" required>
        <input class="border p-2 w-80 rounded"  type="email" name="email" placeholder="Seu email">
        <input class="border p-2 w-80 rounded"  type="text" name="senha" placeholder="Sua senha">
        <input class="border p-2 w-80 rounded"  type="text" name="fone" placeholder="Seu telefone">
        <input class="border p-2 w-80 rounded"  type="text" name="endereco" placeholder="Seu endereço">
        <button class="border bg-blue-300 w-80 p-2 rounded"  type="submit">Cadastrar</button>
        <?php if(isset($_GET['erro'])): ?>
        <?php if($_GET['erro'] == 1): ?>
        <p class="text-red-500"> E-mail já cadastrado</p>
        <?php endif; ?>
        <?php endif;?>
    </form>
    <p class="mt-4 ">Ja tem uma conta? <a class="underline text-blue-500" href="login.php">Entre</a></p>
    </div>
</main>
<footer class="w-full bg-[#556b2f] text-white text-center p-8">
    <p>&copy; 2025 Pizzaria Anjos. Todos os direitos reservados.</p>
</footer>
</body>
</html>
