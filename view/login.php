<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/header.css" />
    <link rel="stylesheet" href="./css/general.css" />
    <link rel="stylesheet" href="./css/footer.css" />
    <link rel="stylesheet" href="./css/responsividade.css" />
    <!-- <link rel="stylesheet" href="./css/login.css" /> -->
    <script src="./js/app.js" defer></script>
    <!-- Kit do fontawesome para icones -->
    <script src="https://kit.fontawesome.com/b4d8cbf4fd.js" crossorigin="anonymous"></script>
    <title>Sportsync - Login</title>
</head>

<body class="inter">
    <header>
        <ul class="header">
            <li class="logo jockey-one-regular"><a href="../index.php">SPORTSYNC</a></li>
            <li><a href="../index.php">Home</a></li>
            <li><a href="ranking.php">Ranking</a></li>
            <li><a href="planos.php">Planos</a></li>
            <li><a href="parceiros.php">Parceiros</a></li>
            <li><a href="cadastro_usuario.php">Cadastrar</a></li>
            <li class="login"><a href="login.php">Login</a></li>
        </ul>
        <ul class="mheader">
            <li class="logo jockey-one-regular"><a href="../index.php">SPORTSYNC</a></li>
        </ul>
        <img onclick="menu()" class="dropbtn menu" src="./assets/bars-solid.svg" alt="Menu">
        <div id="dropdown" class="dropdown-content">
            <a href="../index.php">Home</a>
            <a href="ranking.php">Ranking</a>
            <a href="planos.php">Planos</a>
            <a href="parceiros.php">Parceiros</a>
            <a href="cadastro_usuario.php">Cadastrar</a>
            <a href="login.php">Login</a>
        </div>
    </header>

    
    <main class="loginMain-a">
        <div class="tituloPag">
            <div class="coisarandom"></div>Login
        </div>
        <form action="../controller/loga_usuario.php" method="POST" class="formView">
            <label for="email">E-mail:</label>
            <input type="email" name="email" placeholder="" required><br>
            <label for="senha">Senha:</label>
            <input type="password" name="senha" placeholder="" required><br>
            <div class="esqueci">
                <button class="btnEntrar" type="submit">Entrar</button>
                <a href="./recuperar_senha.php" id="esqueci">Esqueci a senha</a>
            </div>
        </form>
    </main>


    <footer>
        <div class="box-footer">
            <div class="footer-column">
                <h3>Organização</h3>
                <ul>
                    <li><a href="#"><span id="destaque-f">Política de Privacidade</span></a></li>
                    <li><a href="#">Diretrizes da comunidade</a></li>
                    <li><a href="#">Fale conosco</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Recursos</h3>
                <ul>
                    <li><a href="servicos.php">Serviços</a></li>
                    <li><a href="#">Seja um sócio</a></li>
                    <li><a href="parceiros.php">Parceiros</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Redes Sociais</h3>
                <div class="social-icons">
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-x"></i></a>
                    <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="#"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>
        </div>
        <hr class="footer-divider">
        <div class="footer-bottom">
            <p>Sportsync © 2024 - Todos os direitos reservados.</p>
        </div>
    </footer>

    <style type="text/css" href="index.css">
        <?php include('./css/header.css'); ?>
        <?php include('./css/login.css'); ?>
        <?php include('./css/footer.css'); ?>
        <?php include('./css/responsividade.css'); ?>
        <?php include('./css/general.css'); ?>
    </style>
</body>

</html>