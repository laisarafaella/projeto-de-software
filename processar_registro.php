<?php
// Conectar ao banco de dados
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "teste";

$conexao = new mysqli($host, $usuario, $senha, $banco);

// Verificar a conexão
if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}

// Obter os dados do formulário
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografar a senha
$data_nascimento = $_POST['data_nascimento'];
$tipo_usuario = $_POST['tipo_usuario'];

// Preparar e executar a consulta SQL para inserir usuário
$sql = "INSERT INTO usuarios (nome, sobrenome, email, senha, data_nascimento, tipo_usuario) VALUES ('$nome', '$sobrenome', '$email', '$senha', '$data_nascimento', '$tipo_usuario')";

if ($conexao->query($sql) === TRUE) {
    // Após o registro, redirecionar para página específica dependendo do tipo de usuário
    if ($tipo_usuario == 'cliente') {
        header("Location: pagina_cliente.php");
    } elseif ($tipo_usuario == 'sócio') {
        header("Location: pagina_socio.php");
    } else {
        // Caso nenhum tipo específico seja definido, redirecionar para página padrão
        header("Location: index.php");
    }
} else {
    echo "Erro ao registrar usuário: " . $conexao->error;
}

// Fechar a conexão
$conexao->close();
?>
