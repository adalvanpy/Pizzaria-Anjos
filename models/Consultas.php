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
 public function getPizza(){
     return $this->conexao->query("SELECT * FROM pizza")->fetch_all(MYSQLI_ASSOC);
 }
 public function getBebidass(){
     return $this->conexao->query("SELECT * FROM bebida")->fetch_all(MYSQLI_ASSOC);
 }

 public function getPedido($pedido_id){
        $sql = "SELECT * FROM pedido WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("i", $pedido_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
 }

 public function getPizzaId($id)
{
    $sql = "SELECT * FROM pizza WHERE id = ?";
    $stmt = $this->conexao->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();

}

public function getBebidaId($id){
        $sql = "SELECT * FROM bebida WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("i", $id);
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

}
?>
