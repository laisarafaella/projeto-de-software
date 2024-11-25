<?php

// string de conexao para o banco
define('HOST','mysql:host=localhost;dbname=sportsync;charset=utf8');
define('USER','root');
define('PASSWORD','');

// singleton, permite a criação e compartilhamento de apenas uma instância de conexao com o banco
class FabricaConexao 
{
    // armazena a conexão com o banco de dados
    private static $conn;

    // verificando se a conexao ja foi criada
    public static function Conexao()
    {
        try 
        {
            // se não: cria uma nova conexao, se sim: apenas retorna
            if (!isset(self::$conn)):
                self:: $conn = new PDO(HOST,USER,PASSWORD);
                self:: $conn -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            endif;
                return self::$conn;
        }
        catch (PDOException $e)
        {
            echo "Falha na conexão com o banco de dados." . $e -> getMessage();
            die();
        }
    }
}
?>
