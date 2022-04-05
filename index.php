<?php

//Pagina para iniciar sessão ou registar-se
require_once "template/cabecalio.php";
require_once "SQL/dbObj.php";
?> 
<?php
    
    if(isset($_SESSION['login']))
    {
        echo $_SESSION['login'];
    }
?>


<?php
require_once "template/rodape.php";
?>