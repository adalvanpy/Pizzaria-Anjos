<?php
session_start();
include("../conexao/conexao.php");
include("../models/Cadastro.php");
$id = $_GET['id'] ?? 0;
$cadastro = new Cadastro($conexao);
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $ingredientes = $_POST['ingredientes'] ?? '';
    $foto = $_FILES['foto']['name'];
    $caminho = "../fotos/" . $foto;
    move_uploaded_file($_FILES['foto']['tmp_name'], $caminho);

    $cadastro->cadastrarItem($_POST['nome'],
        $_POST['tipo'],$_POST['tamanho'],
        $_POST['ml'],$_POST['borda'],
        $ingredientes,$_POST['preco'],
        $_POST['estoque'],$foto);
    header("location: ../templates/gerenciar_estoque.php?id=$id");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Cadastrar item</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f9f5ed] min-h-screen flex flex-col items-center">
<header class="w-full bg-[#b22222] text-white p-4 flex items-center justify-start">
    <a class="text-2xl ml-8 underline" href="gerenciar_estoque.php?id=<?=$id?>">Voltar</a>
</header>
    <main class="w-full flex-grow p-8">
        <form class="flex flex-col items-center justify-center w-full" method="post" action="cadastrar_item.php?id=<?=$id?>" enctype="multipart/form-data">
            <h2 class="text-2xl">Preencher Cadastro do item</h2>
            <div class="flex flex-wrap w-full mt-4">
                <div class="w-full md:w-1/2 p-2 flex flex-col items-end gap-4">
                    <input class="border  w-[50%] px-4 py-2" type="text" name="nome" id="nome" placeholder="Nome do item">
                    <input class="border  w-[50%] px-4 py-2" type="number" step="0.01" name="preco" id="preco" placeholder="Preço">
                    <textarea class="border w-[50%] px-4 py-2" name="ingredientes" id="ingredientes" placeholder="Ingredientes"></textarea>
                    <input class="border  w-[50%] px-4 py-2" type="file" name="foto" id="foto">
                </div>
                <div class="w-full md:w-1/2 p-2 flex flex-col items-start gap-4">
                    <select class="border  w-[50%] px-4 py-2" name="tipo" id="tipo">
                        <option value="">Tipo</option>
                        <option value="Pizza">Pizza</option>
                        <option value="Bebida">Bebida</option>
                    </select>
                    <select class="border  w-[50%] px-4 py-2" name="tamanho" id="tamanho">
                        <option value="">Tamanho</option>
                        <option value="Pequena">Pequena</option>
                        <option value="Média">Média</option>
                        <option value="Grande">Grande</option>
                        <option value="Família">Família</option>
                    </select>

                    <select class="border  w-[50%] px-4 py-2" name="ml" id="ml">
                        <option value="">ML</option>
                        <option value="350 ml">350 ml</option>
                        <option value="500 ml">500 ml</option>
                        <option value="1 Litro">1 Litro</option>
                    </select>

                    <select class="border  w-[50%] px-4 py-2" name="borda" id="borda">
                        <option value="">Borda</option>
                        <option value="Tradicional">Tradicional</option>
                        <option value="Recheada(catupiry)">Recheada (catupiry)</option>
                    </select>

                    <select class="border  w-[50%] px-4 py-2" name="estoque" id="estoque">
                        <option value="">Estoque</option>
                        <option value="Disponível">Disponível</option>
                        <option value="Indisponível">Indisponível</option>
                    </select>
                </div>
                <div class="w-full p-2 flex flex-col items-center gap-4">
                    <button class="border bg-blue-500 text-white  w-[50%] px-4 py-2" type="submit">Salvar</button>
                </div>
            </div>
        </form>

    </main>
    <footer class="w-full bg-[#367588]  text-white text-center p-8">
        <p>&copy; 2025 Pizzaria Anjos. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
