<?php

include("../config/conexion.php");

$sql = "SELECT * FROM promociones
WHERE NOW() BETWEEN fecha_inicio AND fecha_fin";

$resultado = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promociones - Las Ollitas</title>
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
            --color-rojo: #8B2012;
            --color-rojo-claro: #C0392B;
        }

        body {
            background-color: var(--color-crema);
            font-family: 'Lato', sans-serif;
            color: var(--color-texto);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ─── NAVBAR ─── */
        .navbar {
            background-color: var(--color-tierra-oscuro);
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
            background-color: var(--color-rojo);
            background-image:
                radial-gradient(ellipse at 75% 25%, rgba(240,192,96,0.18) 0%, transparent 55%),
                radial-gradient(ellipse at 15% 75%, rgba(80,10,5,0.5) 0%, transparent 50%);
            padding: 4rem 0 3rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: repeating-linear-gradient(
                -45deg,
                transparent,
                transparent 40px,
                rgba(240,192,96,0.05) 40px,
                rgba(240,192,96,0.05) 42px
            );
        }

        .page-eyebrow {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--color-dorado);
            margin-bottom: 0.75rem;
            position: relative;
        }

        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            color: #fff;
            margin-bottom: 0.5rem;
            position: relative;
        }

        .page-subtitle {
            font-size: 0.92rem;
            color: rgba(255,255,255,0.5);
            font-weight: 300;
            margin-bottom: 1.5rem;
            position: relative;
        }

        .page-divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            max-width: 260px;
            margin: 0 auto;
            position: relative;
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

        /* ─── GRID PROMOCIONES ─── */
        .promos-section {
            padding: 3rem 0 5rem;
        }

        .promo-card {
            background: #fff;
            border: 1px solid rgba(139,32,18,0.12);
            border-radius: 3px;
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
            transition: transform 0.22s, box-shadow 0.22s;
            position: relative;
        }

        .promo-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 40px rgba(139,32,18,0.15);
        }

        /* Cinta de oferta */
        .promo-ribbon {
            position: absolute;
            top: 14px;
            left: -2px;
            background: var(--color-rojo);
            color: #fff;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 5px 14px 5px 12px;
            border-radius: 0 2px 2px 0;
            box-shadow: 2px 2px 6px rgba(0,0,0,0.2);
            z-index: 2;
        }

        .promo-ribbon::before {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            border-top: 5px solid #5a0f07;
            border-left: 5px solid transparent;
        }

        .promo-img-wrapper {
            position: relative;
            overflow: hidden;
        }

        .promo-img-wrapper img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
            transition: transform 0.4s;
        }

        .promo-card:hover .promo-img-wrapper img {
            transform: scale(1.04);
        }

        .promo-img-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 60px;
            background: linear-gradient(to top, rgba(139,32,18,0.45), transparent);
        }

        .promo-body {
            padding: 1.4rem 1.5rem 1.5rem;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .promo-titulo {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            color: var(--color-rojo);
            margin-bottom: 0.5rem;
            line-height: 1.3;
        }

        .promo-descripcion {
            font-size: 0.88rem;
            color: var(--color-texto-claro);
            line-height: 1.7;
            font-weight: 300;
            flex: 1;
            margin-bottom: 1.2rem;
        }

        .promo-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid var(--color-crema-oscuro);
            padding-top: 1rem;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .promo-vencimiento {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--color-rojo-claro);
        }

        .promo-vencimiento-icono {
            font-size: 0.9rem;
        }

        .promo-vencimiento-label {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--color-rojo-claro);
            opacity: 0.7;
            display: block;
            line-height: 1;
            margin-bottom: 1px;
        }

        .promo-fecha {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--color-rojo);
        }

        .promo-badge {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--color-rojo);
            background: #fce8e6;
            padding: 3px 10px;
            border-radius: 2px;
            white-space: nowrap;
        }

        /* ─── ESTADO VACÍO ─── */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-icon {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            opacity: 0.4;
        }

        .empty-titulo {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            color: var(--color-tierra-oscuro);
            margin-bottom: 0.5rem;
        }

        .empty-texto {
            font-size: 0.9rem;
            color: var(--color-texto-claro);
            font-weight: 300;
        }

        /* ─── FOOTER ─── */
        footer {
            margin-top: auto;
            background-color: var(--color-tierra-oscuro);
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
            color: #a08060;
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
        <p class="page-eyebrow">Ofertas vigentes</p>
        <h1 class="page-title">Promociones</h1>
        <p class="page-subtitle">Aprovecha nuestras ofertas disponibles por tiempo limitado</p>
        <div class="page-divider">
            <div class="divider-line"></div>
            <div class="divider-diamond"></div>
            <div class="divider-line reverse"></div>
        </div>
    </div>

    <!-- GRID -->
    <div class="container promos-section">
        <div class="row g-4">

        <?php
        $hayPromos = false;
        while($fila = $resultado->fetch_assoc()){
            $hayPromos = true;
        ?>

            <div class="col-md-4">
                <div class="promo-card">

                    <span class="promo-ribbon">🎁 Oferta</span>

                    <div class="promo-img-wrapper">
                        <img
                            src="../uploads/<?php echo $fila['imagen']; ?>"
                            alt="<?php echo $fila['titulo']; ?>"
                        >
                        <div class="promo-img-overlay"></div>
                    </div>

                    <div class="promo-body">
                        <h3 class="promo-titulo"><?php echo $fila['titulo']; ?></h3>
                        <p class="promo-descripcion"><?php echo $fila['descripcion']; ?></p>
                        <div class="promo-footer">
                            <div class="promo-vencimiento">
                                <span class="promo-vencimiento-icono">⏳</span>
                                <div>
                                    <span class="promo-vencimiento-label">Válido hasta</span>
                                    <span class="promo-fecha"><?php echo $fila['fecha_fin']; ?></span>
                                </div>
                            </div>
                            <span class="promo-badge">Activa</span>
                        </div>
                    </div>

                </div>
            </div>

        <?php } ?>

        <?php if (!$hayPromos): ?>
            <div class="col-12">
                <div class="empty-state">
                    <div class="empty-icon">🍽️</div>
                    <h3 class="empty-titulo">Sin promociones activas</h3>
                    <p class="empty-texto">Por el momento no hay ofertas vigentes. ¡Vuelve pronto!</p>
                </div>
            </div>
        <?php endif; ?>

        </div>
    </div>

    <!-- FOOTER -->
    <footer>
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <p class="footer-brand mb-0">Las Ollitas</p>
            <p class="footer-copy">© 2026 Restaurante Las Ollitas — Todos los derechos reservados</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>