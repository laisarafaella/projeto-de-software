<?php
session_start();
require_once '../controller/conexao.php';



// recuperar o perfil do usuário logado no banco
function geraPerfil()
{
    $id = $_SESSION['id'];
    // Interpolação de strings
    $sql = 'SELECT * FROM usuarios WHERE id = ' . $id;
    $stmt = FabricaConexao::Conexao()->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_CLASS);
}

// verificando se o método de pagamento foi escolhido
if(!isset($_POST['metodoescolhido'])) {
    // redireciona para a página de pagamento caso não tenha sido escolhido um método
   header('Location: pagamento.php');
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
    <script src="https://kit.fontawesome.com/b4d8cbf4fd.js" crossorigin="anonymous"></script>
    <title>Sportsync - Recibo</title>
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
            // verifica se o usuário está logado para realizar tal ação
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
            // faz a mesma verificação do usuário logado
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
        <div class="coisarandom"></div>Meu Recibo
    </div>
    <main class="receipty">
        <div class="ladoA">
            <div class="box">
                <div class="box-header">
                    Recibo
                </div>
                <div class="amount-info">
                    <?php
                    // recupera as infos do plano escolhido no banco
                    $sql = 'SELECT * FROM planos WHERE idPlano = ' . $_SESSION['planoEscolhido'];
                    $stmt = FabricaConexao::Conexao()->prepare($sql);
                    $stmt->execute();
                    $linhas3 = $stmt->fetchAll(PDO::FETCH_CLASS);

                    foreach ($linhas3 as $linha) {
                        // exibe as informações do plano escolhido
                        echo '<span><b>Atualização de plano para:</b><br>';
                        echo '    Plano '. $linha->nome_plano .' - <a href="planos.php">Alterar</a></span><br><br>';
                        echo '<span><b>Total:</b><br>';
                        echo '    R$'. $linha->valor_mensal .'/mês</span><br><br>';
                    }

                    // calcula a próxima data de cobrança - 30dias
                    $date = new DateTime();
                    $date->add(new DateInterval('P30D'));
                    $futureDate = $date->format('d/m/Y');
                    echo '<span><b>Próxima data de cobrança:</b><br>';
                    echo $futureDate . '</span><br><br>';
                    // recupera os últimos dígitos do cartão do método de pagamento escolhido
                    $sql = 'SELECT ultimos_digitos FROM metodos_pagamento WHERE idUsuario_fk = ' . $_SESSION['id'] . ' and idMetodo = ' . $_POST['metodoescolhido'];
                    $stmt = FabricaConexao::Conexao()->prepare($sql);
                    $stmt->execute();
                    $linhas4 = $stmt->fetchAll(PDO::FETCH_CLASS);

                    foreach ($linhas4 as $linha) { 
                        // exibe as infos do método de pagamento escolhido
                        echo '<span><b>Método de pagamento escolhido:</b><br>';
                        echo '    Cartão terminado em ' . $linha->ultimos_digitos . ' - <a href="escolher_metodo.php">Alterar</a></span><br><br>';
                    }
                    
                    // exibe infos sobre a compra
                    echo '<div class="purchase-info">';
                    echo '    <b>Informações:</b>';
                    echo '    <ul>';
                    echo '        <li>Cancele quando quiser. Confira os <a href="#">termos de compra</a>.</li>';
                    echo '        <li>A cobrança será feita a cada 30 dias (mensal).</li>';
                    echo '    </ul>';
                    echo '</div>';

                    ?>
                </div>
                <div class="btn-container">
                   <a href="../controller/gera_finalizacao.php"><button class="btn-finalizar"><b>Finalizar</b></button></a>
                </div>
            </div>
        </div>
        <div class="ladoB">
            <?php
            // exibe os detalhes do plano
            if ($_SESSION['planoEscolhido'] == 2) {
                echo '<div class="card">';
                echo '    <img src="./assets/volleyball.svg" alt="Icon do Plano Esportista" class="icon">';
                echo '    <h2>PLANO ESPORTISTA</h2>';
                echo '    <hr>';
                echo '    <ul class="beneficios">';
                echo '        <li>Descontos em compras: De 10% à 15%</li>';
                echo '        <li>Multiplicador de pontos: 0.6x</li>';
                echo '        <li>Valor mensal: R$19,90</li>';
                echo '        <li>Valor anual: R$199,90</li>';
                echo '    </ul>';
                echo '    <hr>';
                echo '    <button>Seja sócio por R$19,90</button>';
                echo '    <p id="anualmente">Ou pague R$199,90 anualmente</p>';
                echo '    <p id="termos">Leia os <span id="destaque3">Termos de compra</span> ao adquirir o plano.</p>';
                echo '</div>';
            } else if ($_SESSION['planoEscolhido'] == 3) {
                echo '<div class="card">';
                echo '    <img src="./assets/bicycle.svg" alt="Icon do Plano Atleta" class="icon">';
                echo '    <h2>PLANO ATLETA</h2>';
                echo '    <hr>';
                echo '    <ul class="beneficios">';
                echo '        <li>Descontos em compras: De 20% à 30%</li>';
                echo '        <li>Multiplicador de pontos: 0.8x</li>';
                echo '        <li>Valor mensal: R$24,90</li>';
                echo '        <li>Valor anual: R$249,90</li>';
                echo '    </ul>';
                echo '    <hr>';
                echo '    <button>Seja sócio por R$24,90</button>';
                echo '    <p id="anualmente">Ou pague R$249,90 anualmente</p>';
                echo '    <p id="termos">Leia os <span id="destaque3">Termos de compra</span> ao adquirir o plano.</p>';
                echo '</div>';
            }
            ?>
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
        <?php include('./css/finalizar.css'); ?>
        <?php include('./css/planos.css'); ?>
    </style>
</body>

</html>