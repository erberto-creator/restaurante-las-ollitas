<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
}

include("../../config/conexion.php");

$id = $_GET['id'];

$sql = "DELETE FROM platos WHERE id='$id'";

if($conn->query($sql)){
    header("Location: index.php");
}
?>