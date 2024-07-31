<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja de Pontos</title>
    <style>
        body {
            background-color: #f0f0f0;
            font-family: "Inter", sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
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
        .produto {
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
            padding: 10px;
            display: flex;
            align-items: center;
        }
        .produto img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
            margin-right: 20px;
        }
        .produto-info {
            flex-grow: 1;
        }
        .produto-info h3 {
            margin: 0;
            margin-bottom: 10px;
        }
        .produto-info p {
            margin: 0;
            margin-bottom: 5px;
        }
        .produto-info .pontos {
            font-weight: bold;
        }
        .produto-info .resgatar {
            background-color: #007EA7;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
            text-align: center;
        }
        .produto-info .resgatar:hover {
            background-color: #005f73;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Loja de Pontos</h2>
        <?php
        // Configuração do banco de dados
        $host = "localhost";
        $usuario = "root";
        $senha = "";
        $banco = "teste";

        // Conexão com o banco de dados
        $conexao = new mysqli($host, $usuario, $senha, $banco);

        // Verificação de conexão
        if ($conexao->connect_error) {
            die("Erro de conexão: " . $conexao->connect_error);
        }

        // Obter produtos da loja
        $sql = "SELECT * FROM produtos";
        $result = $conexao->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="produto">';
                echo '<img src="' . $row['imagem'] . '" alt="' . $row['nome'] . '">';
                echo '<div class="produto-info">';
                echo '<h3>' . $row['nome'] . '</h3>';
                echo '<p>' . $row['descricao'] . '</p>';
                echo '<p class="pontos">Pontos: ' . $row['pontos'] . '</p>';
                echo '<form action="redeem.php" method="POST">';
                echo '<input type="hidden" name="produto_id" value="' . $row['id'] . '">';
                echo '<input type="submit" class="resgatar" value="Resgatar">';
                echo '</form>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "<p>Nenhum produto disponível.</p>";
        }

        // Fechar a conexão
        $conexao->close();
        ?>
        <p><a href="index.php" id="editar">Voltar para a página inicial</a></p>
    </div>
</body>
</html>
