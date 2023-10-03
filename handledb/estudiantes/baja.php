<?php

if($_SERVER["REQUEST_METHOD"]==="GET"){

var_dump($_GET);
extract($_GET);
require_once($_SERVER["DOCUMENT_ROOT"] ."/config/database.php");
try{

    $stmnt=$pdo->query("DELETE FROM almnos_materias WHERE materia_id='$id' ");


    header("Location: /views/alumno/dashboard.php");



}catch (PDOException $e){
    echo" Error: " . $e->getMessage();

}



}