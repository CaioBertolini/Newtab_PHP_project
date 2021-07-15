<?php
    if ($_GET["page"]=="cliente"){
        $nomePagina = "cliente";
    } else if ($_GET["page"]=="produto"){
        $nomePagina = "produto";
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
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Email</th>
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
                            <th>Código de barras</th>
                            <th>Nome do produto</th>
                            <th>Valor do Produto</th>
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
                                <?php    
                            }
                        }
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>