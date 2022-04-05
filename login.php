
<?php

//Pagina para iniciar sessão ou registar-se
require_once "template/cabecalio.php";
require_once "SQL/dbObj.php";
?> 

<?php 
    $formLogin = '
    <form action="" method="post">
        <label for="login">Login</label><br>
        <input type="text" name="login">
        <br>
        <label for="senha">Senha</label><br>
        <input type="password" name="senha">
        <br>
        <input type="submit" class="botao" value="Entrar">
        <a href="registro.php" class="botao">Registar</a>            
    </form>
    ';
    if(isset($_SESSION['login']))
    {
        ?> 
            <H1>Ola <?php echo $_SESSION['nome']?></H1>
        <?php 
         echo '<a href="template/pedeprasair.php" class = "botao">Sair</a>';

    }else{
        ?> 
        <h1>Login</h1>
        <?php 
        if(!isset($_POST['login']) || !isset($_POST['senha']))
        {
            echo $formLogin;

        }else{
            $bd = new dbObj();
            $con = $bd->getConnstring();
            $sql = "SELECT * FROM `usuario` WHERE `login` = '?';";
            $sql = str_replace('?', $_POST['login'], $sql);
            $result = $bd->query($sql);
            if(!mysqli_error($bd->con))
            {
                if($row = mysqli_fetch_assoc($result)) 
                {           
                    if(password_verify($_POST['senha'], $row['senha']))
                    {  
                        session_destroy();
                        session_start();                  
                        $_SESSION['login'] = $_POST['login'];
                        $_SESSION['nome'] = $row['apelido'];
                        header('Location: '.'index.php');
                    }else{
                        echo $formLogin."<br>Senha errada!";
                    }
                }else{
                    echo $formLogin."<br>Usuario invalido!";
                }
            }
            //echo password_hash($_POST['senha'], PASSWORD_DEFAULT);
            //echo '<br>$2y$10$GLnUAOnbsbed0KYkHz0F3.sHMPjvJbd21LGkxXDLy0gOZkmA65Q0q';
            //print_r($_POST);            
        }
    }
    ?>
<?php
require_once "template/rodape.php";
?>
