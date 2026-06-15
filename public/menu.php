<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Lato:wght@300;400;700&display=swap"
        rel="stylesheet">
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
            background-color: var(--color-crema);
            font-family: 'Lato', sans-serif;
            color: var(--color-texto);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ─── NAVBAR ─── */
        .navbar {
            background-color: var(--color-tierra-oscuro) !important;
            border-bottom: 3px solid var(--color-dorado);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            color: var(--color-dorado-claro) !important;
            letter-spacing: 1px;
        }

        .navbar-brand span {
            color: #fff;
            font-weight: 300;
        }

        .btn-volver {
            background: transparent;
            border: 1.5px solid rgba(201, 136, 42, 0.5);
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

        /* ─── HEADER DE PÁGINA ─── */
        .page-header {
            text-align: center;
            padding: 4rem 0 2.5rem;
        }

        .page-eyebrow {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--color-dorado);
            margin-bottom: 0.75rem;
        }

        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.6rem;
            color: var(--color-tierra-oscuro);
            line-height: 1.15;
            margin-bottom: 0.75rem;
        }

        .page-divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            max-width: 280px;
            margin: 0 auto;
        }

        .page-divider-line {
            flex: 1;
            height: 1px;
            background: linear-gradient(to right, transparent, var(--color-dorado));
        }

        .page-divider-line.reverse {
            background: linear-gradient(to left, transparent, var(--color-dorado));
        }

        .page-divider-diamond {
            width: 7px;
            height: 7px;
            background: var(--color-dorado);
            transform: rotate(45deg);
            flex-shrink: 0;
        }

        /* ─── CARDS DE MENÚ ─── */
        .menu-grid {
            padding: 1rem 0 5rem;
        }

        .menu-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            border-radius: 3px;
            padding: 3.5rem 2rem;
            transition: transform 0.22s, box-shadow 0.22s;
            position: relative;
            overflow: hidden;
            min-height: 260px;
            text-align: center;
        }

        .menu-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0);
            transition: background 0.22s;
        }

        .menu-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
        }

        .menu-card:hover::before {
            background: rgba(0, 0, 0, 0.08);
        }

        /* Tarjeta: Menú del Día */
        .card-comidas {
            background-color: var(--color-tierra);
            background-image:
                radial-gradient(ellipse at 80% 20%, rgba(240, 192, 96, 0.2) 0%, transparent 60%),
                radial-gradient(ellipse at 10% 80%, rgba(78, 45, 13, 0.4) 0%, transparent 50%);
            border: 1px solid rgba(201, 136, 42, 0.3);
        }

        /* Tarjeta: Bebidas */
        .card-bebidas {
            background-color: #2B4A6F;
            background-image:
                radial-gradient(ellipse at 80% 20%, rgba(100, 160, 230, 0.2) 0%, transparent 60%),
                radial-gradient(ellipse at 10% 80%, rgba(15, 30, 55, 0.5) 0%, transparent 50%);
            border: 1px solid rgba(100, 160, 230, 0.25);
        }

        /* Tarjeta: Especiales */
        .card-especiales {
            background-color: #2D5A3D;
            background-image:
                radial-gradient(ellipse at 80% 20%, rgba(100, 200, 130, 0.18) 0%, transparent 60%),
                radial-gradient(ellipse at 10% 80%, rgba(15, 40, 20, 0.5) 0%, transparent 50%);
            border: 1px solid rgba(100, 200, 130, 0.2);
        }

        .card-icon {
            font-size: 3rem;
            margin-bottom: 1.2rem;
            position: relative;
            z-index: 1;
            filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.3));
        }

        .card-label {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.55);
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }

        .card-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.75rem;
            color: #fff;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
            line-height: 1.15;
        }

        .card-arrow {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.45);
            position: relative;
            z-index: 1;
            transition: color 0.2s;
        }

        .menu-card:hover .card-arrow {
            color: rgba(255, 255, 255, 0.85);
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
    <nav class="navbar navbar-expand-lg">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="../index.php">
                Las <span>Ollitas</span>
            </a>
            <a href="../index.php" class="btn-volver">← Volver al inicio</a>
        </div>
    </nav>

    <!-- HEADER -->
    <div class="page-header">
        <p class="page-eyebrow">Restaurante Las Ollitas</p>
        <h1 class="page-title">Nuestro Menú</h1>
        <div class="page-divider">
            <div class="page-divider-line"></div>
            <div class="page-divider-diamond"></div>
            <div class="page-divider-line reverse"></div>
        </div>
    </div>

    <!-- CARDS -->
    <div class="container menu-grid">
        <div class="row g-4 justify-content-center">

            <div class="col-md-4">
                <a href="comidas.php" class="menu-card card-comidas">
                    <div class="card-icon">🍲</div>
                    <p class="card-label">Hoy servimos</p>
                    <h2 class="card-title">Menú del Día</h2>
                    <span class="card-arrow">Ver platos →</span>
                </a>
            </div>

            <div class="col-md-4">
                <a href="bebidas.php" class="menu-card card-bebidas"
                    style="background-color:#6B4F8A; border:1px solid rgba(180,130,230,0.3);">
                    <div class="card-icon">🥤</div>
                    <p class="card-label">Para acompañar</p>
                    <h2 class="card-title">Bebidas</h2>
                    <span class="card-arrow">Ver bebidas →</span>
                </a>
            </div>

            <div class="col-md-4">
                <a href="especiales.php" class="menu-card card-especiales">
                    <div class="card-icon">⭐</div>
                    <p class="card-label">Lo mejor de la casa</p>
                    <h2 class="card-title">Platos Especiales</h2>
                    <span class="card-arrow">Ver especiales →</span>
                </a>
            </div>

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