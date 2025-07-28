<?php
include ("../conexao/conexao.php");
class Cadastro
{
    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    public function cadastrarBebida($nome, $ml, $preco, $estoque,$tipo, $foto)
    {
        $sql = "INSERT INTO bebida(nome, ml, preco, estoque, tipo, foto)
                VALUES(?,?,?,?,?,?)";
         $stmt = $this->conexao->prepare($sql);
         $stmt->bind_param("ssdsss", $nome, $ml, $preco, $estoque, $tipo, $foto);
         $stmt->execute();
         return $this->conexao->insert_id;

    }
}
?>
