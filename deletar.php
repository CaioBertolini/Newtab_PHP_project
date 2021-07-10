<?php

    $dns = "mysql:host=localhost:3306;dbname=newtab_PHP_project";
    $username = "root";

    try{
        $conn = new PDO($dns,$username=$username);

        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
        echo "Conexão falhou, erro:" . $e->getMessage();
    }
    
    echo $id_user; 
    $stmt = $conn->prepare("DELETE FROM cliente WHERE id = :id");
    $stmt->bindParam(':id', $id_user);
    $stmt->execute();

    $conn = null;
    include "./index.php"
?>