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
    
    extract($_POST);

    require_once($_SERVER["DOCUMENT_ROOT"] ."/config/database.php");


    try{

        
        $pdo->beginTransaction();

        $sqlUpdateUser=("UPDATE usuarios SET  correo='$correo', usuario_nombre='$nombre',fecha_nacimientgo='$fecha_nacimiento', direccion='$direccion', role_id='$rol_id' WHERE usuario_id = '$usuario_id' ");

        $pdo->query($sqlUpdateUser);

        $sqlUpateMateria=("UPDATE maestros_materias SET materia_id='$materia' WHERE maestro_id ='$usuario_id'");

        $pdo->query($sqlUpateMateria); 

        $pdo->commit();



        header("Location: /views/admin/maestros.php");

    }catch (PDOException $e){
        $pdo->rollBack();
        echo" Error: " . $e->getMessage();
    
    }















}




?>