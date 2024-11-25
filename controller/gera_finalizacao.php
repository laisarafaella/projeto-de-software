<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

include_once '../controller/conexao.php';

// finalização de uma assinatura de plano para um usuário, gerando um extrato e atualizando o plano do usuário no banco


// recupera as informações do plano escolhido pelo usuário - idPlano
$sql = 'SELECT * FROM planos WHERE idPlano = ' . $_SESSION['planoEscolhido'];
$stmt = FabricaConexao::Conexao()->prepare($sql);
$stmt->execute();
$linhas3 = $stmt->fetchAll(PDO::FETCH_CLASS);

$nomePlano = '';

// itera pelos resultados da consulta para ter o nome e o valor
foreach ($linhas3 as $linha) {
    $nomePlano = $linha->nome_plano;
    $valor = $linha->valor_mensal;
}

// adiciona um registro no extrato do usuário

$sql = "INSERT INTO extrato VALUES(DEFAULT,  'Assinatura do Plano: " . $nomePlano . "', '" . $valor . "', 'dinheiro', '" . date('Y-m-d') . "', '" . $_SESSION['id'] . "')";
$stmt = FabricaConexao::Conexao()->prepare($sql);
$stmt->execute();

// atualiza a coluna idPlano_fk na tabela de usuários, associando o plano escolhido ao usuário que está logado
$sql = "UPDATE usuarios SET idPlano_fk = " . $_SESSION['planoEscolhido'] . " WHERE id = " . $_SESSION['id'];
$stmt = FabricaConexao::Conexao()->prepare($sql);
$stmt->execute();

header('Location: ../view/perfil.php');

?>