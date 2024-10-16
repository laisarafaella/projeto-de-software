<?php
include_once "../model/usuario.php";
include_once './DAOUsuario.php';

$usuarioDAO = new DAOUsuario();
$usuario = new Usuario();


$usuario->setNome($_POST['nome']);
$usuario->setSobrenome($_POST['sobrenome']);
$usuario->setEmail($_POST['email']);
$usuario->setDataNascimento($_POST['data_nascimento']);
$usuario->setSenha(password_hash($_POST['senha'], PASSWORD_BCRYPT));
$usuario->setRecuperarSenha("");
$usuario->setCpf("");
$usuario->setCep("");
$usuario->setTelefone("");
$usuario->setPontos(0);
$usuario->setNumCupons(0);
$usuario->setIdPlano(1);

$usuarioDAO->Inserir($usuario);




