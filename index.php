<?php
header('Content-Type: text/html; charset=utf-8');
// inicia a sessão para gerenciar dados do usuário durante a navegação
session_start();

// faz a conexao com o banco
include './controller/conexao.php';

// gerar o perfil do user a partir do id
function geraPerfil()
{
    // recupera o id e cria uma query para resgatar o user com tal id

    $id = $_SESSION['id'];
    $sql = 'SELECT * FROM usuarios WHERE id = ' . $id;
    $stmt = FabricaConexao::Conexao()->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_CLASS);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./view/css/general.css" />
    <link rel="stylesheet" href="./view/css/footer.css" />
    <script src="https://kit.fontawesome.com/b4d8cbf4fd.js" crossorigin="anonymous"></script>
    <script src="./view/js/app.js" defer></script>
    <!-- Arquivo principal - landing page-->
    <title>Sportsync - SportSync</title>
</head>

<body class="inter">
    <header>
        <ul class="header">
            <li class="logo jockey-one-regular"><a href="index.php">SPORTSYNC</a></li>
            <li><a href="index.php">Home</a></li>
            <li><a href="./view/ranking.php">Ranking</a></li>
            <li><a href="./view/planos.php">Planos</a></li>
            <li><a href="./view/parceiros.php">Parceiros</a></li>

            <!-- Verificando se o usuário está mesmo logado-->
            <?php
            if (!isset($_SESSION['usuario'])) {
                // se não está: exibe o cadastrar e o login
                echo '<li><a href="./view/cadastro_usuario.php">Cadastrar</a></li>';
                echo '<li class="login"><a href="./view/login.php">Login</a></li>';
            } else if ($_SESSION['usuario'] != "") {
                // se está: chama a função para criar o perfil do user
                $linhas = geraPerfil();
                foreach ($linhas as $linha) {
                    echo "<li><b><a href='./view/perfil.php'>" . $linha->nome . "</a></b></li>";
                }
            }
            ?>

        </ul>
        <!-- Menu responsivo -->
        <ul class="mheader">
            <li class="logo jockey-one-regular"><a href="#">SPORTSYNC</a></li>
        </ul>
        <img onclick="menu()" class="dropbtn menu" src="./view/assets/bars-solid.svg" alt="Menu">
        <div id="dropdown" class="dropdown-content">
            <a href="index.php">Home</a>
            <a href="./view/ranking.php">Ranking</a>
            <a href="./view/planos.php">Planos</a>
            <a href="./view/parceiros.php">Parceiros</a>

            <!-- mesma validação do usuário -->
            <?php
            if (!isset($_SESSION['usuario'])) {
                echo '<a href="./view/cadastro_usuario.php">Cadastrar</a>';
                echo '<a href="./view/login.php">Login</a>';
            } else if ($_SESSION['usuario'] != "") {
                $linhas = geraPerfil();
                foreach ($linhas as $linha) {
                    echo '<a href="./view/perfil.php"><b>' . $linha->nome . '</b></a>';
                }
            }
            ?>

        </div>
    </header>

    <div class="banner-section">
        <div class="title">
            Descubra uma nova forma de ajudar! Conheça nosso site, onde cada compra gera
            <span id="destaque1">impacto.</span>
            <button id="button-conheca"><a href="./view/servicos.php">Saiba mais</a></button>
        </div>
        <div>
            <img src="./view/assets/homem.png" id="bolaImg" alt="Homem chutando bola">
        </div>
    </div>

    <div class="section-box-text">
        <div class="box-text">
            Imagine um lugar onde cada compra <br>contribui para o futuro do esporte.
            Acumule pontos, <span id="destaque2">ganhe descontos</span> e
            ajude a transformar vidas.
        </div>
    </div>

    <div class="section-ranking">
        <img src="./view/assets/fundo-ranking.png" alt="Imagem de Fundo">
        <div class="text-section-ranking">
            <div class="text-container">
                <span>Descubra os jovens<br> talentos que você pode<br> impulsionar</span>
                <button class="action-btn"><a href="./view/ranking.php">Apoie e Ganhe</a></button>
            </div>
        </div>
    </div>

    <section class="plano-sessao">
        <div class="texto-central">
            <h1>Experimente fazer a diferença</h1>
            <p>Faça parte do time <span>SportSync</span> e gere impacto com o seu valor.</p>
        </div>

        <div class="cards-container">
            <div class="card">
                <img src="./view/assets/volleyball.svg" alt="Icon do Plano Esportista" class="icon">
                <h2>PLANO ESPORTISTA</h2>
                <hr>
                <ul class="beneficios">
                    <li>Descontos em compras: De 10% à 15%</li>
                    <li>Multiplicador de pontos: 0.6x</li>
                    <li>Valor mensal: R$19,90</li>
                    <li>Valor anual: R$199,90</li>
                </ul>
                <hr>
                <form action="" method="POST">
                    <button value="3">Seja sócio por R$19,90</button>
                </form>
                <p id="anualmente">Ou pague R$199,90 anualmente</p>
                <p id="termos">Leia os <span id="destaque3">Termos de compra</span> ao adquirir o plano.</p>
            </div>

            <div class="card">
                <img src="./view/assets/bicycle.svg" alt="Icon do Plano Atleta" class="icon">
                <h2>PLANO ATLETA</h2>
                <hr>
                <ul class="beneficios">
                    <li>Descontos em compras: De 20% à 30%</li>
                    <li>Multiplicador de pontos: 0.8x</li>
                    <li>Valor mensal: R$24,90</li>
                    <li>Valor anual: R$249,90</li>
                </ul>
                <hr>
                <form action="" method="POST">
                    <button value="2">Seja sócio por R$24,90</button>
                </form>
                <p id="anualmente">Ou pague R$249,90 anualmente</p>
                <p id="termos">Leia os <span id="destaque3">Termos de compra</span> ao adquirir o plano.</p>
            </div>

        </div>
    </section>
    
    <footer>
        <div class="box-footer">
            <div class="footer-column">
                <h3>Organização</h3>
                <ul>
                    <li><a href="./view/politicas.php"><span id="destaque-f">Política de Privacidade</span></a></li>
                    <li><a href="./view/diretrizes.php">Diretrizes da comunidade</a></li>
                    <li><a href="./view/contato.php">Fale conosco</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Recursos</h3>
                <ul>
                    <li><a href="./view/servicos.php">Serviços</a></li>
                    <li><a href="./view/planos.php">Seja um sócio</a></li>
                    <li><a href="./view/parceiros.php">Parceiros</a></li>
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
        <?php include('./view/css/style.css'); ?>
        <?php include('./view/css/responsividade.css'); ?>
        <?php include('./view/css/header.css'); ?>
        <?php include('./view/css/planos.css'); ?>
    </style>
</body>

</html>