<?php 
session_start();
require_once '../controller/conexao.php';

// recupera o perfil do usuário logado no banco
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
  <title>Sportsync - Diretrizes da Comunidade</title>
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
      // verificacao do usuario logado
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
        // verificando se o usuario está logado
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
    <div class="coisarandom"></div>Diretrizes da Comunidade
  </div>


    <section class="container-politicas">
        <h2>Diretrizes da Comunidade do SportSync</h2>
        <p>
            <strong>1. Introdução</strong><br>
            Bem-vindo às Diretrizes da Comunidade do SportSync. Estas diretrizes são destinadas a garantir que todos os usuários tenham uma experiência positiva e respeitosa ao utilizar nossos serviços.
        </p>
        <p>
            <strong>2. Comportamento Esperado</strong><br>
            Esperamos que todos os usuários se comportem de maneira respeitosa e educada. Isso inclui:<br>
              - Respeitar as opiniões e decisões dos outros usuários.<br>
              - Comunicar-se de forma construtiva e educada.<br>
              - Evitar qualquer forma de assédio, discriminação ou discurso de ódio.<br>
              - Seguir todas as leis aplicáveis e regulamentações ao interagir com a plataforma.
        </p>
        <p>
            <strong>3. Proibições</strong><br>
            É proibido:<br>
              - Postar ou compartilhar conteúdo que seja ilegal, ofensivo, difamatório ou prejudicial.<br>
              - Utilizar a plataforma para fins fraudulentos ou enganosos.<br>
              - Violar a privacidade de outros usuários ou coletar informações pessoais sem permissão.<br>
              - Participar de atividades que possam comprometer a segurança ou integridade do sistema.
        </p>
        <p>
            <strong>4. Moderação e Consequências</strong><br>
            Nos reservamos o direito de moderar e remover qualquer conteúdo que viole estas diretrizes. Violações podem resultar em advertências, suspensão temporária ou banimento permanente da plataforma.
        </p>
        <p>
            <strong>5. Denúncias</strong><br>
            Se você encontrar qualquer conteúdo ou comportamento que considere inapropriado, por favor, denuncie-o através das ferramentas disponíveis em nossa plataforma ou entre em contato com nossa equipe de suporte.
        </p>
        <p>
            <strong>6. Alterações nas Diretrizes</strong><br>
            Estas diretrizes podem ser atualizadas periodicamente. Recomendamos revisar esta página regularmente para estar ciente de quaisquer alterações.
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