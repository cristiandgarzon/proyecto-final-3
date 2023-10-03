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
    extract($_POST);

    if(empty($nombre_materia)){
        session_start();
        $_SESSION["Materia_vacia"]=true;
        header("Location: /views/admin/crear_clase.php");


    
    }else{
        try{
    
            var_dump($_POST);
            
            
            $stmt=$pdo->query("INSERT INTO materias (materia_nombre) VALUES ('$nombre_materia')");
        
            
        
        
        
        
            header("Location: /views/admin/clases.php");
        
            }catch(PDOException $e){
                
                if ($e->getCode() === '23000') { 
                    session_start();
                    $_SESSION["Materia_existente"] = true;
                    header("Location: /views/admin/crear_clase.php");
                } else {
                    echo "Error: " . $e->getMessage();
                }
            };

     };

}