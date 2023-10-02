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


    require_once($_SERVER["DOCUMENT_ROOT"] ."/config/database.php");

    try {
        
        $pdo->beginTransaction();
    
       
        $usuario_id = $_GET['id']; 
        $sqlDeleteMaestrosMaterias = "DELETE FROM maestros_materias    WHERE maestro_id = :usuario_id";
        $stmntDeleteMaestrosMaterias = $pdo->prepare($sqlDeleteMaestrosMaterias);
        $stmntDeleteMaestrosMaterias->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmntDeleteMaestrosMaterias->execute();
    
       
        $sqlDeleteUsuario = "DELETE FROM usuarios WHERE usuario_id = :usuario_id";
        $stmntDeleteUsuario = $pdo->prepare($sqlDeleteUsuario);
        $stmntDeleteUsuario->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmntDeleteUsuario->execute();
    
        
        $pdo->commit();
    
        header("Location: /views/admin/maestros.php");
    } catch (PDOException $e) {
        
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
    }
    







}

?>