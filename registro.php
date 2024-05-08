<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuário</title>

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
    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="date"],
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

</style>
</head>
<body>

    <h2>Criar Perfil</h2>
    <form action="processar_registro.php" method="POST">
        <input type="text" name="nome" placeholder="Nome" required><br>
        <input type="text" name="sobrenome" placeholder="Sobrenome" required><br>
        <input type="email" name="email" placeholder="E-mail" required><br>
        <input type="password" name="senha" placeholder="Senha" required><br>
        <input type="date" name="data_nascimento" required><br>
        <button type="submit">Cadastrar</button>
    </form>

</body>
</html>
