<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include_once '../controller/DAOUsuario.php';
include_once '../controller/conexao.php';
function geraPerfil()
{
    $id = $_SESSION['id'];
    // Interpolação de strings
    $sql = 'SELECT * FROM usuarios WHERE id = ' . $id;
    $stmt = FabricaConexao::Conexao()->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_CLASS);
}

$valores = array(200, 300, 450, 520, 700, 800);
$desconto = "";

switch ($_SESSION['idCupom']) {
    case 1:
        $desconto = "5%";
        break;
    case 2:
        $desconto = "7%";
        break;
    case 3:
        $desconto = "10%";
        break;
    case 4:
        $desconto = "15%";
        break;
    case 5:
        $desconto = "20%";
        break;
    case 6:
        $desconto = "30%";
        break;
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
    <title>SportSync - Cupom</title>
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
    <?php
    foreach ($linhas as $linha) ?>
    <div class="tituloPag">
        <div class="coisarandom"></div>Sucesso!
    </div>

    <main class="main-cupom">
        <section class="cupom-container">
            <div class="cimaCupom">
                <div class="containerCupom">
                    <div class="voucher">
                        <div class="dotted">
                            <div class="elipse"></div>
                        </div>
                        <div class="content">
                            <div class="discount"><?php echo $desconto ?> </div>
                            <div class="discount-info">de desconto</div>
                            <div class="description">em lojas parceiras</div>
                            <div class="info-points">
                                <div class="tape">Use <?php echo $valores[$_SESSION['idCupom'] - 1] ?> pontos para esse voucher.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cupom-info">
                    <h2>Aqui está o seu cupom. Aproveite!</h2>
                    <p><?php echo $desconto ?> de desconto em lojas parceiras.</p>
                </div>
            </div>
            <div class="baixoCupom">
                <div class="codigo-container">
                    <input type="text" class="codigo-cupom" value="<?php echo $_SESSION['codigoCupom'] ?>" id="codigocupom" readonly>
                    <button id="copiarcodigo"><img src="./assets/copy.svg" alt="Copiar código"></button>
                    <a href="#" class="problema-link">Problemas com o código?</a>
                </div>
                <div class="btns">
                    <button class="cupom-btn">Gerar novo cupom</button>
                    <button class="cupom-btn"><a href="./meus_cupons.php">Ver meus cupons</a></button>
                </div>
            </div>
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
        <?php include('./css/cupom.css'); ?>
    </style>
    <script>
        document.getElementById('copiarcodigo').addEventListener('click', clipboardCopy);
        async function clipboardCopy() {
            let text = document.querySelector("#codigocupom").value;
            await navigator.clipboard.writeText(text);
        }
    </script>
</body>
</html>