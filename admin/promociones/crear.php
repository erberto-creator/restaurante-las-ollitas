<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
}
include("../../config/conexion.php");

if(isset($_POST['guardar'])){

    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $inicio = $_POST['inicio'];
    $fin = $_POST['fin'];       

    $imagen = $_FILES['imagen']['name'];

    // MEJORA: Validar que el archivo sea una imagen
    $permitidas = ['jpg', 'jpeg', 'png', 'webp'];
    $extension = strtolower(pathinfo($imagen, PATHINFO_EXTENSION));

    if (!in_array($extension, $permitidas)) {
        die("Solo se permiten imágenes JPG, JPEG, PNG y WEBP.");
    }

    $ruta = "../../uploads/" . $imagen;

    move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);

    $sql = "INSERT INTO promociones
    (titulo,descripcion,fecha_inicio,fecha_fin,imagen)
    VALUES
    ('$titulo','$descripcion','$inicio','$fin','$imagen')";

    if($conn->query($sql)){
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Nueva Promoción</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <h1>Nueva Promoción</h1>

    <form method="POST" enctype="multipart/form-data">

        <input
            type="text"
            name="titulo"
            class="form-control mb-3"
            placeholder="Título"
            required
        >

        <textarea
            name="descripcion"
            class="form-control mb-3"
            placeholder="Descripción"
            required
        ></textarea>

        <label>Fecha Inicio</label>

        <input
            type="date"
            name="inicio"
            class="form-control mb-3"
            required
        >

        <label>Fecha Fin</label>

        <input
            type="date"
            name="fin"
            class="form-control mb-3"
            required
        >

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