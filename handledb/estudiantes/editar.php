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
    //var_dump($_POST);
    extract($_POST);
    // echo$nombre;
    // echo$correo;
    // echo$fecha_nacimiento;
    // echo$direccion;
    // echo$rol_id;
    // echo$dni;
    // echo$usuario_id;
    try{

        $stmnt=$pdo->query("UPDATE usuarios SET  correo='$correo', usuario_nombre='$nombre',fecha_nacimientgo='$fecha_nacimiento', direccion='$direccion', role_id='$rol_id', usuario_dni='$dni'WHERE usuario_id = '$usuario_id' ");

        


        header("Location: /views/admin/estudiantes.php");

    }catch (PDOException $e){
        echo" Error: " . $e->getMessage();
    
    }
    



}