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
    <link rel="stylesheet" href="./css/extrato.css">
    <script src="./js/app.js"></script>
    <!-- Kit do fontawesome para ícones -->
    <script src="https://kit.fontawesome.com/b4d8cbf4fd.js" crossorigin="anonymous"></script>
    <title>SportSync - Histórico</title>
</head>

<body class="inter">
    <header>
        <ul class="header">
            <li class="logo jockey-one-regular"><a href="#">SPORTSYNC</a></li>
            <li><a href="../index.php">Home</a></li>
            <li><a href="ranking.php">Ranking</a></li>
            <li><a href="planos.php">Planos</a></li>
            <li><a href="parceiros.php">Parceiros</a></li>
            <?php
            if ($_SESSION['usuario'] == null || $_SESSION['usuario'] == false) {
                header("Location: login.php");
            } else {
                $linhas = geraPerfil();
                foreach ($linhas as $linha) {
                    echo "<li><b><a href='perfil.php'>" . $linha->nome . "</a></b></li>";
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
            if ($_SESSION['usuario'] == null || $_SESSION['usuario'] == false) {
                header("Location: login.php");
            } else {
                $linhas = geraPerfil();
                foreach ($linhas as $linha) {
                    echo "<li><b><a href='perfil.php'>" . $linha->nome . "</a></b></li>";
                }
            }
            ?>
        </div>
    </header>
    <div class="tituloPag">
        <div class="coisarandom"></div>Confira o seu histórico!
    </div>


    <main class="container-historico">
        <section>
            <div class="card-historico">
                <h3>
                    <span>Entradas</span>
                    <img src="./assets/positive.svg" alt="Entradas Img" />
                </h3>
                <p id="positive">Pontos</p>
            </div>

            <div class="card-historico">
                <h3>
                    <span>Saídas</span>
                    <img src="./assets/negative.svg" alt="Saídas Img" />
                </h3>
                <p id="negative">Pontos</p>
            </div>

            <div class="card-historico card-total">
                <h3>
                    <span>Total</span>
                </h3>
                <p id="total">Pontos</p>
            </div>
        </section>

        <section class="historico">
            <table class="table-historico">
                <thead>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Data</th>
                </thead>
                <tr>
                    <td>Doou para Sofia Pomes</td>
                    <td>2000 pontos</td>
                    <td>14/11/2024</td>
                </tr>
            </table>
        </section>
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
        <?php include('./css/extrato.css'); ?>
        <?php include('./css/footer.css'); ?>
        <?php include('./css/responsividade.css'); ?>
        <?php include('./css/general.css'); ?>
    </style>
</body>

</html>