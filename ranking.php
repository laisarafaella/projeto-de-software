<?php
$arquivo_json = 'ranking.json';

if (file_exists($arquivo_json)) {
    $json_data = file_get_contents($arquivo_json);

    $atletas = json_decode($json_data, true);
} else {
    die('Arquivo JSON não encontrado.');
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <title>Ranking de Necessidade</title>
    
    <style>
        body {
                margin: 0;
                padding: 0;
                font-family: "Inter", sans-serif;
                /*min-height: 100vh;*/
                background-color: #007EA7;
                color: white;
            }

        * {
                padding: 0;
                margin: 0;
        }

        #logo {
                font-weight: bold;
                color: black;
                font-size: 20px;
                display: inline;
                margin-bottom: -100px;
                font-family: "Jockey One", sans-serif;
            }

        #icon-menu img {
                height: 80px;
                display: none;
                margin-left: 5%;
                margin-top: 15px;
            }

        .close-menu {
                color: black;
                font-size: 40px;
                margin-left: 10%;
                margin-top: 20px;
            }
        nav.cabeçalho {
                display: flex;
                justify-content: space-around;
                font-size: 22px;
                margin: 0 auto;
                width: 95%;
                border-bottom: solid 1px rgba(255, 255, 255, 0.2);
                left: 5%;
            }

        nav.cabeçalho ul li a {
                color: black;
                text-decoration: none;
                cursor: pointer;
                font-weight: 400;
                margin-left: 55px;
                position: relative;
            }

        nav.cabeçalho ul li a:after {
                position: absolute;
                bottom: -2px;
                left: 50%;
                transform: translateX(-50%);
                width: 0%;
                content: '.';
                color: transparent;
                background: black;
                height: 1px;
                transition: width 0.4s ease-in-out;
            }

        nav.cabeçalho ul li a:hover {
                color: black;
                z-index: 1;
            }

        nav.cabeçalho ul li a:hover:after {
                z-index: -10;
                opacity: 1;
                width: 100%;
            }

        /*inicio nav links*/
        .nav-links {
                display: flex;
                padding-top: 5rem;
                background: rgb(0, 62, 146, 0.2); 
                backdrop-filter: blur(50px);
                margin-top: -75px;
                height: 100vh;
                display: none;
                position: fixed;
                z-index: 1;
            }

        .nav-links ul {
                display: flex;
                flex-direction: column;
                margin-left: 45%;
            }

        .nav-links ul li {
                line-height: 4.0em;
                cursor: pointer;
                color: white;
            }

        .nav-links ul li a{
                font-size: 30px;
            }

        .nav-links ul li button {
                font-size: 15px;
                color: white;
                background: rgb(0, 62, 146, 0.2); 
                backdrop-filter: blur(10px);
                padding: 15px 40px;
            }

        .nav-links ul li:hover {
                color: #B6B6B6;
                transition: 0.4s;
            }
            
        /*final nav links*/
        ul {
                list-style: none;
                display: flex;
                justify-content: space-around;
                padding-top: 20px;
            }

        .login {
                background-color: #022346;
                border: 1px solid rgba(255, 255, 255, 0.30);
                color: black;
                padding: 5px 20px;
                cursor: pointer;
        }

        #button-login{
                border: solid 1px #01448B;
                padding: 5px 12px;
                color: #022346;
            }

        #button-login:hover{
                transform: scale(1.2);
            }

        .title-cards {
            text-align: center;
            margin-top: 40px;
            color: white;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .card-container {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-around;
            }

        .card {
            background-color: #ffffff;
            color: black;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);

            padding: 20px;
            margin: 20px;
            flex: 0 0 calc(33.333% - 40px);
            box-sizing: border-box;
            
            display: flex;
            flex-direction: column;
            align-items: center;
            }

        .card:hover {
            transform: translateY(-10px);
            }

        .card img {
                border-radius: 50%;
                width: 150px;
                height: 150px;
                object-fit: cover;
                margin-bottom: 20px;
            }

        .card h2 {
                margin: 10px 0;
                font-size: 24px;
                color: #003E92;
            }

        .card p {
                font-size: 18px;
                margin: 5px 0;
                text-align: center;
            }

        .card button {
                text-decoration: none;
                border: none;
                padding: 10px 20px;
                margin-top: 15px;
                color: white;
                background-color: #003E92;
                border-radius: 15px;
                font-family: "League Spartan", sans-serif;
                font-size: 15px;
                font-weight: bold;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

        .card button:hover {
            background-color: #002645;
            }

        /*.back-link {
                display: block;
                text-align: center;
                margin-top: 50px;
                text-decoration: none;
                color: #003E92;
                font-size: 20px;
            }

        .back-link:hover{
                text-decoration: underline;
            }*/
            

        #nav-links {
                    display: none;
                }

        @media (max-width: 1025px){
                .section-conheça {
                    grid-template-columns: 1fr;
                    margin-left: 5%;
                    margin-right: 5%;
                    text-align: center;
                    margin-top: 2%;
                }
                .text-conheça{
                    margin: 0 auto;
                    font-size: 30px;
                    width: 55%;
                }
                #button-conheça{
                    margin: 0 auto;
                    margin-bottom: 20px;
                }

                }
        @media (max-width: 995px) {
                    nav.cabeçalho {
                    display: none;
                }
                #icon-menu img {
                    display: block;
                }
                .nav-links{
                    width: 100%;
                }
                    }
        #logo {
                color: black;
                margin: 0 auto;
                font-size: 40px;
            }
        .section-box-text {
                margin-bottom: 10%;
            }
        .box-text {
                width: 70%;
                font-size: 30px;
                max-width: 500px;
                margin: 10% auto;
            }
        footer {
                flex-wrap: wrap;
                width: 100%;
            }
        .box-footer {
                flex-direction: column;
                flex-wrap: wrap;
                margin: 0 auto;
                display: flex;
                align-items: center;
            }
        .pesquisa,
        .conteudo,
        .conteudo1 {
                margin: 0 auto;
                margin-bottom: 15%;
            }
        @media (max-width: 768px){
                    .section-conheça {
                    grid-template-columns: 1fr;
                    margin-left: 5%;
                    margin-right: 5%;
                    text-align: center;
                    margin-top: 2%;
                }
                    .text-conheça {
                        width: 45%;
                        font-size: 35px;
                        margin-bottom: 20px;
                        flex-wrap: wrap;
                        margin: 0 auto; 
                    }
                    #button-conheça{
                        margin: 0 auto;
                        margin-bottom: 20px;
                    }
                    .img img{
                        width: 300px;
                        display: inline-block;
                        margin: auto
                    }
                    }
        /*footer*/
        footer {
            margin-top: 200px;
            background-color: white;
            color: black;
            padding: 20px 0;
            display: flex;
            align-items: center;
        }
        footer a {
            color: white;
            text-decoration: none;
        }
        footer a:hover {
            text-decoration: underline;
        }

        .box-footer {
                    width: 80%;
                    display: flex;
                    justify-content: space-between;
                    flex-direction: row;
        }

        .conteudo1,
        .conteudo {
                    font-weight: bold;
                    font-size: 20px;
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
                    outline: none;
        }

        .botao-pesquisa {
                    background-color: #003E92;
                    border: none;
                    padding: 10px;
                    border-radius: 0 5px 5px 0;
                    cursor: pointer;
                    color: white;
                    font-size: 12px;
                    font-weight: 600;
        }

        .botao-pesquisa:hover {
                    background-color: #0056b3;
                    color: black;
        }

    </style>
</head>
<body>
<div class="icon-menu" id="icon-menu">
        <img src="assets/icon-menu (2).png" alt="">
    </div>
    <nav class="cabeçalho">
        <ul>
            <li>
                <span id="logo">SPORTSYNC</span>
            </li>
            <li>
                <a style="text-decoration: none;" href="index.php">Home</a>
            </li>
            <li>
                <a style="text-decoration: none;">Sobre</a>
            </li>
            <li>
                <a style="text-decoration: none;">Contato</a>
            </li>
            <li>
                <a style="text-decoration: none;">Programas</a>
            </li>
            <li>
                <a  style="text-decoration: none;" href="registro.php">Criar conta</a>
            </li>
            <li>
                <a  style="text-decoration: none;" href="ranking.php">Ranking</a>
            </li>
            <li>
                <a id="button-login" style="text-decoration: none;" href="registro.php">Login</a>
            </li>
        </ul>
        </div>
    </nav>
    <div class="nav-links" id="nav-links">
        <div class="close-menu" id="close-menu">
            <span>x</span>
        </div>
        <ul>
            <li style="margin-right: 20px; font-size: 25px; ">
                <a style="text-decoration: none;" id="logo">SPORTSYNC.</a>
            </li>
            <li>
                <a style="text-decoration: none;" href="{{ route('home') }}" id="nav-links-home">Home</a>
            </li>
            <li>
                <a style="text-decoration: none;">Sobre</a>
            </li>
            <li>
                <a style="text-decoration: none;">Contato</a>
            </li>
            <li>
                <a style="text-decoration: none;">Programas</a>
            </li>
            <li>
                <button class="login">Login</button>
            </li>
            <li>
                <a  style="text-decoration: none;" href="registro.php">Criar conta</a>
            </li>
        </ul>
    </div>
    </div>
    <div class="container">
        <h1 class="title-cards">Ranking de Atletas e Instituições Mais Necessitados</h1>
        <div class="card-container">
            <?php
            foreach ($atletas as $atleta) {
                echo '<div class="card">';
                echo '<img src="' . $atleta['foto'] . '">';
                echo '<h2>' . $atleta['nome'] . '</h2>';
                echo '<p>Categoria: ' . $atleta['categoria'] . '</p>';
                echo '<p>Necessidade: ' . $atleta['necessidade'] . '</p>';
                echo '<a href="saiba_mais_ranking.php?id=' . $atleta['id'] . '"><button>Saiba mais</button></a>';
                echo '</div>';
            }
            ?>
        </div>
        
    </div>
    <footer>
        <div class="box-footer">
            <div class="logo"></div>
            <div class="conteudo1">
                Política de privacidade <br> Diretrizes da comunidade
            </div>
            <div class="conteudo">
                Serviços<br> Seja um colaborador
            </div>
            <div class="pesquisa">
                <h3>Fique por dentro</h3>
                <div class="barra-pesquisa">
                    <input type="text" class="campo-pesquisa" placeholder="Pesquisar...">
                    <button type="submit" class="botao-pesquisa">Pesquisar</button>
                </div>
            </div>
        </div>
    </footer>
    <script>
        const iconmenu = document.getElementById("icon-menu");
        const navlinks = document.getElementById("nav-links");
        const closemenu = document.getElementById("close-menu")

        iconmenu.addEventListener('click', function() {
            if (navlinks.style.display === 'none') {
                navlinks.style.display = 'block';
            } else {
                navlinks.style.display = 'none';
            }
        });
        closemenu.addEventListener('click', function() {
            navlinks.style.display = 'none';
        });
    </script>
