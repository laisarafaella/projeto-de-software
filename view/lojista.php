<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/header.css" />
    <link rel="stylesheet" href="./css/general.css" />
    <link rel="stylesheet" href="./css/footer.css" />
    <link rel="stylesheet" href="./css/responsividade.css" />
    <link rel="stylesheet" href="./css/logista.css">
    <script src="./js/app.js"></script> 
    <!-- Kit do fontawesome para ícones -->
    <script src="https://kit.fontawesome.com/b4d8cbf4fd.js" crossorigin="anonymous"></script>
    <title>SportSync - Logista</title>
</head>
<body class="inter">
    <header>
        <ul class="header">
            <li class="logo jockey-one-regular"><a href="#">SPORTSYNC</a></li>
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
    <div class="tituloPag">
        <div class="coisarandom"></div>Confira o seu cupom!
    </div>



    <main>
        <section class="logista">
            <p>• Informe o código do seu cupom!</p>

            <form method="">
                <label class="inputCapsule3">
                    <div>
                        <input type="text" name="codigoChave" class="inputCodigo" placeholder="Digite o código chave" required>
                    </div>
                    
                </label>
                <button type="submit" name="validar" class="validarBtn">Validar</button>
            </form>
        </section>

        <p>Colocando apenas de enfeite, mas aí validando tem q aparecer: já utilizado ou autorizado - nessa pegada</p>
    </main>
    


    <footer>
        <div class="box-footer">
            <div class="footer-column">
                <h3>Organização</h3>
                <ul>
                    <li><a href="politicas.php"><span id="destaque-f">Política de Privacidade</span></a></li>
                    <li><a href="diretrizes.php">Diretrizes da comunidade</a></li>
                    <li><a href="contato.php">Fale conosco</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Recursos</h3>
                <ul>
                    <li><a href="servicos.php">Serviços</a></li>
                    <li><a href="planos.php">Seja um sócio</a></li>
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
        <?php include('./css/logista.css'); ?>
        <?php include('./css/footer.css'); ?>
        <?php include('./css/responsividade.css'); ?>
        <?php include('./css/general.css'); ?>
    </style> 
</body>
</html> 



