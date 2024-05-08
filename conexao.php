<?php
// configurações do Banco de Dados
$host = "localhost";
$usuario = "root";
$senha = ""; // se definir senha para o mysql no xampp, insirir aqui
$banco = "teste"; 

// conectar ao banco de dados
$conexao = new mysqli($host, $usuario, $senha, $banco);

// verificar conexão
if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}

?>
