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
    </style>
</head>
<body>
    <div class="container">
        <h2>Perfil do Usuário</h2>
        <?php
        // conectar
        $host = "localhost";
        $usuario = "root";
        $senha = "";
        $banco = "teste";


        $conexao = new mysqli($host, $usuario, $senha, $banco);


        // conexao
        if ($conexao->connect_error) {
            die("Erro de conexão: " . $conexao->connect_error);
        }

// Consulta SQL para selecionar os dados
    session_start();
    $email = $_SESSION['usuario'];
    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        echo "<p><strong>Nome:</strong> " . $usuario['nome'] . " " . $usuario['sobrenome'] . "</p>";
        echo "<p><strong>E-mail:</strong> " . $usuario['email'] . "</p>";
        echo "<p><strong>Data de Nascimento:</strong> " . $usuario['data_nascimento'] . "</p>";
    } else {
        echo "Nenhuma informação de usuário encontrada!";
    }

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

    // Fecha a conexão
    $conexao->close();
    ?>

    <p><a href="editar_perfil.php">Editar Perfil</a></p> <!-- ir pra página de editar o perfil -->
    <p><a href="index.php">Voltar para a página inicial</a></p> <!-- voltar pra página inicial -->
    </div>

</body>
</html>