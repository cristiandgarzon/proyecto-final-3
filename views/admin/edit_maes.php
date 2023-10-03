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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin_dashboard</title>
    <link href="/dist/output.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/4baf7d2e5d.js" crossorigin="anonymous"></script>
</head>

<body class="flex">

    <section class="h-screen w-1/4 bg-[#353a40] flex flex-col  text-white aling-center items-center justify-between">
        <div class=" flex flex-col w-[90%] justify-center items-center">
            <div class="flex aling-center items-center text-white p-4 justify-around border-b border-white w-[80%]">
                <div class="bg-[url('/assest/logo.jpg')] bg-cover bg-center rounded-full w-10 h-10">

                </div>

                <h2>Universidad</h2>
            </div>
            <?php
        require_once($_SERVER["DOCUMENT_ROOT"] ."/config/database.php");

        try{
            //var_dump($_SESSION["user_data"]);
            $id=$_SESSION["user_data"]['usuario_id'];
            
            $stmnt=$pdo->prepare('SELECT usuarios.*, roles.role_nombre AS nombre_rol FROM usuarios JOIN roles ON  usuarios.role_id = rol_id WHERE usuarios.usuario_id =:id ');
            $stmnt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmnt->execute();

            $result=$stmnt->fetch(PDO::FETCH_ASSOC);
            //var_dump($result);
            $rol=$result["nombre_rol"];
            $nonmbre=$result["usuario_nombre"];
            
            //var_dump($rol);

        }catch (PDOException $e){
            echo" Error: " . $e->getMessage();
        
        }
        ?>
            <div>
                <h2><?=$rol?></h2>
                <h3><?=$nonmbre?></h3>
            </div>
            <div class="flex flex-col border-t-2">
                <h3>MENU MAESTROS</h3>
                <div class="flex flex-col">


                    <div>
                        <i class="fa-solid fa-chalkboard-user"></i>
                        <button><a href="/views/admin/maestros.php">Lista</a></button>
                    </div>


                </div>


            </div>

        </div>





        <div class="pb-10">
            <i class="fa-solid fa-right-from-bracket"></i>
            <button><a href="/handledb/logout.php">Logout</a></button>
        </div>

    </section>

    <section class="flex  flex-col justify-center items-center h-screen  pl-72">
    <button class="btn-primary"><a href="/views/admin/dashboard.php">Home</a></button>
    <div>
        
    </div>
        <form action="/handledb/maestros/edit.php" method="POST" class="flex flex-col">
            <?php
            require_once($_SERVER["DOCUMENT_ROOT"] ."/config/database.php");
            $id=$_GET["id"];
            try{
                
            $stmnt=$pdo->query("SELECT * FROM usuarios WHERE  usuario_id = '$id' ");
                if($stmnt->rowCount() === 1 ){
                    $result=$stmnt->fetch(PDO::FETCH_ASSOC);
                    

                }

            }catch (PDOException $e){
                echo" Error: " . $e->getMessage();
            
            }
           
            ?>

            <?php $rol=2; $usuario_id=$result["usuario_id"];?>


            <input type="number" hidden value="<?= $rol ?>" name="rol_id">
            <input type="number" hidden value="<?=$usuario_id?>" name="usuario_id">



            <Label>Correo electronico</Label>
            <input type="email" name="correo"
                class="border rounded py-2 px-4 focus:outline-none focus:ring focus:border-blue-500"
                value='<?=$result["correo"]?>'>

            <Label>Nombre(s)</Label>
            <input type="text" name="nombre"
                class="border rounded py-2 px-4 focus:outline-none focus:ring focus:border-blue-500"
                value='<?=$result["usuario_nombre"]?>'>



            <Label>Dirección</Label>
            <input type="text" name="direccion"
                class="border rounded py-2 px-4 focus:outline-none focus:ring focus:border-blue-500"
                value='<?=$result["direccion"]?>'>

            <Label>Fecha de nacimiento</Label>
            <input type="reversedate" name="fecha_nacimiento"
                class="border rounded py-2 px-4 focus:outline-none focus:ring focus:border-blue-500 mb-4"
                placeholder="YYYY-MM-DD" value='<?=$result["fecha_nacimientgo"]?>'>

            <select
                class="border rounded w-full py-2 px-3 mb-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                name="materia">
                <?php
                    require_once($_SERVER["DOCUMENT_ROOT"] ."/config/database.php");

                    $stmnt=$pdo->query(
                    "SELECT m.materia_id, m.materia_nombre FROM materias m LEFT JOIN maestros_materias mm ON m.materia_id=mm.materia_id WHERE mm.materia_id IS NULL; 
                    
                    "); 
                    while ($row = $stmnt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option  value="' . $row['materia_id'] . '">' . $row['materia_nombre'] . '</option>';
                    }
                    
                    ?>
            </select>

            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">Guardar</button>
        </form>

        

        <button><a href="/views/admin/maestros.php">Back</a></button>
    </section>



</body>

</html>