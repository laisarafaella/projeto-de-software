<?php
session_start();
require_once '../controller/conexao.php';


// função para obter os dados do perfil do usuário
function geraPerfil()
{
  $id = $_SESSION['id'];
  // Interpolação de strings
  $sql = 'SELECT * FROM usuarios WHERE id = ' . $id;
  $stmt = FabricaConexao::Conexao()->prepare($sql);
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_CLASS);
}


// verifica se a variável de sessão 'planoEscolhido' está setada se estiver remove ela
if(isset($_SESSION['planoEscolhido'])) {
  unset($_SESSION['planoEscolhido']);
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
  <link rel="stylesheet" href="./css/planos.css" />
  <script src="./js/app.js" defer></script>
  <!-- Kit do fontawesome para ícones -->
  <script src="https://kit.fontawesome.com/b4d8cbf4fd.js" crossorigin="anonymous"></script>
  <title>Sportsync - Planos</title>
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
      // mostra opções de cadastro ou login se o usuário não estiver logado
      if (!isset($_SESSION['usuario'])) {
        echo "<li><a href='cadastro_usuario.php'>Cadastrar</a></li>";
        echo "<li class='login'><a href='login.php'>Login</a></li>";
      } else {
        // mostra o nome do usuário logado como link para o perfil
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
      // a mesma verificacao de cima
      if (!isset($_SESSION['usuario'])) {
        echo "<li><a href='cadastro_usuario.php'>Cadastrar</a></li>";
        echo "<li class='login'><a href='login.php'>Login</a></li>";
      } else {
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
    Faça parte do nosso time de sócios!
  </div>
  <div class="container-cards">
    <div class="card">
      <img src="./assets/volleyball.svg" alt="Icon do Plano Esportista" class="icon">
      <h2>PLANO ESPORTISTA</h2>
      <hr>
      <ul class="beneficios">
        <li>Descontos em compras: De 10% à 15%</li>
        <li>Multiplicador de pontos: 0.6x</li>
        <li>Valor mensal: R$19,90</li>
        <li>Valor anual: R$199,90</li>
      </ul>
      <hr>
      <form action="./escolher_metodo.php" method="POST">
        <button value="2" name="idplano">Seja sócio por R$19,90</button>
      </form>
      <p id="anualmente">Ou pague R$199,90 anualmente</p>
      <p id="termos">Leia os <span id="destaque3">Termos de compra</span> ao adquirir o plano.</p>
    </div>
    <div class="card">
      <img src="./assets/bicycle.svg" alt="Icon do Plano Atleta" class="icon">
      <h2>PLANO ATLETA</h2>
      <hr>
      <ul class="beneficios">
        <li>Descontos em compras: De 20% à 30%</li>
        <li>Multiplicador de pontos: 0.8x</li>
        <li>Valor mensal: R$24,90</li>
        <li>Valor anual: R$249,90</li>
      </ul>
      <hr>
      <form action="./escolher_metodo.php" method="POST">
        <button value="3" name="idplano">Seja sócio por R$24,90</button>
      </form>
      <p id="anualmente">Ou pague R$249,90 anualmente</p>
      <p id="termos">Leia os <span id="destaque3">Termos de compra</span> ao adquirir o plano.</p>
    </div>
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
    <?php include('./css/planos.css'); ?>
    <?php include('./css/general.css'); ?>
    <?php include('./css/footer.css'); ?>
    <?php include('./css/responsividade.css'); ?>
  </style>

</body>

</html>