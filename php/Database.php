<?php

class Database
{
   public  $PDO;

    public function GetConnection()
    {
        try {

            $dsn  = 'mysql:host=localhost; dbname=estimativas';
           // $dsn  = 'mysql:host=localhost; dbname=PainelEstimativa';
            $user = 'root';
            $pass = '';

            //$PDO = new PDO("sqlsrv:server = tcp:177.85.37.184,1433; Database = PainelEstimativa", "painelEstimativa", "Acesso@2018!");
            $PDO = new PDO($dsn, $user, $pass);
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
        }
        catch (PDOException $e) {
            print("Error connecting to SQL Server.");
            die(print_r($e));
            return false;
        }

        return $PDO;
    }


} 
?>