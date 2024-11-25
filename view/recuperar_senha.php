<?php

// inicia uma sessão para armazenar mensagens e estados do user
session_start();
ob_start();
include_once '../controller/conexaoSenha.php';


// usa classes do PHPMailer para envio de e-mails
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// inclui o autoloader do PHPMailer para carregar as classes
require '../controller/lib/vendor/autoload.php';
$mail = new PHPMailer(true);

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
    <title>SportSync - Recuperar Senha</title>
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
    <div class="coisarandom"></div>Recupere sua senha!
  </div>
  <p class="information">• Informe o email registrado para enviarmos um link para a alteração da senha!</p>

    <?php
    // recebe e filtra os dados enviados pelo form
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    // verifica se o botão "Recuperar" foi pressionado
    if (!empty($dados['SendRecupSenha'])) {
        //var_dump($dados);

        // consulta o banco para encontrar o usuário pelo e-mail informado
        $query_usuario = "SELECT id, nome, sobrenome, email, senha, data_nascimento
                    FROM usuarios
                    WHERE email =:email  
                    LIMIT 1";
        $result_usuario = $conn->prepare($query_usuario);
        $result_usuario->bindParam(':email', $dados['email'], PDO::PARAM_STR);
        $result_usuario->execute();

        // se o usuário foi encontrado no banco
        if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);

            // gera um token de recuperação de senha
            $chave_recuperar_senha = password_hash($row_usuario['id'], PASSWORD_DEFAULT);
            //echo "Chave $chave_recuperar_senha <br>";

            // atualiza o banco com o token gerado
            $query_up_usuario = "UPDATE usuarios
                        SET token_reset =:token_reset 
                        WHERE id =:id 
                        LIMIT 1";
            $result_up_usuario = $conn->prepare($query_up_usuario);
            $result_up_usuario->bindParam(':token_reset', $chave_recuperar_senha, PDO::PARAM_STR);
            $result_up_usuario->bindParam(':id', $row_usuario['id'], PDO::PARAM_INT);

            // define o link para a recuperação de senha
            if ($result_up_usuario->execute()) {
                $link = "http://localhost/Sportsync/view/atualizar_senha.php?chave=" . 
                $chave_recuperar_senha;

                //http://localhost/Final23/view/atualizar_senha.php?chave=
                //"http://localhost/localhost/Sportsync/PDO/view/atualizar_senha.php?chave="

                try {
                  // configurações do PHPMailer para envio de e-mails

                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                    $mail->CharSet = 'UTF-8';
                    $mail->isSMTP();
                    $mail->Host       = 'sandbox.smtp.mailtrap.io';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = '948e98fa97bba2';
                    $mail->Password   = '2adef8afe6fa39';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port       = 2525;

                     // define o remetente e destinatário do e-mail
                    $mail->setFrom('sportsync@proton.me', 'Atendimento');
                    $mail->addAddress($row_usuario['email'], $row_usuario['nome']);

                    // define o corpo do e-mail
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Recuperar senha';
                    $mail->Body    = 'Prezado(a) ' . $row_usuario['nome'] .".<br><br>Você solicitou alteração de senha.<br><br>Para continuar o processo de recuperação de sua senha, clique no link abaixo ou cole o endereço no seu navegador: <br><br><a href='" . $link . "'>" . $link . "</a><br><br>Se você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até que você ative este código.<br><br>";
                    $mail->AltBody = 'Prezado(a) ' . $row_usuario['nome'] ."\n\nVocê solicitou alteração de senha.\n\nPara continuar o processo de recuperação de sua senha, clique no link abaixo ou cole o endereço no seu navegador: \n\n" . $link . "\n\nSe você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até que você ative este código.\n\n";

                    // envia o e-mail
                    $mail->send();

                    // mensagem de sucesso
                    $_SESSION['msg'] = "<p style='color: green'>Enviado e-mail com instruções para recuperar a senha. Acesse a sua caixa de e-mail para recuperar a senha!</p>";
                    header("Location: senha.php");
                } catch (Exception $e) {
                    echo "Erro: E-mail não enviado sucesso. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                echo  "<p style='color: #ff0000'>Erro: Tente novamente!</p>";
            }
        } else {
            echo "<p style='color: #ff0000'>Erro: Usuário não encontrado!</p>";
        }
    }

    // exibe mensagem armazenada na sessão se tiver
    if (isset($_SESSION['msg_rec'])) {
        echo $_SESSION['msg_rec'];
        unset($_SESSION['msg_rec']);
    }

    ?>

    <form method="POST" action="" class="formRecuperar">
        <?php
        $usuario = "";
        if (isset($dados['email'])) {
            $usuario = $dados['email'];
        } ?>

        <label class="lblEmail">E-mail</label>
        <input class="inputUser" type="text" name="email" placeholder="Digite o usuário" value="<?php echo $usuario; ?>"><br><br>

        <input type="submit" value="Recuperar" name="SendRecupSenha">
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