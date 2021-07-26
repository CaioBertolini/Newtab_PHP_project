<?php
    if ($_GET["page"]=="cliente"){
        $nomePagina = "cliente";
    } else if ($_GET["page"]=="produto"){
        $nomePagina = "produto";
    }

    if (empty($_GET["order"])){
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
                            <td colspan="5">
                                <form action="">
                                    <input type="text" name="id" placeholder="Pesquisar">
                                    <select name="colunaNome" id="colunaNome">
                                        <option value="nome_cliente">Nome</option>
                                        <option value="cpf">CPF</option>
                                        <option value="email">Email</option>
                                    </select>
                                    <input type="submit" class="pesquisa" value="🔍">
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <th><a href="/index.php?page=cliente&colunm=nome_cliente&order=<?php echo $tipoOrder;?>">Nome <?php if ($_GET["colunm"]=="nome_cliente"){echo $iconOrder;} ?></a></th>
                            <th><a href="/index.php?page=cliente&colunm=cpf&order=<?php echo $tipoOrder;?>">CPF <?php if ($_GET["colunm"]=="cpf"){echo $iconOrder;} ?></a></th>
                            <th><a href="/index.php?page=cliente&colunm=email&order=<?php echo $tipoOrder;?>">Email <?php if ($_GET["colunm"]=="email"){echo $iconOrder;} ?></a></th>
                            <th>Excluir</th>
                            <th>Alterar</th>
                        </tr>
                        <?php
                            foreach ($result2 as $array){
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
                            <form action="" method="POST">
                                <td colspan="5">
                                    <input type="text" name="id" placeholder="Pesquisar">
                                    <select name="colunaNome" id="colunaNome">
                                        <option value="cod_barras">Código de Barras</option>
                                        <option value="nome_produto">Nome</option>
                                        <option value="valor_produto">Valor</option>
                                    </select>
                                    <input type="submit" value="🔍" class="pesquisa">
                                </td>
                            </form>
                        </tr>
                        <tr>
                            <th><a href="/index.php?page=produto&colunm=cod_barras&order=<?php echo $tipoOrder;?>">Código de barras <?php if ($_GET["colunm"]=="cod_barras"){echo $iconOrder;} ?></a></th>
                            <th><a href="/index.php?page=produto&colunm=nome_produto&order=<?php echo $tipoOrder;?>">Nome do produto <?php if ($_GET["colunm"]=="nome_produto"){echo $iconOrder;} ?></a></th>
                            <th><a href="/index.php?page=produto&colunm=valor_produto&order=<?php echo $tipoOrder;?>">Valor do Produto <?php if ($_GET["colunm"]=="valor_produto"){echo $iconOrder;} ?></a></th>
                            <th>Excluir</th>
                            <th>Alterar</th>
                        </tr>
                        <?php
                            foreach ($result2 as $array){
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
                            <td><a href="/index.php?page=<?php echo $_GET["page"]."&pagina=0"; ?>">⬅️</a></td>
                            <td colspan="3"></td>
                            <td><a href="/index.php?page=<?php echo $_GET["page"]."&pagina=1"; ?>">➡️</a></td>
                        </tr>
                </table>
            </div>
        </div>
    </body>
</html>