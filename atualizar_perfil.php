<?php
// conexão com o banco de dados
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

// obter os dados do formulário
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$emailNovo = $_POST['email'];
$dataNascimento = $_POST['data_nascimento'];
$endereco = $_POST['endereco'];
$telefone = $_POST['telefone'];
$interesses = $_POST['interesses'];
$cep = $_POST['cep'];
$cpf = $_POST['cpf'];
$senhaAtual = $_POST['senhaAtual'];
$novaSenha = $_POST['senhaNova'];
$confirmarSenha = $_POST['confirmarSenha'];

// Verificar se o usuário inseriu a senha correta
$sql = "SELECT senha FROM usuarios WHERE email='$email'";
$resultado = $conexao->query($sql);

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
    
    // Verificar se a senha atual está correta
    if (password_verify($senhaAtual, $usuario['senha'])) {
        
        // Atualizar foto de perfil, se houver upload
        if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] == UPLOAD_ERR_OK) {
            $diretorio_upload = 'uploads/';
            if (!is_dir($diretorio_upload)) {
                mkdir($diretorio_upload, 0777, true);
            }

            $nome_arquivo = basename($_FILES['foto_perfil']['name']);
            $caminho_arquivo = $diretorio_upload . $nome_arquivo;
            $tipo_arquivo = strtolower(pathinfo($caminho_arquivo, PATHINFO_EXTENSION));

            // Verificar se o arquivo é uma imagem válida
            $check = getimagesize($_FILES['foto_perfil']['tmp_name']);
            if ($check !== false) {
                if ($_FILES['foto_perfil']['size'] <= 3000000) { // Limite de 3MB
                    $formatos_permitidos = ['jpg', 'jpeg', 'png', 'gif'];
                    if (in_array($tipo_arquivo, $formatos_permitidos)) {
                        move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $caminho_arquivo);
                        // Atualizar caminho da foto no banco de dados
                        $sql_foto = "UPDATE usuarios SET foto_perfil='$caminho_arquivo' WHERE email='$email'";
                        $conexao->query($sql_foto);
                    } else {
                        echo "Formato de arquivo não suportado.";
                        exit;
                    }
                } else {
                    echo "O arquivo é muito grande. Máximo permitido: 3MB.";
                    exit;
                }
            } else {
                echo "O arquivo não é uma imagem válida.";
                exit;
            }
        }

        // Atualizar dados do perfil (exceto a senha)
        $sql = "UPDATE usuarios SET nome='$nome', sobrenome='$sobrenome', email='$emailNovo', data_nascimento='$dataNascimento', endereco='$endereco', telefone='$telefone', interesses='$interesses', cep='$cep', cpf='$cpf' WHERE email='$email'";
        
        // Verificar se nova senha e confirmação de senha são iguais
        if (!empty($novaSenha) && $novaSenha == $confirmarSenha) {
            $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
            $sql .= ", senha='$senhaHash'";
        }
        
        // Executar atualização de perfil
        if ($conexao->query($sql) === TRUE) {
            $_SESSION['mensagem'] = 'Perfil atualizado com sucesso!';
            header('Location: perfil.php');
            exit;
        } else {
            echo "Erro ao atualizar perfil: " . $conexao->error;
        }
    } else {
        echo "Senha atual incorreta!";
    }
} else {
    echo "Usuário não encontrado!";
}

// fechar a conexão
$conexao->close();
?>
