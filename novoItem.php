<?php

//Pagina para iniciar sessão ou registar-se
require_once "template/cabecalio.php";
require_once "SQL/dbObj.php";

//conectar banco--
$bd = new dbObj();
$con = $bd->getConnstring();
?>
<?php

if (isset($_SESSION['login'])) {
?>
    <h1>Novo item</h1>
    <form action="novoItem" method="post" enctype="multipart/form-data" class="cadastro">
        <label for="item">Nome item</label><br>
        <input type="text" name="item">

        <br>
        <label>Categoria</label><br>
        <select name="categoria" class="botao">
           <?php
           $sql = "SELECT * FROM categoria";
           $result = $bd->query($sql);
           
           if(!mysqli_error($bd->con))
           {
               while($row = mysqli_fetch_assoc($result))
               {
                  echo '<option value="'.$row['categoria'].'">'.$row['categoria'].'</option>';
               }
           }
           ?>
           
        </select> <a href="novaCategoria" class="botao">Nova categoria</a>

        <br>

        <label for="descricao">Descrição</label><br>
        <textarea rows="4" cols="50" name="descricao"></textarea>
        <br><br>

        <label for="img" class="botao">Adicione uma Imagem</label><br>
        <input type="file" class="botao" id='img' name="img">

        <br>



        <input type="submit" class="botao">
    </form>
   
    <?PHP

    if (isset($_POST['item']) && isset($_FILES['img']['name'])) {
        if ($_POST['item'] != '' && $_FILES['img']['name'] != '') {
            $sql = "SELECT * FROM usuario as U, item as I where U.login = I.usuario and I.nomeArquivo = '?'";
            $sql = str_replace('?', $_SESSION['login'], $sql);
            $result = $bd->query($sql);
            if (!mysqli_error($bd->con)) {

                if ($result->num_rows == 0) {
                    $destino = 'imgs/' . $_SESSION['login'];
                    if (!file_exists($destino) || !is_dir($destino)) {
                        mkdir($destino);
                    }
                    $destino = $destino . '/' . $_POST['item'] . '.png';

                    $sql = "INSERT INTO item VALUES ('itemNome', 'descricao', 'user', 'categoria', 'destino');";
                    $valores =  array('itemNome' => $_POST['item'], 'descricao' => $_POST['descricao'], 'user' => $_SESSION['login'], 'categoria' => $_POST['categoria'], 'destino' => $destino);
                    $sql = str_replace(array("itemNome", "descricao", "user", 'categoria', 'destino'), $valores, $sql);
                    $bd->query($sql);
                    if (!mysqli_error($bd->con)) {
                        move_uploaded_file($_FILES['img']['tmp_name'], $destino);
    ?>
                        <p>Item inserido com sucesso!</p>
                    <?php
                    } else {
                    ?>
                        <p>Algo deu errado na inserção tente novamente.</p>
    <?php
                    }
                }
            } else {
                echo $sql;
            }
        }
    }
} else {
    ?>
    <h1> Faça o Login para cadastrar itens!<h1>
            <a href="login" class="botao">Login</a>
        <?php
    }
        ?>


        <?php
        require_once "template/rodape.php";
        ?>