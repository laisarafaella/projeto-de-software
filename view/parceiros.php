<?php 
session_start();
require_once '../controller/conexao.php';


// funcao para retornar o usuario pelo id
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
    <link rel="stylesheet" href="./css/parceiros.css" />
    <script src="./js/app.js" defer></script>
    <!-- Kit do fontawesome para ícones -->
    <script src="https://kit.fontawesome.com/b4d8cbf4fd.js" crossorigin="anonymous"></script>
    <title>SportSync - Parceiros</title>
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
        // verificacao do usuario autenticado
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
        // verificacao do usuario autenticado
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


    <h1 class="titulo">Nossos Parceiros</h1>
    <main class="parceiro-container">
        <div class="parceiro-box">
            <img src="./assets/adidas.png" alt="Empresa 1" class="adesdecesta">
            <h3>Adêsdecesta</h3>
        </div>
            
        <div class="parceiro-box">
            <img src="./assets/centauro.png" alt="Empresa 2" class="semtauro">
            <h3>Sem-tauro</h3>
        </div>
        
        <div class="parceiro-box">
            <img src="./assets/decathlon.png" alt="Empresa 3" class="thlondeca">
            <h3>Thlondeca</h3>
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
        <?php include('./css/parceiros.css'); ?>
        <?php include('./css/footer.css'); ?>
        <?php include('./css/responsividade.css'); ?>
    </style>
    
</body>
</html>