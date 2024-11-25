<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include_once '../controller/DAOUsuario.php';
include_once '../controller/conexao.php';

// recupera o perfil do usuário logado
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
    <script src="./js/app.js" defer></script>
    <!-- Kit do fontawesome para ícones -->
    <script src="https://kit.fontawesome.com/b4d8cbf4fd.js" crossorigin="anonymous"></script>
    <title>SportSync - Escolher Cupom</title>
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
            // verificacao do usuário logado
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
            // verificacao do usuário logado
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
    <?php
    foreach ($linhas as $linha) ?>
    <div class="tituloPag">
        <div class="coisarandom"></div>Qual cupom você quer gerar?
    </div>


    <main class="main-cupons">
        <div class="container-cupom">
            <div class="voucher">
                <div class="dotted">
                    <div class="elipse"></div>
                </div>
                <div class="content">
                    <div class="discount">5%</div>
                    <div class="discount-info">de desconto</div>
                    <div class="description">em lojas parceiras</div>
                    <div class="info-points">
                        <div class="tape">Use 200 pontos para esse voucher.</div>
                    </div>
                </div>
            </div>
            <form action="./cupom_gerado.php" method="POST">
                <button class="generate-cupom" name="gerarCupom" value="1">Gerar este cupom</button>
            </form>
        </div>
        <div class="container-cupom">
            <div class="voucher">
                <div class="dotted">
                    <div class="elipse"></div>
                </div>
                <div class="content">
                    <div class="discount">7%</div>
                    <div class="discount-info">de desconto</div>
                    <div class="description">em lojas parceiras</div>
                    <div class="info-points">
                        <div class="tape">Use 300 pontos para esse voucher.</div>
                    </div>
                </div>
            </div>
            <form action="./cupom_gerado.php" method="POST">
                <button class="generate-cupom" name="gerarCupom" value="2">Gerar este cupom</button>
            </form>
        </div>
        <div class="container-cupom">
            <div class="voucher">
                <div class="dotted">
                    <div class="elipse"></div>
                </div>
                <div class="content">
                    <div class="discount">10%</div>
                    <div class="discount-info">de desconto</div>
                    <div class="description">em lojas parceiras</div>
                    <div class="info-points">
                        <div class="tape">Use 450 pontos para esse voucher.</div>
                    </div>
                </div>
            </div>
            <form action="./cupom_gerado.php" method="POST">
                <button class="generate-cupom" name="gerarCupom" value="3">Gerar este cupom</button>
            </form>
        </div>
        <div class="container-cupom">
            <div class="voucher">
                <div class="dotted">
                    <div class="elipse"></div>
                </div>
                <div class="content">
                    <div class="discount">15%</div>
                    <div class="discount-info">de desconto</div>
                    <div class="description">em lojas parceiras</div>
                    <div class="info-points">
                        <div class="tape">Use 520 pontos para esse voucher.</div>
                    </div>
                </div>
            </div>
            <form action="./cupom_gerado.php" method="POST">
                <button class="generate-cupom" name="gerarCupom" value="4">Gerar este cupom</button>
            </form>
        </div>
        <div class="container-cupom">
            <div class="voucher">
                <div class="dotted">
                    <div class="elipse"></div>
                </div>
                <div class="content">
                    <div class="discount">20%</div>
                    <div class="discount-info">de desconto</div>
                    <div class="description">em lojas parceiras</div>
                    <div class="info-points">
                        <div class="tape">Use 700 pontos para esse voucher.</div>
                    </div>
                </div>
            </div>
            <form action="./cupom_gerado.php" method="POST">
                <button class="generate-cupom" name="gerarCupom" value="5">Gerar este cupom</button>
            </form>
        </div>
        <div class="container-cupom">
            <div class="voucher">
                <div class="dotted">
                    <div class="elipse"></div>
                </div>
                <div class="content">
                    <div class="discount">30%</div>
                    <div class="discount-info">de desconto</div>
                    <div class="description">em lojas parceiras</div>
                    <div class="info-points">
                        <div class="tape">Use 800 pontos para esse voucher.</div>
                    </div>
                </div>
            </div>
            <form action="./cupom_gerado.php" method="POST">
                <button class="generate-cupom" name="gerarCupom" value="6">Gerar este cupom</button>
            </form>
        </div>
        <!-- <button class=""><a href="./lojista.php">Lojista</a></button> -->
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
                    <li><a href="planos.php">Seja um colaborador</a></li>
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
        <?php include('./css/responsividade.css'); ?>
        <?php include('./css/gerar_cupom.css'); ?>
    </style>
</body>

</html>