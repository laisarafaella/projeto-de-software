<?php
// conectar ao banco de dados
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "teste";

$conexao = new mysqli($host, $usuario, $senha, $banco);

// verificar a conexão
if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}

// obter os dados do form
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // criptografar a senha
$data_nascimento = $_POST['data_nascimento'];

// prepara e executar a consulta sql
$sql = "INSERT INTO usuarios (nome, sobrenome, email, senha, data_nascimento) VALUES ('$nome', '$sobrenome', '$email', '$senha', '$data_nascimento')";

if ($conexao->query($sql) === TRUE) {
    session_start();
    $_SESSION['usuario'] = $email;
    header("Location: login.php"); // redirecionar para a página de login após o registro
} else {
    echo "Erro ao registrar usuário: " . $conexao->error;
}

// fechar a conexão
$conexao->close();
?>
