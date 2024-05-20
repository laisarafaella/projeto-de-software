<?php
// conexão com o bd
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "teste";

$conexao = new mysqli($host, $usuario, $senha, $banco);

// verificar a conexão
if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}

session_start();
$email = $_SESSION['usuario'];

// obter os dados do form
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$emailNovo = $_POST['email'];
$dataNascimento = $_POST['data_nascimento'];
$endereco = $_POST['endereco'];
$telefone = $_POST['telefone'];
$interesses = $_POST['interesses'];
$cep = $_POST['cep'];
$cpf = $_POST['cpf'];

// atualizar informações no banco
$sql = "UPDATE usuarios SET nome='$nome', sobrenome='$sobrenome', email='$emailNovo', data_nascimento='$dataNascimento', endereco='$endereco', telefone='$telefone', interesses='$interesses', cep='$cep', cpf='$cpf' WHERE email='$email'";

if ($conexao->query($sql) === TRUE) {
    $_SESSION['mensagem'] = 'Perfil atualizado com sucesso!';
    header('Location: perfil.php');
    exit;
} else {
    echo "Erro ao atualizar perfil: " . $conexao->error;
}

// fechar a conexão
$conexao->close();
?>
