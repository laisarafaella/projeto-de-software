<?php
session_start();
require_once '../controller/conexao.php';

// exibe o histórico de entradas, saídas e o saldo total de pontos 


// recuperar o perfil do usuário logado no banco
function geraPerfil()
{
    $id = $_SESSION['id'];
    // Interpolação de strings
    // consulta para buscar todos os dados do usuário com o id obtido
    $sql = 'SELECT * FROM usuarios WHERE id = ' . $id;

    // prepara e executa a consulta no banco
    $stmt = FabricaConexao::Conexao()->prepare($sql);
    $stmt->execute();
    // retorna os resultados da consulta como um array de objetos
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
            // verifica se o usuário está logado
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
            // mesma verificação do usuário
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
                <?php
                // consulta para buscar todas as entradas (gastos positivos) do usuário
                $sql = 'SELECT gasto FROM extrato WHERE idUsuario_fk = ' . $_SESSION['id'] . ' and tipo_gasto = "pontos" and gasto > 0';
                $stmt = FabricaConexao::Conexao()->prepare($sql);
                $stmt->execute();
                $linhas2 = $stmt->fetchAll(PDO::FETCH_CLASS);

                $sum = 0;

                // soma todos os valores de entrada encontrados
                foreach ($linhas2 as $linha) {
                    $sum += $linha->gasto;
                }

                // exibe o total de pontos ganhos
                echo '<p id="positive">' . $sum . ' Pontos</p>';

                ?>

            </div>

            <div class="card-historico">
                <h3>
                    <span>Saídas</span>
                    <img src="./assets/negative.svg" alt="Saídas Img" />
                </h3>
                <?php
                // consulta para buscar todas as saídas (gastos negativos) do usuário
                $sql = 'SELECT gasto FROM extrato WHERE idUsuario_fk = ' . $_SESSION['id'] . ' and tipo_gasto = "pontos" and gasto < 0';
                $stmt = FabricaConexao::Conexao()->prepare($sql);
                $stmt->execute();
                $linhas2 = $stmt->fetchAll(PDO::FETCH_CLASS);

                $sum = 0;

                // soma todos os valores de saída encontrados
                foreach ($linhas2 as $linha) {
                    $sum += $linha->gasto;
                }

                // exibe o total de pontos gastos (convertendo o valor negativo para positivo)
                echo '<p id="negative">' . $sum * (-1) . ' Pontos</p>';

                ?>
            </div>

            <div class="card-historico card-total">
                <h3>
                    <span>Total</span>
                </h3>
                <?php
                // consulta para buscar o total de pontos do usuário
                $sql = 'SELECT pontos FROM usuarios WHERE id = ' . $_SESSION['id'];
                $stmt = FabricaConexao::Conexao()->prepare($sql);
                $stmt->execute();
                $linhas3 = $stmt->fetchAll(PDO::FETCH_CLASS);

                // exibe o total de pontos
                foreach ($linhas3 as $linha) {
                    echo '<p id="total">' . $linha->pontos . ' Pontos</p>';
                }
                
                ?>
            </div>
        </section>

        <section class="historico">
            <table class="table-historico">
                <thead>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Data</th>
                </thead>
                <?php
                // consulta para buscar todas as transações do usuário
                $sql = 'SELECT * FROM extrato WHERE idUsuario_fk = ' . $_SESSION['id'];
                $stmt = FabricaConexao::Conexao()->prepare($sql);
                $stmt->execute();
                $linhas = $stmt->fetchAll(PDO::FETCH_CLASS);

                // loop para exibir cada transação na tabela
                foreach ($linhas as $linha) {
                    echo "<tr>";
                    echo "<td>" . $linha->nome_extrato . "</td>";

                    // exibe o valor da transação
                    if ($linha->tipo_gasto == 'pontos') {
                        echo "<td>" . intval($linha->gasto) . " pontos</td>";
                    } else {
                        echo "<td>R$" . $linha->gasto . "</td>";
                    }

                    // exibe a data da transação no formato dia - mes - ano
                    echo "<td>" . date('d/m/Y', strtotime($linha->data_acao)) . "</td>";
                    echo "</tr>";
                }

                ?>
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