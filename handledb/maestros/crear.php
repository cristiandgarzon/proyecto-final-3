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
    $contrasena="maestro";
    $hashp=password_hash($contrasena,PASSWORD_DEFAULT);

    try{
        var_dump($_POST);
        extract($_POST); 
        $pdo->beginTransaction();

        $sqlInsertMaestro="INSERT INTO usuarios (correo, contrasena, usuario_nombre, fecha_nacimientgo, direccion, role_id) VALUES('$correo','$hashp','$nombre','$fecha','$direccion','$rol_id')";

        $pdo->query($sqlInsertMaestro); 

        $maestro_id=$pdo->lastInsertId();

        $sqlInsertarMateria="INSERT INTO maestros_materias (maestro_id, materia_id)
        VALUES ('$maestro_id','$materia')";

        $pdo->query($sqlInsertarMateria);


        

        $pdo->commit();

        
        header("Location: /views/admin/maestros.php");




    }catch (PDOException $e){
        $pdo->rollBack();
        echo" Error: " . $e->getMessage();
    
    }




}
?>