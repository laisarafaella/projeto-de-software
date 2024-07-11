<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento - <?php echo htmlspecialchars($_GET['plano']); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #001f54;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .pagamento-container {
            background-color: #002f7a;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
        }
        .pagamento-container h2 {
            background-color: #0056b3;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }
        .pagamento-container form {
            display: flex;
            flex-direction: column;
        }
        .pagamento-container label {
            margin-top: 10px;
        }
        .pagamento-container input, .pagamento-container select {
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: none;
        }
        .pagamento-container button {
            background-color: #0056b3;
            color: white;
            padding: 10px;
            margin-top: 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .pagamento-container button:hover {
            background-color: #007EA7;
        }
    </style>
</head>
<body>
    <div class="pagamento-container">
        <h2>Pagamento - <?php echo htmlspecialchars($_GET['plano']); ?></h2>
        <form action="processa_pagamento.php" method="POST">
            <input type="hidden" name="plano" value="<?php echo htmlspecialchars($_GET['plano']); ?>">
            <label for="nome">Nome Completo</label>
            <input type="text" id="nome" name="nome" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="endereco">Endereço</label>
            <input type="text" id="endereco" name="endereco" required>

            <label for="cartao">Número do Cartão</label>
            <input type="text" id="cartao" name="cartao" required>

            <label for="validade">Data de Validade</label>
            <input type="month" id="validade" name="validade" required>

            <label for="cvv">CVV</label>
            <input type="text" id="cvv" name="cvv" required>

            <button type="submit">Finalizar Pagamento</button>
        </form>
    </div>
</body>
</html>
