<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include_once '../controller/DAOUsuario.php';
include_once '../controller/conexao.php';
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
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/header.css" />
    <link rel="stylesheet" href="./css/general.css" />
    <link rel="stylesheet" href="./css/footer.css" />
    <link rel="stylesheet" href="./css/responsividade.css" />
    <link rel="stylesheet" href="./css/perfil.css" />
    <script src="./js/app.js" defer></script>
    <!-- Kit do fontawesome para ícones -->
    <script src="https://kit.fontawesome.com/b4d8cbf4fd.js" crossorigin="anonymous"></script>
    <title>Sportsync - Perfil</title>
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
        <!-- Coloquei esse trem da seção, só pra ter uma ideia do q o fernando falou-->
        <ul class="mheader">
            <li class="logo jockey-one-regular"><a href="../index.php">SPORTSYNC</a></li>
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
        <img onclick="menu()" class="dropbtn menu" src="./assets/bars-solid.svg" alt="Menu">
        <div id="dropdown" class="dropdown-content">
                <a href="../index.php">Home</a>
                <a href="ranking.php">Ranking</a>
                <a href="planos.php">Planos</a>
                <a href="parceiros.php">Parceiros</a>
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
        </div>
    </header>
    <?php
    foreach ($linhas as $linha) ?>
    <div class="tituloPag">
        <div class="coisarandom"></div>Olá, <?php echo $linha->nome ?>
    </div>
    <main class="profile-container">
        <div class="column photo-column">
            <img src="./assets/avatar.png" alt="Foto do Usuário" class="profile-photo">
            <!-- <button class="upload-photo-btn">
                <i class="fa-solid fa-upload"></i> Carregar Foto
            </button> -->
        </div>
        <div class="column info-column">
            <div class="user-info">
                <?php
                echo "<div><b>Nome:</b>";
                echo "<br>" . $linha->nome . " " . $linha->sobrenome . "</div>";
                echo "<div><b>Email:</b>";
                echo "<br>" . $linha->email . "</div>";
                echo "<div><b>Data de Nascimento:</b>";
                echo "<br>" . date('d/m/Y', strtotime($linha->data_nascimento )) . "</div>";   
                echo "<div><b>CPF:</b>";
                echo "<br>" . $linha->cpf . "</div>";
                echo "<div><b>CEP:</b>";
                echo "<br>" . $linha->cep . "</div>";
                echo "<div><b>Telefone:</b>";
                echo "<br>" . $linha->telefone . "</div>";
                echo "<div><b>Pontos:</b>";
                echo "<br>" . $linha->pontos . "</div>";
                ?>
            </div>
        </div>
        <div class="column address-column">
            <button class="edit-profile-btn"><a href="editar_perfil.php?id=<?php echo $linha->id ?>">Editar</a><i
            class="fa-solid fa-pencil"></i></button>
            <button class="edit-profile-btn"><a href="./cadastrar_nfe.php">Cadastrar NFE</a></button>
            <button class="edit-profile-btn"><a href="./minhas_nfes.php">Minhas NFEs</a></button>
            <button class="edit-profile-btn"><a href="./extrato.php">Extrato</a></button>
            <button class="edit-profile-btn"><a href="./pagamento.php">Pagamento</a></button>
            <button class="edit-profile-btn"><a href="./doar.php">Doação</a></button>
            <button class="edit-profile-btn"><a href="./gerar_cupom.php">Gerar Cupom</a></button>
            <button class="edit-profile-btn"><a href="./meus_cupons.php">Meus Cupons</a></button>
            <button class="edit-profile-btn"><a href="../controller/sair_conta.php">Sair</a></button>
            <button class="edit-profile-btn"><a href="../controller/deletar_conta.php">Deletar</a></button>
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
                    <li><a href="planos.php">Seja um colaborador</a></li>
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
        <?php include('./css/perfil.css'); ?>
        <?php include('./css/header.css'); ?>
        <?php include('./css/responsividade.css'); ?>
    </style>
</body>

</html>