<?php

//Pagina para iniciar sessão ou registar-se
require_once "template/cabecalio.php";
require_once "SQL/dbObj.php";
?> 
<?php
    
    if(isset($_SESSION['login']))
    {
        $bd = new dbObj();
        $con = $bd->getConnstring();
        $sql = "SELECT nomeArquivo, categoria, diretorio, descricao FROM usuario as U, item as I where U.login = I.usuario and U.login = '?'";
        $sql = str_replace('?', $_SESSION['login'], $sql);
        $result = $bd->query($sql);
        if(!mysqli_error($bd->con))
        {
            echo "<h1>Seus itens ".$_SESSION['nome'] ." </h1>";
            while($row = mysqli_fetch_assoc($result))
            {
                $nomeitem = $row['nomeArquivo'];
                $tipo = $row['categoria'];
                $imagem = $row['diretorio'];
                $descricao = $row['descricao'];
                $info = '<div class = caixaItem>
                <h2>Item: nomeArquivo</h2>
                <h3>Categoria: categoria</h3>
                <img src="diretorio" alt="">
                <h4>Descrição</h4>
                <p class = "caixaTexto">descricao</p>
                </div>';
                $info = str_replace(array('nomeArquivo', 'categoria', 'diretorio', 'descricao'), $row, $info);
                echo $info;


            }
            
        
        }
        else
        {
            echo '<p>Opa algo deu errado tente novamente</p><br> <a href="login.php" class="botao" >voltar</a>';
        }
    }
    else
    {
        ?>
        <h1> Faça o Login para cadastrar itens!<h1>
        <a href="login" class="botao">Login</a>
        <?php
    }
?>


<?php
require_once "template/rodape.php";
?>
