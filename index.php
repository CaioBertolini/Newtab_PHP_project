<?php

    $dns = "mysql:host=localhost:3306;dbname=newtab_PHP_project";
    $username = "root";
    $conn = new PDO($dns,$username=$username);
    
    $sql = "SELECT * FROM cliente";

    $result = $conn->query($sql);
    echo json_encode($result->fetchAll());

?>
