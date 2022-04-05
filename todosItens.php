<?php

//Pagina para iniciar sessão ou registar-se
require_once "template/cabecalio.php";
require_once "SQL/dbObj.php";
?> 
<?php
    
        $bd = new dbObj();
        $con = $bd->getConnstring();
        $sql = "SELECT nomeArquivo, categoria, diretorio, descricao, apelido FROM usuario as U, item as I where U.login = I.usuario ORDER BY U.login;";
        $result = $bd->query($sql);
        $nome = '';
        if(!mysqli_error($bd->con))
        {
            while($row = mysqli_fetch_assoc($result))
            {
                if($row['apelido'] != $nome)
                {
                    echo "<h1>Itens do ".$row['apelido'] .":</h1>";
                    $nome = $row['apelido'];
                }

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

                $nome = $row['apelido'];
            }         
        }

?>


<?php
require_once "template/rodape.php";
?>