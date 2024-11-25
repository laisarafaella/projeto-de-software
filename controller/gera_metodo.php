<?php 
session_start();

// inclui os arquivos que contem a classe e a lógica
include_once "../model/metodo.php";
include_once "./DAOMetodo.php";

// adiciona um método de pagamento ao banco


// instanciando classes
// DAOMetodo - operações no banco relacionadas a métodos de pagamento
$metDAO = new DAOMetodo();
// MetodoPagamento - representa um método de pagamento
$metodo = new MetodoPagamento();


// calcula o total de caracteres do cartão
$tamanho = strlen($_POST['ncartao']);

// extrai os 4 últimos digitos do cartao
echo substr($_POST['ncartao'], $tamanho - 4, 4);

// remove os espaços do numero do cartao
$ncartao = str_replace(' ', '', $_POST['ncartao']);

// configuracao de objeto pegando os valores do POST e a sessao
$metodo->setApelido($_POST['apelido']);
$metodo->setTitular($_POST['titular']);
$metodo->setNumeroCartao($ncartao);
$metodo->setUltimosDigitos(substr($_POST['ncartao'], $tamanho - 4, 4));
$metodo->setDataValidade($_POST['validade']);
$metodo->setCvv($_POST['cvv']);
$metodo->setIdUsuario($_SESSION['id']);

// invoca o metodo Inserir da classe DAOMetodo para salvar os dados no banco
$metDAO->Inserir($metodo);
?>