<?php

define('HOST','mysql:host=localhost;dbname=sportsync;charset=utf8');
define('USER','root');
define('PASSWORD','');

class FabricaConexao 
{
    private static $conn;

    public static function Conexao()
    {
        try 
        {
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
