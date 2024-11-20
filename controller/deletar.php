<?php
include_once './DAOUsuario.php';

$usuarioDAO = new DAOUsuario();

$usuarioDAO->Deletar($_SESSION['id']);


?>