<?php

require_once "conexao.php";
require_once "../model/metodo.php";

// implementação de acesso a dados
class DAOMetodo {
    // inserir um novo método de pagamento no banco
    public function Inserir(MetodoPagamento $n) {
        // consulta SQL de inserção de dados nessa tabela
        $sql = "INSERT INTO metodos_pagamento VALUES(DEFAULT,?,?,?,?,?,?,?)";
        $stmt = FabricaConexao::Conexao()->prepare($sql);

        // vinculando os valores que serão inseridos no banco nesses parametros na consulta
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

    // localizar/buscar todos os metodos de pagamento cadastrados pelo id do usuario
    public function LocalizarMetodos($id)
    {
        // consulta de busca baseado no idUsuario_fk
        $sql = "SELECT * FROM metodos_pagamento WHERE idUsuario_fk = ".$id;
        $stmt = FabricaConexao::Conexao()->prepare($sql);
        $stmt->execute();
        // retorna todos os registros encontrados
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    // deletar um método de pagamento
    public function Deletar($id, $idMetodo)
    {
        // consulta de exclusao baseado no idUsuario_fk e idMetodo
        $sql = `DELETE FROM metodos_pagamento WHERE idUsuario_fk = $id AND idMetodo = $idMetodo`;
        $stmt = FabricaConexao::Conexao()->prepare($sql);
        $stmt->execute();
        echo "<script language='javascript' type='text/javascript'>alert('Metódo de pagamento deletado com sucesso!');window.location.href='../view/perfil.php';</script>";
    }
}
