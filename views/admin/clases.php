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
                    <div>
                        <i class="fa-solid fa-folder-plus"></i>
                        <button><a href="/views/admin/crear_clase.php">Crear clases</a></button>
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
            <h1 class="text-2xl">Lista de clases</h1>
            <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded m-5"><a
                    href="/views/admin/dashboard.php">Home</a></button>
        </header>
        <section class=" flex w-[100%] aling-center justify-center">

            <table>
                <thead>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Clase
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Maestro
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alumnos
                        inscritos</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones
                    </th>
                </thead>
                <tbody>

                
            
            <?php
               require_once($_SERVER["DOCUMENT_ROOT"] . "/config/database.php");
               

                try{

              $sql = "SELECT
               m.materia_id AS ID_Materia,
               m.materia_nombre AS Nombre_Materia,
               GROUP_CONCAT(DISTINCT ma.usuario_nombre) AS Maestros_Asignados,
               COUNT(DISTINCT aa.alumno_id) AS Numero_Alumnos
               FROM materias AS m
               LEFT JOIN maestros_materias AS mm ON m.materia_id = mm.materia_id
               LEFT JOIN usuarios AS ma ON mm.maestro_id = ma.usuario_id
               LEFT JOIN almnos_materias AS aa ON m.materia_id = aa.materia_id
               GROUP BY m.materia_id, m.materia_nombre";
       
               $stmt = $pdo->prepare($sql);
               $stmt->execute();
               
               
               while($row= $stmt->fetch(PDO::FETCH_ASSOC)){
                
                ?>
                

                <tr>
                <td class="border text-center"><?= $row["ID_Materia"]?></td>
                <td class="border text-center" ><?= $row["Nombre_Materia"]?></td>
                <td class="border text-center <?=($row["Maestros_Asignados"]===NULL)?"bg-red-100":""?>"><?=($row["Maestros_Asignados"]===NULL)?"Sin asignación": $row["Maestros_Asignados"]?></td>
                <td class="border text-center <?=($row["Numero_Alumnos"]===0)?"bg-[#f2c84b]":""?>"><?= ($row["Numero_Alumnos"]===0)?"Sin alumnos":$row["Numero_Alumnos"]?></td>
                <td class="border text-center">
                <a href="/views/admin/editar_clase.php?id=<?=$row["ID_Materia"]?>" class="text-green-400">
                <i class="fa-regular fa-pen-to-square"></i>
                </a>
                <a href="/handledb/clases/delete.php?id=<?=$row["ID_Materia"]?>" class="text-red-500">
                <i class="fa-regular fa-trash-can"></i>
                </a>
                
                </td>
                
                </tr>









                <?php
               }



                }catch (PDOException $e){
                echo" Error: " . $e->getMessage();
        
                }
               ?>
                </tbody>
           </table>
        </section>



    </main>


</body>

</html>