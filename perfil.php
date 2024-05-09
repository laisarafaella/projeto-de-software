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
$sql = "SELECT nome, sobrenome, email, data_nascimento FROM usuarios";
$result = $conexao->query($sql);

if ($result->num_rows > 0) {
    // Exibe os dados de cada linha
    while($row = $result->fetch_assoc()) {
        echo "Nome: " . $row["nome"]. " " . $row["sobrenome"]. "<br>";
        echo "Email: " . $row["email"]. "<br>";
        echo "Data de Nascimento: " . $row["data_nascimento"]. "<br><br>";
    }
} else {
    echo "Nenhuma informação encontrada!";
}

// Fecha a conexão
$conexao->close();
?>

<a href="index.php">Voltar para a página inicial</a>
