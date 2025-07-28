<?php
$conexao = mysqli_connect("localhost", "root", "", "pizzaria_anjos");
if (!$conexao) {
    die("Falha na conexão: " . mysqli_connect_error());
}
?>
