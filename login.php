<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Usuário</title>

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

    #esqueci {
        font-size: 16px;
        text-decoration: none;
        color: #007EA7;
        font-weight: bold;
    }

    #volta {
        font-size: 16px;
        text-decoration: none;
        color: white;
        font-weight: bold;
    }

    .voltar {
        background-color: #007EA7;
        height: 30px;
        text-decoration: none;
        border-radius: 50px;
    }
    

    .esqueci {
        text-align: center;
    }

    </style>
</head>
<body>
    <h2>Login</h2>
    <form action="processar_login.php" method="POST">
        <input type="email" name="email" placeholder="E-mail" required><br>
        <input type="password" name="senha" placeholder="Senha" required><br>
        <button type="submit">Entrar</button>
        <div class="esqueci">
            <a href="esqueci_senha.php" id="esqueci">Esqueci a senha</a><br><br>
            <div class="voltar">
                <button id="volta">
                    <a href="index.php" id="volta">Voltar para a página inicial</a>
                </button>
            </div>
        </div>
    </form>

</body>
</html>
