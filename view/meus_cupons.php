<?php 
session_start();
require_once '../controller/conexao.php';

$id = $_SESSION['id'];
// Interpolação de strings
$sql = 'SELECT * FROM cupons WHERE idUsuario_fk = ' . $_SESSION['id'];
$stmt = FabricaConexao::Conexao()->prepare($sql);
$stmt->execute();
$linhas = $stmt->fetchAll(PDO::FETCH_CLASS);

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
    <link rel="stylesheet" href="./css/meus-cupons.css" />
    <script src="./js/app.js"></script>
    <!-- Kit do fontawesome para ícones -->
    <script src="https://kit.fontawesome.com/b4d8cbf4fd.js" crossorigin="anonymous"></script>
    <title>SportSync - Meus Cupons</title>
</head>
<body class="inter">

    <header>
        <ul class="header">
            <li class="logo jockey-one-regular"><a href="#">SPORTSYNC</a></li>
            <li><a href="../index.php">Home</a></li>
            <li><a href="ranking.php">Ranking</a></li>
            <li><a href="planos.php">Planos</a></li>
            <li><a href="parceiros.php">Parceiros</a></li>
            <li><a href="">Não consegui colocar aquele código aq</a></li>
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
        </div>
    </header>
    <div class="tituloPag">
        <div class="coisarandom"></div>Meus cupons gerados!
    </div>
    
    <table border="1" class="container-meusCupons">
        <tr>
            <th>Apelido</th>
            <th>Desconto</th>
            <th>Validade</th>
            <th>Código</th>
        </tr>
    <?php 
        foreach ($linhas as $row) {
            $validade = new DateTime($row->data_expiracao);
            $today = new DateTime();
            $interval = $today->diff($validade);
            $daysRemaining = $interval->format('%a');

            echo "<tr>";
            echo "<td>" . $row->apelido . "</td>";
            echo "<td>" . $row->desconto . "</td>";
            echo "<td>" . $daysRemaining . "</td>";
            echo "<td>" . $row->codigo_cupom . "</td>";
            echo "</tr>";
        }
    ?>
    </table>
    <button class="btnVoltar"><a href="./perfil.php">Voltar</a></button>
    

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
        <?php include('./css/meus-cupons.css'); ?>
        <?php include('./css/footer.css'); ?>
        <?php include('./css/responsividade.css'); ?>
        <?php include('./css/general.css'); ?>
    </style>
</body>
</html>