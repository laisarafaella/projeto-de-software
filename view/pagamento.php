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
    <link rel="stylesheet" href="./css/pagamento.css">
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
        <div class="coisarandom"></div>Faça o pagamento do plano escolhido!
    <!-- Cadastre uma forma de pagamento-->
    </div>

    <div class="wrapper">
        <form action="../controller/gera_metodo.php" class="form-container">
            <div class="box-form">
                <div class="input-content">
                    <div class="box-input">
                        <label>Número do Cartão</label>
                        <input autocomplete="off" id="input-number" type="text" name="ncartao" maxlength="19" required style="word-spacing: 8px;" onkeydown="handleNumber(event)">
                        <div class="info">
                            <span class="icon">
                                <img src="./assets/warning.svg" />
                            </span>
                            
                            <span class="message"></span>
                        </div>
                    </div>
                    
                    <div class="box-input">
                        <label>Nome do Titular</label>
                        <input autocomplete="off" id="input-name" type="text" name="titular" required onkeydown="handleName(event)">
                        <div class="info">
                            <span class="icon">
                                <img src="./assets/warning.svg" />
                            </span>
                            
                            <span class="message"></span>
                        </div>
                    </div>
                    
                    <div class="box-input-more">
                        <div class="box-one">
                            <label>Validade</label>
                            <input autocomplete="off" id="input-validate" maxlength="5" type="text" name="validade" required onkeydown="handleValidate(event)">
                            <div class="info">
                                <span class="icon">
                                    <img src="./assets/warning.svg" />
                                </span>
                                
                                <span class="message"></span>
                            </div>
                        </div>
                        
                        <div class="box-two">
                            <label>CVV</label>
                            <input autocomplete="off" id="input-cvv" type="password" maxlength="3" name="cvv" required onkeydown="handleCvv(event)">
                            <div class="info">
                                <span class="icon">
                                    <img src="./assets/warning.svg" />
                                </span>
                                <span class="message"></span>
                            </div>
                        </div>
                    </div>
                    <div class="box-input">
                        <label>Apelido</label>
                        <input autocomplete="off" id="input-number" type="text" name="apelido" maxlength="50" required> 
                    </div>
                </div>
                <div class="card-content animate">                    
                    <div class="card-content-box rotate">
                        <div class="box-card">
                            <div class="content ">
                                <div class="card-header">
                                    <span class="icon"><img src="./assets/payment.svg" /></span>
                                    <span class="icon"><img src="./assets/visa.svg" /></span>
                                </div>
                                
                                <div class="card-body">
                                    <div id="card-user-number" class="number-card">•••• •••• •••• ••••</div>
                                    
                                    <div class="name-and-date">
                                        <div id="card-user-name" class="name">Titular</div>
                                        <div id="card-user-date" class="date">• • / • •</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="box-card">
                            <div class="content card-2">
                                <div class="bar"></div>
                                <div class="cvv">
                                    <div id="card-user-cvv" class="cvv-number"></div>
                                    <div class="cvv-text">CVV</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div id="rotate-card" class="rotate-card" title="Ver a outra parte do cartão">
                        <img src="./assets/rotate.svg" width="20px">
                    </div>
                    
                    <div class="status-security">
                        <span class="icon"><img src="./assets/security.svg" /></span>
                        <span>Dados protegidos!</span>
                    </div>
                </div>
            </div>
            
            <button id="input-submit" type="submit" class="button-submit">Finalizar</button>
        </form>
    </div>

    
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
    </style>
    <script src="./js/pagamento.js"></script>
</body>
</html>