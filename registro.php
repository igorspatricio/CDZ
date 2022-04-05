
<?php

//Pagina para iniciar sessão ou registar-se
require_once "template/cabecalio.php";
require_once "SQL/dbObj.php";

?> 

<?php
    $formregistro = '
                    <form action="" method="post">
                        <label for="apelido">Apelido</label><br>
                        <input type="text" name="apelido">
                        <br>
                        <label for="login">Login</label><br>
                        <input type="text" name="login">
                        <br>
                        <label for="senha">Senha</label><br>
                        <input type="password" name="senha">
                        <br>
                        <input type="submit" class="botao" value="Registrar">
                        <a href="login.php" class="botao">Voltar</a>            
                    </form>
                    ';
    ?>
    <h1>Registro</h1>
    <?php
    if(!isset($_POST['login']) || !isset($_POST['senha']))
    {
        echo $formregistro;
    }
    else
    {
        if(strlen($_POST['senha']) < 6){echo $formregistro.'<br>Senha deve ter no minio 6 caracters. Tente novamente';}
        else
        {        
            $db = new dbObj();
            $con = $db->getConnstring();
            $sql = "INSERT INTO usuario VALUES ('apelido', 'login', 'senha');";
            $_POST['senha'] =  password_hash($_POST['senha'], PASSWORD_DEFAULT);
            $sql = str_replace(array("apelido", "login", "senha"), $_POST, $sql);
            $db->query($sql);
            if(!mysqli_error($db->con))
            {
                session_destroy();
                session_start();                  
                $_SESSION['login'] = $_POST['login'];
                $_SESSION['nome'] = $_POST['apelido'];
                header('Location: '.'login');
            }
            else
            {
                echo $formregistro.'<br>Usuario ja existente. Tente novamente';
            }
        
        }
    }
?>

<?php
require_once "template/rodape.php";
?>