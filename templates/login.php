<?php
session_start();
include("../conexao/conexao.php");
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $sql = "SELECT * FROM usuario WHERE email = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1){
        $usuario = $result->fetch_assoc();
        if(password_verify($senha, $usuario["senha"])){
            $_SESSION["id"] = $usuario["id"];
            if($usuario["tipo"] === "admin"){
                header("Location: gerenciar_estoque.php?id=".$usuario["id"]);
            } else {
                header("Location: dashboard.php?id=".$usuario["id"]);
            }
            exit();
        } else {
            echo "Senha incorreta";
        }
    } else {
        echo "Usuario não encontrado";
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
    <form class="border bg-white/50 flex w-[40%] h-[40%] p-8 flex-col items-center justify-center gap-4 rounded shadow-lg shadow-orange-300" method="post" action="login.php">
        <input class="border p-2 w-80" type="email" name="email" placeholder="Seu email">
        <input class="border p-2 w-80"  type="password" name="senha" placeholder="Sua senha">
        <button class="border bg-blue-300 w-80 p-2" type="submit">Entrar</button>
    </form>
    <p class="mt-4 ">Não tem uma conta ainda? <a class="underline text-blue-500" href="signin.php">Cadastre-se</a></p>
</main>
<footer class="bg-white/50 text-black text-center p-4 w-full py-8 mt-60">
    <p>&copy; 2025 Pizzaria Anjos. Todos os direitos reservados.</p>
</footer>
</body>
</html>

