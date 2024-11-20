<?php

session_start();

include_once './DAOUsuario.php';

$usuarioDAO = new DAOUsuario();

$usuarioDAO->Deletar($_SESSION['id']);

unset($_SESSION['login_session']);
session_destroy();

