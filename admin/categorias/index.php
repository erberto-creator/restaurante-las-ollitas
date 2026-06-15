<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
}

include("../../config/conexion.php");

$sql = "SELECT * FROM categorias";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías - Admin Las Ollitas</title>
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

        .sidebar-nav {
            padding: 1.2rem 0;
            flex: 1;
        }

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
            letter-spacing: 0.5px;
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

        /* Topbar */
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

        /* Content */
        .content {
            padding: 2rem 2.5rem 4rem;
        }

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

        /* Tabla */
        .tabla-card {
            background: #fff;
            border: 1px solid rgba(124,74,30,0.1);
            border-radius: 3px;
            overflow: hidden;
        }

        .tabla-header {
            padding: 1.2rem 1.5rem;
            border-bottom: 1px solid rgba(124,74,30,0.08);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .tabla-header-title {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--color-texto-claro);
        }

        .tabla-count {
            font-size: 0.68rem;
            background: var(--color-crema-oscuro);
            color: var(--color-tierra);
            font-weight: 700;
            padding: 2px 10px;
            border-radius: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead tr {
            background: #FAFAF8;
            border-bottom: 2px solid var(--color-crema-oscuro);
        }

        thead th {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--color-texto-claro);
            padding: 0.9rem 1.5rem;
            text-align: left;
        }

        tbody tr {
            border-bottom: 1px solid rgba(124,74,30,0.07);
            transition: background 0.15s;
        }

        tbody tr:last-child { border-bottom: none; }

        tbody tr:hover { background: var(--color-crema); }

        tbody td {
            padding: 1rem 1.5rem;
            font-size: 0.9rem;
            color: var(--color-texto);
            vertical-align: middle;
        }

        .td-id {
            font-size: 0.75rem;
            font-weight: 700;
            color: rgba(124,74,30,0.35);
            font-family: monospace;
        }

        .td-nombre {
            font-weight: 700;
            color: var(--color-tierra-oscuro);
        }

        .td-acciones {
            display: flex;
            gap: 0.5rem;
        }

        .btn-editar {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 5px 12px;
            border-radius: 2px;
            text-decoration: none;
            background: #FEF3C7;
            color: #92400E;
            border: 1px solid rgba(146,64,14,0.2);
            transition: background 0.15s;
        }

        .btn-editar:hover {
            background: #FDE68A;
            color: #92400E;
        }

        .btn-eliminar {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 5px 12px;
            border-radius: 2px;
            text-decoration: none;
            background: #FEE2E2;
            color: #B91C1C;
            border: 1px solid rgba(185,28,28,0.2);
            transition: background 0.15s;
        }

        .btn-eliminar:hover {
            background: #FECACA;
            color: #B91C1C;
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
            <a href="index.php" class="sidebar-link active">
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

    <!-- MAIN -->
    <div class="main">

        <!-- Topbar -->
        <div class="topbar">
            <p class="topbar-breadcrumb">Admin / <span>Categorías</span></p>
            <p class="topbar-admin">Sesión: <strong><?php echo $_SESSION['admin']; ?></strong></p>
        </div>

        <!-- Content -->
        <div class="content">

            <div class="page-head">
                <div>
                    <h1 class="page-head-title">Categorías</h1>
                    <p class="page-head-sub">Administra las categorías del menú</p>
                </div>
                <a href="crear.php" class="btn-nueva">+ Nueva Categoría</a>
            </div>

            <div class="tabla-card">
                <div class="tabla-header">
                    <span class="tabla-header-title">Listado de categorías</span>
                    <span class="tabla-count" id="conteo">—</span>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th style="width:80px">ID</th>
                            <th>Nombre</th>
                            <th style="width:160px">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-body">

                        <?php
                        $total = 0;
                        while($fila = $resultado->fetch_assoc()){
                            $total++;
                        ?>
                        <tr>
                            <td class="td-id">#<?php echo $fila['id']; ?></td>
                            <td class="td-nombre"><?php echo $fila['nombre']; ?></td>
                            <td>
                                <div class="td-acciones">
                                    <a href="editar.php?id=<?php echo $fila['id']; ?>" class="btn-editar">Editar</a>
                                    <a href="eliminar.php?id=<?php echo $fila['id']; ?>" class="btn-eliminar"
                                       onclick="return confirm('¿Eliminar esta categoría?')">Eliminar</a>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script>
        document.getElementById('conteo').textContent = '<?php echo $total; ?> registros';
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>