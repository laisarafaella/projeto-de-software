<?php
session_start();
require_once '../controller/conexao.php';
include_once "../controller/geraCodigo.php";

$gera = new gerarCodigo();

$sql = "SELECT pontos, idPlano_fk FROM usuarios WHERE id = " . $_SESSION['id'];
$stmt = FabricaConexao::Conexao()->prepare($sql);
$stmt->execute();
$linhas = $stmt->fetchAll(PDO::FETCH_NUM);

foreach ($linhas as $linha) {
    $pontos = $linha[0];
    $idPlano = $linha[1];
}

$valores = array(200, 300, 450, 520, 700, 800);

$_SESSION['idCupom'] = $_POST['gerarCupom'];

if ($pontos < $valores[$_POST['gerarCupom'] - 1]) {
    echo "<script language='javascript' type='text/javascript'>alert('Você não tem pontos suficientes!');window.location.href='./gerar_cupom.php';</script>";
    unset($_SESSION['idCupom']);
}
else {
    if ($_POST['gerarCupom'] == 1 || $_POST['gerarCupom'] == 2) {
        $gera->geraCodigo();
        header('Location: ./cupom.php');
    }
    
    if ($_POST['gerarCupom'] == 3 || $_POST['gerarCupom'] == 4) {
        if ($idPlano >= 2) {
            $gera->geraCodigo();
            header('Location: ./cupom.php');
    
        } else {
            echo "<script language='javascript' type='text/javascript'>alert('Você não pode gerar esse cupom! Faça um upgrade de plano ou gere outro cupom!');window.location.href='./gerar_cupom.php';</script>";
            unset($_SESSION['idCupom']);
        }
    }
    
    if ($_POST['gerarCupom'] == 5 || $_POST['gerarCupom'] == 6) {
        if ($idPlano >= 3) {
            $gera->geraCodigo();
            header('Location: ./cupom.php');
        } else {
            echo "<script language='javascript' type='text/javascript'>alert('Você não pode gerar esse cupom! Faça um upgrade de plano ou gere outro cupom!');window.location.href='./gerar_cupom.php';</script>";
            unset($_SESSION['idCupom']);
        }
    }
}



?>