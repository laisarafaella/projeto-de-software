<?php
session_start();
ob_start();
include_once '../controller/conexaoSenha.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-ico">
    <link rel="stylesheet" href="./css/header.css" />
    <link rel="stylesheet" href="./css/general.css" />
    <link rel="stylesheet" href="./css/footer.css" />
    <link rel="stylesheet" href="./css/responsividade.css" />
    <link rel="stylesheet" href="./css/recuperar-senha.css" />
    <script src="https://kit.fontawesome.com/b4d8cbf4fd.js" crossorigin="anonymous"></script>
    <title>SportSync - Alterar Senha</title>
</head>

<body class="inter">
    <?php
    //Exemplo criptografar a senha
    //echo password_hash(123456, PASSWORD_DEFAULT);
    ?>

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
    <div class="coisarandom"></div>Lembrou? Faça login novamente!
  </div>

    <?php
    // captura e filtra os dados do form
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    // verifica se o botão "Acessar" foi pressionado
    if (!empty($dados['SendLogin'])) {
        //var_dump($dados);

        // consulta o banco para buscar infos do usuário com base no e-mail
        $query_usuario = "SELECT id, nome, sobrenome, email, senha, data_nascimento
                        FROM usuarios
                        WHERE email =:email  
                        LIMIT 1";
        $result_usuario = $conn->prepare($query_usuario);
        $result_usuario->bindParam(':email', $dados['email'], PDO::PARAM_STR);
        $result_usuario->execute();

        if(($result_usuario) AND ($result_usuario->rowCount() != 0)){
            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
            //var_dump($row_usuario);

            // compara a senha digitada com a senha criptografada armazenada
            if(password_verify($dados['senha'], $row_usuario['senha'])) {

              // se as credenciais forem válidas: inicia uma sessão para armazenar infos do usuário
                $_SESSION['id'] = $row_usuario['id'];
                $_SESSION['nome'] = $row_usuario['nome'];
                header("Location: perfil.php");
            }else{
              // exibe uma mensagem de erro
                $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Usuário ou senha inválida!</p>";
            }
        }else{
            $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Usuário ou senha inválida!</p>";
        }

        
    }

    // exibe mensagens de erro ou sucesso armazenadas na sessão
    // limpa a mensagem após exibir
    
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>

    <form method="POST" action="" class="formRecuperar">
        <label>Usuário</label>
        <input type="text" name="email" placeholder="Digite o usuário" value="<?php if(isset($dados['email'])){ echo $dados['email']; } ?>"><br><br>

        <label>Senha</label>
        <input type="password" name="senha" placeholder="Digite a senha" value="<?php if(isset($dados['senha'])){ echo $dados['senha']; } ?>"><br><br>

        <input type="submit" value="Acessar" name="SendLogin">
    </form>

    <p class="forgot"> <a href="recuperar_senha.php">Esqueceu a senha?</a></p>
    
    <!--<br><br>
    Usuário: cesar@celke.com.br<br>
    Senha: 123456-->



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
        <?php include('./css/general.css'); ?>
        <?php include('./css/header.css'); ?>
        <?php include('./css/footer.css'); ?>
        <?php include('./css/responsividade.css'); ?>
        <?php include('./css/recuperar-senha.css'); ?>
</style>

</body>

</html>