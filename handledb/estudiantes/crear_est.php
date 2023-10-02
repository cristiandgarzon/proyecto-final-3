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
    require_once($_SERVER["DOCUMENT_ROOT"] ."/config/database.php");
    $contrasena="estudiante";
    $hashp=password_hash($contrasena,PASSWORD_DEFAULT);
    var_dump($_POST);
    extract($_POST);

    try{
        
     $stmt=$pdo->prepare("INSERT INTO usuarios (correo, contrasena, usuario_nombre, fecha_nacimientgo, direccion, role_id,usuario_dni) VALUES (:correo, :hashp, :nombre, :fecha_nacimiento, :direccion, :rol_id, :dni  )");
     $stmt->bindParam(':correo',$correo,PDO::PARAM_STR);
     $stmt->bindParam(':hashp',$hashp,PDO::PARAM_STR);
     $stmt->bindParam(':nombre',$nombre,PDO::PARAM_STR );
     $stmt->bindParam(':fecha_nacimiento',$fecha_nacimiento,PDO::PARAM_STR );
     $stmt->bindParam(':direccion', $direccion,PDO::PARAM_STR);
     $stmt->bindParam(':rol_id',$rol_id,PDO::PARAM_INT);
     $stmt->bindParam(':dni',$dni, PDO::PARAM_INT);
     $stmt->execute();


     header("Location: /views/admin/Estudiantes.php");

     

    }catch(PDOException $e){
        echo" Error: " . $e->getMessage();
    
    }
}



?>
