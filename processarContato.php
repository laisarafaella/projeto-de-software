<?php

$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "teste";

$conexao = new mysqli($host, $usuario, $senha, $banco);


if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}


$nome = $_POST['nome'];
$email = $_POST['email'];
$mensagem = $_POST['mensagem'];

// Preparar a consulta para evitar injeção de SQL
$stmt = $conexao->prepare("INSERT INTO contatos (nome, email, mensagem) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nome, $email, $mensagem);

// Executar a consulta
if ($stmt->execute()) {
    echo "Mensagem enviada com sucesso!";
} else {
    echo "Erro: " . $stmt->error;
}

$stmt->close();
$conexao->close();
?>
