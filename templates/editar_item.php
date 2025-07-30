<?php
include("../conexao/conexao.php");
include("../models/Editar.php");
include("../models/Consultas.php");
$id = $_GET['id'] ?? 0;
$user_id = $_GET['user_id'] ?? 0;
$editar = new Editar($conexao);
$buscar = new Consultas($conexao);

$item = $buscar->getItemId($id);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $foto = $_FILES['foto']['name'];
    $caminho = "../fotos/" . $foto;
    move_uploaded_file($_FILES['foto']['tmp_name'], $caminho);
    $editar->editarItem($id, $_POST['preco'], $_POST['estoque'], $foto);

    header("Location: ../templates/gerenciar_estoque.php?id=$user_id");
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Editar Item</title>
</head>
<body>
<header>
    <h1>Vpltar</h1>
</header>
<main>
    <form method="POST" action="editar_item.php?id=<?=$id?>&user_id=<?=$user_id?>" enctype="multipart/form-data">
        <input name="preco" placeholder="Preço" value="<?=$item['preco']?>">
        <select name="estoque">
            <option value="" selected><?=$item['estoque']?></option>
            <option value="Disponível">Disponível</option>
            <option value="Indisponível">Indisponível</option>
        </select>
        <input class="border  w-[50%] px-4 py-2" type="file" name="foto" id="foto" value="<?=$item['foto']?>">
        <button type="submit">Salvar</button>
    </form>
</main>
<footer>

</footer>
</body>
</html>
