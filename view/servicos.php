<?php 
session_start();
require_once '../controller/conexao.php';


// funcao que pega o id do usuario
function geraPerfil()
{
    $id = $_SESSION['id'];
    // Interpolação de strings
    $sql = 'SELECT * FROM usuarios WHERE id = ' . $id;
    $stmt = FabricaConexao::Conexao()->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_CLASS);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/header.css" />
    <link rel="stylesheet" href="./css/general.css" />
    <link rel="stylesheet" href="./css/footer.css" />
    <link rel="stylesheet" href="./css/responsividade.css" />
    <link rel="stylesheet" href="./css/servicos.css" />
    <script src="./js/app.js" defer></script>
    <!-- Kit do fontawesome para ícones -->
    <script src="https://kit.fontawesome.com/b4d8cbf4fd.js" crossorigin="anonymous"></script>
    <title>SportSync - Serviços</title>
</head>
<body class="inter">
<header>
<ul class="header">
            <li class="logo jockey-one-regular"><a href="../index.php">SPORTSYNC</a></li>
            <li><a href="../index.php">Home</a></li>
            <li><a href="ranking.php">Ranking</a></li>
            <li><a href="planos.php">Planos</a></li>
            <li><a href="parceiros.php">Parceiros</a></li>
            <?php

            // verificando se está logado
            if(!isset($_SESSION['usuario']))
                {
                echo "<li><a href='cadastro_usuario.php'>Cadastrar</a></li>";
                echo "<li class='login'><a href='login.php'>Login</a></li>";
                }
                else {
                if ($_SESSION['usuario'] == null || $_SESSION['usuario'] == false) {
                    echo "<li><a href='cadastro_usuario.php'>Cadastrar</a></li>";
                    echo "<li class='login'><a href='login.php'>Login</a></li>";
                } else {
                    $linhas = geraPerfil();
                    foreach ($linhas as $linha) {
                    echo "<li><b><a href='perfil.php'>" . $linha->nome . "</a></b></li>";
                    }
                }
            }
            ?>
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
            <?php

            // verificando se está logado
            if(!isset($_SESSION['usuario']))
                {
                echo "<li><a href='cadastro_usuario.php'>Cadastrar</a></li>";
                echo "<li class='login'><a href='login.php'>Login</a></li>";
                }
                else {
                if ($_SESSION['usuario'] == null || $_SESSION['usuario'] == false) {
                    echo "<li><a href='cadastro_usuario.php'>Cadastrar</a></li>";
                    echo "<li class='login'><a href='login.php'>Login</a></li>";
                } else {
                    $linhas = geraPerfil();
                    foreach ($linhas as $linha) {
                    echo "<li><b><a href='perfil.php'>" . $linha->nome . "</a></b></li>";
                    }
                }
            }
            ?>
        </div>
    </header>


    <h1 class="titulo">Nossos Serviços</h1>
    <main class="servico-container">
        <div class="servico-box">
            <img src="./assets/hiking.svg" alt="Icon 1">
            <div class="servico-divider"></div>
            <h3>Acúmulo e Resgate de Pontos</h3>
            <p>Acumule pontos a cada compra realizada nas lojas esportivas e troque por descontos ou doe para apoiar o esporte.</p>
            <p><span>Benefícios:</span>Economia e Apoio</p>
        </div>
            
        <div class="servico-box">
            <img src="./assets/medal.svg" alt="Icon 2">
            <div class="servico-divider"></div>
            <h3>Validação de Notas Fiscais</h3>
            <p>Valide as suas compras feitas em lojas esportivas para receber os seus pontos, ao cadastrar a sua nota fiscal.</p>
            <p><span>Benefícios:</span>Confiança e Transparência</p>
        </div>
        
        <div class="servico-box">
            <img src="./assets/football.svg" alt="Icon 3">
            <div class="servico-divider"></div>
            <h3>Cupons de Desconto</h3>
            <p>Após atingir o número de pontos acumulados, poderá receber cupons de descontos para novas compras.</p>
            <p><span>Benefícios:</span>Descontos exclusivos</p>
        </div>
        <div class="servico-box">
            <img src="./assets/ball.svg" alt="Icon 4">
            <div class="servico-divider"></div>
            <h3>Programa de Sócios</h3>
            <p>Ao adquirir um dos planos, receberá benefícios exclusivos, como multiplicador de pontos e aumento de desconto.</p>
            <p><span>Benefícios:</span>Experiência e Privilégio</p>
        </div>
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
        <?php include('./css/servicos.css'); ?>
        <?php include('./css/footer.css'); ?>
        <?php include('./css/responsividade.css'); ?>
    </style>
    
</body>
</html>