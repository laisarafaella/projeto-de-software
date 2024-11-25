<?php
// inicia a sessão e o buffer de saída
session_start();
ob_start();

// inclui a conexão com o banco de dados
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
    <title>SportSync - Atualizar Senha</title>
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
    <div class="coisarandom"></div>Atualize sua senha!
  </div>

  
    <?php
    // obtém o token de recuperação de senha passado pela URL
    $chave = filter_input(INPUT_GET, 'chave', FILTER_DEFAULT);


    /* verifica se a chave/token foi passada pela URL */
    if (!empty($chave)) {
      // consulta o banco de dados para verificar se o token existe e está associado a um usuário
        $query_usuario = "SELECT id 
                            FROM usuarios 
                            WHERE token_reset =:token_reset  
                            LIMIT 1";
        $result_usuario = $conn->prepare($query_usuario);
        $result_usuario->bindParam(':token_reset', $chave, PDO::PARAM_STR);
        $result_usuario->execute();

        // se o token for válido, o processo de recuperação da senha continua
        if (($result_usuario) and ($result_usuario->rowCount() != 0)) {

          // obtém o ID do usuário associado ao token
            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);

            // verifica se a senha foi enviada pelo formulário
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if (!empty($dados['SendNovaSenha'])) {
              // criptografa a nova senha
                $senha_usuario = password_hash($dados['senha'], PASSWORD_DEFAULT);
                // limpa o token de recuperação após a atualização da senha
                $recuperar_senha = 'NULL';

                // atualiza a senha no banco e remove o token de recuperação
                $query_up_usuario = "UPDATE usuarios
                        SET senha =:senha,
                        token_reset =:token_reset
                        WHERE id =:id 
                        LIMIT 1";
                $result_up_usuario = $conn->prepare($query_up_usuario);
                $result_up_usuario->bindParam(':senha', $senha_usuario, PDO::PARAM_STR);
                $result_up_usuario->bindParam(':token_reset', $recuperar_senha);
                $result_up_usuario->bindParam(':id', $row_usuario['id'], PDO::PARAM_INT);

                // verifica se a atualização foi bem-sucedida
                if ($result_up_usuario->execute()) {
                  // mensagem positiva
                    $_SESSION['msg'] = "<p style='color: green'>Senha atualizada com sucesso!</p>";
                    header("Location: login.php");
                } else {
                  // mensagem de erro
                    echo "<p style='color: #ff0000'>Erro: Tente novamente!</p>";
                }
            }
        } else {
          // mensagem de token invalido
            $_SESSION['msg_rec'] = "<p style='color: #ff0000'>Erro: Link inválido, solicite novo link para atualizar a senha!</p>";
            header("Location: recuperar_senha.php");
        }
    } else {
      // mensagem se o token não estiver presente
        $_SESSION['msg_rec'] = "<p style='color: #ff0000'>Erro: Link inválido, solicite novo link para atualizar a senha!</p>";
        header("Location: recuperar_senha.php");
    }

    ?>
    <form method="POST" action="" class="formRecuperar">
        <?php
        // verifica se a nova senha foi preenchida, para preencher o campo de senha com o valor atual
        $usuario = "";
        if (isset($dados['senha'])) {
            $usuario = $dados['senha'];
        } ?>
        
        <label>Senha</label>
        <input type="password" name="senha" placeholder="Digite a nova senha" value="<?php echo $usuario; ?>"><br><br>

        <input type="submit" value="Atualizar" name="SendNovaSenha">
    </form>

    <p class="remember">Lembrou? <a href="login.php">Clique aqui</a> para logar</p>


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