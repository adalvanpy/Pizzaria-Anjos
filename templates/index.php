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
<header class="w-full bg-[#b22222] text-white p-8 flex items-center justify-center">
<p class="text-2xl text-white animate-pulse ">SEJA BEM VINDO A PIZZARIA ANJOS</p>
</header>
<main class="w-full flex-grow p-8">
    <div class="flex flex-col items-center justify-center gap-8 mt-4">
        <h2 class="text-4xl text-[#b22222] animate-bounce">Sabor autêntico em cada fatia. Peça já sua pizza favorita!</h2>
        <img src="../fotos/pzz.png" class="w-40 h-40 animate-bounce" >
        <div class="flex items-center justify-center gap-8">
            <a href="login.php" class="border text-center bg-blue-300 text-white rounded w-60 px-4 py-2
               transform transition duration-300 hover:scale-105">Entrar</a>
            <a href="signin.php" class="border text-center bg-blue-300 text-white rounded w-60 px-4 py-2
                transform transition duration-300 hover:scale-105">Cadastre-se</a>
        </div>
    </div>
</main>
<footer class="w-full bg-[#556b2f] text-white text-center p-8">
    <p>&copy; 2025 Pizzaria Anjos. Todos os direitos reservados.</p>
</footer>
</body>

</html>
