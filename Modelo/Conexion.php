<?php

$servername = "localhost";
$database = "bdtacoburger";
$username = "root";
$password = "";

// Crea la conexión a la base de datos
$conexion = mysqli_connect($servername, $username, $password, $database);

// Verifica si la conexión es exitosa
if (!$conexion) {
        return "Conexión falló: " . mysqli_connect_error();
}

