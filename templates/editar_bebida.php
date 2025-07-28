<?php
session_start();
include("../conexao/conexao.php");
include("../models/Editar.php");
include ("../models/Consultas.php");
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$bebida_editar = new Editar($conexao);
$bebida_buscar = new Consultas($conexao);
$beb = $bebida_buscar->getBebidaId($id);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $foto = $_FILES['foto']['name'];
    move_uploaded_file($_FILES['foto']['tmp_name'], "../fotos/".$foto);
    $bebida_editar->editarBebida($id,$_POST['nome'],$_POST['preco'],$_POST['estoque'],$foto);
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Editar bebida</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<header>

</header>
<main class="border">
    <form action="editar_bebida.php?id=<?=$beb['id']?>" enctype="multipart/form-data" method="post">
        <input placeholder="Nome" type="text" name="nome" id="nome" value="<?=$beb['nome']?>"><br>
        <input placeholder="Preco" type="number" name="preco" id="preco" value="<?=$beb['preco']?>"><br>
        <select name="estoque" id="estoque">
            <option value="<?=$beb['estoque']?>" selected><?=$beb['estoque']?> </option>
            <option value="Disponível"> Disponível </option>
            <option value="Indisponível"> Indisponível </option>
        </select>
        <input type="file" name="foto" accept="image/*" value="<?=$beb['foto']?>">
        <button type="submit">Salvar</button>
    </form>
</main>
<footer>

</footer>
</body>
</html>
