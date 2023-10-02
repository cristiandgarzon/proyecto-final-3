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

<body class="flex ">

    <section class="h-screen w-1/4 bg-[#353a40] flex flex-col  text-white  items-center justify-between">
        <div class=" flex flex-col w-[90%] justify-center items-center">
            <div class="flex aling-center items-center text-white p-4    justify-around border-b border-white w-[90%]">
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
                <h3>MENU ADMINISTRACION</h3>
                <div class="flex flex-col">


                    <div>
                        <i class="fa-solid fa-chalkboard-user"></i>
                        <button><a href="/views/admin/maestros.php">Maestros</a></button>
                    </div>
                    
                </div>


            </div>

        </div>





        <div class="pb-10">
            <i class="fa-solid fa-right-from-bracket"></i>
            <button><a href="/handledb/logout.php">Logout</a></button>
        </div>

    </section>
    
    <main class="flex flex-col items-center w-[100%]  h-screen  ">
        <header class=" flex   justify-between  mb-4 items-center w-[100%]">
            <h1 class="text-2xl ml-8 ">Añadir maestros</h1>
            <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded m-5"><a href="/views/admin/dashboard.php">Home</a></button>
        </header>
        <section>
            <form action="/handledb/maestros/crear.php" class="flex flex-col" method="POST">
                <?php $rol=2?>
                <input type="number" hidden value="<?= $rol ?>" name="rol_id">

                <label class="block text-gray-700 text-sm font-bold mb-2" >Correo electronico</label>
                <input class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="email" name="correo" >

                <label class="block text-gray-700 text-sm font-bold mt-2 mb-2">Nombre(s)</label>
                <input class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="nombre">

                <label class="block text-gray-700 text-sm font-bold mt-2 mb-2">Dirección</label>
                <input class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="direccion">

                <label class="block text-gray-700 text-sm font-bold  mt-2 mb-2">Fecha de Nacimiento</label>
                <input class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="YYYY-MM-DD" type="text" name="fecha">

                <label class="block text-gray-700 text-sm font-bold mt-2 mb-2">Clase asignada: </label>
                <select class="border rounded w-full py-2 px-3 mb-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="materia">
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
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Guardar</button>
            </form>
        </section>
    </main>

</body>