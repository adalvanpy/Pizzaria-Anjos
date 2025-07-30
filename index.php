<?php
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Pizzaria Anjos</title>
</head>
<body class="bg-[#f9f5ed] min-h-screen flex flex-col items-center">
<header class="w-full gap-4 bg-[#b22222] text-[#b22222] p-8 flex items-center justify-end">
    <a href="templates/login.php" class=" text-center bg-[#367588] text-white rounded w-40 px-4 py-2
               transform transition duration-300 hover:scale-105">Entrar</a>
    <a href="templates/signin.php" class=" text-center bg-[#F5F5DC] rounded w-40 px-4 py-2
                transform transition duration-300 hover:scale-105">Cadastre-se</a>
</header>
<main class="w-full flex-grow p-8">
    <div class="flex flex-col items-center justify-center gap-8 mt-4">
        <h2 class="text-4xl text-[#b22222] animate-bounce">Sabor autêntico em cada fatia. Peça já sua pizza favorita!</h2>
        <img src="fotos/pzz.png" class="w-40 h-40 animate-bounce" >
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 p-4">
            <a href="templates/cardapio.php" class="border rounded shadow-lg p-6 text-center hover:shadow-xl">
                <h2 class="text-xl font-semibold mb-2">CARDÁPIO</h2>
                <p class="text-gray-600">Veja todas as opções disponíveis.</p>
            </a>
            <a href="templates/cardapio.php" class="border rounded shadow-lg p-6 text-center hover:shadow-xl">
                <h2 class="text-xl font-semibold mb-2">PROMOÇÃO</h2>
                <p class="text-gray-600">Confira nossas ofertas especiais.</p>
            </a>
            <div class="border rounded shadow-lg p-6 text-center hover:shadow-xl">
                <h2 class="text-xl font-semibold mb-2">SOBRE NÓS</h2>
                <p class="text-gray-600">Conheça a história da nossa pizzaria.</p>
            </div>
        </div>

    </div>
</main>
<footer class="w-full bg-[#367588] text-white text-center p-8">
    <p>&copy; 2025 Pizzaria Anjos. Todos os direitos reservados.</p>
</footer>
</body>

</html>
