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
    $hashp=password_hash($contrasena,PASSWORD_DEFAULT);

    require_once($_SERVER["DOCUMENT_ROOT"] ."/config/database.php");

    try{


        $sqlUpdateUser=("UPDATE usuarios SET  correo='$correo', contrasena='$hashp', usuario_nombre='$nombre',fecha_nacimientgo='$fecha', direccion='$direccion'WHERE usuario_id = '$user_id' ");

        $pdo->query($sqlUpdateUser);


        header("Location: /views/alumno/dashboard.php");

    }catch (PDOException $e){
        
        echo" Error: " . $e->getMessage();
    
    }
}