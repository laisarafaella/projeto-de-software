<!DOCTYPE html>
<html lang="pt-br">

<head>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Site Esportivo </title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
        <style>
            body {
                margin: 0;
                padding: 0;

                font-family: "Inter", sans-serif;
                font-optical-sizing: auto;
                font-style: normal;
                font-variation-settings: "slnt" 0;
                background-color: #007EA7;
            }

            nav li {
                color: white;
                text-decoration: none;
                cursor: pointer;
                font-weight: bold;
            }

            nav {
                border-bottom: 0.1px solid #D3D3D3;
            }


            .texto_img {
                margin-top: 100px;
                display: flex;
                color: white;
                border-left: 0.1px solid #D3D3D3;
                position: relative;
            }

            .texto {
                left: 150px;
                font-size: 40px;
                position: absolute;
                width: 40%;
                text-align: justify;
                font-weight: bold;
            }

            #imagem {
                position: absolute;
                left: 440px;
                top: -110px;
                height: 838px;
            }

            .login {
                background-color: transparent;
                border: 2px solid white;
                color: white;
                padding: 5px 20px;
                cursor: pointer;
                transition: background-color 0.3s, color 0.3s;
            }

            .login:hover {
                background-color: white;
                color: black;
            }

            .contato {
                color: #fff;
            }

            #conheça {
                background-color: transparent;
                border: 2px solid white;
                color: white;
                padding: 10px 30px;
                font-size: 25px;
                cursor: pointer;
                transition: background-color 0.3s, color 0.3s;
            }

            #conheça:hover {
                background-color: white;
                color: black;
            }

            .div_texto {
                margin-left: 160px;
                margin-top: 580px;
            }

            .texto2 {
                font-size: 35px;
                width: 50%;
                text-align: center;
                margin-left: 220px;
                color: #00A8E8;
                font-weight: bold;
            }

            .branco {
                width: 80%;
                padding: 50px;
                background-color: white;
                border-radius: 15px;
            }
            

            .final {
                margin-top: 200px;
                background-color: white;
                color: black;
                padding: 20px 0;
                display: flex;
                align-items: center;
            }

            .conteudo1 {
                padding: 20px;
                font-weight: bold;
                margin-left: 100px;
            }

            .conteudo {
                padding: 20px;
                margin-bottom: 20px;
                font-weight: bold;
            }

            .barra-pesquisa {
                display: flex;
                align-items: center;
                max-width: 300px;
                margin: 20px auto;
            }

            .campo-pesquisa {
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px 0 0 5px;
                /* Borda arredondada à esquerda */
                outline: none;
            }

            .botao-pesquisa {
                background-color: #007bff;
                border: none;
                padding: 10px;
                border-radius: 0 5px 5px 0;
                cursor: pointer;
            }

            .botao-pesquisa:hover {
                background-color: #0056b3;
                color: white;
            }

            .pesquisa {
                margin-left: 300px;
            }

            .container-ranking {
            
            margin: auto;
            width: 70%;
            height: 400px;
    
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;

            color: white;
        }

        .container-ranking h1 {
            font-size: 40px;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .container-ranking a {
            text-decoration: none;
            color: white;
            font-size: 24px;
            background-color: #003E92;
            border-radius: 30px;
            padding: 15px 40px;
            border: none;
            margin-top: 20px;
            transition: transform 0.3s, background-color 0.3s;
        }

        .container-ranking a:hover {
            transform: scale(1.05);
            background-color: #002A5D;
            cursor: pointer;
        }

        .planos-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }

        .plano {
            background-color: #002f7a;
            padding: 20px;
            border-radius: 10px;
            width: 250px;
        }

        .plano h2 {
            background-color: #0056b3;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }

        .plano ul {
            list-style-type: none;
            padding: 0;
        }

        .plano li {
            background-color: #FFFFFF;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
        }

        .plano button {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            background-color: #0056b3;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .plano button:hover {
            background-color: #007EA7;
        }

        </style>
    </head>
</head>

<body>
    <nav id="cabeçalho">
        <div style="max-width: 960px; margin: 0 auto;">
            <ul style="display: flex; justify-content:space-between; list-style: none;">
                <li style="margin-right: 20px; font-size: 25px ">
                    <a style="text-decoration: none;">SPORTSYNC</a>
                </li>
                <li style="margin-right: 20px; margin-top: 20px; ">
                    <a style="text-decoration: none;">HOME</a>
                </li>
                <li style="margin-right: 20px; margin-top: 20px; ">
                    <a style="text-decoration: none;">SOBRE</a>
                </li>
                <li style="margin-top: 20px; ">
                    <a style="text-decoration: none;" class="contato" href="contato.php">CONTATO</a>
                </li>
                <li style="margin-top: 20px; ">
                    <a style="text-decoration: none;">PROGRAMAS</a>
                </li>
                <li style="margin-top: 20px; ">
                    <a style="text-decoration: none;" class="login" href="registro.php">CRIAR CONTA</a>
                </li>
                <li style="margin-top: 20px; ">
                    <a style="text-decoration: none;" class="login" href="perfil.php">PERFIL</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="texto_img">
        <div class="texto">Descubra uma nova forma de ajudar! Conheça nosso site, onde cada compra gera impacto.
            <br><br><button id="conheça">CONHEÇA</button>
        </div>
        <img id="imagem" src="imagem_mulher.png" alt="">
    </div>
    <div class="div_texto">
        <div class="branco">
            <div class="texto2">
                Imagine um lugar onde cada compra é uma chance de mudar o mundo. Aqui, não apenas você encontra produtos
                a sua cara, mas também faz parte de algo maior.
            </div>
        </div>
    </div>

    <div class="container-ranking">
        <div>
            <h1>Conheça nosso <span>ranking</span> de atletas e instituições mais necessitados! E também conheça nossa loja!</h1>
            <a href="ranking.php">Ver Ranking</a>
            <a href="shop.php">Acessar Loja de Pontos</a>
        </div>
    </div>

    <div class="planos-container">
        <?php
            $planos = [
                [
                    "nome" => "Categoria 1",
                    "beneficios" => [
                        "Taxa de adesão única: R$ 5,00",
                        "Descontos: Sim",
                        "Pontuação: x1.5",
                        "Conteúdos exclusivos: Sim",
                        "Valor mensal: R$ 15,00"
                    ]
                ],
                [
                    "nome" => "Categoria 2",
                    "beneficios" => [
                        "Taxa de adesão única: R$ 10,00",
                        "Descontos: Sim",
                        "Pontuação: x2.0",
                        "Conteúdos exclusivos: Sim",
                        "Valor mensal: R$ 30,00"
                    ]
                ]
            ];

            foreach ($planos as $plano) {
                echo "<div class='plano'>";
                echo "<h2>{$plano['nome']}</h2>";
                echo "<ul>";
                foreach ($plano['beneficios'] as $beneficio) {
                    echo "<li>$beneficio</li>";
                }
                echo "</ul>";
                echo "<form action='pagamento.php' method='GET'>";
                echo "<input type='hidden' name='plano' value='{$plano['nome']}'>";
                echo "<button type='submit'>Quero ser sócio</button>";
                echo "</form>";
                echo "</div>";
            }
        ?>
    </div>

    <footer class="final">
        <div class="logo"></div>
        <div class="conteudo1">
            <a href="politicaPrivacidade.php">Política de Privacidade</a>
            <br> Termos de Uso <br> Diretrizes da comunidade
        </div>
        <div class="conteudo">
            Serviços <br> Seja um colaborador
        </div>
        <div class="pesquisa">
            <h3>Fique por dentro</h3>
            <div class="barra-pesquisa">
                <input type="text" class="campo-pesquisa" placeholder="Pesquisar...">
                <button type="submit" class="botao-pesquisa">PESQUISAR
                </button>
            </div>
        </div>
    </footer>


</body>
</html>