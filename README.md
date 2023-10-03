Proyecto Final nivel 3 

en este proyecto hay unos cuantos cambios al diseño y la funcionalidad, que explicare a continuacion:  el correo maesto@maestro tiene como contraseña "lala"

1. las vistas de administrador estan en su mayoria completas, la unica que hace falta es la de "permisos" al ser la menos importante la deje para el final y no me dio tiempo de crearlas. 
2. todos los usuarios Maestros o alumnos son creados con una contraseña default "maestro" para los maestros y "alumno" para los alumnos ellos pueden cambiar su propia contraseña una vez se loguean
3. todas las vistas de admin tienen doble verificacion no solo que haya una sesion iniciada.  
4. en algunas consultas SQL se utilizo el metodo prepare, pero no en todas ya que consumia demasiado tiempo y decidi usar $pdo->query en su lugar pero entiendo que prepare es mas seguro. 
5. las unicas vistas qeu tienen un dashboard son los maestros y el admin.  los alumnos  me parecio una perdida de tiempo ya que no hay mucho que puedan hacer salvo editar sus clases y su perfil por eso mismo se dejo  la mayoria de la info en el dashboard y una sola visa extra para editar su informacion. 
6. en cuanto al diseño se cambio el UI para dejar todas las opciones a la izquierda salvo algunas exepciones en el boton Home y vistas en  maestros.  
7. La base de datos usada para este proyecto esta incluida como dump_database-proyectofinal-,sql.

este fue un gran reto, y aun cuando no esta completo aun di mi mejor esfuerzo espero sea de su agrado.