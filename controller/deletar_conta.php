<?php

session_start();

include_once './DAOUsuario.php';

$usuarioDAO = new DAOUsuario();

$usuarioDAO->Deletar($_SESSION['id']);

