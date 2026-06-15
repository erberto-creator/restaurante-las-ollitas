<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
}

include("../../config/conexion.php");

$sql = "SELECT * FROM galeria";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería - Admin Las Ollitas</title>
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

        /* ─── SIDEBAR ─── */
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

        /* ─── MAIN ─── */
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

        /* Page header */
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

        .btn-nueva {
            background: var(--color-tierra-oscuro);
            color: var(--color-dorado-claro);
            border: none;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 0.65rem 1.4rem;
            border-radius: 2px;
            text-decoration: none;
            transition: background 0.2s, transform 0.15s;
        }

        .btn-nueva:hover {
            background: var(--color-tierra);
            color: var(--color-dorado-claro);
            transform: translateY(-1px);
        }

        /* Contador */
        .galeria-meta {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--color-texto-claro);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .galeria-count {
            background: var(--color-crema-oscuro);
            color: var(--color-tierra);
            font-weight: 700;
            padding: 2px 10px;
            border-radius: 20px;
            font-size: 0.68rem;
        }

        /* ─── GRID GALERÍA ─── */
        .galeria-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 1rem;
        }

        .galeria-item {
            background: #fff;
            border: 1px solid rgba(124,74,30,0.1);
            border-radius: 3px;
            overflow: hidden;
            position: relative;
            transition: transform 0.22s, box-shadow 0.22s;
        }

        .galeria-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(78,45,13,0.15);
        }

        .galeria-img-wrapper {
            position: relative;
            overflow: hidden;
        }

        .galeria-img-wrapper img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
            transition: transform 0.4s;
        }

        .galeria-item:hover .galeria-img-wrapper img {
            transform: scale(1.05);
        }

        /* Overlay con acciones */
        .galeria-overlay {
            position: absolute;
            inset: 0;
            background: rgba(78,45,13,0);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.25s;
        }

        .galeria-item:hover .galeria-overlay {
            background: rgba(78,45,13,0.55);
        }

        .galeria-overlay-btn {
            opacity: 0;
            transform: translateY(8px);
            transition: opacity 0.2s, transform 0.2s;
            background: #B91C1C;
            border: none;
            color: #fff;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 0.55rem 1.1rem;
            border-radius: 2px;
            text-decoration: none;
            cursor: pointer;
        }

        .galeria-item:hover .galeria-overlay-btn {
            opacity: 1;
            transform: translateY(0);
        }

        .galeria-overlay-btn:hover {
            background: #991B1B;
            color: #fff;
        }

        /* Footer de la card */
        .galeria-item-footer {
            padding: 0.7rem 0.9rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid rgba(124,74,30,0.07);
        }

        .galeria-item-id {
            font-size: 0.65rem;
            font-family: monospace;
            color: rgba(124,74,30,0.35);
            font-weight: 700;
        }

        .galeria-item-filename {
            font-size: 0.7rem;
            color: var(--color-texto-claro);
            font-weight: 300;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 140px;
        }

        /* Estado vacío */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 4rem 2rem;
            background: #fff;
            border: 1px solid rgba(124,74,30,0.1);
            border-radius: 3px;
        }

        .empty-icon { font-size: 3rem; margin-bottom: 1rem; opacity: 0.35; }

        .empty-titulo {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            color: var(--color-tierra-oscuro);
            margin-bottom: 0.4rem;
        }

        .empty-texto {
            font-size: 0.85rem;
            color: var(--color-texto-claro);
            font-weight: 300;
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
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
            <a href="../platos/index.php" class="sidebar-link">
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
            <a href="index.php" class="sidebar-link active">
                <span class="icon">🖼️</span> Galería
            </a>
            
        </nav>

        <div class="sidebar-footer">
            <a href="../login.php">← Cerrar sesión</a>
        </div>
    </aside>

    <!-- MAIN -->
    <div class="main">

        <div class="topbar">
            <p class="topbar-breadcrumb">Admin / <span>Galería</span></p>
            <p class="topbar-admin">Sesión: <strong><?php echo $_SESSION['admin']; ?></strong></p>
        </div>

        <div class="content">

            <div class="page-head">
                <div>
                    <h1 class="page-head-title">Galería</h1>
                    <p class="page-head-sub">Administra las imágenes del restaurante</p>
                </div>
                <a href="crear.php" class="btn-nueva">+ Nueva Imagen</a>
            </div>

            <?php
            // Recopilar filas para mostrar contador y grid
            $imagenes = [];
            while($fila = $resultado->fetch_assoc()){
                $imagenes[] = $fila;
            }
            ?>

            <div class="galeria-meta">
                Imágenes
                <span class="galeria-count"><?php echo count($imagenes); ?> registros</span>
            </div>

            <div class="galeria-grid">

                <?php if(empty($imagenes)): ?>
                    <div class="empty-state">
                        <div class="empty-icon">🖼️</div>
                        <h3 class="empty-titulo">Sin imágenes</h3>
                        <p class="empty-texto">Agrega la primera imagen a la galería.</p>
                    </div>
                <?php else: ?>
                    <?php foreach($imagenes as $fila): ?>
                    <div class="galeria-item">

                        <div class="galeria-img-wrapper">
                            <img
                                src="../../uploads/<?php echo $fila['imagen']; ?>"
                                alt="Imagen galería #<?php echo $fila['id']; ?>"
                            >
                            <div class="galeria-overlay">
                                <a
                                    href="eliminar.php?id=<?php echo $fila['id']; ?>"
                                    class="galeria-overlay-btn"
                                    onclick="return confirm('¿Eliminar esta imagen?')"
                                >
                                    🗑️ Eliminar
                                </a>
                            </div>
                        </div>

                        <div class="galeria-item-footer">
                            <span class="galeria-item-id">#<?php echo $fila['id']; ?></span>
                            <span class="galeria-item-filename"><?php echo $fila['imagen']; ?></span>
                        </div>

                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>