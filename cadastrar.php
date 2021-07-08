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
        </style>
    </head>
    <body>
        <form action="./index.php" method="POST" >
            <input name="nome_cliente" type="text" placeholder="nome" required>
            <input name="cpf" type="number" placeholder="CPF" required>
            <input name="email" type="email" placeholder="Email" required>
            <input type="submit" value="Cadastrar">
        </form>
    </body>
</html>