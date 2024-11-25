<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

// inclui arquivos de classes e banco
include_once '../controller/DAONfe.php';
include_once '../controller/DAOUsuario.php';
include_once '../controller/conexao.php';

// função para buscar nfes do usuario logado
function trazNFE()
{
  // localiza nfes vinculadas ao id do usuario
  $nfeDAO = new DAONfe();
  return $nfeDAO->LocalizarNfes($_SESSION['id']);
}


// função para buscar infos do usuário logado
function trazUser()
{
  // localiza o usuário pelo id dele
  $nfeUser = new DAOUsuario();
  return $nfeUser->Localizar($_SESSION['id']);
}


// armazenando as nfes e infos do usuário
$linhas = trazNFE();
$linhas2 = trazUser();


// função para pegar infos do perfil do usuário
function geraPerfil() {
    $id = $_SESSION['id'];
    // Interpolação de strings

    // consulta o banco para obter infos do usuário
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
  <script src="./js/app.js" defer></script>
  <!-- Kit do fontawesome para icones -->
  <script src="https://kit.fontawesome.com/b4d8cbf4fd.js" crossorigin="anonymous"></script>
  <title>Sportsync - Minhas Notas Fiscais</title>
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
      // verifica se o usuário está logado
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
        // verifica se o usuário está logado
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


  <main class="minhasNfes">
    <div class="tituloPag">
      <div class="coisarandom"></div>
      Minhas NF-E's
    </div>

      <!-- exibição das nfes do usuario -->
    <?php foreach ($linhas as $linha) {
      $contador++;
      echo '<div class="caixa">';
      echo '<p class="titulo">&nbsp' . $linha->apelido . '</p>';
      echo '<span class="valor">Valor: R$' . $linha->valor_total . '</span>';
      echo '<div class="botoes">';
      echo '<button class="mais" onclick="toggleDetalhes('.$contador.')">Mais Detalhes</button>';
      echo '</div>';
      echo '</div>';

      // exibe os detalhes ao clicar
      echo '<div class="detalhes-nfe" id="detalhes-'.$contador.'">';
      echo '<p><strong>Chave de Acesso:&nbsp</strong>' . $linha->chave_acesso . '</p>';
      echo '<p><strong>Nome/razão social:&nbsp</strong>' . $linha->razao_social . '</p>';
      echo '<p><strong>CNPJ do Emitente:&nbsp</strong>' . $linha->cnpj . '</p>';
      echo '<p><strong>Data de Emissão:&nbsp</strong>' . date('d/m/Y', strtotime($linha->data_emissao)) . '</p>';
      echo '<p><strong>Valor Total:&nbsp</strong>' . $linha->valor_total . '</p>';
      echo '<p><strong>Apelido:</strong>&nbsp' . $linha->apelido . '</p>';
      echo '</div> ';
    }
      // echo '<p><strong>Nome do cliente:</strong>' . $linhas2[0] . ' ' . $linhas2[1] . '</p>';
      // echo '<p><strong>CPF:</strong>' . $linha2->cpf . '</p>';
      // echo '</div> ';
      // echo '<p class="pontos-atuais">Seus pontos atuais: ' . $linhas2[10] . ' pontos</p>';


      // exibe os pontos do usuário
      foreach ($linhas2 as $linha2)
      {
        echo '<p class="pontos-atuais">Seus pontos atuais: ' . $linha2->pontos . ' pontos</p>';
      }
      ?>
      
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


  // função para alternar visibilidade dos detalhes da nfe
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
        <?php include('./css/header.css'); ?>
        <?php include('./css/minhas-nfe.css'); ?>
        <?php include('./css/footer.css'); ?>
        <?php include('./css/responsividade.css'); ?>
        <?php include('./css/general.css'); ?>
    </style>
</body>

</html>