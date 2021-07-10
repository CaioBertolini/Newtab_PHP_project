<?php
    include "./connectbd.php";

    
    if (!(empty($_POST) || empty($_GET))){
        $sql_update = "UPDATE cliente SET nome_cliente=:nome_cliente, cpf=:cpf, email=:email WHERE id = :id and data_delecao IS NULL;";
        $stmt = $conn->prepare($sql_update);
        $stmt->bindParam(':nome_cliente', $_POST["nome_cliente"]);
        $stmt->bindParam(':cpf', $_POST["cpf"]);
        $stmt->bindParam(':email', $_POST["email"]);
        $stmt->bindParam(':id', $_GET["id"]);
        $stmt->execute();
    } else if (!empty($_POST)){
        $stmt = $conn->prepare("INSERT INTO cliente(nome_cliente, cpf, email) VALUES (:nome_cliente,:cpf,:email);");
        $stmt->bindParam(':nome_cliente', $_POST["nome_cliente"]);
        $stmt->bindParam(':cpf', $_POST["cpf"]);
        $stmt->bindParam(':email', $_POST["email"]);
        $stmt->execute();
    } else if (!empty($_GET)){
        $stmt = $conn->prepare("UPDATE cliente SET data_delecao=NOW() WHERE id = :id;");
        $stmt->bindParam(':id', $_GET["id"]);
        $stmt->execute();
    }

    
    
    $sql = "SELECT * FROM cliente WHERE data_delecao IS NULL";
    $result = $conn->query($sql);

    $conn = null;
?>