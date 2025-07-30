<?php
include ("../conexao/conexao.php");
class Cadastro
{
    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    public function cadastrarItem($nome, $tipo, $tamanho, $ml, $borda, $ingredientes, $preco, $estoque, $foto)
    {
        $sql = "INSERT INTO itens(nome, tipo, tamanho, ml, borda, ingredientes, preco, estoque, foto)
                VALUES(?,?,?,?,?,?,?,?,?) ";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("ssssssdss", $nome, $tipo, $tamanho, $ml, $borda, $ingredientes, $preco, $estoque, $foto);
        $stmt->execute();
        return $this->conexao->insert_id;


    }
    public function criarPedido($id_c, $id_f, $status, $endereco, $tipo_entrega, $frete, $hora, $total, $telefone,$userId)
    {
        $sql = "INSERT INTO pedido(cliente_id, funcionario_id, status, endereco_entrega, tipo_entrega, frete,hora, total, telefone) VALUES(?,?,?,?,?,?,?,?,?)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("iisssdsds", $id_c,$id_f,$status,$endereco,$tipo_entrega,$frete,$hora,$total,$telefone);
        $stmt->execute();
        $id = $this->conexao->insert_id;
        header("location: ../templates/add_itens.php?id_pedido=$id&user_id=$userId");
        return $id;
    }

    public function criarItemPedido($id_pedido,$id_item,$quantidade,$observacao,$subtotal)
    {
     $sql = "INSERT INTO item_pedido(id_pedido,id_item,quantidade,observacao,subtotal) VALUES(?,?,?,?,?)";
     $stmt = $this->conexao->prepare($sql);
     $stmt->bind_param("iiisd",$id_pedido,$id_item,$quantidade,$observacao,$subtotal);
     $stmt->execute();
     return $this->conexao->insert_id;
    }

    public function criarPagamento($id_pedido, $id_func, $metodo, $valor, $troco,$data, $status)
    {
        $sql = "INSERT INTO pagamento(pedido_id, funcionario_id,metodo,valor,troco,data_pagamento,status_pagamento) VALUES(?,?,?,?,?,?,?)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("iisddss",$id_pedido,$id_func,$metodo,$valor,$troco,$data,$status);
        $stmt->execute();
        return $this->conexao->insert_id;

    }
}
?>
