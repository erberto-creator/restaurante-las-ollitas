<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "las_ollitas";

$conn = new mysqli($host, $user, $pass, $db);

if($conn->connect_error){
    die("Error de conexión: " . $conn->connect_error);
}

?>