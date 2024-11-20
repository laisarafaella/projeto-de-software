<?php 
header('Content-Type: text/html; charset=utf-8');
session_start();
include_once '../controller/DAOUsuario.php';
include_once '../controller/conexao.php';

class gerarCodigo {
    function geraCodigo() {
        $numero_de_bytes = 24;
        $random = random_bytes($numero_de_bytes);
    
        $codigoCupom = strtoupper(bin2hex($random));
        $tamanho = strlen($codigoCupom);
        $cupomFinal = "";
    
        for ($i = 1; $i <= $tamanho; $i++) {
            if ($i % 4 == 0 and $i != $tamanho) {
                $cupomFinal .= $codigoCupom[$i - 1] . "-";
            } else {
                $cupomFinal .= $codigoCupom[$i - 1];
            }
        }
    
        $sql = "SELECT pontos, idPlano_fk FROM usuarios WHERE id = " . $_SESSION['id'];
        $stmt = FabricaConexao::Conexao()->prepare($sql);
        $stmt->execute();
        $linhas = $stmt->fetchAll(PDO::FETCH_NUM);
    
        foreach ($linhas as $linha) {
            $pontos = $linha[0];
            $idPlano = $linha[1];
        }

        $apelido = "";

        switch ($_SESSION['idCupom']) {
            case 1:
                $apelido = "Desconto de 5%.";
                $desconto = 0.05;
                break;
            case 2:
                $apelido = "Desconto de 7%.";
                $desconto = 0.07;
                break;
            case 3:
                $apelido = "Desconto de 10%.";
                $desconto = 0.1;
                break;
            case 4:
                $apelido = "Desconto de 15%.";
                $desconto = 0.15;
                break;
            case 5:
                $apelido = "Desconto de 20%.";
                $desconto = 0.2;
                break;
            case 6:
                $apelido = "Desconto de 30%.";
                $desconto = 0.3;
                break;
        }

        $date = new DateTime();
        $date->add(new DateInterval('P30D')); // Add 30 days
        $futureDate = $date->format('Y-m-d'); // Format the date

        $sql = "INSERT INTO cupons VALUES(DEFAULT,  '$apelido', '$desconto', '" . date('Y-m-d') . "', '$futureDate', '$cupomFinal', '" . $_SESSION['id'] . "')";
        $stmt = FabricaConexao::Conexao()->prepare($sql);
        $stmt->execute();

        $valores = array(200, 300, 450, 520, 700, 800);
    
        $pontos = $pontos - $valores[$_SESSION['idCupom'] - 1];
    
        $sql = "UPDATE usuarios SET pontos = " . $pontos . " WHERE id = " . $_SESSION['id'];
        $stmt = FabricaConexao::Conexao()->prepare($sql);
        $stmt->execute();
    
        $_SESSION['codigoCupom'] = $cupomFinal;
    }
}



?>