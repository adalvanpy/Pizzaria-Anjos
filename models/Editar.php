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

    public function atualizarStatus($id, $status,$userId){
        $sql = "UPDATE pedido SET status = ? WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();
        header("location: ../templates/gerenciar_pedidos.php?id=$userId");
        return $stmt->affected_rows;

    }
    public function atualizarStatusPagamento($id, $status,$userId){
        $sql = "UPDATE pagamento SET status_pagamento = ? WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();
        header("location: ../templates/gerenciar_caixa.php?id=$userId");
    }
    public function atualizarTotal($id, $total){
        $sql = "UPDATE pedido SET total = total + ? WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("di", $total, $id);
        $stmt->execute();
        return $stmt->affected_rows;

    }
    public function editarStatusP($id, $status){
        $sql = "UPDATE pedido SET status = ? WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();
        return $stmt->affected_rows;
    }

}