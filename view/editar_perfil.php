<?php

include_once "../model/usuario.php";
include_once '../controller/DAOUsuario.php';
include_once "../controller/conexao.php";

// instanciacao de classes
$usuarioDAO = new DAOUsuario();
$usuario = new Usuario();

// processo de alteracao
if (isset($_POST['alterar'])) {
    // converte a string de data enviada pelo form
    $dt = date('Y-m-d', strtotime($_POST['data_nascimento']));
    $date = new DateTime($dt);
    // calcula a diferença entre a data atual e a data de nascimento fornecida
    $interval = $date->diff( new DateTime( date('Y-m-d') ) );

    // validacao da idade, se é maior de 18
    if($interval->format('%Y') >= 18){
        $usuario->setId($id = $_GET['id']);
        $usuario->setNome($_POST['nome']);
        $usuario->setSobrenome($_POST['sobrenome']);
        $usuario->setEmail($_POST['email']);
        $usuario->setDataNascimento(date('Y-m-d', strtotime($_POST['data_nascimento'])));
        $usuario->setCpf($_POST['cpf']);
        $usuario->setCep($_POST['cep']);
        $usuario->setTelefone($_POST['telefone']);

        // chama o método da classe DAOUsuario para salvar as alterações no banco
        $usuarioDAO->Atualizar($usuario);
        header("Location: perfil.php");
    }
    else {
        echo "<script>alert('Por favor, digite uma data de nascimento válida.');</script>";
        header("Location: ../view/editar_perfil.php?id=". $_GET['id']);
    }

}

// busca os dados do usuário com base no id, retornando um array com as infos
$ids = $_GET['id'];
$linhas = $usuarioDAO->Localizar($ids);



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
    <link rel="stylesheet" href="./css/editar.css" />
    <script src="./js/app.js" defer></script>
    <!-- Kit do fontawesome para ícones -->
    <script src="https://kit.fontawesome.com/b4d8cbf4fd.js" crossorigin="anonymous"></script>
    <title>Sportsync - Editar Perfil</title>
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
                $linhas = geraPerfil();
                foreach ($linhas as $linha) {
                    echo "<li><b><a href='perfil.php'>" . $linha->nome . "</a></b></li>";
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
        // verifica se o usuário está logado no menu responsivo
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
    <div class="tituloPag">
        <div class="coisarandom"></div>Editar Perfil
    </div>

    <main>
        <form method="POST" class="formEditar">
            <div class="inputCapsule">
                <label for="exampleInputEmail1" class="form-label">Nome:</label>
                <?php
                // itera sobre o array $linhas para preencher os campos do form
                foreach ($linhas as $linha) {
                    // pré-preenche o campo
                    echo '<input type="text" class="input" name="nome" value="' . $linha->nome . '">';
                    ?>
                </div>
                <div class="inputCapsule">
                    <label for="exampleInputEmail1" class="form-label">Sobrenome:</label>
                    <?php
                    echo '<input type="text" name="sobrenome" class="input" value="' . $linha->sobrenome . '">';
                    ?>
                </div>
                <div class="inputCapsule">
                    <label for="exampleInputEmail1" class="form-label">E-mail:</label>
                    <?php
                    // exibe o e-mail atual do usuário no campo
                    echo '<input type="text" name="email" class="input" value="' . $linha->email . '">';
                    ?>
                </div>
                <div class="inputCapsule">
                    <label for="exampleInputEmail1" class="form-label">Data de Nascimento:</label>
                    <?php
                    // o valor de data_nascimento do banco é exibido
                    echo '<input type="date" name="data_nascimento" class="input" value="' . $linha->data_nascimento . '">';
                    ?>
                    <div class="inputCapsule">
                        <label for="">CPF:</label>
                        <?php
                        echo '<input type="text" name="cpf" id="cpf" class="input" maxlength="14" value="' . $linha->cpf . '">';
                        ?>
                    </div>
                    <div class="inputCapsule">
                        <label for="">CEP:</label>
                        <?php
                        echo '<input type="text" name="cep" id="cep" class="input" maxlength="8" value="' . $linha->cep . '">';
                        ?>
                    </div>
                    <div class="inputCapsule">
                        <label for="">Telefone:</label>
                        <?php
                        echo '<input type="text" name="telefone" id="phoneNumber" class="input" maxlength="14" value="' . $linha->telefone . '">';
                        ?>
                    </div>
                    <?php
                } ?>
            </div>
            <div class="editar">
            <button type="submit" name="alterar" class="alterarBtn">Alterar</button>
            </div>
            
        </form>
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

    <script src="./js/validacao.js"></script>

    <style type="text/css" href="index.css">
        <?php include('./css/editar.css'); ?>
        <?php include('./css/responsividade.css'); ?>
        <?php include('./css/footer.css'); ?>
    </style>

</body>

</html>