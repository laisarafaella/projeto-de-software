<?php
require_once 'conexao.php';


// operações relacionadas aos dados de usuarios no banco
class DAOUsuario {

    // insere um novo usuário na tabela usuarios
    public function Inserir(Usuario $u)
    {
        require_once '../model/usuario.php';
        // cria um comando SQL com placeholders
        $sql = "INSERT INTO usuarios VALUES(DEFAULT,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        //substitui os placeholders pelos valores do usuário.

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
        $stmt->bindValue(13,$u -> getExpiracao());

        $stmt->execute();

        header('Location: ../index.php');
    }

    // atualiza os dados de um usuário

    public function Atualizar(Usuario $u)
    {
        require_once '../model/usuario.php';
        // a busca no banco é feita pelo id do usuário

        $sql = 'UPDATE usuarios SET nome=?, sobrenome=?, email=?, data_nascimento=?, cpf=?, cep=?, telefone=? WHERE id=?';
        $stmt = FabricaConexao::Conexao()->prepare($sql);

        // recebe o objeto $u com os dados que foram atualizados

        $stmt->bindValue(1,$u -> getNome());
        $stmt->bindValue(2,$u -> getSobrenome());
        $stmt->bindValue(3,$u -> getEmail());
        $stmt->bindValue(4,$u -> getDataNascimento());
        $stmt->bindValue(5,$u -> getCpf());
        $stmt->bindValue(6,$u -> getCep());
        $stmt->bindValue(7,$u -> getTelefone());
        $stmt->bindValue(8,$u -> getId());

        $stmt->execute();
    }

    // busca os dados de um usuario específico no banco

    public function Localizar($id)
    {
        require_once '../model/usuario.php';

        //localiza  o registro correspondente ao id no banco
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = FabricaConexao::Conexao()->prepare($sql);

        // bindParam para substituir o :id pelo valor passado como parametro
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    // deletar uma conta de um usuario no banco
    public function Deletar($id)
    {
        $id = $_SESSION['id'];
        require_once '../model/usuario.php';
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = FabricaConexao::Conexao()->prepare($sql);

        // bindParam para associar o id do usuário na consulta
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->execute();   
        unset($_SESSION['id']);
        unset($_SESSION['usuario']);
        session_destroy();
        echo "<script language='javascript' type='text/javascript'>alert('Conta deletada com sucesso!');window.location.href='../index.php';</script>";
        
    }
}



