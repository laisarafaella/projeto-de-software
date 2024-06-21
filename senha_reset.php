<?php
// reset_password.php
require 'vendor/autoload.php';
require 'funcoes.php'; // Inclua o arquivo de funções

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['token'])) {
    $token = $_GET['token'];
    $user = getUserByToken($token);

    if ($user) {
        echo '
        <form action="senha_reset.php" method="POST">
            <input type="hidden" name="token" value="'.$token.'">
            <label for="senha">Nova Senha:</label>
            <input type="senha" id="senha" name="senha" required>
            <button type="submit">Redefinir Senha</button>
        </form>';
    } else {
        echo 'Token inválido ou expirado.';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $newPassword = $_POST['senha'];
    $user = getUserByToken($token);

    if ($user) {
        updatePassword($user['id'], password_hash($newPassword, PASSWORD_DEFAULT));
        deletePasswordResetToken($user['id']);
        echo 'Sua senha foi redefinida com sucesso.';
    } else {
        echo 'Token inválido ou expirado.';
    }
}
?>
