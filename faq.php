<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - SportSync</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: "Inter", sans-serif;
            background-color: #007EA7;
            color: white;
            margin: 0;
            padding: 0;
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

        .faq-container {
            max-width: 960px;
            margin: 50px auto;
            padding: 20px;
            background-color: #003E92;
            border-radius: 10px;
        }

        h1 {
            text-align: center;
            font-size: 36px;
            margin-bottom: 30px;
        }

        .faq-item {
            margin-bottom: 20px;
        }

        .faq-item h3 {
            font-size: 24px;
            cursor: pointer;
            padding: 10px;
            background-color: #0056b3;
            border-radius: 5px;
        }

        .faq-item p {
            display: none;
            margin-top: 10px;
            padding: 10px;
            background-color: #0068C3;
            border-radius: 5px;
        }

        .faq-item h3:hover {
            background-color: #007EA7;
        }

        .faq-item p.show {
            display: block;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const faqItems = document.querySelectorAll(".faq-item h3");
            faqItems.forEach(item => {
                item.addEventListener("click", function () {
                    const answer = this.nextElementSibling;
                    answer.classList.toggle("show");
                });
            });
        });
    </script>
</head>

<body>

<nav id="cabeçalho">
    <div style="max-width: 960px; margin: 0 auto;">
        <ul style="display: flex; justify-content:space-between; list-style: none;">
            <li style="margin-right: 20px; font-size: 25px ">
                <a style="text-decoration: none;">SPORTSYNC</a>
            </li>
            <li style="margin-right: 20px; margin-top: 20px; ">
                <a style="text-decoration: none;" href="index.php">HOME</a>
            </li>
            <li style="margin-right: 20px; margin-top: 20px; ">
                <a style="text-decoration: none;">SOBRE</a>
            </li>
                
            <li style="margin-right: 20px; margin-top: 20px; ">
                <a style="text-decoration: none;" href="faq.php">FAQ</a>
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

    <div class="faq-container">
        <h1>Perguntas Frequentes</h1>

        <div class="faq-item">
            <h3>Como funciona o sistema de acumulação de pontos?</h3>
            <p>Nosso sistema permite que você acumule pontos em cada compra realizada em sites parceiros como Centauro e Netshoes. Esses pontos podem ser convertidos em descontos em compras futuras ou em frete grátis.</p>
        </div>

        <div class="faq-item">
            <h3>Como posso utilizar meus pontos acumulados?</h3>
            <p>Os pontos acumulados podem ser utilizados nessas mesmas lojas esportivas para obter descontos em equipamentos esportivos ou até mesmo frete grátis. Basta acessar a seção "Pontos" em nosso site e verificar a sua pontuação.</p>
        </div>

        <div class="faq-item">
            <h3>Posso doar meus pontos para jovens atletas ou instituições?</h3>
            <p>Sim! Você pode escolher doar seus pontos acumulados para jovens atletas ou instituições que apoiamos. Isso ajuda a apoiar o esporte e a contribuir para o crescimento de futuros talentos.</p>
        </div>

        <div class="faq-item">
            <h3>Quais são os benefícios de ser um sócio?</h3>
            <p>Os sócios têm acesso a descontos exclusivos, pontuação maior em compras e conteúdos exclusivos. Também é possível escolher entre diferentes categorias de associação, cada uma com seus próprios benefícios.</p>
        </div>

        <div class="faq-item">
            <h3>Como posso conhecer novos estabelecimentos esportivos?</h3>
            <p>Além de compras, nosso site oferece informações sobre diversos estabelecimentos esportivos parceiros, incentivando você a explorar e apoiar o esporte em sua região.</p>
        </div>

    </div>
</body>

</html>
