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
if($_SERVER["REQUEST_METHOD"]==="GET"){
    var_dump($_GET);
try{


    require_once($_SERVER["DOCUMENT_ROOT"] ."/config/database.php");
    $pdo->beginTransaction();
    $materia_id = $_GET['id']; 

    $borrarEnMaestros=$pdo->query("DELETE FROM maestros_materias WHERE materia_id='$materia_id'" ); 

    $borrarEnAlumnos=$pdo->query("DELETE FROM almnos_materias WHERE materia_id='$materia_id'");

    $borrarmateria=$pdo->query("DELETE FROM materias WHERE materia_id='$materia_id'");

    $pdo->commit();
    header("Location: /views/admin/clases.php");

} catch (PDOException $e) {
        
    $pdo->rollBack();
    echo "Error: " . $e->getMessage();
}

    






}