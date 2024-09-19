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

// Verificação do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigoNota = $_POST['codigo_nota'];
    $acaoCliente = $_POST['acao'];
    $valorCompra = 100.00;  // Valor fictício da compra, pode ser substituído com o valor real

    // Verifica se o código inserido existe e não foi utilizado
    $stmt = $pdo->prepare("SELECT * FROM notas_fiscais WHERE codigo_nota = :codigo AND usado = 0");
    $stmt->execute(['codigo' => $codigoNota]);
    $nota = $stmt->fetch();

    if ($nota) {
        // Verifica o percentual de desconto
        $percentualDesconto = floatval($nota['desconto']);
        $valorDesconto = $valorCompra * ($percentualDesconto / 100);
        $valorFinal = $valorCompra - $valorDesconto;

        // Atualiza o status para "usado"
        $stmt = $pdo->prepare("UPDATE notas_fiscais SET usado = 1 WHERE id = :id");
        $stmt->execute(['id' => $nota['id']]);

        if ($acaoCliente == 'usar') {
            echo "<div class='mensagem'>Você escolheu usar o código! O desconto foi de $percentualDesconto%. O valor final da compra é R$" . number_format($valorFinal, 2, ',', '.') . ".</div>";
        } elseif ($acaoCliente == 'doar') {
            echo "<div class='mensagem'>Você escolheu doar o código de desconto!</div>";
        }
    } else {
        echo "<div class='mensagem erro'>Código inválido ou já utilizado!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validação de Código de Desconto</title>
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
            display: flex;
            justify-content: space-evenly;
            margin: 12px;
            flex-direction: column;
            background-color: #e6f2ff;
            border: 1px solid #99ccff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            height: 400px;
            max-width: 800px;
            text-align: center;
        }
        .container h1 {
            font-size: 25px;
            color: #0066cc;
        }
        input[type="text"], select {
            width: 200px;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #99ccff;
            border-radius: 5px;
        }
        .btn {
            background-color: #3399ff;
            color: #fff;
            padding: 15px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0066cc;
        }
        .btn2 {
            font-size: 12px;
            background-color: #3399ff;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn2:hover {
            background-color: #0066cc;
        }
        .mensagem {
            margin-top: 20px;
            font-weight: bold;
        }
        .erro {
            color: red;
        }
        #loja {
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container">
    <div>
    <h1>Valide seu Código de Desconto</h1>
    <label for="">Após sua compra você pode utilizar seu cupom até 30 dias</label>
    </div>
    <form action="" method="POST">
        <div>
            <label for="codigo_nota">Digite o Código da Nota Fiscal:</label><br>
            <input type="text" id="codigo_nota" name="codigo_nota" required><br>
        </div>
        <div>
            <label for="acao">Escolha uma ação:</label><br>
            <select id="acao" name="acao" required>
                <option value="usar">Usar na Próxima Compra</option>
                <option value="doar">Doar</option>
            </select>
        </div><br>
        <div id="loja">
            <label for="">Não realizou sua compra?</label>
            <a href="shop.php" class="btn2">Conheça nossa Loja!</a>
        </div><br>

        <button type="submit" class="btn">Validar Código</button>
    </form>
</div>

</body>
</html>
