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

// Nome do usuário (pode ser uma variável de sessão no futuro)
$nomeUsuario = 'cliente1';

// Busca as informações do usuário (quantidade de notas e pontos)
$stmt = $pdo->prepare("SELECT notas_recebidas, pontos FROM usuarios WHERE nome = :usuario");
$stmt->execute(['usuario' => $nomeUsuario]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Verifica se o usuário existe
if (!$usuario) {
    die("<div class='mensagem'>Usuário não encontrado.</div>");
}

$notasRecebidas = $usuario['notas_recebidas'];
$pontos = $usuario['pontos'];

// Função para processar a troca de pontos
if (isset($_POST['cupom'])) {
    $cupom = $_POST['cupom'];
    $desconto = 0;

    switch ($cupom) {
        case 'SYNC5':
            $desconto = 5;
            break;
        case 'SYNC10':
            $desconto = 10;
            break;
        case 'SYNC15':
            $desconto = 15;
            break;
    }

    // Verifica se o usuário tem pontos suficientes
    $custo = $desconto * 50; // 50 pontos por percentual
    if ($pontos >= $custo) {
        // Deduz os pontos e exibe o cupom
        $stmt = $pdo->prepare("UPDATE usuarios SET pontos = pontos - :custo WHERE nome = :usuario");
        $stmt->execute(['custo' => $custo, 'usuario' => $nomeUsuario]);

        // Armazena a mensagem de sucesso
        $mensagem = "Você trocou $custo pontos pelo cupom de $desconto% de desconto: $cupom";

        $pontos -= $custo; // Atualiza a variável de pontos
    } else {
        $mensagem = "Pontos insuficientes para trocar por esse desconto.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pontos do Usuário</title>
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
        .btn {
            background-color: #3399ff;
            color: #fff;
            padding: 10px 20px;
            margin: 10px 0;
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
    <h1>Quantidade de Notas: <?php echo $notasRecebidas; ?></h1>
    <h1>Seus Pontos: <?php echo $pontos; ?></h1>

    <form method="POST">
        <button class="btn" name="cupom" value="SYNC5">Trocar por desconto de 5% (250 pontos)</button>
        <button class="btn" name="cupom" value="SYNC10">Trocar por desconto de 10% (500 pontos)</button>
        <button class="btn" name="cupom" value="SYNC15">Trocar por desconto de 15% (750 pontos)</button>
    </form>

    <div class="mensagem">
        <?php if (isset($mensagem)) echo $mensagem; ?>
    </div>

    <a href="criar_codigofiscal.php" class="btn" style="display: inline-block; text-decoration: none;">Voltar</a>
</div>

</body>
</html>