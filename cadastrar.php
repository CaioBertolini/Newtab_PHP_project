<?php
    $value1 = "";
    $value2 = "";
    $value3 = "";
    $botaoCadastro = "Cadastrar";

    if ($_GET["page"]=="cliente"){
        $placeH1 = "Nome";
        $placeH2 = "CPF";
        $placeH3 = "Email";

        $tipo1 = "text";
        $tipo2 = "number";
        $tipo3 = "email";

        $step = "";

        if (!empty($_GET["id"])){
            include "./connectbd.php";

            $stmt = $conn->prepare("SELECT * FROM cliente WHERE id = :id and data_delecao IS NULL");
            $stmt->bindParam(':id', $_GET["id"]);
            $stmt->execute();

            $result = $stmt->fetch();

            $value1 = $result["nome_cliente"];
            $value2 = $result["cpf"];
            $value3 = $result["email"];
            $botaoCadastro = "Alterar";

            $conn = null;
        }

    } else if ($_GET["page"]=="produto"){

        $placeH1 = "Código de barras";
        $placeH2 = "Nome do produto";
        $placeH3 = "Valor do produto";

        $tipo1 = "number";
        $tipo2 = "text";
        $tipo3 = "number";

        $step = "step=0.01";

        if (!empty($_GET["id"])){
            include "./connectbd.php";

            $stmt = $conn->prepare("SELECT * FROM produto WHERE id = :id and data_delecao IS NULL");
            $stmt->bindParam(':id', $_GET["id"]);
            $stmt->execute();

            $result = $stmt->fetch();

            $value1 = $result["cod_barras"];
            $value2 = $result["nome_produto"];
            $value3 = $result["valor_produto"];
            $botaoCadastro = "Alterar";

            $conn = null;
        }
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
            <a href="/index.php?page=<?php echo $_GET['page']?>">Voltar</a>
        </div>
        <form
            action="./index.php<?php
                if (!empty($_GET['id'])){
                    echo "?page=".$_GET['page']."&id=".$_GET['id'];
                } else {
                    echo "?page=".$_GET['page'];
                }
                ?>" 
            method="POST" 
        >
            <input name="nome_cliente" type="<?php echo $tipo1;?>" placeholder="<?php echo $placeH1;?>" value="<?php echo $value1;?>" required>
            <input name="cpf" type="<?php echo $tipo2;?>" placeholder="<?php echo $placeH2;?>" value="<?php echo $value2;?>" required>
            <input name="email" <?php echo $step;?> type="<?php echo $tipo3;?>"  placeholder="<?php echo $placeH3;?>" value="<?php echo $value3;?>" required>
            <input type="submit" value="<?php echo $botaoCadastro;?>">
        </form>
    </body>
</html>