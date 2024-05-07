<!DOCTYPE html>
<html lang="pt-br">
<head>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Laravel </title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
        <style>
            body {
                padding: 4px;
                font-family: "Inter", sans-serif;
                font-optical-sizing: auto;
                font-weight: <weight>;
                font-style: normal;
                font-variation-settings: "slnt" 0;
                background-color: #007EA7;
            }
            nav li{
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
                border-left:  0.1px solid #D3D3D3;
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
                border-radius: 5px 0 0 5px; /* Borda arredondada à esquerda */
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
        </style>
    </head>
</head>
<body>
<nav id="cabeçalho">
    <div style="max-width: 960px; margin: 0 auto;">
    <ul style="display: flex; justify-content:space-between; list-style: none;">
        <li style="margin-right: 20px;">
            <a style="text-decoration: none;">HOME</a>
        </li>
        <li style="margin-right: 20px;">
            <a style="text-decoration: none;">SOBRE</a>
        </li>
         <li>
            <a style="text-decoration: none;">CONTATO</a>
        </li>
        <li>
            <a style="text-decoration: none;">PROGRAMAS</a>
        </li>
        <li>
            <!--<button class="login">LOGIN</button>-->
            <a style="text-decoration: none;" class="btnlogin" href="registro.php">LOGIN</a>
        </li>
        </ul>
    </div>
</nav>

<div class="texto_img">
    <div class="texto">Descubra uma nova forma de ajudar! Conheça nosso site, onde cada compra gera impacto.
        <br><br><button id="conheça">CONHEÇA</button>       
    </div>
    <img id="imagem" src="https://s3-alpha-sig.figma.com/img/e99b/513c/f23c08642e74aefe14e44f05b7f5ab82?Expires=1716163200&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&Signature=iFsXSaiY0gROd0h11BDsdpbPErDg8~iE4Dv~cPXILWj0LY6baLGRwaGPI33T47NF1Al3qFEl~wijFwx4sy2R5Vx4JfluLpADn~GCvybh6E-flZhb3KvHiNgLsqngm4XBFuG0p0yhYqaV~I0pOg66B1wyepkesoBYWKIU7AEXqw5HLVD4lA5i1PIn0mn1b~l~PnL-K87xcQSs1FXVM0vDj8zb8OrXsuKR1uOSLoh5JPpLfBG7yP1dVqgJkflhWCq4vu-SiKOgOliKJy7aTKDFc5Xp2qG7TBA76ztyoGe6limArUzEtiBNFLbvdKkLkQ4An194yrgUGiEa4D-adLRLBw__" alt="">
</div>
<div class="div_texto">
    <div class="branco">
        <div class="texto2">
            Imagine um lugar onde cada compra é uma chance de mudar o mundo. Aqui, não apenas você encontra produtos a sua cara, mas também faz parte de algo maior.
        </div>
    </div>
</div>
<header class="final">
        <div class="logo"></div>
        <div class="conteudo1">
        política de privacidade <br> diretrizes da comunidade
        </div>
        <div class="conteudo">
        serviços<br> seja um colaborador
        </div>
        <div class="pesquisa">
            <h3>Fique por dentro</h3>
            <div class="barra-pesquisa">
            <input type="text" class="campo-pesquisa" placeholder="Pesquisar...">
            <button type="submit" class="botao-pesquisa">PESQUISAR
            </button>
        </div>
    </div>
    </header>


</body>
</html>
