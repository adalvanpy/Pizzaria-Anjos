<?php

class Editar
{
    private $conexao;
    public function __construct($conexao){
        $this->conexao = $conexao;
    }

    public function editarBebida($id, $nome, $preco, $estoque, $foto){
        $sql = "UPDATE bebida SET nome = ?, preco = ?, estoque = ?, foto = ? WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("sdssi", $nome, $preco, $estoque, $foto, $id);
        $stmt->execute();
        header("location: ../templates/gerenciar_estoque.php");
        return $stmt->affected_rows;
    }

    public function editarPizza($id, $nome, $tamanho, $preco, $estoque, $tipo, $borda, $foto, $igredientes){
        $sql = "UPDATE pizza SET nome = ?, tamanho = ?, preco = ?, estoque = ?, tipo = ?, borda = ?, foto = ?, igredientes = ? WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("ssdsssssi", $nome, $tamanho, $preco, $estoque, $tipo, $borda, $foto, $igredientes, $id);
        $stmt->execute();
        header("location: ../templates/gerenciar_estoque.php");
        return $stmt->affected_rows;
    }

}