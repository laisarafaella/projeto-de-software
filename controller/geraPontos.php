<?php
require_once 'conexao.php';
require_once '../model/nfe.php';


// calcular e gerar pontos para um usuário com base em uma compra (NFE), considerando o multiplicador do plano do usuário

class geraPontos
{
    function novosPontos($nfe)
    {
        function getUsuario()
        {
            // recupera o número de pontos atuais e o idPlano_fk do usuário no banco
            $sql = "SELECT pontos, idPlano_fk FROM usuarios WHERE id = " . $_SESSION['id'];
            $stmt = FabricaConexao::Conexao()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_NUM);
        }

        // percorre o resultado da consulta
        $linhas = getUsuario();

        $idPlano = 0;

        // pontos atuais e o plano são armazenados
        foreach ($linhas as $linha) {
            $pontos = $linha[0];
            $idPlano = $linha[1];
        }

        function getMultiplicador($idPlano)
        {
            // recupera o multiplicador associado ao plano do usuário, com base no idPlano 
            $sql = "SELECT multiplicador FROM planos WHERE idPlano = " . $idPlano;
            $stmt = FabricaConexao::Conexao()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_NUM);
        }

        // percorre o resultado da consulta getMultiplicador() e  retorna o multiplicador para o plano do usuário
        $linhas2 = getMultiplicador($idPlano);

        foreach ($linhas2 as $linha2) {
            $multi = $linha2[0];
        }

        // a partir do valor da compra sao atribuidos pontos 1 a cada 10 reais (calcula pontos da compra) +  bônus calculado com o multiplicador do plano do usuário
        $totalPontos = $pontos + round($nfe->getValorTotal() / 10) + round($nfe->getValorTotal() / 10 * $multi);

        // consulta SQL atualiza a coluna pontos na tabela usuarios com o novo valor de $totalPontos
        $sql = "UPDATE usuarios SET pontos = :totalPontos WHERE id = :id";
        $stmt = FabricaConexao::Conexao()->prepare($sql);
        $stmt->bindParam(':totalPontos', $totalPontos, PDO::PARAM_INT);
        $stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
        $stmt->execute();

        // registrando a transação de pontos (ganho) no extrato do usuario e mesmo calculo
        $sql = "INSERT INTO extrato VALUES(DEFAULT,  'Cadastro de NFE', '". round($nfe->getValorTotal() / 10) + round($nfe->getValorTotal() / 10 * $multi) ."', 'pontos', '" . date('Y-m-d') . "', '" . $_SESSION['id'] . "')";
        $stmt = FabricaConexao::Conexao()->prepare($sql);
        $stmt->execute();

        header('Location: ../view/perfil.php');
    }



   
}
?>


<!-- Se eu fiz uma compra 320 reais
10 reais -> 1 ponto
Ou seja, com esta compra, eu consegui 32 pontos.
Porém, se eu sou um cliente com o plano comum, meu multiplicador é de 0.6x
32 * 0.6 = 19 -> 32 + 19 = 51
No final total eu acumulei 51 pontos

Ai quando eu for gerar o cupom
100 pontos -> 10 reais
Supondo que eu tenha 300 pontos, 
eu consigo fazer um cupom de 25 reais sobrando no final 50 pontos -->