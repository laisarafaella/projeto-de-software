<?php
// Conexão com o banco de dados
$host = 'localhost';
$dbname = 'teste';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

// Verifica o envio do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigoNota = $_POST['codigo_nota'];

    // Insere o código no banco de dados
    $stmt = $pdo->prepare("INSERT INTO notas_fiscais (codigo_nota, usado) VALUES (:codigo, 0)");
    $stmt->execute(['codigo' => $codigoNota]);

    echo "<div class='mensagem'>Código inserido com sucesso!</div>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Código de Nota Fiscal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #e6f2ff;
            border: 1px solid #99ccff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            text-align: center;
        }
        .container h1 {
            color: #0066cc;
        }
        input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #99ccff;
            border-radius: 5px;
        }
        .btn {
            background-color: #3399ff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0066cc;
        }
        .mensagem {
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Adicionar Código de Nota Fiscal</h1>
    <form action="" method="POST">
        <label for="codigo_nota">Digite o Código da Nota Fiscal:</label>
        <input type="text" id="codigo_nota" name="codigo_nota" required>

        <input type="submit" class="btn" value="Adicionar Código">
        <a id="voltar" href="index.php">página inicial</a>
    </form>
</div>

</body>
</html>