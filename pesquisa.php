<?php

//Pagina para iniciar sessão ou registar-se
require_once "template/cabecalio.php";
require_once "SQL/dbObj.php";
?>
<h1>Pesquisa de itens</h1>
<form action="pesquisa" method="get">
    <label for="apelido">Apelido</label>
    <input type="text" name="apelido">
    <label for="categoria">Categoria</label>
    <input type="text" name="categoria">
    <label for="palavaChave">Palavra chave</label>
    <input type="text" name="palavaChave">

    <input type="submit" value="Pesquisar" class="botao">

</form>
<?php
    if(isset($_GET['apelido']))
    {
        $bd = new dbObj();
        $con = $bd->getConnstring();
        $sql = "SELECT nomeArquivo, categoria, diretorio, descricao, apelido FROM usuario as U, item as I where U.login = I.usuario";
        $sql = $sql." AND ( U.apelido LIKE '%1%' AND I.categoria LIKE '%2%' AND (I.descricao LIKE '%3%' OR I.categoria LIKE '%3%' OR I.nomeArquivo LIKE '%3%')) ORDER BY U.login;";
        $sql = str_replace(array('1', '2', '3'), $_GET, $sql);
        $result = $bd->query($sql);

        if(!mysqli_error($bd->con))
        {
            $nome = '';
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
    }
?>


<?php
require_once "template/rodape.php";
?>