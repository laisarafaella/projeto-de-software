<?php

// conectar bd
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "teste";

// Cria a conexão
$conn = new mysqli($host, $usuario, $senha, $banco);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Exemplo de função para obter usuário por e-mail
function getUserByEmail($email) {
    global $conn; // Torna $conn global dentro da função
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// Função para salvar token de redefinição de senha
function savePasswordResetToken($userId, $token) {
    global $conn;
    $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
    $stmt = $conn->prepare("UPDATE usuarios SET token_reset = ?, token_reset_expiracao = ? WHERE id = ?");
    $stmt->bind_param("ssi", $token, $expiry, $userId);
    $stmt->execute();
}

// Função para obter usuário pelo token de redefinição de senha
function getUserByToken($token) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE token_reset = ? AND token_reset_expiracao > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// Função para atualizar a senha do usuário
function updatePassword($userId, $newPassword) {
    global $conn;
    $stmt = $conn->prepare("UPDATE usuarios SET senha = ? WHERE id = ?");
    $stmt->bind_param("si", $newPassword, $userId);
    $stmt->execute();
}

// Função para deletar token de redefinição de senha
function deletePasswordResetToken($userId) {
    global $conn;
    $stmt = $conn->prepare("UPDATE usuarios SET token_reset = NULL, token_reset_expiracao = NULL WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
}
?>
