<?php
    include './connectbd.php';

    $sql = "SELECT id, nome_cliente FROM cliente WHERE data_delecao IS NULL;";
    $resultCliente = $conn->query($sql);

    $sql = "SELECT id, nome_produto FROM produto WHERE data_delecao IS NULL;";
    $resultProduto = $conn->query($sql);

    if (is_null($_GET['id'])){
        $botaoCadastro = "Cadastrar";
        $id_cliente = null;
        $id_produto = null;

        $selectAberto="";
        $selectPago="";
        $selectCancelado="";
        
    } else{
        $botaoCadastro = "Alterar";

        $stmt = $conn->prepare("SELECT * FROM pedido WHERE num_pedido = :id and data_delecao IS NULL;");
        $stmt->bindParam(':id', $_GET["id"]);
        $stmt->execute();

        $result = $stmt->fetch();

        $id_cliente = $result['id_cliente'];
        $id_produto = $result['id_produto'];

        if ($result['status_pedido']=="Aberto"){
            $selectAberto="selected";
            $selectPago="";
            $selectCancelado="";
        } else if ($result['status_pedido']=="Pago"){
            $selectAberto="";
            $selectPago="selected";
            $selectCancelado="";
        } else if ($result['status_pedido']=="Cancelado"){
            $selectAberto="";
            $selectPago="";
            $selectCancelado="selected";
        }
        
    }
    

    

    $conn = null;
?>

<html>
    <head>
        <style>
            form{
                display: flex;
                flex-direction: column;
            }
            input{
                margin: 10px;
            }
            select{
                margin: 10px;
            }
            div {
                display: flex;
                flex-direction: column;
                align-items: flex-end;
                margin: 20px 10px;
            }
            a {
                cursor: pointer;
                text-decoration: none;
                color: white;
                padding: 10px;
                font-size: 16px;
                background-color: rebeccapurple;
                border: none;
                border-radius: 8px;
            }
        </style>
    </head>
    <body>
        <div>
            <a href="/index.php?page=pedido">Voltar</a>
        </div>
        <form
            action="./index.php<?php
                if (!is_null($_GET['id'])){
                    echo "?page=pedido&id=".$_GET['id'];
                } else {
                    echo "?page=pedido";
                }
                ?>" 
            method="POST" 
        >
            <select name="nome_cliente" id="nome_cliente" required>
                <?php foreach ($resultCliente as $array){
                    if ($id_cliente == $array["id"]){?>
                        <option value="<?php echo $array["id"];?>" selected="selected"><?php echo $array["nome_cliente"];?></option>
                    <?php } else { ?>
                        <option value="<?php echo $array["id"];?>"><?php echo $array["nome_cliente"];?></option>
                <?php }
                } ?>
            </select>
            <select name="nome_produto" id="nome_produto" required>
                <?php foreach ($resultProduto as $array){
                    if ($id_produto == $array["id"]){?>
                        <option value="<?php echo $array["id"];?>" selected="selected"><?php echo $array["nome_produto"];?></option>
                    <?php } else { ?>
                        <option value="<?php echo $array["id"];?>"><?php echo $array["nome_produto"];?></option>
                <?php }
                }?>
            </select>
            <input name="quantidade" type="number" placeholder="Quantidade" value="<?php echo $result["quantidade"];?>" required>
            <select name="status_pedido" id="status_pedido" required>
                <option value="Aberto" <?php echo $selectAberto;?>>Aberto</option>
                <option value="Pago" <?php echo $selectPago;?>>Pago</option>
                <option value="Cancelado" <?php echo $selectCancelado;?>>Cancelado</option>
            </select>
            <input type="submit" value="<?php echo $botaoCadastro;?>">
        </form>
    </body>
</html>