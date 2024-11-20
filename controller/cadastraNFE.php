<?php
session_start();    

include_once "../model/nfe.php";
include_once './DAONfe.php';

$nfeDAO = new DAONfe();
$nfe = new NFE();


$nfe->setApelido($_POST['apelido']);
$nfe->setChaveAcesso($_POST['chave']);
$nfe->setCnpj($_POST['cnpj']);
$nfe->setRazaoSocial($_POST['razao']);
$nfe->setDataEmissao(date('Y-m-d', strtotime($_POST['data_emissao'])));
$nfe->setValorTotal($_POST['valor']);

$nfeDAO->Inserir($nfe, $_SESSION['id']);
