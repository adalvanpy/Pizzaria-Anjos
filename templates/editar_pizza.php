<?php
session_start();
include ('../conexao/conexao.php');
include ('../models/Consultas.php');
include ('../models/Editar.php');
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$pizza = new Consultas($conexao);
$pizzas = new Editar($conexao);
$pizza_buscada = $pizza->getPizzaId($id);
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $foto = $_FILES['foto']['name'];
    move_uploaded_file($_FILES['foto']['tmp_name'], "../fotos/".$foto);
    $pizzas->editarPizza($id, $_POST["nome"], $_POST["tamanho"], $_POST["preco"], $_POST["estoque"], $_POST["tipo"], $_POST["borda"], $foto,$_POST["igrediente"]);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastrar Pizza</title>
    <meta charset="utf-8">
</head>
<body>
<header>
    <h1>Cadastrar Pizza</h1>
</header>
<main>
    <form method="POST" enctype="multipart/form-data" action="editar_pizza.php?id=<?=$pizza_buscada['id']?>">
        <input type="text" name="nome" placeholder="Nome" value="<?=$pizza_buscada['nome']?>" required>
        <select name="tamanho">
            <option value="<?=$pizza_buscada['tamanho']?>" selected><?=$pizza_buscada['tamanho']?></option>
            <option value="pequena">Pequena</option>
            <option value="media">Média</option>
            <option value="grande">Grande</option>
            <option value="familia">Família</option>
        </select>
        <input value="<?=$pizza_buscada['preco']?>" type="number" step="0.01" name="preco" placeholder="Preco" required />
        <select name="estoque">
            <option value="<?=$pizza_buscada['estoque']?>" selected ><?=$pizza_buscada['estoque']?>" </option>
            <option value="Disponível">Disponível</option>
            <option value="Indisponível">Indisponível</option>
        </select>

        <select name="tipo">
            <option value="<?=$pizza_buscada['tipo']?>" selected><?=$pizza_buscada['tipo']?></option>
            <option value="Tradicional">Tradicional</option>
            <option value="Doce">Doce</option>
        </select>

        <select name="borda">
            <option value="<?=$pizza_buscada['borda']?>" selected><?=$pizza_buscada['borda']?></option>
            <option value="Com borda">Com borda</option>
            <option value="Sem borda">Sem borda</option>
        </select>
        <input type="file" name="foto" accept="image/*" value="<?=$pizza_buscada['foto']?>" required>
        <input type="text" name="igrediente" placeholder="Igredientes" value="<?=$pizza_buscada['igredientes']?>" required>
        <button type="submit">Cadastrar</button>
    </form>
</main>
</body>
</html>
