<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
}

include("../../config/conexion.php");

$id = $_GET['id'];

$categorias = $conn->query("SELECT * FROM categorias");

$sql = "SELECT * FROM platos WHERE id='$id'";
$resultado = $conn->query($sql);

$plato = $resultado->fetch_assoc();

if(isset($_POST['actualizar'])){

    $categoria = $_POST['categoria'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    if($_FILES['imagen']['name'] != ""){

        $imagen = $_FILES['imagen']['name'];

        $ruta = "../../uploads/" . $imagen;

        move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);
        $titulo_galeria = $nombre;
        $conn->query("INSERT INTO galeria (imagen, titulo, fecha_subida) 
        VALUES ('$imagen', '$titulo_galeria', NOW())");
        $update = "UPDATE platos SET
        categoria_id='$categoria',
        nombre='$nombre',
        descripcion='$descripcion',
        precio='$precio',
        imagen='$imagen'
        WHERE id='$id'";

    }else{

        $update = "UPDATE platos SET
        categoria_id='$categoria',
        nombre='$nombre',
        descripcion='$descripcion',
        precio='$precio'
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

    <title>Editar Plato</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <h1>Editar Plato</h1>

    <form method="POST" enctype="multipart/form-data">

        <select
            name="categoria"
            class="form-control mb-3"
            required
        >

            <?php while($cat = $categorias->fetch_assoc()){ ?>

            <option
                value="<?php echo $cat['id']; ?>"
                <?php if($cat['id'] == $plato['categoria_id']) echo "selected"; ?>
            >
                <?php echo $cat['nombre']; ?>
            </option>

            <?php } ?>

        </select>

        <input
            type="text"
            name="nombre"
            class="form-control mb-3"
            value="<?php echo $plato['nombre']; ?>"
            required
        >

        <textarea
            name="descripcion"
            class="form-control mb-3"
            required
        ><?php echo $plato['descripcion']; ?></textarea>

        <input
            type="number"
            step="0.01"
            name="precio"
            class="form-control mb-3"
            value="<?php echo $plato['precio']; ?>"
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

        <a href="index.php" class="btn btn-secondary">
            Volver
        </a>

    </form>

</div>

</body>
</html>