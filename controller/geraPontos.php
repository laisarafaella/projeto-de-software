<?php
require_once 'conexao.php';
require_once '../model/nfe.php';
class geraPontos
{
    function novosPontos($nfe)
    {
        function getUsuario()
        {
            $sql = "SELECT pontos, idPlano_fk FROM usuarios WHERE id = " . $_SESSION['id'];
            $stmt = FabricaConexao::Conexao()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_NUM);
        }

        $linhas = getUsuario();

        $idPlano = 0;

        foreach ($linhas as $linha) {
            $pontos = $linha[0];
            $idPlano = $linha[1];
        }

        function getMultiplicador($idPlano)
        {
            $sql = "SELECT multiplicador FROM planos WHERE idPlano = " . $idPlano;
            $stmt = FabricaConexao::Conexao()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_NUM);
        }

        $linhas2 = getMultiplicador($idPlano);

        foreach ($linhas2 as $linha2) {
            $multi = $linha2[0];
        }

        $totalPontos = $pontos + round($nfe->getValorTotal() / 10) + round($nfe->getValorTotal() / 10 * $multi);

        $sql = "UPDATE usuarios SET pontos = :totalPontos WHERE id = :id";
        $stmt = FabricaConexao::Conexao()->prepare($sql);
        $stmt->bindParam(':totalPontos', $totalPontos, PDO::PARAM_INT);
        $stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
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