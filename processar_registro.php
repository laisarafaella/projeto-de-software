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


// Configurações de upload de arquivo
$diretorio_upload = 'uploads/';
$nome_arquivo = basename($_FILES['arquivo']['name']);
$caminho_arquivo = $diretorio_upload . $nome_arquivo;
$tipo_arquivo = strtolower(pathinfo($caminho_arquivo, PATHINFO_EXTENSION));

// Verifica se a imagem é válida
$check = getimagesize($_FILES['arquivo']['tmp_name']);
if($check === false) {
    die("O arquivo não é uma imagem válida.");
}

// Verifica o tamanho do arquivo
if ($_FILES['arquivo']['size'] > 3000000) {
    die("O arquivo é muito grande. Máximo permitido: 3MB.");
}

// Permitir apenas certos formatos de imagem
if($tipo_arquivo != "jpg" && $tipo_arquivo != "png" && $tipo_arquivo != "jpeg" && $tipo_arquivo != "gif" ) {
    die("Somente arquivos JPG, JPEG, PNG e GIF são permitidos.");
}

// Tentativa de mover o arquivo carregado para o diretório de uploads
if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $caminho_arquivo)) {
    echo "O arquivo ". htmlspecialchars($nome_arquivo). " foi enviado com sucesso.";
} else {
    die("Desculpe, houve um erro ao enviar o arquivo.");
}

// Obter os dados do formulário
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografar a senha
$data_nascimento = $_POST['data_nascimento'];
$tipo_usuario = $_POST['tipo_usuario'];

// Preparar e executar a consulta SQL para inserir usuário
$sql = "INSERT INTO usuarios (nome, sobrenome, email, senha, data_nascimento, tipo_usuario, foto_perfil) VALUES ('$nome', '$sobrenome', '$email', '$senha', '$data_nascimento', '$tipo_usuario', '$caminho_arquivo')";

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
