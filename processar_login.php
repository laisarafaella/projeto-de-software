<?php
// conectar bd
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "teste";

$conexao = new mysqli($host, $usuario, $senha, $banco);

// verificar a conexão c o banco
if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}

// obter os dados do formulário
$email = $_POST['email'];
$senha = $_POST['senha'];

// consultar o usuario no banco
$sql = "SELECT * FROM usuarios WHERE email='$email'";
$resultado = $conexao->query($sql);

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
    if (password_verify($senha, $usuario['senha'])) {
        // login bem sucedido
        session_start();
        $_SESSION['usuario'] = $email;
        header("Location: perfil.php"); // redirecionar para a página de perfil
    } else {
        echo "Senha incorreta!";
    }
} else {
    echo "Usuário não encontrado!";
}

// fechar a conexão
$conexao->close();
?>
