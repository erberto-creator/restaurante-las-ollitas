<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
}

include("../../config/conexion.php");

if(isset($_POST['guardar'])){

    $imagen = $_FILES['imagen']['name'];

    $ruta = "../../uploads/" . $imagen;

    move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);

    $sql = "INSERT INTO galeria(imagen)
    VALUES('$imagen')";

    if($conn->query($sql)){
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Nueva Imagen</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <h1>Nueva Imagen</h1>

    <form method="POST" enctype="multipart/form-data">

        <input
            type="file"
            name="imagen"
            class="form-control mb-3"
            required
        >

        <button
            type="submit"
            name="guardar"
            class="btn btn-success"
        >
            Guardar
        </button>

        <a href="index.php" class="btn btn-secondary">
            Volver
        </a>

    </form>

</div>

</body>
</html>