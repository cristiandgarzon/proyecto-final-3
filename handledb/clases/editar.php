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
<?php
if($_SERVER["REQUEST_METHOD"]==="POST"){
    var_dump($_POST);
    
    extract($_POST);

    require_once($_SERVER["DOCUMENT_ROOT"] ."/config/database.php");


    try{

        
        

        $stmt=$pdo->query("UPDATE materias SET   materia_nombre='$materia_nombre' WHERE materia_id = '$materia_id' ");



        header("Location: /views/admin/clases.php");

    }catch (PDOException $e){
        $pdo->rollBack();
        echo" Error: " . $e->getMessage();
    
    }
}
