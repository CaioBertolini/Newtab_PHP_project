<html>
    <head>
        <style>
            body{
                margin: 20px;
            }
            .cadastrar{
                color: white;
                margin: 20px;
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
            div {
                margin: 10px;
            }
            table {
                width: 100%;
            }
            tr {
                text-align: center;
            }
        </style>
    </head>
    <body>
        <a href="./cadastrar.php" class="cadastrar">
            Cadastrar Cliente
        </a>
        <div>
            <table>
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
                        <td><a href="./index.php?id=<?php echo $array["id"];?>">🗑</a></td>
                        <td><a href="./cadastrar.php?id=<?php echo $array["id"];?>">🖊️</a></td>
                    </tr>
                <?php    
                    }
                ?>
            </table>
        </div>
    </body>
</html>