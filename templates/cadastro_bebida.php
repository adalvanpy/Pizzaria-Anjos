<?php
session_start();
include ('../conexao/conexao.php');
include('../models/Cadastro.php');

$cadastro = new Cadastro($conexao);
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $cadastro->cadastrarBebida($_POST['nome'], $_POST['ml'], $_POST['preco'],$_POST['estoque'], $_POST['tipo'], $_POST['foto']);
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Cadastro bebida</title>
</head>
<body>
<header>

</header>
<main>
    <form action="cadastro_bebida.php" enctype="multipart/form-data" method="post">
        <input placeholder="Nome" type="text" name="nome" id="nome"><br>
        <select name="ml" id="ml">
            <option value="250 ml">250 ml</option>
            <option value="350 ml"> 350 ml</option>
            <option value="500 ml"> 500 ml</option>
            <option value="1 Litro"> 1 Litro</option>
        </select>
        <input placeholder="Preco" type="number" name="preco" id="preco"><br>
        <select name="estoque" id="estoque">
            <option value="Disponível"> Disponível </option>
            <option value="Indisponível"> Indisponível </option>
        </select>
        <select name="tipo" id="tipo">
            <option value="Suco"> Suco </option>
            <option value="Refrigerante"> Refrigerante </option>
            <option value="Agua"> Água </option>
        </select>
        <input type="file" name="foto" accept="image/*">
        <button type="submit">Cadastrar</button>
    </form>
</main>
<footer>

</footer>
</body>
</html>
