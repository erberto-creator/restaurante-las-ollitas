<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
}

include("../../config/conexion.php");

$categorias = $conn->query("SELECT * FROM categorias");

if(isset($_POST['guardar'])){

    $categoria = $_POST['categoria'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    $imagen = $_FILES['imagen']['name'];

    $ruta = "../../uploads/" . $imagen;

    move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);

    $titulo_galeria = $nombre;
    $conn->query("INSERT INTO galeria (imagen, titulo, fecha_subida) VALUES ('$imagen', '$titulo_galeria', NOW())");

    $sql = "INSERT INTO platos
    (categoria_id,nombre,descripcion,precio,imagen)
    VALUES
    ('$categoria','$nombre','$descripcion','$precio','$imagen')";

    if($conn->query($sql)){
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Producto - Admin Las Ollitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --color-tierra: #7C4A1E;
            --color-tierra-oscuro: #4E2D0D;
            --color-dorado: #C9882A;
            --color-dorado-claro: #F0C060;
            --color-crema: #FAF5EC;
            --color-crema-oscuro: #EFE6D0;
            --color-texto: #2C1A0A;
            --color-texto-claro: #7A5C3A;
            --sidebar-w: 240px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Lato', sans-serif;
            background: #F2EDE4;
            color: var(--color-texto);
            min-height: 100vh;
            display: flex;
        }

        .sidebar {
            width: var(--sidebar-w);
            background: var(--color-tierra-oscuro);
            border-right: 3px solid var(--color-dorado);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
        }

        .sidebar-brand {
            padding: 1.8rem 1.5rem 1.4rem;
            border-bottom: 1px solid rgba(201,136,42,0.2);
        }

        .sidebar-brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            color: var(--color-dorado-claro);
            letter-spacing: 0.5px;
            display: block;
        }

        .sidebar-brand-name span { color: #fff; font-weight: 300; }

        .sidebar-label {
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: rgba(201,136,42,0.5);
            display: block;
            margin-top: 2px;
        }

        .sidebar-nav { padding: 1.2rem 0; flex: 1; }

        .sidebar-section {
            font-size: 0.58rem;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.2);
            padding: 0.8rem 1.5rem 0.4rem;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.65rem 1.5rem;
            font-size: 0.82rem;
            font-weight: 700;
            color: rgba(232,216,192,0.7);
            text-decoration: none;
            transition: background 0.15s, color 0.15s;
            border-left: 3px solid transparent;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            background: rgba(201,136,42,0.1);
            color: var(--color-dorado-claro);
            border-left-color: var(--color-dorado);
        }

        .sidebar-link .icon { font-size: 1rem; width: 20px; text-align: center; }

        .sidebar-footer {
            padding: 1.2rem 1.5rem;
            border-top: 1px solid rgba(201,136,42,0.15);
        }

        .sidebar-footer a {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.3);
            text-decoration: none;
            transition: color 0.2s;
        }

        .sidebar-footer a:hover { color: var(--color-dorado); }

        .main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background: #fff;
            border-bottom: 1px solid rgba(124,74,30,0.1);
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .topbar-breadcrumb {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--color-texto-claro);
        }

        .topbar-breadcrumb span { color: var(--color-dorado); }

        .topbar-admin {
            font-size: 0.78rem;
            color: var(--color-texto-claro);
            font-weight: 300;
        }

        .topbar-admin strong {
            color: var(--color-tierra-oscuro);
            font-weight: 700;
        }

        .content { padding: 2rem 2.5rem 4rem; }

        .page-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-head-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            color: var(--color-tierra-oscuro);
        }

        .page-head-sub {
            font-size: 0.78rem;
            color: var(--color-texto-claro);
            font-weight: 300;
            margin-top: 2px;
        }

        /* ─── FORM CARD ─── */
        .form-card {
            background: #fff;
            border: 1px solid rgba(124,74,30,0.1);
            border-radius: 3px;
            max-width: 640px;
        }

        .form-card-header {
            padding: 1.2rem 1.5rem;
            border-bottom: 1px solid rgba(124,74,30,0.08);
        }

        .form-card-header-title {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--color-texto-claro);
        }

        .form-card-body { padding: 1.8rem 1.5rem; }

        .form-label-custom {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--color-texto-claro);
            display: block;
            margin-bottom: 0.4rem;
        }

        .form-control-custom {
            width: 100%;
            background: var(--color-crema);
            border: 1px solid rgba(124,74,30,0.18);
            border-radius: 2px;
            padding: 0.6rem 0.9rem;
            font-family: 'Lato', sans-serif;
            font-size: 0.88rem;
            color: var(--color-texto);
            outline: none;
            transition: border-color 0.2s;
            margin-bottom: 1.2rem;
        }

        .form-control-custom:focus {
            border-color: var(--color-dorado);
        }

        textarea.form-control-custom {
            resize: vertical;
            min-height: 100px;
        }

        .form-file-label {
            display: block;
            background: var(--color-crema);
            border: 1px dashed rgba(124,74,30,0.3);
            border-radius: 2px;
            padding: 1.2rem;
            text-align: center;
            cursor: pointer;
            margin-bottom: 1.2rem;
            transition: border-color 0.2s, background 0.2s;
        }

        .form-file-label:hover {
            border-color: var(--color-dorado);
            background: var(--color-crema-oscuro);
        }

        .form-file-label span {
            display: block;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--color-texto-claro);
            margin-top: 0.3rem;
        }

        .form-file-label small {
            font-size: 0.68rem;
            color: rgba(124,74,30,0.45);
            font-weight: 300;
        }

        #imagen { display: none; }

        #preview-img {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: 2px;
            margin-bottom: 1.2rem;
            display: none;
            border: 1px solid rgba(124,74,30,0.12);
        }

        .form-divider {
            border: none;
            border-top: 1px solid rgba(124,74,30,0.08);
            margin: 0.4rem 0 1.4rem;
        }

        .btn-guardar {
            background: var(--color-tierra-oscuro);
            color: var(--color-dorado-claro);
            border: none;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 0.7rem 1.6rem;
            border-radius: 2px;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
        }

        .btn-guardar:hover {
            background: var(--color-tierra);
            transform: translateY(-1px);
        }

        .btn-volver {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 0.7rem 1.4rem;
            border-radius: 2px;
            text-decoration: none;
            background: transparent;
            color: var(--color-texto-claro);
            border: 1px solid rgba(124,74,30,0.2);
            transition: background 0.15s;
            margin-left: 0.75rem;
        }

        .btn-volver:hover {
            background: var(--color-crema-oscuro);
            color: var(--color-texto);
        }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="sidebar-brand">
            <span class="sidebar-brand-name">Las <span>Ollitas</span></span>
            <span class="sidebar-label">Panel Admin</span>
        </div>
        <nav class="sidebar-nav">
            <p class="sidebar-section">Principal</p>
            <a href="../dashboard.php" class="sidebar-link">
                <span class="icon">📊</span> Dashboard
            </a>
            <p class="sidebar-section">Gestión</p>
            <a href="index.php" class="sidebar-link active">
                <span class="icon">🍲</span> Platos
            </a>
            <a href="../categorias/index.php" class="sidebar-link">
                <span class="icon">🏷️</span> Categorías
            </a>
            <a href="../promociones/index.php" class="sidebar-link">
                <span class="icon">🎁</span> Promociones
            </a>
            <a href="../reservas/index.php" class="sidebar-link">
                <span class="icon">📅</span> Reservas
            </a>
            <a href="../galeria/index.php" class="sidebar-link">
                <span class="icon">🖼️</span> Galería
            </a>
        </nav>
        <div class="sidebar-footer">
            <a href="../login.php">← Cerrar sesión</a>
        </div>
    </aside>

    <div class="main">

        <div class="topbar">
            <p class="topbar-breadcrumb">Admin / Platos / <span>Nuevo Producto</span></p>
            <p class="topbar-admin">Sesión: <strong><?php echo $_SESSION['admin']; ?></strong></p>
        </div>

        <div class="content">

            <div class="page-head">
                <div>
                    <h1 class="page-head-title">Nuevo Producto</h1>
                    <p class="page-head-sub">Completa los datos para agregar al menú</p>
                </div>
            </div>

            <div class="form-card">

                <div class="form-card-header">
                    <span class="form-card-header-title">Datos del producto</span>
                </div>

                <div class="form-card-body">

                    <form method="POST" enctype="multipart/form-data">

                        <label class="form-label-custom">Categoría</label>
                        <select name="categoria" class="form-control-custom" required>
                            <option value="">Seleccione una categoría</option>
                            <?php while($cat = $categorias->fetch_assoc()){ ?>
                            <option value="<?php echo $cat['id']; ?>">
                                <?php echo $cat['nombre']; ?>
                            </option>
                            <?php } ?>
                        </select>

                        <label class="form-label-custom">Nombre del producto</label>
                        <input
                            type="text"
                            name="nombre"
                            class="form-control-custom"
                            placeholder="Ej: Sopa de maní"
                            required
                        >

                        <label class="form-label-custom">Descripción</label>
                        <textarea
                            name="descripcion"
                            class="form-control-custom"
                            placeholder="Describe brevemente el plato..."
                            required
                        ></textarea>

                        <label class="form-label-custom">Precio (Bs.)</label>
                        <input
                            type="number"
                            step="0.01"
                            name="precio"
                            class="form-control-custom"
                            placeholder="0.00"
                            required
                        >

                        <hr class="form-divider">

                        <label class="form-label-custom">Imagen del plato</label>

                        <img id="preview-img" src="" alt="Vista previa">

                        <label class="form-file-label" for="imagen">
                            📷
                            <span>Seleccionar imagen</span>
                            <small>JPG, PNG o WEBP — se guardará también en galería</small>
                        </label>

                        <input
                            type="file"
                            name="imagen"
                            id="imagen"
                            accept="image/*"
                            required
                            onchange="previewImagen(this)"
                        >

                        <div>
                            <button type="submit" name="guardar" class="btn-guardar">
                                Guardar producto
                            </button>
                            <a href="index.php" class="btn-volver">Volver</a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

    <script>
        function previewImagen(input) {
            const preview = document.getElementById('preview-img');
            if(input.files && input.files[0]){
                const reader = new FileReader();
                reader.onload = e => {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>