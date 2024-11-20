<?php
include_once "../model/usuario.php";
include_once './DAOUsuario.php';

$usuarioDAO = new DAOUsuario();
$usuario = new Usuario();

$dt = date('Y-m-d', strtotime($_POST['data_nascimento']));
$date = new DateTime($dt);
$interval = $date->diff( new DateTime( date('Y-m-d') ) );
if($interval->format('%Y') >= 18){
    $usuario->setNome($_POST['nome']);
    $usuario->setSobrenome($_POST['sobrenome']);
    $usuario->setEmail($_POST['email']);
    $usuario->setDataNascimento(date('Y-m-d', strtotime($_POST['data_nascimento'])));
    $usuario->setSenha(password_hash($_POST['senha'], PASSWORD_BCRYPT));
    $usuario->setRecuperarSenha("");
    $usuario->setCpf("");
    $usuario->setCep("");
    $usuario->setTelefone(""); 
    $usuario->setPontos(0);
    $usuario->setNumCupons(0);
    $usuario->setIdPlano(1);
    $usuario->setExpiracao("");

    $usuarioDAO->Inserir($usuario);
}
else {
    echo "<script>alert('Por favor, digite uma data de nascimento válida.');window.location.href='../view/cadastro_usuario.php';</script>";
    
}


