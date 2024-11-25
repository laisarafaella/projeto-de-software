<?php
session_start();
require_once "conexao.php";

// Sanitizar entradas para que seja válido
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$senha = $_POST['senha'];

// e-mail e senha foram preenchidos
if ($email && $senha) {
    // select para encontrar o usuário
    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $stmt = FabricaConexao::Conexao()->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    // testando resultado do número de linhas do select
    // se o num de linhas for maior q 0, significa q existe um usuario com o email que foi fornecido
    if ($stmt->rowCount() > 0) {
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Debug: verificar o hash armazenado e a senha fornecida
        error_log("Senha fornecida: " . $senha);
        error_log("Hash armazenado: " . $usuario['senha']);

        // a senha fornecida pelo usuário corresponde à senha armazenada
        if (password_verify($senha, $usuario['senha'])) {
            // login bem sucedido, as info são armazenadas na sessao
            $_SESSION['usuario'] = $email;
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nomeUsuario'] = $usuario['nome'];
            header("Location: ../view/perfil.php");
            exit();
        } else {
            // caso a senha esteja errada (fazer retorno ao login)
            echo "<script language='javascript' type='text/javascript'>alert('Senha incorreta!');window.location.href='../view/login.php';</script>";
        }
    } else {
        // caso o usuário não exista (fazer retorno ao login)
        echo "<script language='javascript' type='text/javascript'>alert('Usuário inexistente!');window.location.href='../view/login.php';</script>";
    }
} else {
    // caso nem todos os campos tenha sido preenchidos (fazer retorno ao login)
    echo "<script language='javascript' type='text/javascript'>alert('Nem todos os campos foram preenchidos!');window.location.href='../view/login.php';</script>";
}

