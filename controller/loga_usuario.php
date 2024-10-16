<?php
session_start();
require_once "conexao.php";

// Sanitizar entradas
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$senha = $_POST['senha'];

if ($email && $senha) {
    // Select para encontrar o usuário
    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $stmt = FabricaConexao::Conexao()->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    //Testando resultado do número de linhas do select
    if ($stmt->rowCount() > 0) {
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Debug: Verificar o hash armazenado e a senha fornecida
        error_log("Senha fornecida: " . $senha);
        error_log("Hash armazenado: " . $usuario['senha']);

        if (password_verify($senha, $usuario['senha'])) {
            // Login bem sucedido
            $_SESSION['usuario'] = $email;
            $_SESSION['id'] = $usuario['id'];
            header("Location: ../view/perfil.php");
            exit();
        } else {
            // Caso a senha esteja errada (fazer retorno ao login)
            echo "<script language='javascript' type='text/javascript'>alert('Senha incorreta!');window.location.href='../view/login.php';</script>";
        }
    } else {
        // Caso o usuário não exista (fazer retorno ao login)
        echo "<script language='javascript' type='text/javascript'>alert('Usuário inexistente!');window.location.href='../view/login.php';</script>";
    }
} else {
    // Caso nem todos os campos tenha sido preenchidos (fazer retorno ao login)
    echo "<script language='javascript' type='text/javascript'>alert('Nem todos os campos foram preenchidos!');window.location.href='../view/login.php';</script>";
}

