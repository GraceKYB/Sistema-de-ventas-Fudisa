<?php
$host="localhost";
$nombre_db="fudisa";
$usuario="root";
$contrasenia="";

try{
    $conexion= new PDO("mysql:host=$host;dbname=$nombre_db", $usuario, $contrasenia);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException $ex){
    echo "error a conectar a la base de datos" .$ex->getMessage();


}