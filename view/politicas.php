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
  <link rel="stylesheet" href="./css/politicas.css" />
  <script src="./js/app.js" defer></script>
  <!-- Kit do fontawesome para ícones -->
  <script src="https://kit.fontawesome.com/b4d8cbf4fd.js" crossorigin="anonymous"></script>
  <title>Sportsync - Política de Privacidade</title>
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
    <div class="coisarandom"></div>Política de Privacidade
  </div>


    <section class="container-politicas">
        <h2>Política de Privacidade do SportSync</h2>
        <p>
            <strong>1. Introdução</strong><br>
              Bem-vindo ao SportSync. Esta Política de Privacidade explica como coletamos, usamos, armazenamos e protegemos suas informações pessoais quando você utiliza nosso site e serviços. Ao acessar e utilizar o SportSync, você concorda com os termos descritos nesta política.
        </p>
        <p>
            <strong>2. Informações que Coletamos</strong><br>
            <strong>2.1 Informações Pessoais</strong><br>
              Coletamos informações pessoais que você nos fornece diretamente, como nome, e-mail, telefone e endereço, quando você se cadastra em nosso site, faz uma compra ou entra em contato conosco.
        </p>
        <p>
            <strong>2.2 Informações de Navegação</strong><br>
              Coletamos informações sobre sua navegação, incluindo endereços IP, tipo de navegador, páginas visitadas e tempo gasto em cada página. Essas informações ajudam a melhorar a funcionalidade e o desempenho do nosso site.
        </p>
        <p>
            <strong>2.3 Cookies</strong><br>
              Utilizamos cookies para personalizar sua experiência e analisar o uso do nosso site. Você pode configurar seu navegador para recusar cookies, mas isso pode afetar o funcionamento de algumas partes do site.
        </p>
        <p>
            <strong>3. Uso das Informações</strong><br>
              Utilizamos suas informações para:<br>
              - Fornecer e melhorar nossos serviços.<br>
              - Processar transações e gerenciar sua conta.<br>
              - Enviar atualizações e ofertas, se você optou por recebê-las.<br>
              - Responder a perguntas e solicitações.<br>
              - Realizar análises para aprimorar nossa oferta e desempenho.
        </p>
        <p>
            <strong>4. Compartilhamento de Informações</strong><br>
              Não compartilhamos suas informações pessoais com terceiros, exceto:<br>
              - Com prestadores de serviços que auxiliam na operação do site, desde que concordem em manter a confidencialidade.<br>
              - Quando exigido por lei ou para proteger nossos direitos e segurança.
        </p>
        <p>
            <strong>5. Segurança</strong><br>
              Adotamos medidas de segurança para proteger suas informações contra acesso não autorizado e divulgação. No entanto, a segurança absoluta não pode ser garantida.
        </p>
        <p>
            <strong>6. Seus Direitos</strong><br>
              Você pode acessar, corrigir ou excluir suas informações pessoais. Para exercer esses direitos, entre em contato conosco.
        </p>
        <p>
            <strong>7. Alterações na Política</strong><br>
              Podemos atualizar esta política ocasionalmente. Recomendamos revisar esta página periodicamente. A data da última atualização será indicada nesta política.
        </p>
        <p>
            <strong>8. Contato</strong><br>
              Para dúvidas sobre esta Política de Privacidade, entre em contato em:<br>
              E-mail: sportsync@proton.me
        </p>
      </section>

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
        <?php include('./css/politicas.css'); ?>
        <?php include('./css/general.css'); ?>
        <?php include('./css/footer.css'); ?>
        <?php include('./css/responsividade.css'); ?>
    </style>

</body>
</html>