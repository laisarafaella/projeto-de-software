<?php
// inicia ou resume a sessão do usuário
session_start();
include_once './DAOUsuario.php';

// exclusão do usuário do banco

//  método Deletar será chamado
$usuarioDAO = new DAOUsuario();


//  método Deletar é chamado e id do usuario como argumento é passado
$usuarioDAO->Deletar($_SESSION['id']);


?>