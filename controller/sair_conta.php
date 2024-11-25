<?php
session_start();

// logout do usuario

// limpa todas as informações do usuário da sessão
$_SESSION = array();

// pode destruir a sessão completamente
// verifica se sessao com cookies, e removido
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// finalmente, destrua a sessão
session_destroy();

// redireciona o usuário para a página inicial
header("Location: ../index.php");
exit;
?>
