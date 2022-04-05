<?php

//Pagina para iniciar sessão ou registar-se
require_once "template/cabecalio.php";
require_once "SQL/dbObj.php";
?> 
<?php
    
    if(isset($_SESSION['login']))
    {
        echo '<form action="" method="get">
        <label for="categoria">Nova Categoria</label><br>
        <input type="text" name="categoria">
        <input type="submit" class="botao" value="Adicionar">
        </form>';
    }else{
        echo "Você não deveria estar aqui!";
    }
    if(isset($_GET['categoria']))
    {

        $CATEGORIA = $_GET['categoria'];
        $bd = new dbObj();
        $con = $bd->getConnstring();
        $sql = "SELECT * FROM categoria WHERE categoria like '$CATEGORIA';";
        $result = $bd->query($sql);
        if($result->num_rows == 0)
        {
            $sql = "INSERT INTO categoria values ('$CATEGORIA')";
            $bd->query($sql);
            if(!mysqli_error($bd->con))
            {
                echo "<p>Item inserido com sucesso!</p> <a href='novoItem' class='botao'>Voltar</a>";
            }
        
        }else{
            echo '<p>Categoria existente!</p>';
        }
    }

    

    
?>


<?php
require_once "template/rodape.php";
?>
