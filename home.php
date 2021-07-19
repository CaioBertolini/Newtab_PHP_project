<?php
    if ($_GET["page"]=="cliente"){
        $nomePagina = "cliente";
    } else if ($_GET["page"]=="produto"){
        $nomePagina = "produto";
    }

    if (is_null($_GET["order"])){
        $tipoOrder = 1;
        $iconOrder = "";
    } else if ($_GET["order"]=="1"){
        $tipoOrder = 2;
        $iconOrder = "⬆";
    } else if ($_GET["order"]=="2"){
        $tipoOrder = 0;
        $iconOrder = "⬇";
    } else if ($_GET["order"]=="0"){
        $tipoOrder = 1;
        $iconOrder = "";
    }
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
                <a href="./cadastrar.php?page=<?php echo $nomePagina?>" class="cadastrar">
                    <?php echo "Cadastrar ".$nomePagina?>
                </a>
            </div>
            <div>
                <table>
                    <?php
                        if ($_GET["page"]=="cliente"){
                    ?>
                        <tr>
                            <th><a href="/index.php?page=cliente&colunm=nome_cliente&order=<?php echo $tipoOrder;?>">Nome <?php if ($_GET["colunm"]=="nome_cliente"){echo $iconOrder;} ?></a></th>
                            <th><a href="/index.php?page=cliente&colunm=cpf&order=<?php echo $tipoOrder;?>">CPF <?php if ($_GET["colunm"]=="cpf"){echo $iconOrder;} ?></a></th>
                            <th><a href="/index.php?page=cliente&colunm=email&order=<?php echo $tipoOrder;?>">Email <?php if ($_GET["colunm"]=="email"){echo $iconOrder;} ?></a></th>
                            <th>Excluir</th>
                            <th>Alterar</th>
                        </tr>
                        <?php
                            foreach ($result as $array){
                        ?>
                                <tr>
                                    <td><?php echo $array["nome_cliente"];?></td>
                                    <td><?php echo $array["cpf"];?></td>
                                    <td><?php echo $array["email"];?></td>
                                    <td><a href="./index.php?<?php echo "page=".$nomePagina."&id=".$array["id"];?>">🗑</a></td>
                                    <td><a href="./cadastrar.php?<?php echo "page=".$nomePagina."&id=".$array["id"];?>">🖊️</a></td>
                                </tr>
                    <?php    
                            }
                        } else if ($_GET["page"]=="produto"){
                    ?>
                        <tr>
                            <th><a href="/index.php?page=produto&colunm=cod_barras&order=<?php echo $tipoOrder;?>">Código de barras <?php if ($_GET["colunm"]=="cod_barras"){echo $iconOrder;} ?></a></th>
                            <th><a href="/index.php?page=produto&colunm=nome_produto&order=<?php echo $tipoOrder;?>">Nome do produto <?php if ($_GET["colunm"]=="nome_produto"){echo $iconOrder;} ?></a></th>
                            <th><a href="/index.php?page=produto&colunm=valor_produto&order=<?php echo $tipoOrder;?>">Valor do Produto <?php if ($_GET["colunm"]=="valor_produto"){echo $iconOrder;} ?></a></th>
                            <th>Excluir</th>
                            <th>Alterar</th>
                        </tr>
                        <?php
                            foreach ($result as $array){
                        ?>
                                <tr>
                                    <td><?php echo $array["cod_barras"];?></td>
                                    <td><?php echo $array["nome_produto"];?></td>
                                    <td><?php echo $array["valor_produto"];?></td>
                                    <td><a href="./index.php?<?php echo "page=".$nomePagina."&id=".$array["id"];?>">🗑</a></td>
                                    <td><a href="./cadastrar.php?<?php echo "page=".$nomePagina."&id=".$array["id"];?>">🖊️</a></td>
                                </tr>
                            <?php }
                        }?>
                        <tr>
                            <td><a href="/index.php?page=<?php echo $_GET["page"]."&offset=" ?><?php if(!is_null($_GET["colunm"])){echo "&colunm=".$_GET["colunm"]."&order=".$tipoOrder;} ?>">⬅️</a></td>
                            <td colspan="3">1 - <?php echo $result->rowCount(); ?></td>
                            <td><a href="/index.php?page=<?php echo $_GET["page"]."&offset=" ?><?php if(!is_null($_GET["colunm"])){echo "&colunm=".$_GET["colunm"]."&order=".$tipoOrder;} ?>">➡️</a></td>
                        </tr>
                </table>
            </div>
        </div>
    </body>
    <script type="text/javascript">
        function orderColuna(){
            <?php
                if ($tipoOrder == 0){
                    $tipoOrder = 1;
                } else if ($tipoOrder == 1){
                    $tipoOrder = 2;
                } else if ($tipoOrder == 2){
                    $tipoOrder = 0;
                }
            ?>
        }
    </script>
</html>