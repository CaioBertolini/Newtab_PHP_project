<?php
    include './connectbd.php';

    if (!(empty($_POST) || empty($_GET['id']))){
        $sql_update = "UPDATE pedido SET id_cliente=:id_cliente, id_produto=:id_produto, quantidade=:quantidade, status_pedido=:status_pedido WHERE num_pedido = :id and data_delecao IS NULL;";
        $stmt = $conn->prepare($sql_update);
        $stmt->bindParam(':id_cliente', $_POST["nome_cliente"]);
        $stmt->bindParam(':id_produto', $_POST["nome_produto"]);
        $stmt->bindParam(':quantidade', $_POST["quantidade"]);
        $stmt->bindParam(':status_pedido', $_POST["status_pedido"]);
        $stmt->bindParam(':id', $_GET["id"]);
        $stmt->execute();
    } else if (!empty($_POST)){
        $stmt = $conn->prepare("INSERT INTO pedido(id_cliente, id_produto, quantidade, status_pedido) VALUES (:id_cliente ,:id_produto,:quantidade, :status_pedido);");
        $stmt->bindParam(':id_cliente', $_POST["nome_cliente"]);
        $stmt->bindParam(':id_produto', $_POST["nome_produto"]);
        $stmt->bindParam(':quantidade', $_POST["quantidade"]);
        $stmt->bindParam(':status_pedido', $_POST["status_pedido"]);
        $stmt->execute();
    } else if (!empty($_GET["id"])){
        $stmt = $conn->prepare("UPDATE pedido SET data_delecao=NOW() WHERE num_pedido = :id;");
        $stmt->bindParam(':id', $_GET["id"]);
        $stmt->execute();
    }

    $sql = "SELECT pedido.num_pedido, cliente.nome_cliente, produto.nome_produto, pedido.quantidade, pedido.status_pedido
                FROM pedido 
                INNER JOIN cliente ON pedido.id_cliente = cliente.id
                INNER JOIN produto ON pedido.id_produto = produto.id
                WHERE pedido.data_delecao IS NULL;";
    $result = $conn->query($sql);

    $conn=null;
?>

<html>
    <head>
        <style>
            .cadastrar{
                color: white;
                margin: 50px;
                padding: 10px;
                font-size: 16px;
                background-color: green;
                border: none;
                border-radius: 8px;
            }
            a {
                cursor: pointer;
                text-decoration: none;
            }
            table {
                width: 100%;
            }
            tr {
                text-align: center;
            }
            .botaoCadastrar{
                margin-top: 20px;
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>
        <div>
            <div class="botaoCadastrar">
                <a href="./cadastrarpedido.php?page=pedido" class="cadastrar">
                    Cadastrar pedido
                </a>
            </div>
            <div>
                <table>
                    <tr>
                        <th>Cliente</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Status pedido</th>
                        <th>Excluir</th>
                        <th>Alterar</th>
                    </tr>
                    <?php
                        foreach ($result as $array){
                    ?>
                            <tr>
                                <td><?php echo $array["nome_cliente"];?></td>
                                <td><?php echo $array["nome_produto"];?></td>
                                <td><?php echo $array["quantidade"];?></td>
                                <td><?php echo $array["status_pedido"];?></td>
                                <td><a href="./index.php?page=pedido&id=<?php echo $array["num_pedido"];?>">🗑</a></td>
                                <td><a href="./cadastrarpedido.php?page=pedido&id=<?php echo $array["num_pedido"];?>">🖊️</a></td>
                            </tr>
                    <?php    
                        }   
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>