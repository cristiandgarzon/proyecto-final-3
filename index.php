<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://kit.fontawesome.com/4baf7d2e5d.js" crossorigin="anonymous"></script>
    <link href="/dist/output.css" rel="stylesheet">
</head>

<body class="bg-[#fff5d2]">
    <main class="h-screen flex flex-col items-center justify-center">
        <img src="/assest/logo.jpg" alt="logo universidad" class="w-1/3 mb-4 pt-[15rem]">
        <div class="bg-white flex flex-col items-center w-1/3 p-8 mx-auto my-auto  mb-[30rem] rounded-lg border border-gray-300">
            <form action="/handledb/login.php" method="post" class="text-center  flex flex-col">
                <p >Bienvenido Ingresa con tu cuenta</p>
                <div class="relative">
                <i class="fa-solid fa-envelope absolute right-7 top-7"></i>
                <input type="email" name="correo" placeholder="Email"
                class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:border-blue-500 m-3">
                </div>
                
                <div class="relative">
                <i class="fa-solid fa-lock absolute right-7 top-7"></i>
                <input type="password" name="contrasena" placeholder="Password" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:border-blue-500 m-3">
                </div>
                
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-5 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 mb-10">Ingresar</button>
                
                

            </form>

        </div>



    </main>



</body>

</html>