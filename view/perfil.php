<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include_once '../controller/DAOUsuario.php';
include_once '../controller/conexao.php';
function geraPerfil()
{
    $id = $_SESSION['id'];
    // Interpolação de strings
    $sql = 'SELECT id, nome, sobrenome, email, data_nascimento FROM usuarios WHERE id = ' . $id;
    $stmt = FabricaConexao::Conexao()->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_CLASS);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/header.css" />
    <link rel="stylesheet" href="./css/general.css" />
    <link rel="stylesheet" href="./css/footer.css" />
    <link rel="stylesheet" href="./css/responsividade.css" />
    <link rel="stylesheet" href="./css/perfil.css" />
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
            <li><a href="#">Instituições</a></li>
            <li><a href="#">Associe-se</a></li>
            <li><a href="#">Parceiros</a></li>
            <?php
            if ($_SESSION['usuario'] == null || $_SESSION['usuario'] == false) {
                header("Location: login.php");
            } else {
                $linhas = geraPerfil();
                foreach ($linhas as $linha) {
                    echo "<li><b><a href='perfil.php'>" . $linha->nome . "</a></b></li>";
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
    <?php
    foreach ($linhas as $linha) ?>
    <div class="tituloPag">
        <div class="coisarandom"></div>Olá, <?php echo $linha->nome ?>
    </div>
    <main class="profile-container">
        <div class="column photo-column">
            <img src="avatar.png" alt="Foto do Usuário" class="profile-photo">
            <button class="upload-photo-btn">
                <i class="fa-solid fa-upload"></i> Carregar Foto
            </button>
        </div>
        <div class="column info-column">
            <div class="user-info">
                <?php
                echo "<div><b>Nome:</b>";
                echo "<br>" . $linha->nome . " " . $linha->sobrenome . "</div>";
                echo "<div><b>Email:</b>";
                echo "<br>" . $linha->email . "</div>";
                echo "<div><b>Data de Nascimento:</b>";
                echo "<br>" . $linha->data_nascimento . "</div>";
                ?>
            </div>
        </div>
        <div class="column address-column">
            <button class="edit-profile-btn"><a href="editar_perfil.php?id='<?php echo $linha->id ?>'">Editar</a><i
                    class="fa-solid fa-pencil"></i></button>
            <button class="edit-profile-btn"><a href="../controller/sair_conta.php">Sair</a></button>
            <button class="edit-profile-btn"><a href="./cadastrar_nfe.php">Cadastrar NFE</a></button>
            <button class="edit-profile-btn"><a href="./minhas_nfes.php">Minhas NFEs</a></button>
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