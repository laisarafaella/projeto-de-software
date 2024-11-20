<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./css/header.css" />
  <link rel="stylesheet" href="./css/general.css" />
  <link rel="stylesheet" href="./css/footer.css" />
  <link rel="stylesheet" href="./css/responsividade.css" />
  <link rel="stylesheet" href="./css/cadastro.css" />
  <script src="./js/app.js" defer></script>
  <!-- Kit do fontawesome para ícones -->
  <script src="https://kit.fontawesome.com/b4d8cbf4fd.js" crossorigin="anonymous"></script>
  <title>Sportsync - Cadastro</title>
</head>

<body class="inter">
  <header>
    <ul class="header">
      <li class="logo jockey-one-regular"><a href="../index.php">SPORTSYNC</a></li>
      <li><a href="../index.php">Home</a></li>
      <li><a href="ranking.php">Ranking</a></li>
      <li><a href="planos.php">Planos</a></li>
      <li><a href="parceiros.php">Parceiros</a></li>
      <li><a href="cadastro_usuario.php">Cadastrar</a></li>
      <li class="login"><a href="login.php">Login</a></li>
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
      <a href="cadastro_usuario.php">Cadastrar</a>
      <a href="login.php">Login</a>
    </div>
  </header>
  <div class="tituloPag">
    <div class="coisarandom"></div>Cadastre-se
  </div>


  <main>
    <div class="conteudo">
      <form method="POST" class="loginForm" action="../controller/gera_registro.php">
        <div class="form-sections">
          <div class="form-left">
            <label class="inputCapsule">
              <b>Nome:</b><br>
              <input type="text" name="nome" class="input" required>
            </label>
            <label class="inputCapsule">
              <b>Data de Nascimento:</b><br>
              <div class="date-wrapper">
                <input type="date" name="data_nascimento" class="input date-input" required>
                <!--<span class="date-icon"><i class="fa-solid fa-calendar"></i></span>
                <span class="date-placeholder">Escolha uma data</span>-->
              </div>
            </label>
          </div>
          <div class="form-right">
            <label class="inputCapsule">
              <b>Sobrenome:</b><br>
              <input type="text" name="sobrenome" class="input" required>
            </label>
            <label class="inputCapsule">
              <b>Email:</b><br>
              <input type="email" name="email" class="input" required>
            </label>
          </div>
        </div>
        <div class="form-bottom">
          <label class="inputCapsule7">
            <b>Senha:</b><br>
            <input type="password" name="senha" class="senhainput" required>
          </label>
        </div>
        <div class="termos">
          <div class="checkbox-group">
            <input type="checkbox" id="policies" name="policies">
            <label for="policies">
              Ao cadastrar na SportSync você concorda com as <span id="destaque"><a href="politicas.php">Políticas de Privacidade.</a></span>
            </label>
          </div>
          <div class="checkbox-group">
            <input type="checkbox" id="newsletter" name="newsletter">
            <label for="newsletter">
              Desejo receber a newsletter da SportSync no meu e-mail (opcional).
            </label>
          </div>
        </div>
        <div class="form-button">
          <button type="submit" name="logar" class="logarBtn">Cadastrar</button>
        </div>
        <div class="pergunta">Já possui cadastro? Vá para <a href="login.php" id="destaque">Login</a></div>
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

  <script>
    const iconmenu = document.getElementById("icon-menu");
    const navlinks = document.getElementById("nav-links");
    const closemenu = document.getElementById("close-menu")

    iconmenu.addEventListener('click', function () {
      if (navlinks.style.display === 'none') {
        navlinks.style.display = 'block';
      } else {
        navlinks.style.display = 'none';
      }
    });
    closemenu.addEventListener('click', function () {
      navlinks.style.display = 'none';
    });
  </script>
  <style type="text/css" href="index.css">
        <?php include('./css/header.css'); ?>
        <?php include('./css/cadastro.css'); ?>
        <?php include('./css/footer.css'); ?>
        <?php include('./css/responsividade.css'); ?>
        <?php include('./css/general.css'); ?>
    </style>
</body>

</html>