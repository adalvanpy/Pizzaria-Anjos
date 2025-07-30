<?php
include ("../conexao/conexao.php");
class Consultas {
    private $conexao;

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }

public function getUsuario($id){
     $sql = "SELECT * FROM usuario WHERE id = ?";
     $stmt = $this->conexao->prepare($sql);
     $stmt->bind_param("i", $id);
     $stmt->execute();
     return $stmt->get_result()->fetch_assoc();
}

 public function getCliente($usuario_id){
     $sql = "SELECT id, telefone, endereco FROM cliente WHERE usuario_id = ?";
     $stmt = $this->conexao->prepare($sql);
     $stmt->bind_param("i", $usuario_id);
     $stmt->execute();
     return $stmt->get_result()->fetch_assoc();
 }

 public function getFuncionarioId($usuario_id){
     $sql = "SELECT id FROM funcionario WHERE usuario_id = ?";
     $stmt = $this->conexao->prepare($sql);
     $stmt->bind_param("i", $usuario_id);
     $stmt->execute();
     return $stmt->get_result()->fetch_assoc();

 }

 public function getPedido($pedido_id){
        $sql = "SELECT * FROM pedido WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("i", $pedido_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
 }

    public function getPedidoId($id){
        $sql = "SELECT * FROM pedido WHERE cliente_id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getPedidosForGerencia($id){
        $sql = "SELECT * FROM pedido WHERE funcionario_id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    public function getPagamentos($id){
        $sql = "SELECT * FROM pagamento WHERE funcionario_id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    }
    public function getPagamentoId($id){
        $sql = "SELECT id, status_pagamento FROM pagamento WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    function getAdmin($tipo){
        $sql = "SELECT id FROM usuario WHERE tipo = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("s", $tipo);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();

    }

    public function getItens()
    {
        $sql = "SELECT * FROM itens";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getItem_pedido($id)
    {
        $sql = "SELECT item_pedido.*, itens.nome, itens.preco, itens.tamanho, itens.borda, itens.ml
            FROM item_pedido
            JOIN itens ON item_pedido.id_item = itens.id
            WHERE item_pedido.id_pedido = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getEmails(){
        $sql = "SELECT email FROM usuario";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getItemId($id){
        $sql = "SELECT * FROM itens WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();

    }


}
?>
