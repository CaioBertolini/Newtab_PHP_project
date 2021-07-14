<?php
    $nomeCadastro = "";
    $cpfCadastro = "";
    $emailCadastro = "";
    $botaoCadastro = "Cadastrar";

    if (!empty($_GET)){
        include "./connectbd.php";

        $stmt = $conn->prepare("SELECT * FROM cliente WHERE id = :id and data_delecao IS NULL");
        $stmt->bindParam(':id', $_GET["id"]);
        $stmt->execute();

        $result = $stmt->fetchAll();

        $nomeCadastro = $result[0]["nome_cliente"];
        $cpfCadastro = $result[0]["cpf"];
        $emailCadastro = $result[0]["email"];
        $botaoCadastro = "Alterar";

        $conn = null;
    }
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
        </style>
    </head>
    <body>
        <form 
            action="./index.php<?php
                if (!empty($_GET)){
                    echo "?page=cliente&id=".$_GET['id'];
                } else {
                    echo "?page=cliente";
                }
                ?>" 
            method="POST" 
        >
            <input name="nome_cliente" type="text" placeholder="nome" value="<?php echo $nomeCadastro;?>" required>
            <input name="cpf" type="number" placeholder="CPF" value="<?php echo $cpfCadastro;?>" required>
            <input name="email" type="email" placeholder="Email" value="<?php echo $emailCadastro;?>" required>
            <input type="submit" value="<?php echo $botaoCadastro;?>">
        </form>
    </body>
</html>