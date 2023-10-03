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
    
  
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar_clase</title>
    <link href="/dist/output.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/4baf7d2e5d.js" crossorigin="anonymous"></script>
</head>

<body class="flex h-screen">

    <section class=" h-[100%] w-1/4 bg-[#353a40] flex flex-col  text-white aling-center items-center justify-between ">
        <div class=" flex flex-col w-[90%] h-[100%] justify-center items-center">
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
                <h3>MENU CLASES</h3>
                <div class="flex flex-col">



                    <div>
                        <i class="fa-solid fa-chalkboard"></i>
                        <button><a href="/views/admin/clases.php">Clases</a></button>
                    </div>
                  
                </div>


            </div>







            <div class="mt-auto pb-10">
                <i class="fa-solid fa-right-from-bracket"></i>
                <button><a href="/handledb/logout.php">Logout</a></button>
            </div>

    </section>
    <main class="w-[100%] flex flex-col  ">
        <header class=" flex   justify-between w-[100%] mb-4 items-center">
            <h1 class="text-2xl">Editar clases</h1>
            <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded m-5"><a
                    href="/views/admin/dashboard.php">Home</a></button>
        </header>
        <section class="flex flex-col items-center">
            <?php
            
            
            ?>
            <Form class="flex flex-col" action="/handledb/clases/editar.php" method="POST">
            <?php
            require_once($_SERVER["DOCUMENT_ROOT"] ."/config/database.php");

            $id=$_GET["id"];
            try{
                
            $stmnt=$pdo->query("SELECT * FROM materias WHERE  materia_id = '$id' ");
                if($stmnt->rowCount() === 1 ){
                    $result=$stmnt->fetch(PDO::FETCH_ASSOC);
                    
                    
                }

            }catch (PDOException $e){
                echo" Error: " . $e->getMessage();
            
            }
           
            ?>
            <input type="number" hidden name="materia_id" value="<?=$result["materia_id"]?>">
            <label class="block text-gray-700 text-sm font-bold mb-2" >Cambia el Nombre de la materia</label>
            <input class="border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-blue-500" type="text" name="materia_nombre"
            value="<?=$result["materia_nombre"]?>">
            <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded m-5" type="submit">Guardar</button>

            </Form>
            <button class="btn-back"><a href="/views/admin/Estudiantes.php">Back</a></button>
        </section>
    </main>   



</body>