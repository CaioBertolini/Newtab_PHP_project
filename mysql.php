<?php

    $dns = "mysql:host=localhost:3306;dbname=newtab_PHP_project";
    $username = "root";

    try{
        $conn = new PDO($dns,$username=$username);

        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
        echo "Conexão falhou, erro:" . $e->getMessage();
    }

    if (!empty($_POST)){
        $stmt = $conn->prepare("INSERT INTO cliente(nome_cliente, cpf, email) VALUES (:nome_cliente,:cpf,:email);");
        $stmt->bindParam(':nome_cliente', $_POST["nome_cliente"]);
        $stmt->bindParam(':cpf', $_POST["cpf"]);
        $stmt->bindParam(':email', $_POST["email"]);
        $stmt->execute();
    }
    
    $sql = "SELECT * FROM cliente";
    $result = $conn->query($sql);

    $conn = null;
?>