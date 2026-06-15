<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
}

include("../../config/conexion.php");

$id = $_GET['id'];

// Obtener datos de la categoría antes de eliminar
$sqlGet = "SELECT * FROM categorias WHERE id='$id'";
$resultado = $conn->query($sqlGet);
$fila = $resultado->fetch_assoc();

if(isset($_POST['confirmar'])){

    $sql = "DELETE FROM categorias WHERE id='$id'";

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
    <title>Eliminar Categoría - Admin Las Ollitas</title>
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

        .topbar-breadcrumb span { color: #B91C1C; }

        .topbar-admin {
            font-size: 0.78rem;
            color: var(--color-texto-claro);
            font-weight: 300;
        }

        .topbar-admin strong {
            color: var(--color-tierra-oscuro);
            font-weight: 700;
        }

        .content {
            padding: 2rem 2.5rem 4rem;
            max-width: 560px;
        }

        .page-head { margin-bottom: 2rem; }

        .page-head-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            color: #B91C1C;
        }

        .page-head-sub {
            font-size: 0.78rem;
            color: var(--color-texto-claro);
            font-weight: 300;
            margin-top: 2px;
        }

        /* ─── CONFIRM CARD ─── */
        .confirm-card {
            background: #fff;
            border: 1px solid rgba(185,28,28,0.18);
            border-top: 4px solid #B91C1C;
            border-radius: 3px;
            overflow: hidden;
        }

        .confirm-card-header {
            padding: 1.5rem 1.8rem 1.2rem;
            border-bottom: 1px solid rgba(185,28,28,0.08);
            background: #FFF5F5;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .confirm-icon {
            width: 48px;
            height: 48px;
            background: #FEE2E2;
            border: 1px solid rgba(185,28,28,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            flex-shrink: 0;
        }

        .confirm-header-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            color: #B91C1C;
            margin-bottom: 2px;
        }

        .confirm-header-sub {
            font-size: 0.78rem;
            color: #6B7280;
            font-weight: 300;
        }

        .confirm-card-body {
            padding: 1.8rem;
        }

        /* Fila de datos de la categoría */
        .data-row {
            background: var(--color-crema);
            border: 1px solid rgba(124,74,30,0.12);
            border-radius: 2px;
            padding: 1rem 1.2rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .data-row-label {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--color-texto-claro);
            min-width: 60px;
        }

        .data-row-sep {
            width: 1px;
            height: 28px;
            background: rgba(124,74,30,0.15);
        }

        .data-row-value {
            font-size: 1rem;
            font-weight: 700;
            color: var(--color-tierra-oscuro);
        }

        .data-row-id {
            font-size: 0.78rem;
            font-family: monospace;
            color: rgba(124,74,30,0.4);
            margin-left: auto;
        }

        /* Aviso */
        .aviso {
            background: #FEF2F2;
            border: 1px solid rgba(185,28,28,0.15);
            border-left: 3px solid #B91C1C;
            border-radius: 2px;
            padding: 0.9rem 1rem;
            font-size: 0.82rem;
            color: #7F1D1D;
            font-weight: 400;
            margin-bottom: 1.8rem;
            line-height: 1.6;
        }

        .confirm-actions {
            display: flex;
            gap: 0.75rem;
            align-items: center;
            padding-top: 0.5rem;
            border-top: 1px solid var(--color-crema-oscuro);
        }

        .btn-eliminar {
            background: #B91C1C;
            border: none;
            color: #fff;
            font-family: 'Lato', sans-serif;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            padding: 0.7rem 1.6rem;
            border-radius: 2px;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
        }

        .btn-eliminar:hover {
            background: #991B1B;
            transform: translateY(-1px);
        }

        .btn-cancelar {
            background: transparent;
            border: 1.5px solid rgba(124,74,30,0.2);
            color: var(--color-texto-claro);
            font-family: 'Lato', sans-serif;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            padding: 0.7rem 1.4rem;
            border-radius: 2px;
            text-decoration: none;
            transition: border-color 0.2s, color 0.2s;
        }

        .btn-cancelar:hover {
            border-color: var(--color-dorado);
            color: var(--color-tierra);
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
            <a href="../bebidas/index.php" class="sidebar-link">
                <span class="icon">🥤</span> Bebidas
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
            <a href="../mensajes/index.php" class="sidebar-link">
                <span class="icon">✉️</span> Mensajes
            </a>
        </nav>

        <div class="sidebar-footer">
            <a href="../login.php">← Cerrar sesión</a>
        </div>
    </aside>

    <!-- MAIN -->
    <div class="main">

        <div class="topbar">
            <p class="topbar-breadcrumb">Admin / Categorías / <span>Eliminar</span></p>
            <p class="topbar-admin">Sesión: <strong><?php echo $_SESSION['admin']; ?></strong></p>
        </div>

        <div class="content">

            <div class="page-head">
                <h1 class="page-head-title">Eliminar Categoría</h1>
                <p class="page-head-sub">Esta acción no se puede deshacer</p>
            </div>

            <div class="confirm-card">

                <div class="confirm-card-header">
                    <div class="confirm-icon">🗑️</div>
                    <div>
                        <p class="confirm-header-title">¿Confirmar eliminación?</p>
                        <p class="confirm-header-sub">Revisa los datos antes de continuar</p>
                    </div>
                </div>

                <div class="confirm-card-body">

                    <!-- Datos de la categoría -->
                    <div class="data-row">
                        <span class="data-row-label">Nombre</span>
                        <div class="data-row-sep"></div>
                        <span class="data-row-value"><?php echo $fila['nombre']; ?></span>
                        <span class="data-row-id">#<?php echo $fila['id']; ?></span>
                    </div>

                    <p class="aviso">
                        ⚠️ &nbsp;Al eliminar esta categoría, los platos asociados a ella podrían quedar sin categoría asignada. Verifica antes de continuar.
                    </p>

                    <form method="POST">
                        <div class="confirm-actions">
                            <button type="submit" name="confirmar" class="btn-eliminar">
                                Sí, eliminar
                            </button>
                            <a href="index.php" class="btn-cancelar">Cancelar</a>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>