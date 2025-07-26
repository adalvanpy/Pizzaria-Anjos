<?php
session_start();
include("conexao.php");
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
                header("Location: gerenciar_estoque.php");
            } else {
                header("Location: dashboard.php");
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
</head>
<body>
<header>

</header>
<main>
    <form method="post" action="login.php">
        <input type="email" name="email" placeholder="Seu email">
        <input type="password" name="senha" placeholder="Sua senha">
        <button type="submit">Entrar</button>
    </form>
</main>
</body>
</html>

