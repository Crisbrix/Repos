<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "RePOS";

    //Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    //Verificar la conexión
    if($conn->connect_error) {
        die("La conexión a la base de datos falló: " . $conn->connect_error);
    }
?>