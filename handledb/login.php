<?php
if($_SERVER["REQUEST_METHOD"]==="POST"){
    extract($_POST);
    require_once($_SERVER["DOCUMENT_ROOT"] ."/config/database.php");

    try{

        $stmnt=$pdo->query("SELECT * FROM usuarios WHERE correo = '$correo' ");

        if($stmnt->rowCount() === 1 ){
            $result=$stmnt->fetch(PDO::FETCH_ASSOC);
            
            if(password_verify($contrasena, $result["contrasena"])){
                session_start();
                $_SESSION["user_data"]=$result;
                

                switch($result){
                    case$result["role_id"]===1:
                        
                        header("Location: /views/admin/dashboard.php");
                        break;
                    case$result["role_id"]===2:
                        header("Location: /views/maestro/dashboard.php");
                        break;
                    case$result["role_id"]===3:
                        header("Location: /views/alumno/dashboard.php");
                        break;
                    default:
                    echo"YOU SHALL NOT PASS";
                        break;
                }
                
                
                
                
                
                
                
                
                
                
                // session_start();
                // $_SESSION["user_data"]=$result;
                // var_dump($_SESSION["user_data"]);

            }else{
                echo"contraseña incorrecta";
            
            }


        }else{
            echo"el correo no existe";
        }
    } catch (PDOException $e){
        echo" Error: " . $e->getMessage();
    
    }



}


?>