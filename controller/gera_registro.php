<?php
include_once "../model/usuario.php";
include_once './DAOUsuario.php';

// cria um novo usuário no banco

// instanciando classe
// DAOUsuario - objeto para manipular dados no banco
$usuarioDAO = new DAOUsuario();
// Usuario - objeto representando o modelo de dados de um usuário
$usuario = new Usuario();

// calcula a idade do usuário com base na data de nascimento fornecida
// data convertida em ano - mes - dia
$dt = date('Y-m-d', strtotime($_POST['data_nascimento']));

// intervalo é calculado entre a data atual e a data de nascimento
$date = new DateTime($dt);
$interval = $date->diff( new DateTime( date('Y-m-d') ) );

// se for acima de 18 anos, o cadastro do usuario continua
if($interval->format('%Y') >= 18) {

    // atributos do objeto Usuario com os valores enviados pelo formulário - $_POST

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

    // método Inserir é chamado da classe DAOUsuario para salvar o objeto Usuario no banco
    $usuarioDAO->Inserir($usuario);
}
else {
    echo "<script>alert('Por favor, digite uma data de nascimento válida.');window.location.href='../view/cadastro_usuario.php';</script>";
    
}


