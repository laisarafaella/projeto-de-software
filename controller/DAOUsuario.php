<?php

require_once 'conexao.php';
require_once '../model/usuario.php';

class DAOUsuario {
    public function Inserir(Usuario $u)
    {
        $sql = "INSERT INTO usuarios VALUES(DEFAULT,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = FabricaConexao::Conexao()->prepare($sql);
        $stmt->bindValue(1,$u -> getNome());
        $stmt->bindValue(2,$u -> getSobrenome());
        $stmt->bindValue(3,$u -> getEmail());
        $stmt->bindValue(4,$u -> getDataNascimento());
        $stmt->bindValue(5,$u -> getSenha());
        $stmt->bindValue(6,$u -> getRecuperarSenha());
        $stmt->bindValue(7,$u -> getCpf());
        $stmt->bindValue(8,$u -> getCep());
        $stmt->bindValue(9,$u -> getTelefone());
        $stmt->bindValue(10,$u -> getPontos());
        $stmt->bindValue(11,$u -> getNumCupons());
        $stmt->bindValue(12,$u -> getIdPlano());

        $stmt->execute();

        header('Location: ../index.php');
    }

    public function Atualizar(Usuario $u)
    {
        $sql = 'UPDATE usuarios SET nome=?, sobrenome=?, email=?, senha=?, data_nascimento=?, cpf=?, cep=?, telefone=? WHERE id=?';
        $stmt = FabricaConexao::Conexao()->prepare($sql);

        $stmt->bindValue(1,$u -> getNome());
        $stmt->bindValue(2,$u -> getSobrenome());
        $stmt->bindValue(3,$u -> getEmail());
        $stmt->bindValue(4,$u -> getSenha());
        $stmt->bindValue(5,$u -> getDataNascimento());
        $stmt->bindValue(6,$u -> getCpf());
        $stmt->bindValue(7,$u -> getCep());
        $stmt->bindValue(8,$u -> getTelefone());
        $stmt->bindValue(9,$u -> getId());

        $stmt->execute();
    }

    public function Localizar($id)
    {
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = FabricaConexao::Conexao()->prepare($sql);
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function Deletar($id)
    {
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = FabricaConexao::Conexao()->prepare($sql);
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->execute();
        echo "<script language='javascript' type='text/javascript'>alert('Conta deletada com sucesso!');window.location.href='../index.php';</script>";
    }
}



