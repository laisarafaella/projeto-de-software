<?php
// request_password_reset.php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// conectar bd
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "sportsync";

// cria a conexão
$conn = new mysqli($host, $usuario, $senha, $banco);

// verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// função para obter usuário pelo e-mail
function getUserByEmail($email) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// função para salvar token de redefinição de senha e a data expiração (1hora)
function savePasswordResetToken($userId, $token) {
    global $conn;
    $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
    $stmt = $conn->prepare("UPDATE usuarios SET token_reset = ?, token_reset_expiracao = ? WHERE id = ?");
    $stmt->bind_param("ssi", $token, $expiry, $userId);
    $stmt->execute();
}

// solicitação de redefinição de senha
// email enviado, se for encontrado um token é gerado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $user = getUserByEmail($email);

    if ($user) {
        // convertido para hexadecimal
        $token = bin2hex(random_bytes(16));
        // token salvo e depois enviado
        savePasswordResetToken($user['id'], $token);
        sendPasswordResetEmail($email, $token);
    }

    echo 'um link para redefinir sua senha foi enviado.';
}

// função para enviar o email com o link para redefinir senha
function sendPasswordResetEmail($email, $token) {
    $resetLink = "http://localhost/projeto-de-software/senha_reset.php?token=$token";
    
    // PHPMailer é utilizado para enviar o e-mail
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp-mail.outlook.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'testeprojdesoftware@outlook.com';
        $mail->Password = 'ProjDeSoftware';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('testeprojdesoftware@outlook.com', 'Davi Pimenta');
        $mail->addAddress($email);

        // e-mail contém tanto o corpo HTML quanto o corpo alternativo
        $mail->isHTML(true);
        $mail->Subject = 'Redefinição de Senha';
        $mail->Body    = "Clique no link a seguir para redefinir sua senha: <a href='$resetLink'>$resetLink</a>";
        $mail->AltBody = "Clique no link a seguir para redefinir sua senha: $resetLink";

        // e-mail for enviado com sucesso
        $mail->send();
        echo 'Mensagem enviada, ';
    } catch (Exception $e) {
        echo "Falha ao enviar o e-mail. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
