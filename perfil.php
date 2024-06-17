

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <style>
         body {
            background-color: #007EA7;
            font-family: "Inter", sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        p {
            margin-bottom: 10px;
        }
        .sai {
            justify-content: space-evenly;
            display: flex;
        }
        .sair {
            
            background-color: #007EA7; 
            border: 3px solid #153870;
            color: #153870; 
            font-weight: bold;
            padding: 5px 20px; 
            font-size: 16px;
            cursor: pointer;
            transition: background-color: #007EA7 0.3s, color 0.3s;
        }
        .sair:hover {
            background-color: white; 
            color: #153870; 
            border-color: #153870;
            transition: 0.9s;
        }
        #editar {
        font-size: 16px;
        text-decoration: none;
        color: #007EA7;
        font-weight: bold;
    }
    </style>
</head>
<body>
    <div class="container">
        <h2>Perfil do Usuário</h2>
        <?php
session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['usuario'])) {
    // Se não estiver, redireciona para a página de login
    header("Location: login.php");
    exit;
}

// conectar ao banco de dados
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "teste";

$conexao = new mysqli($host, $usuario, $senha, $banco);

// Verifica se há erro na conexão
if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}

// Consulta SQL para selecionar os dados do usuário
$email = $_SESSION['usuario'];
$sql = "SELECT * FROM usuarios WHERE email='$email'";
$result = $conexao->query($sql);

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
    echo "<p><strong>Nome:</strong> " . $usuario['nome'] . " " . $usuario['sobrenome'] . "</p>";
    echo "<p><strong>E-mail:</strong> " . $usuario['email'] . "</p>";
    echo "<p><strong>Data de Nascimento:</strong> " . $usuario['data_nascimento'] . "</p>";

    // Exibir campos adicionais se preenchidos pelo usuário
    if (!empty($usuario['telefone'])) {
        echo "<p><strong>Telefone:</strong> " . $usuario['telefone'] . "</p>";
    }
    if (!empty($usuario['cpf'])) {
        echo "<p><strong>CPF:</strong> " . $usuario['cpf'] . "</p>";
    }
    if (!empty($usuario['endereco'])) {
        echo "<p><strong>Endereço:</strong> " . $usuario['endereco'] . "</p>";
    }
    if (!empty($usuario['cep'])) {
        echo "<p><strong>CEP:</strong> " . $usuario['cep'] . "</p>";
    }
    if (!empty($usuario['interesses'])) {
        echo "<p><strong>Interesses Esportivos:</strong> " . $usuario['interesses'] . "</p>";
    }
} else {
    echo "Nenhuma informação de usuário encontrada!";
}

// Fecha a conexão
$conexao->close();
?>
        <p><a href="index.php" id="editar">Voltar para a página inicial</a></p> <!-- Ir para a página de editar o perfil -->
        <p><a href="editar_perfil.php" id="editar">Editar Perfil</a></p> <!-- Ir para a página de editar o perfil -->
        <div class="sai">
            <form action="sair_login.php" method="post">
                <input type="submit" value="Sair Conta" class="sair">
            </form>
            <form action="deletar_conta.php" method="post">
                <input type="submit" name="delete" value="Excluir Conta" class="sair" onclick="return confirm('Tem certeza de que deseja excluir sua conta? Esta ação não pode ser desfeita.');">
            </form>
        </div>
    </div>
</body>
</html>
