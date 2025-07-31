<?php
include("../conexao/conexao.php");
class Deletar
{
private $conexao;
function __construct($conexao){
    $this->conexao = $conexao;
}

    public function deletePedido($id){
        $sql = "DELETE FROM pedido WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->affected_rows;
    }
    public function delete_Item_Pedido($id){
    $sql = "DELETE FROM item_pedido WHERE id_pedido = ?";
    $stmt = $this->conexao->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->affected_rows;
    }
}