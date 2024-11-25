<?php
session_start();
require_once '../controller/conexao.php';

// geraPerfil() usa o ID da sessão para buscar informações do usuário no banco
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
  <link rel="stylesheet" href="./css/footer.css" />
  <link rel="stylesheet" href="./css/responsividade.css" />
  <script src="./js/app.js" defer></script>
  <!-- Kit do fontawesome para icones -->
  <script src="https://kit.fontawesome.com/b4d8cbf4fd.js" crossorigin="anonymous"></script>
  <title>Sportsync - Cadastrar NFE</title>
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
      // verificacao se o usuario está logado
      if ($_SESSION['usuario'] == null || $_SESSION['usuario'] == false) {
        header("Location: login.php");
      } else {
        // se estiver, aparecerá o nome do usuario
        $linhas3 = geraPerfil();
        foreach ($linhas3 as $linha3) {
          echo "<li><b><a href='perfil.php'>" . $linha3->nome . "</a></b></li>";
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
        $linhas3 = geraPerfil();
        foreach ($linhas3 as $linha3) {
          echo "<li><b><a href='perfil.php'>" . $linha3->nome . "</a></b></li>";
        }
      }
      ?>
    </div>
  </header>
  <main class="mainNFE">
    <div class="tituloPag">
      <div class="coisarandom"></div>
      Cadastrar uma NF-E
    </div>

    <div class="contNfe">
      <form method="POST" class="NFEForm" action="../controller/cadastraNFE.php">
        <div class="inputs">
          <div class="lado1">
            <div>
              <label for="nfe">Chave de Acesso:</label><br>
              <input type="text" name="chave" class="inputNfe" maxlength="44" required>
            </div>
            <div>
              <label for="cnpj">CNPJ:</label><br>
              <input type="text" name="cnpj" id="cnpj" class="inputNfe" maxlength="14" required>
            </div>
            <div>
              <label for="valor">Valor total:</label><br>
              <input type="text" name="valor" class="inputNfe" required>
            </div>
          </div>
          <div class="lado2">
            <div>
              <label>Nome/Razão Social:</label><br>
              <input type="text" name="razao" class="inputNfe" required>
            </div>
            <div>
              <label>Data de Emissão:</label><br>
              <input type="date" name="data_emissao" class="inputNfe inputDataEmissao" required>
            </div>
            <div>
              <label>Apelido:</label><br>
              <input type="text" name="apelido" class="inputNfe" required>
            </div>
          </div>
        </div>
        <div class="containerBotao">
          <button type="submit" name="cadastrar" class="cadastrarBtn">Cadastrar</button>
        </div>
      </form>
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
    <?php include('./css/cadastro-nfe.css'); ?>
    <?php include('./css/footer.css'); ?>
    <?php include('./css/responsividade.css'); ?>
    <?php include('./css/general.css'); ?>
  </style>
  <script src="./js/validacao.js"></script>
</body>
</html>