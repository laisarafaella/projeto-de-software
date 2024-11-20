<?php

require_once "conexao.php";
require_once "../model/metodo.php";

class DAOMetodo {
    public function Inserir(MetodoPagamento $n) {
        $sql = "INSERT INTO metodos_pagamento VALUES(DEFAULT,?,?,?,?,?,?,?)";
        $stmt = FabricaConexao::Conexao()->prepare($sql);

        $stmt->bindValue(1,$n -> getApelido());
        $stmt->bindValue(2,$n -> getTitular());
        $stmt->bindValue(3,$n -> getNumeroCartao());
        $stmt->bindValue(4,$n -> getUltimosDigitos());
        $stmt->bindValue(5,$n -> getDataValidade());
        $stmt->bindValue(6,$n -> getCvv());
        $stmt->bindValue(7, $n -> getIdUsuario());
        $stmt->execute();

        header('Location: ../view/perfil.php');
    }

    public function LocalizarMetodos($id)
    {
        $sql = "SELECT * FROM metodos_pagamento WHERE idUsuario_fk = ".$id;
        $stmt = FabricaConexao::Conexao()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function Deletar($id, $idMetodo)
    {
        $sql = `DELETE FROM metodos_pagamento WHERE idUsuario_fk = $id AND idMetodo = $idMetodo`;
        $stmt = FabricaConexao::Conexao()->prepare($sql);
        $stmt->execute();
        echo "<script language='javascript' type='text/javascript'>alert('Metódo de pagamento deletado com sucesso!');window.location.href='../view/perfil.php';</script>";
    }
}
