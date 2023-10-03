<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/config/database.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    var_dump($_POST);

    // Recuperar la materia seleccionada desde el formulario
    $materia_id = $_POST["materia"];
    $alumno_id=$_POST["alumno_id"];


    // Realizar la inserción en la tabla almnos_materias
    try {
        $sql = "INSERT INTO almnos_materias (alumno_id, materia_id) VALUES (:alumno_id, :materia_id)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':alumno_id', $alumno_id, PDO::PARAM_INT);
        $stmt->bindParam(':materia_id', $materia_id, PDO::PARAM_INT);
        $stmt->execute();

        //Redirigir de vuelta a la página anterior
        header("Location: /views/alumno/dashboard.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
