<?php

// incluir arquivos
require_once "conexao.php";
require_once "../model/nfe.php";
require_once "geraPontos.php";

// operações de Notafiscal Eletrônica (NFE) no banco de dados
class DAONfe {

    // insere uma nova nfe no banco
    public function Inserir(NFE $n, $userId) {
        // consulta sql que vai inserir baseado ao usuario especifico
        // ??? ... placeholders (evitar injecao sql) q vão ser substituido pelos valores inseridos (bindValue)
        $sql = "INSERT INTO nfe VALUES(DEFAULT,?,?,?,?,?,?,".$userId.")";
        $stmt = FabricaConexao::Conexao()->prepare($sql);

        // associa os valores dos parametros da consulta com os dados do objeto NFE
        //bindValue() - vincula um valor a um parâmetro da consulta
        $stmt->bindValue(1,$n -> getApelido());
        $stmt->bindValue(2,$n -> getChaveAcesso());
        $stmt->bindValue(3,$n -> getCnpj());
        $stmt->bindValue(4,$n -> getRazaoSocial());
        $stmt->bindValue(5,$n -> getDataEmissao());
        $stmt->bindValue(6,$n -> getValorTotal());
        $stmt->execute();

        // calcula e gera os pontos para o usuario com base no valor da compra (funcionalidade)

        // objeto da classe
        $gr = new geraPontos();

        // metodo é chamado
        $gr->novosPontos($n);

    }

    // localiza as Nfes de um usuario
    public function LocalizarNfes($id)
    {
        // consulta sql para selecionar todas essas nfes q estao associadas ao usuario - idUsuario_fk
        $sql = "SELECT * FROM nfe WHERE idUsuario_fk = ".$id;
        $stmt = FabricaConexao::Conexao()->prepare($sql);
        $stmt->execute();
        // retorna todos os registro
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    // deletar uma nfe do banco
    public function Deletar($id, $idNfe)
    {
        // consulta q deleta a relaçao do usuario e a nfe na tabela 
        $sql = `DELETE FROM usuarios_nfe WHERE usuarios_id = $id AND nfe_idNfe = $idNfe`;
        $stmt = FabricaConexao::Conexao()->prepare($sql);
        $stmt->execute();

        // consulta para excluir o registro da nfe
        $sql = 'DELETE FROM nfe WHERE idNfe = :idNfe';
        $stmt = FabricaConexao::Conexao()->prepare($sql);
        // evitar injeção sql (bindParam) -  vincula a referência do valor
        $stmt->bindParam(':idNfe',$idNfe,PDO::PARAM_INT);
        $stmt->execute();

        echo "<script language='javascript' type='text/javascript'>alert('NFE deletada com sucesso!');window.location.href='../view/perfil.php';</script>";
    }
}