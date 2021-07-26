<?php
    include './connectbd.php';

    if (!(empty($_POST["nome_cliente"]) || is_null($_GET['id']))){
        $sql_update = "UPDATE pedido SET id_cliente=:id_cliente, id_produto=:id_produto, quantidade=:quantidade, status_pedido=:status_pedido WHERE num_pedido = :id and data_delecao IS NULL;";
        $stmt = $conn->prepare($sql_update);
        $stmt->bindParam(':id_cliente', $_POST["nome_cliente"]);
        $stmt->bindParam(':id_produto', $_POST["nome_produto"]);
        $stmt->bindParam(':quantidade', $_POST["quantidade"]);
        $stmt->bindParam(':status_pedido', $_POST["status_pedido"]);
        $stmt->bindParam(':id', $_GET["id"]);
        $stmt->execute();
    } else if (!empty($_POST["nome_cliente"])){
        $stmt = $conn->prepare("INSERT INTO pedido(id_cliente, id_produto, quantidade, status_pedido) VALUES (:id_cliente ,:id_produto,:quantidade, :status_pedido);");
        $stmt->bindParam(':id_cliente', $_POST["nome_cliente"]);
        $stmt->bindParam(':id_produto', $_POST["nome_produto"]);
        $stmt->bindParam(':quantidade', $_POST["quantidade"]);
        $stmt->bindParam(':status_pedido', $_POST["status_pedido"]);
        $stmt->execute();
    } else if (!is_null($_GET["id"])){
        $stmt = $conn->prepare("UPDATE pedido SET data_delecao=NOW() WHERE num_pedido = :id;");
        $stmt->bindParam(':id', $_GET["id"]);
        $stmt->execute();
    }

    if (is_null($_GET["order"])){
        $tipoOrder = 1;
        $iconOrder = "";
        $sql = "SELECT pedido.num_pedido, cliente.nome_cliente, produto.nome_produto, pedido.quantidade, pedido.status_pedido
                FROM pedido 
                INNER JOIN cliente ON pedido.id_cliente = cliente.id
                INNER JOIN produto ON pedido.id_produto = produto.id
                WHERE pedido.data_delecao IS NULL;";
    } else if ($_GET["order"]=="1"){
        $tipoOrder = 2;
        $iconOrder = "⬆";
        $sql = "SELECT pedido.num_pedido, cliente.nome_cliente, produto.nome_produto, pedido.quantidade, pedido.status_pedido
                FROM pedido 
                INNER JOIN cliente ON pedido.id_cliente = cliente.id
                INNER JOIN produto ON pedido.id_produto = produto.id
                WHERE pedido.data_delecao IS NULL ORDER BY ".$_GET["colunm"]." ASC;";
    } else if ($_GET["order"]=="2"){
        $tipoOrder = 0;
        $iconOrder = "⬇";
        $sql = "SELECT pedido.num_pedido, cliente.nome_cliente, produto.nome_produto, pedido.quantidade, pedido.status_pedido
                FROM pedido 
                INNER JOIN cliente ON pedido.id_cliente = cliente.id
                INNER JOIN produto ON pedido.id_produto = produto.id
                WHERE pedido.data_delecao IS NULL ORDER BY ".$_GET["colunm"]." DESC;";
    } else if ($_GET["order"]=="0"){
        $tipoOrder = 1;
        $iconOrder = "";
        $sql = "SELECT pedido.num_pedido, cliente.nome_cliente, produto.nome_produto, pedido.quantidade, pedido.status_pedido
                FROM pedido 
                INNER JOIN cliente ON pedido.id_cliente = cliente.id
                INNER JOIN produto ON pedido.id_produto = produto.id
                WHERE pedido.data_delecao IS NULL;";
    }

    if (!empty($_POST['pesquisaNome'])){
        $sql = "SELECT pedido.num_pedido, cliente.nome_cliente, produto.nome_produto, pedido.quantidade, pedido.status_pedido
                FROM pedido 
                INNER JOIN cliente ON pedido.id_cliente = cliente.id
                INNER JOIN produto ON pedido.id_produto = produto.id
                WHERE (".$_POST["colunaNome"]." LIKE '%".$_POST['pesquisaNome']."%' AND pedido.data_delecao IS NULL);";
    }

    $result = $conn->query($sql);
    $result = $result->fetchAll();

    $maxPagina = count($result)/5;
    
    if (empty($_GET["pagina"])){
        $numPagina = 0;
    } else if ($_GET["pagina"]=="0" and $numPagina>1){
        $numPagina = $numPagina - 1;
    } else if ($_GET["pagina"]=="1" and $numPagina<$maxPagina){
        $numPagina = $numPagina + 1;
    }
    
    $result2 = array_chunk($result,20)[$numPagina];

    if (empty($result2)){
        $result2 = array_chunk($result,20)[$numPagina-1];
    }

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
            input {
                width: 20%;
                height: 30px;
                border: 1px solid black;
                border-radius: 20px;
                margin: 20px;
            }
            .pesquisa{
                width: 30px;
                border-radius: 10px;
                cursor: pointer;
                margin-left: 10px;
            }
            select{
                width: 130px;
                height: 30px;
                border-radius: 10px;
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
                        <td colspan="6">
                            <form action="/index.php?page=pedido" method="POST">
                                <input type="text" name="pesquisaNome" placeholder="Pesquisar">
                                <select name="colunaNome">
                                    <option value="cliente.nome_cliente">Cliente</option>
                                    <option value="produto.nome_produto">Produto</option>
                                    <option value="pedido.quantidade">Quantidade</option>
                                    <option value="pedido.status_pedido">Status pedido</option>
                                </select>
                                <input type="submit" class="pesquisa" value="🔍">
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <th><a href="/index.php?page=pedido&colunm=nome_cliente&order=<?php echo $tipoOrder;?>">Cliente <?php if ($_GET["colunm"]=="nome_cliente"){echo $iconOrder;} ?></a></th>
                        <th><a href="/index.php?page=pedido&colunm=nome_produto&order=<?php echo $tipoOrder;?>">Produto <?php if ($_GET["colunm"]=="nome_produto"){echo $iconOrder;} ?></a></th>
                        <th><a href="/index.php?page=pedido&colunm=quantidade&order=<?php echo $tipoOrder;?>">Quantidade <?php if ($_GET["colunm"]=="quantidade"){echo $iconOrder;} ?></a></th>
                        <th><a href="/index.php?page=pedido&colunm=status_pedido&order=<?php echo $tipoOrder;?>">Status pedido <?php if ($_GET["colunm"]=="status_pedido"){echo $iconOrder;} ?></a></th>
                        <th>Excluir</th>
                        <th>Alterar</th>
                    </tr>
                    <?php
                        foreach ($result2 as $array){
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
                    <tr>
                        <td><a href="/index.php?page=pedido&pagina=0">⬅️</a></td>
                        <td colspan="4"></td>
                        <td><a href="/index.php?page=pedido&pagina=1">➡️</a></td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>