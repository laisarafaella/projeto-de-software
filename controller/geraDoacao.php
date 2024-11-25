<?php
session_start();
include_once '../controller/conexao.php';

//  doação de pontos de um usuário para um atleta


// usuario está logado? só pode fazer a doacao se estiver logado
if(!isset($_SESSION['id']) or $_SESSION['id'] == null or $_SESSION['id'] == ''){
    header("Location: ../view/login.php");
} else {
    // recebe o valor do atleta escolhido pelo usuário através de um form -POST
    $atleta = $_POST['athlete'];
    $nomeAtleta = '';
    
    if ($atleta == 1) {
        $nomeAtleta = 'Sofia Pomes';
    } else if ($atleta == 2) {
        $nomeAtleta = 'Paulo Victor';
    } else if ($atleta == 3) {
        $nomeAtleta = 'Gabriella Navarro';
    }
    
    // pontos que o usuário quer doar
    $pontosDoados = $_POST['points'];
    
    // consulta no banco para pegar os pontos atuais do usuário
    $sql = "SELECT pontos FROM usuarios WHERE id = " . $_SESSION['id'];
    $stmt = FabricaConexao::Conexao()->prepare($sql);
    $stmt->execute();
    $linhas = $stmt->fetchAll(PDO::FETCH_NUM);
    
    // percorre os registros retornado
    foreach ($linhas as $linha) {
        $pontos = $linha[0];
    }
    
    // subtraindo os pontos que o usuario deseja doar do total que ele possui
    $pontos -= $pontosDoados;
    
    // atualiza a tabela com o novo valor de pontos do usuario
    $sql = "UPDATE usuarios SET pontos = " . $pontos . " WHERE id = " . $_SESSION['id'];
    $stmt = FabricaConexao::Conexao()->prepare($sql);
    $stmt->execute();
    
    // registro do movimento de doacao no extrato do usuario, saldo negativo
    $sql = "INSERT INTO extrato VALUES(DEFAULT,  'Doou para $nomeAtleta', '" . $pontosDoados * (-1) . "', 'pontos', '" . date('Y-m-d') . "', '" . $_SESSION['id'] . "')";
    $stmt = FabricaConexao::Conexao()->prepare($sql);
    $stmt->execute();

    header("Location: ../view/perfil.php");
}
?>