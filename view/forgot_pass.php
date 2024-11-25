<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sportsync - Esqueci a senha</title>

    <style>
    body {
        background-color: #007EA7;
        font-family: "Inter", sans-serif;
        margin: 0;
        padding: 0;
        
    }
    h2 {
        
        text-align: center;
        margin-bottom: 20px;
    }
    form {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 300px;
        width: 100%;
        margin: 0 auto;
    }
    input[type="email"],
    input[type="password"],
    button {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    button {
        background-color: #007EA7;
        color: white;
        cursor: pointer;
    }

    button:hover {
        background-color: #005F81;
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
    <h2>Encontre sua conta</h2>
    <form action="../controller/validar_email.php" method="POST">
        <h4>Insira seu email ou número de celular para procurar a sua conta.</h4>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <button type="submit">Validar</button>
        <p><a href="../index.php" id="editar">Voltar para a página inicial</a></p> <!-- Ir para a página de editar o perfil -->
    </form>
</body>
</html>
