<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz de Preferências Esportivas</title>
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
        form {
            display: flex;
            flex-direction: column;
        }
        label, select, input {
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #007EA7;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #005f73;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Quiz de Preferências Esportivas</h2>
        <form action="salvar_quiz.php" method="POST">
            <label for="preferencia_esporte">Você prefere:</label>
            <select name="preferencia_esporte" id="preferencia_esporte">
                <option value="futebol">Futebol</option>
                <option value="basquete">Basquete</option>
                <option value="volei">Vôlei</option>
                <option value="corrida">Corrida</option>
                <option value="natação">Natação</option>
            </select>
            
            <label for="preferencia_calcado">Você prefere que tipo de calçado:</label>
            <select name="preferencia_calcado" id="preferencia_calcado">
                <option value="tenis">Tênis</option>
                <option value="chuteira">Chuteira</option>
                <option value="sapatenis">Sapatênis</option>
                <option value="bota">Bota</option>
            </select>

            <label for="preferencia_roupa">Você prefere que tipo de roupa:</label>
            <select name="preferencia_roupa" id="preferencia_roupa">
                <option value="camisa">Camisa</option>
                <option value="short">Short</option>
                <option value="calca">Calça</option>
                <option value="jaqueta">Jaqueta</option>
            </select>

            <label for="frequencia_pratica">Com que frequência você pratica esportes:</label>
            <select name="frequencia_pratica" id="frequencia_pratica">
                <option value="diariamente">Diariamente</option>
                <option value="semanalmente">Semanalmente</option>
                <option value="mensalmente">Mensalmente</option>
                <option value="raramente">Raramente</option>
            </select>

            <label for="marca_preferida">Qual sua marca preferida de artigos esportivos:</label>
            <select name="marca_preferida" id="marca_preferida">
                <option value="nike">Nike</option>
                <option value="adidas">Adidas</option>
                <option value="puma">Puma</option>
                <option value="under_armour">Under Armour</option>
            </select>

            <input type="submit" value="Enviar Respostas">
        </form>
    </div>
</body>
</html>
