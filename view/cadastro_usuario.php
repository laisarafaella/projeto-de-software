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
  <script src="./js/dropdown.js"></script>
  <!-- Kit do fontawesome para ícones -->
  <script src="https://kit.fontawesome.com/b4d8cbf4fd.js" crossorigin="anonymous"></script>
  <title>Sportsync - Cadastro</title>
</head>

<body class="inter">
  <header>
    <ul class="nav-bar">
      <li class="logo jockey-one-regular"><a href="#">SPORTSYNC</a></li>
      <li><a href="../index.php">Home</a></li>
      <li><a href="ranking.html">Instituições</a></li>
      <li><a href="#">Associe-se</a></li>
      <li><a href="#">Parceiros</a></li>
      <li><a href="cadastro_usuario.php">Cadastrar</a></li>
      <li><a href="perfil.php">Perfil</a></li>
      <li class="login"><a href="login.php">Login</a></li>
    </ul>
    <div class="dropmenu">
      <span class="logo jockey-one-regular">SPORTSYNC</span>
      <div class="dropdown">
        <img onclick="Dropdown()" class="dropbtn" src="./icons/bars-solid.svg" />
        <div id="myDropdown" class="dropdown-content">
          <a href="index.php">Home</a>
          <a href="ranking.html">Instituições</a>
          <a href="#">Associe-se</a>
          <a href="#">Parceiros</a>
          <a href="cadastro_usuario.php">Cadastrar</a>
          <li><a href="perfil.php">Perfil</a></li>
          <a href="login.php">Login</a>
        </div>
      </div>
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
              <input type="text" name="nome" class="input">
            </label>
            <label class="inputCapsule">
              <b>Data de Nascimento:</b><br>
              <div class="date-wrapper">
                <input type="date" name="data_nascimento" class="input date-input">
                <span class="date-icon"><i class="fa-solid fa-calendar"></i></span>
                <span class="date-placeholder">Escolha uma data</span>
              </div>
            </label>
          </div>
          <div class="form-right">
            <label class="inputCapsule">
              <b>Sobrenome:</b><br>
              <input type="text" name="sobrenome" class="input">
            </label>
            <label class="inputCapsule">
              <b>Email:</b><br>
              <input type="email" name="email" class="input">
            </label>
            <label class="inputCapsule">
              <b>Senha:</b><br>
              <input type="password" name="senha" class="input">
            </label>
          </div>
        </div>
        <div class="termos">
          <div class="checkbox-group">
            <input type="checkbox" id="policies" name="policies">
            <label for="policies">
              Ao cadastrar na SportSync você concorda com as <span id="destaque">Políticas de Privacidade</span> e com
              os <span id="destaque-p">Termos de Uso</span> (obrigatório).
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
        <div class="pergunta">Já possui cadastro? vá para <a href="login.html" id="destaque">Login</a></div>
      </form>
    </div>
  </main>
  <footer>
    <div class="box-footer">
      <div class="footer-column">
        <h3>Organização</h3>
        <ul>
          <li><a href="#"><span id="destaque-f">Política de Privacidade</span></a></li>
          <li><a href="#">Diretrizes da comunidade</a></li>
          <li><a href="#">Fale conosco</a></li>
        </ul>
      </div>
      <div class="footer-column">
        <h3>Recursos</h3>
        <ul>
          <li><a href="#">Serviços</a></li>
          <li><a href="#">Seja um colaborador</a></li>
          <li><a href="#">Assine nossa newsletter</a></li>
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
</body>

</html>