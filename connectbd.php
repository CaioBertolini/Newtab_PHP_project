<?php
    $dns = "mysql:host=localhost:3306;dbname=newtab_PHP_project";
    $username = "root";

    try{
        $conn = new PDO($dns,$username=$username);

        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
        echo "Conexão falhou, erro:" . $e->getMessage();
    }
?>