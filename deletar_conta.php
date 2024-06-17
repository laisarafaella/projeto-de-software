<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "teste";

$conexao = new mysqli($host, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}

$email = $_SESSION['usuario'];
$sql = "DELETE FROM usuarios WHERE email='$email'";
if ($conexao->query($sql) === TRUE) {
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();

    header("Location: index.php");
    exit;
} else {
    echo "Erro ao excluir a conta: " . $conexao->error;
}

// Fecha a conexão
$conexao->close();
?>
