<?php

include_once "../model/usuario.php";
include_once '../controller/DAOUsuario.php';
include_once "../controller/conexao.php";

$usuarioDAO = new DAOUsuario();
$usuario = new Usuario();

if (isset($_POST['alterar'])) {
    $usuario->setId($id = $_GET['id']);
    $usuario->setNome($nome = $_POST['nome']);
    $usuario->setSobrenome($nome = $_POST['sobrenome']);
    $usuario->setEmail($nome = $_POST['email']);
    $usuario->setDataNascimento($cpf = $_POST['data_nascimento']);
    $usuarioDAO->Atualizar($usuario);
    header("Location: perfil.php");
}

$ids = (int)$_GET['id'];
$linhas = $usuarioDAO->Localizar($ids);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
</head>

<body>
    <form method="POST">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nome:</label>
            <?php
            foreach ($linhas as $linha) {
                echo '<input type="text" name="nome" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="' . $linha->nome . '">';
                ?>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Sobrenome</label>
                <?php
                echo '<input type="text" name="sobrenome" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="' . $linha->sobrenome . '">';
                ?>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">E-mail</label>
                <?php
                echo '<input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="' . $linha->email . '">';
                ?>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Data de Nascimento:</label>
                <?php
                echo '<input type="text" name="data_nascimento" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="' . $linha->data_nascimento . '">';
            } ?>
        </div>
        <button type="submit" name="alterar" class="btn btn-primary">Alterar</button>
    </form>
</body>

</html>