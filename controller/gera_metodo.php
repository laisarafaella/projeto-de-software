<?php 
session_start();
include_once "../model/metodo.php";
include_once "./DAOMetodo.php";

$metDAO = new DAOMetodo();
$metodo = new MetodoPagamento();

$tamanho = strlen($_POST['ncartao']);

echo substr($_POST['ncartao'], $tamanho - 4, 4);

$metodo->setApelido($_POST['apelido']);
$metodo->setTitular($_POST['titular']);
$metodo->setNumeroCartao($_POST['ncartao']);
$metodo->setUltimosDigitos(substr($_POST['ncartao'], $tamanho - 4, 4));
$metodo->setDataValidade($_POST['validade']);
$metodo->setCvv($_POST['cvv']);
$metodo->setIdUsuario($_SESSION['id']);

$metDAO->Inserir($metodo);
?>