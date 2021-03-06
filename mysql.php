<?php
    include "./connectbd.php";

    
    if (!(empty($_POST["nome_cliente"]) || empty($_GET['id']))){
        if ($_GET["page"]=="cliente"){
            $sql_update = "UPDATE cliente SET nome_cliente=:nome_cliente, cpf=:cpf, email=:email WHERE id = :id and data_delecao IS NULL;";
            $stmt = $conn->prepare($sql_update);
            $stmt->bindParam(':nome_cliente', $_POST["nome_cliente"]);
            $stmt->bindParam(':cpf', $_POST["cpf"]);
            $stmt->bindParam(':email', $_POST["email"]);
        } else if($_GET["page"]=="produto"){
            $sql_update = "UPDATE produto SET cod_barras=:cod_barras, nome_produto=:nome_produto, valor_produto=:valor_produto WHERE id = :id and data_delecao IS NULL;";
            $stmt = $conn->prepare($sql_update);
            $stmt->bindParam(':cod_barras', $_POST["nome_cliente"]);
            $stmt->bindParam(':nome_produto', $_POST["cpf"]);
            $stmt->bindParam(':valor_produto', $_POST["email"]);
        }
        $stmt->bindParam(':id', $_GET["id"]);
        $stmt->execute();
    } else if (!empty($_POST["nome_cliente"])){
        if ($_GET["page"]=="cliente"){
            $stmt = $conn->prepare("INSERT INTO cliente(nome_cliente, cpf, email) VALUES (:nome_cliente,:cpf,:email);");
            $stmt->bindParam(':nome_cliente', $_POST["nome_cliente"]);
            $stmt->bindParam(':cpf', $_POST["cpf"]);
            $stmt->bindParam(':email', $_POST["email"]);
        } else if($_GET["page"]=="produto"){
            $stmt = $conn->prepare("INSERT INTO produto(cod_barras, nome_produto, valor_produto) VALUES (:cod_barras,:nome_produto,:valor_produto);");
            $stmt->bindParam(':cod_barras', $_POST["nome_cliente"]);
            $stmt->bindParam(':nome_produto', $_POST["cpf"]);
            $stmt->bindParam(':valor_produto', $_POST["email"]);
        }
        $stmt->execute();
    } else if (!empty($_GET["id"])){
        if ($_GET["page"]=="cliente"){
            $stmt = $conn->prepare("UPDATE cliente SET data_delecao=NOW() WHERE id = :id;");
        } else if($_GET["page"]=="produto"){
            $stmt = $conn->prepare("UPDATE produto SET data_delecao=NOW() WHERE id = :id;");
        }
        $stmt->bindParam(':id', $_GET["id"]);
        $stmt->execute();
    }

    if ($_GET["page"]=="cliente"){
        if (empty($_GET["order"])){
            $sql = "SELECT * FROM cliente WHERE data_delecao IS NULL;";
        } else if ($_GET["order"]==1){
            $sql = "SELECT * FROM cliente WHERE data_delecao IS NULL ORDER BY ".$_GET["colunm"]." ASC;";
        } else if ($_GET["order"]==2){
            $sql = "SELECT * FROM cliente WHERE data_delecao IS NULL ORDER BY ".$_GET["colunm"]." DESC;";
        } else if($_GET["order"]==0){
            $sql = "SELECT * FROM cliente WHERE data_delecao IS NULL;";
        }
        
        if (!empty($_POST['pesquisaNome'])){
            $sql = "SELECT * FROM cliente WHERE (".$_POST["colunaNome"]." LIKE '%".$_POST['pesquisaNome']."%' AND data_delecao IS NULL);";
        }

    } else if ($_GET["page"]=="produto") {
        if (empty($_GET["order"])){
            $sql = "SELECT * FROM produto WHERE data_delecao IS NULL;";
        } else if ($_GET["order"]==1){
            $sql = "SELECT * FROM produto WHERE data_delecao IS NULL ORDER BY ".$_GET["colunm"]." ASC;";
        } else if ($_GET["order"]==2){
            $sql = "SELECT * FROM produto WHERE data_delecao IS NULL ORDER BY ".$_GET["colunm"]." DESC;";
        } else if($_GET["order"]==0){
            $sql = "SELECT * FROM produto WHERE data_delecao IS NULL;";
        }

        if (!empty($_POST['pesquisaNome'])){
            $sql = "SELECT * FROM produto WHERE (".$_POST["colunaNome"]." LIKE '%".$_POST['pesquisaNome']."%' AND data_delecao IS NULL);";
        }
    }

    $result = $conn->query($sql);
    $result = $result->fetchAll();

    $conn = null;
?>