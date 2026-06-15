<?php

include("../config/conexion.php");

$sql = "SELECT * FROM galeria";

$resultado = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería - Las Ollitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
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
        }

        body {
            background-color: var(--color-tierra-oscuro);
            font-family: 'Lato', sans-serif;
            color: var(--color-texto);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ─── NAVBAR ─── */
        .navbar {
            background-color: rgba(30, 15, 4, 0.95);
            border-bottom: 3px solid var(--color-dorado);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            color: var(--color-dorado-claro) !important;
            letter-spacing: 1px;
            text-decoration: none;
        }

        .navbar-brand span {
            color: #fff;
            font-weight: 300;
        }

        .btn-volver {
            background: transparent;
            border: 1.5px solid rgba(201,136,42,0.5);
            color: #e8d8c0;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 0.45rem 1.1rem;
            border-radius: 2px;
            text-decoration: none;
            transition: border-color 0.2s, color 0.2s;
        }

        .btn-volver:hover {
            border-color: var(--color-dorado-claro);
            color: var(--color-dorado-claro);
        }

        /* ─── HEADER ─── */
        .page-header {
            text-align: center;
            padding: 4rem 0 2.5rem;
        }

        .page-eyebrow {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--color-dorado);
            margin-bottom: 0.75rem;
        }

        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            color: #fff;
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            font-size: 0.92rem;
            color: rgba(255,255,255,0.4);
            font-weight: 300;
            margin-bottom: 1.5rem;
        }

        .page-divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            max-width: 260px;
            margin: 0 auto;
        }

        .divider-line {
            flex: 1;
            height: 1px;
            background: linear-gradient(to right, transparent, var(--color-dorado));
        }

        .divider-line.reverse {
            background: linear-gradient(to left, transparent, var(--color-dorado));
        }

        .divider-diamond {
            width: 7px;
            height: 7px;
            background: var(--color-dorado);
            transform: rotate(45deg);
            flex-shrink: 0;
        }

        /* ─── GALERÍA ─── */
        .galeria-section {
            padding: 2.5rem 0 5rem;
        }

        .galeria-item {
            overflow: hidden;
            border-radius: 3px;
            border: 1px solid rgba(201,136,42,0.18);
            cursor: zoom-in;
            position: relative;
        }

        .galeria-item img {
            width: 100%;
            height: 260px;
            object-fit: cover;
            display: block;
            transition: transform 0.45s ease;
        }

        .galeria-item::after {
            content: '🔍';
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            background: rgba(78,45,13,0.0);
            transition: background 0.3s;
            pointer-events: none;
        }

        .galeria-item:hover img {
            transform: scale(1.07);
        }

        .galeria-item:hover::after {
            background: rgba(78,45,13,0.45);
        }

        /* ─── LIGHTBOX ─── */
        .lightbox-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(20, 10, 3, 0.92);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            cursor: zoom-out;
        }

        .lightbox-overlay.active {
            display: flex;
        }

        .lightbox-overlay img {
            max-width: 90vw;
            max-height: 85vh;
            object-fit: contain;
            border: 2px solid var(--color-dorado);
            border-radius: 3px;
            box-shadow: 0 0 80px rgba(0,0,0,0.8);
            cursor: default;
        }

        .lightbox-close {
            position: fixed;
            top: 1.5rem;
            right: 2rem;
            color: var(--color-dorado-claro);
            font-size: 2rem;
            font-weight: 300;
            cursor: pointer;
            line-height: 1;
            z-index: 10000;
            background: none;
            border: none;
            padding: 0;
            transition: color 0.2s;
        }

        .lightbox-close:hover {
            color: #fff;
        }

        /* ─── FOOTER ─── */
        footer {
            margin-top: auto;
            background-color: rgba(30, 15, 4, 0.95);
            border-top: 3px solid var(--color-dorado);
            padding: 2rem 0;
        }

        .footer-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            color: var(--color-dorado-claro);
        }

        .footer-copy {
            font-size: 0.78rem;
            color: #7a5c3a;
            margin: 0;
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="../index.php">
                Las <span>Ollitas</span>
            </a>
            <a href="../index.php" class="btn-volver">← Volver al Inicio</a>
        </div>
    </nav>

    <!-- HEADER -->
    <div class="page-header">
        <p class="page-eyebrow">Restaurante Las Ollitas</p>
        <h1 class="page-title">Nuestra Galería</h1>
        <p class="page-subtitle">Momentos, platos y rincones de nuestra cocina</p>
        <div class="page-divider">
            <div class="divider-line"></div>
            <div class="divider-diamond"></div>
            <div class="divider-line reverse"></div>
        </div>
    </div>

    <!-- GALERÍA -->
    <div class="container galeria-section">
        <div class="row g-3">

            <?php while($fila = $resultado->fetch_assoc()){ ?>

            <div class="col-md-4 col-sm-6">
                <div class="galeria-item" onclick="abrirLightbox(this)">
                    <img
                        src="../uploads/<?php echo $fila['imagen']; ?>"
                        alt="Galería Las Ollitas"
                    >
                </div>
            </div>

            <?php } ?>

        </div>
    </div>

    <!-- LIGHTBOX -->
    <div class="lightbox-overlay" id="lightbox" onclick="cerrarLightbox()">
        <button class="lightbox-close" onclick="cerrarLightbox()">✕</button>
        <img id="lightbox-img" src="" alt="Imagen ampliada" onclick="event.stopPropagation()">
    </div>

    <!-- FOOTER -->
    <footer>
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <p class="footer-brand mb-0">Las Ollitas</p>
            <p class="footer-copy">© 2026 Restaurante Las Ollitas — Todos los derechos reservados</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function abrirLightbox(el) {
            const src = el.querySelector('img').src;
            document.getElementById('lightbox-img').src = src;
            document.getElementById('lightbox').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function cerrarLightbox() {
            document.getElementById('lightbox').classList.remove('active');
            document.body.style.overflow = '';
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') cerrarLightbox();
        });
    </script>
</body>
</html>