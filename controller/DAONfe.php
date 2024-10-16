<?php

require_once "conexao.php";
require_once "../model/nfe.php";

class DAONfe {
    public function Inserir(NFE $n, $userId) {
        $sql = "INSERT INTO nfe VALUES(DEFAULT,?,?,?,?,?,?,".$userId.")";
        $stmt = FabricaConexao::Conexao()->prepare($sql);

        $stmt->bindValue(1,$n -> getApelido());
        $stmt->bindValue(2,$n -> getChaveAcesso());
        $stmt->bindValue(3,$n -> getCnpj());
        $stmt->bindValue(4,$n -> getRazaoSocial());
        $stmt->bindValue(5,$n -> getDataEmissao());
        $stmt->bindValue(6,$n -> getValorTotal());
        $stmt->execute();

        header('Location: ../view/perfil.php');
    }

    public function LocalizarNfes($id)
    {
        $sql = "SELECT * FROM nfe WHERE idUsuario_fk = ".$id;
        $stmt = FabricaConexao::Conexao()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function Deletar($id, $idNfe)
    {
        $sql = `DELETE FROM usuarios_nfe WHERE usuarios_id = $id AND nfe_idNfe = $idNfe`;
        $stmt = FabricaConexao::Conexao()->prepare($sql);
        $stmt->execute();

        $sql = 'DELETE FROM nfe WHERE idNfe = :idNfe';
        $stmt = FabricaConexao::Conexao()->prepare($sql);
        $stmt->bindParam(':idNfe',$idNfe,PDO::PARAM_INT);
        $stmt->execute();

        echo "<script language='javascript' type='text/javascript'>alert('NFE deletada com sucesso!');window.location.href='../view/perfil.php';</script>";
    }
}