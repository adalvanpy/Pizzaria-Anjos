<?php
include ("../conexao/conexao.php");
class Consultas {
    private $conexao;

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }

public function getUsuarioTipo($tipo){
     $sql = "SELECT id, nome FROM usuario WHERE tipo = ?";
     $stmt = $this->conexao->prepare($sql);
     $stmt->bind_param("s", $tipo);
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

}
?>
