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

// Verifica se o arquivo foi enviado
if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] == UPLOAD_ERR_OK) {
    // Configurações de upload de arquivo
    $diretorio_upload = 'uploads/';
    
    // Verificar se o diretório de upload existe, senão, criar
    if (!is_dir($diretorio_upload)) {
        mkdir($diretorio_upload, 0777, true);
    }

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
    $formatos_permitidos = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($tipo_arquivo, $formatos_permitidos)) {
        die("Somente arquivos JPG, JPEG, PNG e GIF são permitidos.");
    }

    // Tentativa de mover o arquivo carregado para o diretório de uploads
    if (!move_uploaded_file($_FILES['arquivo']['tmp_name'], $caminho_arquivo)) {
        die("Desculpe, houve um erro ao enviar o arquivo.");
    }
}

// Obter os dados do formulário
$nome = $conexao->real_escape_string($_POST['nome']);
$sobrenome = $conexao->real_escape_string($_POST['sobrenome']);
$email = $conexao->real_escape_string($_POST['email']);
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografar a senha
$data_nascimento = $conexao->real_escape_string($_POST['data_nascimento']);
$tipo_usuario = $conexao->real_escape_string($_POST['tipo_usuario']);

// Preparar e executar a consulta SQL para inserir usuário
$sql = $conexao->prepare("INSERT INTO usuarios (nome, sobrenome, email, senha, data_nascimento, tipo_usuario, foto_perfil) VALUES (?, ?, ?, ?, ?, ?, ?)");
$sql->bind_param("sssssss", $nome, $sobrenome, $email, $senha, $data_nascimento, $tipo_usuario, $caminho_arquivo);

if ($sql->execute()) {
    // Após o registro, redirecionar para página específica dependendo do tipo de usuário
    if ($tipo_usuario == 'cliente') {
        header("Location: pagina_cliente.php");
        exit();
    } else if ($tipo_usuario == 'sócio') {
        header("Location: pagina_socio.php");
        exit();
    } else {
        header("Location: index.php");
        exit();
    }
} else {
    echo "Erro ao registrar usuário: " . $sql->error;
}

// Fechar a conexão
$conexao->close();
?>
