<?php
session_start();
require_once '../controller/conexao.php';

// recupera o perfil do usuário logado no banco
function geraPerfil()
{
    $id = $_SESSION['id'];
    $sql = 'SELECT * FROM usuarios WHERE id = ' . $id;
    $stmt = FabricaConexao::Conexao()->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_CLASS);
}

// verifica se o plano foi escolhido e armazena na sessão
if(!isset($_SESSION['planoEscolhido'])) {
    // salva o plano enviado via POST
    $_SESSION['planoEscolhido'] = $_POST['idplano'];
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
    <script src="./js/app.js"></script>
    <!-- Kit do fontawesome para ícones -->
    <script src="https://kit.fontawesome.com/b4d8cbf4fd.js" crossorigin="anonymous"></script>
    <title>SportSync - Escolher Método</title>
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
            // verifica se o usuário está logado
            if ($_SESSION['usuario'] == null || $_SESSION['usuario'] == false) {
                header("Location: login.php");
            } else {
                // recupera o perfil e exibe o nome, se estiver logado
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
            // mesma verificacao
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
        <div class="coisarandom"></div>Minhas formas de pagamento
    </div>
    <main class="my-payments">
        <form class="container-cartoes" method="POST" action="./finalizar.php">
            <?php
            // busca os métodos de pagamento do usuário no banco
            $sql = 'SELECT * FROM metodos_pagamento WHERE idUsuario_fk = ' . $_SESSION['id'];
            $stmt = FabricaConexao::Conexao()->prepare($sql);
            $stmt->execute();
            $linhas3 = $stmt->fetchAll(PDO::FETCH_CLASS);

            // loop para exibir cada método de pagamento
            foreach ($linhas3 as $linha) {
                echo '<button class="cartao-botao" value="'. $linha->idMetodo .'" name="metodoescolhido">';
                echo '    <div class="bandeira">';
                // verifica a bandeira do cartão com base no número
                if (substr($linha->numero_cartao,0,1) == '4') {
                    echo '<img src="./assets/visa.svg">'; // visa
                } else if (intval(substr($linha->numero_cartao,0,2)) >= 51 and intval(substr($linha->numero_cartao,0,2)) <= 55) {
                    echo '        <img src="./assets/mastercard.svg">'; // mastercard
                }
                echo '    </div>';
                // exibe detalhes do cartão
                echo '    <div class="conteudo-cartao">';
                echo '        <div class="numero-cartao">**** **** **** '. $linha->ultimos_digitos .'</div>';
                echo '        <div class="titulo-validade">';
                echo '            <div class="titular">'. $linha->titular .'</div>';
                echo '            <div class="validade inter">'. $linha->data_validade .'</div>';
                echo '        </div>';
                echo '    </div>';
                echo '</button>';
            }
            ?>
            <div class="add">
                <a href="./pagamento.php">
                    <button>+</button>
                </a>
            </div>
        </form>
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
        <?php include('./css/detalhes.css'); ?>
        <?php include('./css/footer.css'); ?>
        <?php include('./css/responsividade.css'); ?>
        <?php include('./css/general.css'); ?>
        <?php include('./css/metodos.css'); ?>
    </style>
</body>

</html>