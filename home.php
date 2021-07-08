<?php
    if (!empty($_POST)){
        echo $$_POST["nome_cliente"];
    }
?>


<html>
    <head>
        <style>
            a {
                cursor: pointer;
                margin: 20px;
            }
            div {
                margin: 10px;
            }
            table {
                width: 100%;
            }
            tr {
                text-align: left;
            }
        </style>
    </head>
    <body>
        <a href="./cadastrar.php">
            Cadastrar Cliente
        </a>
        <div>
            <table>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Email</th>
                </tr>
                <tr>
                    <?php
                        foreach ($result as $array){
                    ?>
                        <td><?php echo $array["nome_cliente"];?></td>
                        <td><?php echo $array["cpf"];?></td>
                        <td><?php echo $array["email"];?></td>
                    <?php    
                        }
                    ?>
                </tr>
            </table>
        </div>
    </body>
</html>