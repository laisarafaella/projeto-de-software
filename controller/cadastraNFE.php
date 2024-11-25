<?php
//  associar o usuário que está cadastrando a NFE
session_start();    

// incluindo
include_once "../model/nfe.php";
include_once './DAONfe.php';

// instanciando
$nfeDAO = new DAONfe();
$nfe = new NFE();


// dados recebidos do form pelo metodo POST atribui ao objeto nfe

$nfe->setApelido($_POST['apelido']);
$nfe->setChaveAcesso($_POST['chave']);
$nfe->setCnpj($_POST['cnpj']);
$nfe->setRazaoSocial($_POST['razao']);
$nfe->setDataEmissao(date('Y-m-d', strtotime($_POST['data_emissao'])));
$nfe->setValorTotal($_POST['valor']);


// metodo Inserir: insere a nota no banco com os dados + o id do usuario
$nfeDAO->Inserir($nfe, $_SESSION['id']);
