<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./css/header.css" />
  <!-- <link rel="stylesheet" href="./css/general.css" /> -->
  <link rel="stylesheet" href="./css/footer.css" />
  <link rel="stylesheet" href="./css/responsividade.css" />
  <script src="./js/dropdown.js"></script>
  <!-- Kit do fontawesome para icones -->
  <script src="https://kit.fontawesome.com/b4d8cbf4fd.js" crossorigin="anonymous"></script>
  <title>Sportsync - Login</title>
</head>

<body class="inter">
  <header>
    <ul class="nav-bar">
      <li class="logo jockey-one-regular"><a href="#">SPORTSYNC</a></li>
      <li><a href="#">Home</a></li>
      <li><a href="#">Instituições</a></li>
      <li><a href="#">Associe-se</a></li>
      <li><a href="#">Parceiros</a></li>
      <li><a href="#">Cadastrar</a></li>
      <li class="login"><a href="#">Login</a></li>
    </ul>
    <div class="dropmenu">
      <span class="logo jockey-one-regular">SPORTSYNC</span>
      <div class="dropdown">
        <img onclick="Dropdown()" class="dropbtn" src="./icons/bars-solid.svg" />
        <div id="myDropdown" class="dropdown-content">
          <a href="#">Home</a>
          <a href="#">Instituições</a>
          <a href="#">Associe-se</a>
          <a href="#">Parceiros</a>
          <a href="#">Cadastrar</a>
          <a href="#">Login</a>
        </div>
      </div>
    </div>
  </header>
  <main>
    <div class="tituloPag">
      <div class="coisarandom"></div>
      Cadastrar uma NF-E
    </div>
    <div class="conteudo">
      <div class="contTitulo">Cupom Fiscal/NF-E</div>
      <form method="POST" class="NFEForm" action="../controller/cadastraNFE.php">
        <label class="inputCapsule2">
          <div>
            <b>Chave de Acesso:</b><br>
            <input type="text" name="chave" class="input" max-lenght="44">
          </div>
          <div>
            <b>CNPJ:</b><br>
            <input type="text" name="cnpj" class="input">
          </div>
          <div>
            <b>Valor total:</b><br>
            <input type="text" name="valor" class="input">
          </div>
        </label>
        <label class="inputCapsule2">
          <div>
            <b>Nome/Razão Social:</b><br>
            <input type="text" name="razao" class="input">
          </div>
          <div>
            <b>Data de Emissão:</b><br>
            <input type="text" name="data_emissao" class="input">
          </div>
          <div>
            <b>Apelido:</b><br>
            <input type="text" name="apelido" class="input">
          </div>
        </label>
        <button type="submit" name="cadastrar" class="cadastrarBtn">Cadastrar</button>
      </form>
      
    </div>
  </main>
  <footer>
    <div class="container">
      <div class="section">
        <h4>Organização</h4>
        <ul>
          <li>
            <a href="#">Políticas de Privacidade</a>
          </li>
          <li><a href="#">Diretrizes da Comunidade</a></li>
          <li><a href="#">Fale Conosco</a></li>
        </ul>
      </div>
      <div class="section">
        <h4>Recursos</h4>
        <ul>
          <li><a href="#">Serviços</a></li>
          <li><a href="#">Seja um colaborador</a></li>
          <li><a href="#">Assine nossa newsletter</a></li>
        </ul>
      </div>
      <div class="section">
        <div class="midia">
          <h4>Redes Sociais</h4>
          <div class="icons">
            <a href="#"><i class="fa-brands fa-instagram fa-xl"></i></a>
            <a href="#"><i class="fa-brands fa-x-twitter fa-xl"></i></a>
            <a href="#"><i class="fa-brands fa-whatsapp fa-xl"></i></a>
            <a href="#"><i class="fa-brands fa-youtube fa-xl"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="bottom normal">
      <p>
        <span>SportSync &copy; 2024</span> - Todos os direitos reservados.
      </p>
    </div>
    <div class="bottom responsive">
      <p>
        <span>SPORTSYNC</span>
        <span class="text">Todos os direitos reservados.</span>
      </p>
    </div>
  </footer>
  <style type="text/css" href="index.css">
        <?php include('./css/general.css'); ?>
    </style>
</body>

</html>



<?php 

  // if(isset($_POST['cadastrar'])) {
  //   header('Location: ../controller/cadastraNFE.php') ;
  // }

?>