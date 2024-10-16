<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include_once '../controller/DAONfe.php';
include_once '../controller/DAOUsuario.php';
include_once '../controller/conexao.php';

function trazNFE()
{
  $nfeDAO = new DAONfe();
  return $nfeDAO->LocalizarNfes($_SESSION['id']);
}

function trazUser()
{
  $nfeUser = new DAOUsuario();
  return $nfeUser->Localizar($_SESSION['id']);
}

$linhas = trazNFE();
$linhas2 = trazUser();

function geraPerfil() {
    $id = $_SESSION['id'];
    // Interpolação de strings
    $sql = 'SELECT id, nome, sobrenome, email, data_nascimento FROM usuarios WHERE id = ' . $id;
    $stmt = FabricaConexao::Conexao()->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_CLASS);
}

$contador = 0;
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
  <!-- <script src="./js/dropdown.js"></script> -->
  <!-- Kit do fontawesome para icones -->
  <script src="https://kit.fontawesome.com/b4d8cbf4fd.js" crossorigin="anonymous"></script>
  <title>Sportsync - Login</title>
</head>

<body class="inter">
  <header>
    <ul class="nav-bar">
      <li class="logo jockey-one-regular"><a href="#">SPORTSYNC</a></li>
      <li><a href="../index.php">Home</a></li>
      <li><a href="#">Instituições</a></li>
      <li><a href="#">Associe-se</a></li>
      <li><a href="#">Parceiros</a></li>
      <?php
      if ($_SESSION['usuario'] == null || $_SESSION['usuario'] == false) {
        header("Location: login.php");
      } else {
        $linhas3 = geraPerfil();
        foreach ($linhas3 as $linha3) {
        echo "<li><b><a href='perfil.php'>" . $linha3->nome . "</a></b></li>";
        }
      }
      ?>

    </ul>
    <div class="dropmenu">
      <span class="logo jockey-one-regular">SPORTSYNC</span>
      <div class="dropdown">
        <img onclick="Dropdown()" class="dropbtn" src="./icons/bars-solid.svg" />
        <div id="myDropdown" class="dropdown-content">
          <a href="index.html">Home</a>
          <a href="#">Instituições</a>
          <a href="#">Associe-se</a>
          <a href="#">Parceiros</a>
          <a href="cadastro.html">Cadastrar</a>
          <a href="login.html">Login</a>
        </div>
      </div>
    </div>
  </header>
  <main>
    <div class="tituloPag">
      <div class="coisarandom"></div>
      Minhas NF-E's
    </div>
    <?php foreach ($linhas as $linha) {
      $contador++;
      echo '<div class="caixa">';
      echo '<p class="titulo">&nbsp' . $linha->apelido . '</p>';
      echo '<span class="valor">Valor:&nbsp ' . $linha->valor_total . '</span>';
      echo '<div class="botoes">';
      echo '<button class="mais" onclick="toggleDetalhes('.$contador.')">Mais</button>';
      echo '<button class="pontos">Obter pontos</button>';
      echo '</div>';
      echo '</div>';
      echo '<div class="detalhes-nfe" id="detalhes-'.$contador.'">';
      echo '<p><strong>Chave de Acesso:&nbsp</strong>' . $linha->chave_acesso . '</p>';
      echo '<p><strong>Nome/razão social:&nbsp</strong>' . $linha->razao_social . '</p>';
      echo '<p><strong>CNPJ do Emitente:&nbsp</strong>' . $linha->cnpj . '</p>';
      echo '<p><strong>Data de Emissão:&nbsp</strong>' . $linha->data_emissao . '</p>';
      echo '<p><strong>Valor Total:&nbsp</strong>' . $linha->valor_total . '</p>';
      echo '<p><strong>Apelido:</strong>&nbsp' . $linha->apelido . '</p>';
      echo '</div> ';
    }
      // echo '<p><strong>Nome do cliente:</strong>' . $linhas2[0] . ' ' . $linhas2[1] . '</p>';
      // echo '<p><strong>CPF:</strong>' . $linha2->cpf . '</p>';
      // echo '</div> ';
      // echo '<p class="pontos-atuais">Seus pontos atuais: ' . $linhas2[10] . ' pontos</p>';
      foreach ($linhas2 as $linha2)
      {
        echo '<p class="pontos-atuais">Seus pontos atuais: ' . $linha2->pontos . ' pontos</p>';
      }
      ?>
      
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
        <span class="spanfooter">SPORTSYNC</span>
        <span class="text">Todos os direitos reservados.</span>
      </p>
    </div>
  </footer>
  <script>

    function toggleDetalhes(id) {
      const detalhes = document.getElementById('detalhes-' + id);
      detalhes.style.display = detalhes.style.display === 'block' ? 'none' : 'block';
    }

    const iconmenu = document.getElementById("icon-menu");
    const navlinks = document.getElementById("nav-links");
    const closemenu = document.getElementById("close-menu");

    iconmenu.addEventListener('click', function () {
      if (navlinks.style.display === 'none') {
        navlinks.style.display = 'block';
        iconmenu.style.display = 'none';
        closemenu.style.display = 'block';
      } else {
        navlinks.style.display = 'none';
      }
    });

    closemenu.addEventListener('click', function () {
      navlinks.style.display = 'none';
      closemenu.style.display = 'none';
      iconmenu.style.display = 'block';
    });
  </script>
  <style type="text/css" href="index.css">
        <?php include('./css/minhas-nfe.css'); ?>
    </style>
</body>

</html>