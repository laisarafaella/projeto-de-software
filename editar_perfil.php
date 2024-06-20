<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
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
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"], input[type="email"], input[type="password"], input[type="date"] {
            width: 85%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #007EA7;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
        input[type="submit"]:hover {
            background-color: #00546D;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Editar Perfil</h2>
        <?php
        // conectar
        $host = "localhost";
        $usuario = "root";
        $senha = "";
        $banco = "teste";

        $conexao = new mysqli($host, $usuario, $senha, $banco);

        // conexao
        if ($conexao->connect_error) {
            die("Erro de conexão: " . $conexao->connect_error);
        }

        // obter informações do usuário
        session_start();
        $email = $_SESSION['usuario'];
        $sql = "SELECT * FROM usuarios WHERE email='$email'";
        $resultado = $conexao->query($sql);

        if ($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();
            ?>
            <form action="atualizar_perfil.php" method="post">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?php echo $usuario['nome']; ?>">

                <label for="sobrenome">Sobrenome:</label>
                <input type="text" id="sobrenome" name="sobrenome" value="<?php echo $usuario['sobrenome']; ?>">

                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" value="<?php echo $usuario['email']; ?>">

                <label for="data_nascimento">Data de Nascimento:</label>
                <input type="date" id="data_nascimento" name="data_nascimento" value="<?php echo $usuario['data_nascimento']; ?>">

                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" name="telefone" maxlength="15" value="<?php echo isset($usuario['telefone']) ? $usuario['telefone'] : ''; ?>">

                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" maxlength="14" value="<?php echo isset($usuario['cpf']) ? $usuario['cpf'] : ''; ?>">

                <label for="endereco">Endereço:</label>
                <input type="text" id="endereco" name="endereco" value="<?php echo isset($usuario['endereco']) ? $usuario['endereco'] : ''; ?>">

                <label for="cep">CEP:</label>
                <input type="text" id="cep" name="cep" maxlength="10" value="<?php echo isset($usuario['cep']) ? $usuario['cep'] : ''; ?>">

                <label for="interesses">Interesses Esportivos:</label>
                <input type="text" id="interesses" name="interesses" maxlength="255" value="<?php echo isset($usuario['interesses']) ? $usuario['interesses'] : ''; ?>">

                <label for="senhaAtual">Senha Atual:</label>
                <input type="password" id="senhaAtual" name="senhaAtual">

                <label for="senhaNova">Nova Senha:</label>
                <input type="password" id="senhaNova" name="senhaNova">

                <label for="confirmarSenha">Confirmar Nova Senha:</label>
                <input type="password" id="confirmarSenha" name="confirmarSenha">
                
                <input type="submit" value="Salvar Alterações">
            </form>
            <?php
        } else {
            echo "Usuário não encontrado!";
        }

        // fechar a conexão
        $conexao->close();
        ?>
        <p><a href="perfil.php">Voltar para o Perfil</a></p>
    </div>
</body>
</html>
