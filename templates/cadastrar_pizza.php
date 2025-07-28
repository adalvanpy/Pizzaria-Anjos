<?php
session_start();
include("../conexao/conexao.php");
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome = $_POST['nome'];
    $tamanho = $_POST['tamanho'];
    $preco = $_POST['preco'];
    $estoque = $_POST['estoque'];
    $tipo = $_POST['tipo'];
    $borda = $_POST['borda'];
    $foto = $_FILES['foto']['name'];
    $caminho = "fotos/" . basename($foto);
    move_uploaded_file($_FILES["foto"]["tmp_name"], $caminho);
    $igrediente = $_POST['igrediente'];

    $sql = "INSERT INTO pizza(nome,tamanho,preco,estoque,tipo,borda,foto,igredientes) VALUES (?,?,?,?,?,?,?,?)";
    $stmt = mysqli_prepare($conexao, $sql);
    $stmt->bind_param("ssssssss", $nome,$tamanho,$preco,$estoque,$tipo,$borda,$foto,$igrediente);
    if($stmt->execute()){
        echo "Pizza Cadastrado com Sucesso";
        header("Location: gerenciar_estoque.php");

    }
    else{
        echo "Erro ao Cadastrar Pizza";
    }

}
$conexao->close();
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
         <form method="POST" enctype="multipart/form-data" action="cadastrar_pizza.php">
             <input type="text" name="nome" placeholder="Nome" required>
             <select name="tamanho">
                 <option value="" selected>Tamanho</option>
                 <option value="pequena">Pequena</option>
                 <option value="media">Média</option>
                 <option value="grande">Grande</option>
                 <option value="familia">Família</option>
             </select>
             <input type="number" step="0.01" name="preco" placeholder="Preco" required />
             <select name="estoque">
                 <option value="Disponível">Disponível</option>
                 <option value="Indisponível">Indisponível</option>
             </select>

             <select name="tipo">
                 <option value="Tradicional">Tradicional</option>
                 <option value="Doce">Doce</option>
             </select>

             <select name="borda">
                 <option value="Com borda">Com borda</option>
                 <option value="Sem borda">Sem borda</option>
             </select>
             <input type="file" name="foto" accept="image/*">
             <input type="text" name="igrediente" placeholder="Igredientes" required>
             <button type="submit">Cadastrar</button>
         </form>
     </main>
</body>
</html>
