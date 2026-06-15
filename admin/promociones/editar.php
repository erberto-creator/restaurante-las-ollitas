<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
}

include("../../config/conexion.php");

$id = $_GET['id'];

$sql = "SELECT * FROM promociones WHERE id='$id'";
$resultado = $conn->query($sql);

$promo = $resultado->fetch_assoc();

if(isset($_POST['actualizar'])){

    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $inicio = $_POST['inicio'];
    $fin = $_POST['fin'];

    if($_FILES['imagen']['name'] != ""){

        $imagen = $_FILES['imagen']['name'];

        $ruta = "../../uploads/" . $imagen;

        move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);

        $update = "UPDATE promociones SET
        titulo='$titulo',
        descripcion='$descripcion',
        fecha_inicio='$inicio',
        fecha_fin='$fin',
        imagen='$imagen'
        WHERE id='$id'";

    }else{

        $update = "UPDATE promociones SET
        titulo='$titulo',
        descripcion='$descripcion',
        fecha_inicio='$inicio',
        fecha_fin='$fin'
        WHERE id='$id'";
    }

    if($conn->query($update)){
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Editar Promoción</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <h1>Editar Promoción</h1>

    <form method="POST" enctype="multipart/form-data">

        <input
            type="text"
            name="titulo"
            class="form-control mb-3"
            value="<?php echo $promo['titulo']; ?>"
            required
        >

        <textarea
            name="descripcion"
            class="form-control mb-3"
            required
        ><?php echo $promo['descripcion']; ?></textarea>

        <input
            type="date"
            name="inicio"
            class="form-control mb-3"
            value="<?php echo $promo['fecha_inicio']; ?>"
            required
        >

        <input
            type="date"
            name="fin"
            class="form-control mb-3"
            value="<?php echo $promo['fecha_fin']; ?>"
            required
        >

        <input
            type="file"
            name="imagen"
            class="form-control mb-3"
        >

        <button
            type="submit"
            name="actualizar"
            class="btn btn-warning"
        >
            Actualizar
        </button>

    </form>

</div>

</body>
</html>