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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./css/header.css" />
  <link rel="stylesheet" href="./css/general.css" />
  <link rel="stylesheet" href="./css/footer.css" />
  <link rel="stylesheet" href="./css/responsividade.css" />
  <link rel="stylesheet" href="./css/detalhes.css" />
  <script src="./js/app.js" defer></script>
  <!-- Kit do fontawesome para ícones -->
  <script src="https://kit.fontawesome.com/b4d8cbf4fd.js" crossorigin="anonymous"></script>
  <title>Sportsync - Detalhes de Sofia Pomes</title>
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

      if(!isset($_SESSION['usuario']))
        {
          echo "<li><a href='cadastro_usuario.php'>Cadastrar</a></li>";
          echo "<li class='login'><a href='login.php'>Login</a></li>";
        }
        else {
          if ($_SESSION['usuario'] == null || $_SESSION['usuario'] == false) {
            echo "<li><a href='cadastro_usuario.php'>Cadastrar</a></li>";
            echo "<li class='login'><a href='login.php'>Login</a></li>";
          } else {
            $linhas = geraPerfil();
            foreach ($linhas as $linha) {
              echo "<li><b><a href='perfil.php'>" . $linha->nome . "</a></b></li>";
              }
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

        if(!isset($_SESSION['usuario']))
            {
            echo "<li><a href='cadastro_usuario.php'>Cadastrar</a></li>";
            echo "<li class='login'><a href='login.php'>Login</a></li>";
            }
            else {
            if ($_SESSION['usuario'] == null || $_SESSION['usuario'] == false) {
                echo "<li><a href='cadastro_usuario.php'>Cadastrar</a></li>";
                echo "<li class='login'><a href='login.php'>Login</a></li>";
            } else {
                $linhas = geraPerfil();
                foreach ($linhas as $linha) {
                echo "<li><b><a href='perfil.php'>" . $linha->nome . "</a></b></li>";
                }
            }
        }
        ?>
      </div>
  </header>
  <div class="tituloPag">
    <div class="coisarandom"></div>
    Mais detalhes de&nbsp;<span id="destaque1">Sofia Pomes</span>
  </div>


  <main class="detalhes-container">
    <div class="coluna-esquerda">
        <img src="./assets/atleta.png" alt="Atleta 1" class="atleta-foto">
        <h2 class="nome-atleta">Sofia Pomes</h2>
        <div class="caixa-biografia">
        Meu sonho é participar das Olimpíadas e representar o país no atletismo. Treino sozinha e, muitas vezes, sinto a falta de suporte adequado, o que dificulta o desenvolvimento e aprimoramento nas competições.
        </div>
    </div>

    <div class="coluna-direita informacoes-detalhadas">
        <p><strong>Categoria:</strong> Atletismo</p>
        <p><strong>Necessidade:</strong> Suporte</p>
        <p><strong>Objetivo:</strong> Recordes pessoais e competições internacionais.</p>

        <h3>Opções de Apoio</h3>
        <button class="doar-button"><a href="doar.php">Doar Agora</a></button>
    </div>
</main>


  <footer>
        <div class="box-footer">
            <div class="footer-column">
                <h3>Organização</h3>
                <ul>
                    <li><a href="#"><span id="destaque-f">Política de Privacidade</span></a></li>
                    <li><a href="#">Diretrizes da comunidade</a></li>
                    <li><a href="contato.php">Fale conosco</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Recursos</h3>
                <ul>
                    <li><a href="servicos.php">Serviços</a></li>
                    <li><a href="#">Seja um sócio</a></li>
                    <li><a href="parceiros.php">Parceiros</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Redes Sociais</h3>
                <div class="social-icons">
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
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
</body>
</html>