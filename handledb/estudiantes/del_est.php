<?php
    session_start();
    if(!isset($_SESSION["user_data"])){
        echo"debes iniciar sesion<br>";
        echo"<a href='/index.php'>Login</a>";
        die();

        
    }elseif ($_SESSION["user_data"]["role_id"] !== 1) {
        echo "No eres administrador<br>";
        echo "vuelve a iniciar sesion <br>";
        echo"<a href='/index.php'>Login</a>";

        die();
    }
    
  
?>

<?Php

if($_SERVER["REQUEST_METHOD"]==="GET"){

var_dump($_GET);
extract($_GET);
require_once($_SERVER["DOCUMENT_ROOT"] ."/config/database.php");
try{

    $stmnt=$pdo->query("DELETE FROM usuarios WHERE usuario_id='$id' ");
    header("Location: /views/admin/estudiantes.php");
}catch (PDOException $e){
    echo" Error: " . $e->getMessage();

}

}
