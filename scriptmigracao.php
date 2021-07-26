<?php
    include "./connectbd.php";

    echo "<a href='/'>Voltar</a><br>";

    $sql = "SELECT DISTINCT NomeCliente, CPF, Email FROM tabela_velha;";
    $result = $conn->query($sql);
    $result = $result->fetchAll();

    foreach ($result as $array){
        $stmt = $conn->prepare("INSERT INTO cliente(nome_cliente, cpf, email) VALUES (:nome_cliente,:cpf,:email);");
        $stmt->bindParam(':nome_cliente', $array["NomeCliente"]);
        $stmt->bindParam(':cpf', $array["CPF"]);
        $stmt->bindParam(':email', $array["Email"]);
        $stmt->execute();
    }

    $sql = "SELECT DISTINCT CodBarras, NomeProduto, ValorUnitario FROM tabela_velha;";
    $result = $conn->query($sql);
    $result = $result->fetchAll();

    foreach ($result as $array){
        $stmt2 = $conn->prepare("INSERT INTO produto(cod_barras, nome_produto, valor_produto) VALUES (:cod_barras,:nome_produto,:valor_produto);");
        $stmt2->bindParam(':cod_barras', $array["CodBarras"]);
        $stmt2->bindParam(':nome_produto', $array["NomeProduto"]);
        $stmt2->bindParam(':valor_produto', $array["ValorUnitario"]);
        $stmt2->execute();
    }

    $sql = "SELECT tabela_velha.NumeroPedido, cliente.id AS id_cliente, produto.id AS id_produto, tabela_velha.Quantidade
            FROM tabela_velha 
            INNER JOIN cliente ON tabela_velha.NomeCliente = cliente.nome_cliente
            INNER JOIN produto ON tabela_velha.NomeProduto = produto.nome_produto;";

    $result = $conn->query($sql);
    $result = $result->fetchAll();

    $status_pedido = 'Pago';

    foreach ($result as $array){
        $stmt = $conn->prepare("INSERT INTO pedido(num_pedido, id_cliente, id_produto, quantidade, status_pedido) VALUES (:num_pedido, :id_cliente ,:id_produto, :quantidade, :status_pedido);");
        $stmt->bindParam(':num_pedido', $array["NumeroPedido"]);
        $stmt->bindParam(':id_cliente', $array["id_cliente"]);
        $stmt->bindParam(':id_produto', $array["id_produto"]);
        $stmt->bindParam(':quantidade', $array["Quantidade"]);
        $stmt->bindParam(':status_pedido', $status_pedido);
        $stmt->execute();
    }
    
    echo "<span>Migração finalizada com sucesso</span>";

    $conn = null;

?>