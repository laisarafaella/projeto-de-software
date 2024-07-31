<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página do Cliente</title>
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
        #editar {
            font-size: 16px;
            text-decoration: none;
            color: #007EA7;
            font-weight: bold;
        }
        .sair {
            background-color: #007EA7; 
            border: 3px solid #153870;
            color: #153870; 
            font-weight: bold;
            padding: 5px 20px; 
            font-size: 16px;
            cursor: pointer;
            transition: background-color: #007EA7 0.3s, color 0.3s;
        }
        .sair:hover {
            background-color: white; 
            color: #153870; 
            border-color: #153870;
            transition: 0.9s;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Página do Cliente</h2>
        <p>Bem-vindo, Cliente!</p>
        <form action="sair_login.php" method="post">
            <input type="submit" value="Sair Conta" class="sair">
        </form>
        <p><a href="index.php" id="editar">Voltar para a página inicial</a></p>
    </div>
</body>
</html>
