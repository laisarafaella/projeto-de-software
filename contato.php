<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <title>Contato</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Inter", sans-serif;
            background-color: #007EA7;
            color: white;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 50px 20px;
        }

        h1 {
            text-align: center;
            font-size: 36px;
            margin-bottom: 30px;
            color: #000;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        label {
            font-size: 18px;
            color: #000;
        }

        input, textarea {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            width: 100%;
            resize: none;
        }

        input[type="submit"] {
            background-color: #0056b3;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #003E92;
        }

        .mensagem-sucesso {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .mensagem-erro {
            background-color: #f44336;
            color: white;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

    </style>
</head>

<body>

<div class="container">
        <h1>Entre em Contato</h1>
        
        <!-- Verifica se há uma mensagem de sucesso ou erro -->
        <?php
        if (isset($_GET['mensagem'])) {
            echo "<div class='mensagem-sucesso'>{$_GET['mensagem']}</div>";
        } elseif (isset($_GET['erro'])) {
            echo "<div class='mensagem-erro'>{$_GET['erro']}</div>";
        }
        ?>
        
        <form action="processarContato.php" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>

            <label for="assunto">Assunto:</label>
            <input type="text" id="assunto" name="assunto" required>

            <label for="mensagem">Mensagem:</label>
            <textarea id="mensagem" name="mensagem" rows="4" required></textarea>

            <input type="submit" value="Enviar">
        </form>
    </div>
    
</body>
</html>