<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';  // Inclui o autoload do Composer

// Configuração do banco de dados
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "teste";

$conexao = new mysqli($host, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $sql = "SELECT id FROM usuarios WHERE email='$email'";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
        $reset_code = rand(100000, 999999);
        $sql = "UPDATE usuarios SET reset_code='$reset_code' WHERE email='$email'";
        if ($conexao->query($sql) === TRUE) {
            $mail = new PHPMailer(true);
            try {
                //Configurações do servidor
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'your-email@gmail.com';
                $mail->Password   = 'your-email-password';
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;

                //Destinatários
                $mail->setFrom('your-email@gmail.com', 'Seu Nome');
                $mail->addAddress($email);

                //Conteúdo
                $mail->isHTML(true);
                $mail->Subject = 'Código de Recuperação de Senha';
                $mail->Body    = "Seu código de recuperação de senha é: $reset_code";

                $mail->send();
                echo "Código enviado com sucesso.";
            } catch (Exception $e) {
                echo "Falha ao enviar o email. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "Erro ao atualizar o código: " . $conexao->error;
        }
    } else {
        echo "Email não encontrado.";
    }
}

$conexao->close();
?>
<p><a href="esqueci_senha.php">Voltar</a></p>

