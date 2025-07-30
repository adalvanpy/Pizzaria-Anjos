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
            header("location: login.php?erro=1");
            exit();
        }
    } else {
        header("location: login.php?erro=2");
        exit();
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
<body class="bg-[#f9f5ed] w-full min-h-screen flex flex-col items-center justify-between">
<header class=" p-4 flex items-center justify-between w-full h-[50%] bg-[#b22222] text-white ">
    <a class="text-2xl underline" href="../index.php">Inicio</a>
</header>
<main class="flex w-[90%] flex-col justify-center items-center">
    <img src="../fotos/pzz.png" class="w-40 h-40 animate-pulse" >
    <form class=" mt-4 border bg-white/50 flex w-[40%] h-[40%] p-8 flex-col items-center justify-center gap-4 rounded shadow shadow-[#556b2f]" method="post" action="login.php">
        <input class="border p-2 w-80" type="email" name="email" placeholder="Seu email">
        <input class="border p-2 w-80"  type="password" name="senha" placeholder="Sua senha">
        <button class="border bg-[#367588] text-white w-80 p-2" type="submit">Entrar</button>
        <?php if(isset($_GET['erro'])): ?>
            <?php if($_GET['erro'] == 1): ?>
                <p class="text-red-500">Senha incorreta</p>
            <?php elseif($_GET['erro'] == 2): ?>
                <p class="text-red-500">Usuário não encontrado</p>
            <?php endif; ?>
        <?php endif; ?>
    </form>
    <p class="mt-4 ">Não tem uma conta ainda? <a class="underline text-blue-500" href="signin.php">Cadastre-se</a></p>
</main>
<footer class="bg-[#367588] text-white text-center p-4 w-full py-8 mt-60">
    <p>&copy; 2025 Pizzaria Anjos. Todos os direitos reservados.</p>
</footer>
</body>
</html>

