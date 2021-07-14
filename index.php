<html>
    <head>
        <style>
            .divMenu{
                padding: 20px;
                border: 2px solid black;
            }
            a{
                cursor: pointer;
                text-decoration: none;
            }
            .menuPrincipal{
                color: white;
                margin: 5px;
                padding: 10px;
                font-size: 16px;
                background-color: blue;
                border: none;
                border-radius: 8px;
            }
        </style>
    </head>
    <body>
        <div class="divMenu">
            <a class="menuPrincipal" href="/index.php?page=cliente">Clientes</a>
            <a class="menuPrincipal" href="/index.php?page=produto">Produtos</a>
            <a class="menuPrincipal" href="/">Pedidos</a>
        </div>
    </body>
</html>

<?php
    if ($_GET["page"]=="cliente"){
        include "./mysql.php";
        include "./home.php";
    } else if ($_GET["page"]=="produto"){
        include "./mysql.php";
        include "./home.php";
    }
?>