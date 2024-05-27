<?php
session_start();

// Limpa todas as informações do usuário da sessão
$_SESSION = array();

// Se desejar, você também pode destruir a sessão completamente
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destrua a sessão
session_destroy();

// Redireciona o usuário para a página inicial
header("Location: index.php");
exit;
?>
