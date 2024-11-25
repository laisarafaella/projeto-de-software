<?php 
header('Content-Type: text/html; charset=utf-8');
session_start();
include_once '../controller/DAOUsuario.php';
include_once '../controller/conexao.php';


// gerar cupons de desconto, atualizar infos no banco e registrar as ações dos pontos


// lógica para criar cupons - gerarCodigo
class gerarCodigo {
    function geraCodigo() {

        // código aleatório de 24 bytes
        $numero_de_bytes = 24;
        // converte para uma string hexadecimal
        $random = random_bytes($numero_de_bytes);
    
        // transforma em letras maiúsculas
        $codigoCupom = strtoupper(bin2hex($random));

        // adiciona um hífen - após cada bloco de 4 caracteres, mas no final não
        // calculando o comprimento da string
        $tamanho = strlen($codigoCupom);

        // variavel vazia para construir a formatada
        $cupomFinal = "";
    
        for ($i = 1; $i <= $tamanho; $i++) {
            if ($i % 4 == 0 and $i != $tamanho) {
                $cupomFinal .= $codigoCupom[$i - 1] . "-";
            } else {
                $cupomFinal .= $codigoCupom[$i - 1];
            }
        }
    
        // obtém os pontos e o id do plano atual do usuário no banco
        $sql = "SELECT pontos, idPlano_fk FROM usuarios WHERE id = " . $_SESSION['id'];
        $stmt = FabricaConexao::Conexao()->prepare($sql);
        $stmt->execute();
        $linhas = $stmt->fetchAll(PDO::FETCH_NUM);
    
        // retorna resultados como um array e percorre cada linha
        foreach ($linhas as $linha) {
            $pontos = $linha[0];
            $idPlano = $linha[1];
        }

        $apelido = "";

        // definindo o tipo de desconto e o valor
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

        // definindo a validade do cupom de desconto com 30 dias
        $date = new DateTime();
        $date->add(new DateInterval('P30D')); // Add 30 days
        $futureDate = $date->format('Y-m-d'); // Format the date

        // adicionando o cupom que foi gerado no banco
        $sql = "INSERT INTO cupons VALUES(DEFAULT,  '$apelido', '$desconto', '" . date('Y-m-d') . "', '$futureDate', '$cupomFinal', '" . $_SESSION['id'] . "')";
        $stmt = FabricaConexao::Conexao()->prepare($sql);
        $stmt->execute();


        // manipulação de pontos e extrato

        // array com os custos dos pontos para cada tipo de cupom
        $valores = array(200, 300, 450, 520, 700, 800);

        // adiciona um registro na tabela extrato indicando que o usuário gastou pontos para adquirir um cupom
        $sql = "INSERT INTO extrato VALUES(DEFAULT,  'Cupom: $apelido', '". $valores[$_SESSION['idCupom'] - 1] * (-1) ."', 'pontos', '" . date('Y-m-d') . "', '" . $_SESSION['id'] . "')";
        $stmt = FabricaConexao::Conexao()->prepare($sql);
        $stmt->execute();
    
        // dedução de pontos do usuário com base no valor correspondente ao cupom escolhido
        $pontos = $pontos - $valores[$_SESSION['idCupom'] - 1];
        // ex: indice 2 - 1 = 1 e pontos: 500 - 300 = 200
    
        // atualiza a quantidade de pontos do usuário, definindo os pontos restantes na tabela
        $sql = "UPDATE usuarios SET pontos = " . $pontos . " WHERE id = " . $_SESSION['id'];
        $stmt = FabricaConexao::Conexao()->prepare($sql);
        $stmt->execute();
    
        // salvando o cod do cupom na sessao
        $_SESSION['codigoCupom'] = $cupomFinal;
    }
}



?>