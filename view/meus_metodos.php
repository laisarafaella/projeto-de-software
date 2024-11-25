<?php
session_start();
require_once '../controller/conexao.php';

// função que retorna os dados do perfil do usuário logado
function geraPerfil()
{
    // obtém o id do usuário da sessão
    $id = $_SESSION['id'];
    // Interpolação de strings

    // consulta para buscar os dados do usuário pelo id
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
    <script src="./js/app.js"></script>
    <!-- Kit do fontawesome para ícones -->
    <script src="https://kit.fontawesome.com/b4d8cbf4fd.js" crossorigin="anonymous"></script>
    <title>SportSync - Checkout</title>
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
            // verificação de autenticação do usuário
            if ($_SESSION['usuario'] == null || $_SESSION['usuario'] == false) {
                header("Location: login.php");
            } else {
                $linhas = geraPerfil();
                foreach ($linhas as $linha) {
                    // exibe o nome do usuário no header
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
            // mesma verificacao do usuario
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
        <div class="container-cartoes">
            <?php
            // consulta para buscar os métodos de pagamento do usuario
            $sql = 'SELECT * FROM metodos_pagamento WHERE idUsuario_fk = ' . $_SESSION['id'];
            $stmt = FabricaConexao::Conexao()->prepare($sql);
            $stmt->execute();
            // obtém os metodos de pagamento como objetos
            $linhas3 = $stmt->fetchAll(PDO::FETCH_CLASS);

            // itera pelos métodos de pagamento achados
            foreach ($linhas3 as $linha) {
                echo '<div class="cartao">';
                echo '    <div class="bandeira">';

                // determina a bandeira do cartão com base nos números iniciais
                if (substr($linha->numero_cartao,0,1) == '4') {
                    echo '<img src="./assets/visa.svg">';
                } else if (intval(substr($linha->numero_cartao,0,2)) >= 51 and intval(substr($linha->numero_cartao,0,2)) <= 55) {
                    echo '        <img src="./assets/mastercard.svg">';
                }
                echo '    </div>';
                echo '    <div class="conteudo-cartao">';
                // exibe os últimos dígitos do cartão e infos do titular
                echo '        <div class="numero-cartao">**** **** **** '. $linha->ultimos_digitos .'</div>';
                echo '        <div class="titulo-validade">';
                echo '            <div class="titular">'. $linha->titular .'</div>';
                echo '            <div class="validade">'. $linha->data_validade .'</div>';
                echo '        </div>';
                echo '    </div>';
                echo '</div>';
            }
            ?>
            <div class="add">
                <a href="./pagamento.php">
                    <button>+</button>
                </a>
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