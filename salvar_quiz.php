<?php
session_start();

// Configuração do banco de dados
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "teste";

// Conexão com o banco de dados
$conexao = new mysqli($host, $usuario, $senha, $banco);

// Verificação de conexão
if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}

// Obter dados do formulário
$usuario_id = $_SESSION['usuario_id']; // Assumindo que o ID do usuário está armazenado na sessão
$preferencia_esporte = $_POST['preferencia_esporte'];
$preferencia_calcado = $_POST['preferencia_calcado'];
$preferencia_roupa = $_POST['preferencia_roupa'];
$frequencia_pratica = $_POST['frequencia_pratica'];
$marca_preferida = $_POST['marca_preferida'];

// Inserir dados no banco de dados
$sql = "INSERT INTO quiz_respostas (usuario_id, preferencia_esporte, preferencia_calcado, preferencia_roupa, frequencia_pratica, marca_preferida)
        VALUES ('$usuario_id', '$preferencia_esporte', '$preferencia_calcado', '$preferencia_roupa', '$frequencia_pratica', '$marca_preferida')";

if ($conexao->query($sql) === TRUE) {
    echo "<script>alert('Respostas enviadas com sucesso!'); window.location.href='index.php';</script>";
} else {
    echo "<script>alert('Erro ao enviar respostas: " . $conexao->error . "'); window.location.href='index.php';</script>";
}

// Fechar a conexão
$conexao->close();
?>
