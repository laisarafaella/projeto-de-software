<?php 
session_start();
require_once '../controller/conexao.php';
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
    <link rel="stylesheet" href="./css/ranking.css" />
    <script src="./js/app.js" defer></script>
    <!-- Kit do fontawesome para ícones -->
    <script src="https://kit.fontawesome.com/b4d8cbf4fd.js" crossorigin="anonymous"></script>
    <title>SportSync - Ranking</title>
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


    <h1 class="titulo">Ranking de Atletas e Instituições <br>Mais Necessitados</h1>
    <main class="ranking-container">
        <div class="ranking-box">
            <img src="./assets/atleta2.png" alt="Atleta 1">
            <h3>Paulo Victor</h3>
            <p><span>Categoria: </span>Tênis</p>
            <p><span>Necessidade: </span>Equipamentos</p>
            <div class="button-container">
                <button><a href="detalhesPaulo.php">Mais detalhes</a></button>
            </div>
        </div>
            
        <div class="ranking-box-big">
            <img src="./assets/atleta.png" alt="Atleta 2">
            <h3>Sofia Pomes</h3>
            <p><span>Categoria: </span>Atletismo</p>
            <p><span>Necessidade: </span>Suporte</p>
            <div class="button-container">
                <button><a href="detalhesSofia.php">Mais detalhes</a></button>
            </div>
        </div>
        
        <div class="ranking-box">
            <img src="./assets/atleta3.png" alt="Atleta 3">
            <h3>Gabriella Navarro</h3>
            <p><span>Categoria: </span>Basquete</p>
            <p><span>Necessidade: </span>Financeira</p>
            <div class="button-container">
                <button><a href="detalhesGabriella.php">Mais detalhes</a></button>
            </div>
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
                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
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
        <?php include('./css/ranking.css'); ?>
        <?php include('./css/footer.css'); ?>
        <?php include('./css/responsividade.css'); ?>
    </style>
</body>
</html>
