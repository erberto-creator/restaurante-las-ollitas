<?php

include("config/conexion.php");

$config = $conn->query("SELECT * FROM configuracion")->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Las Ollitas</title>
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
            color: var(--color-texto);
            font-family: 'Lato', sans-serif;
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

        .nav-link {
            color: #e8d8c0 !important;
            font-size: 0.88rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 0.5rem 1rem !important;
            transition: color 0.2s;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 1rem;
            right: 1rem;
            height: 2px;
            background: var(--color-dorado-claro);
            transform: scaleX(0);
            transition: transform 0.25s;
        }

        .nav-link:hover {
            color: var(--color-dorado-claro) !important;
        }

        .nav-link:hover::after {
            transform: scaleX(1);
        }

        /* ─── HERO ─── */
        .hero-section {
            background-color: var(--color-tierra-oscuro);
            background-image:
                radial-gradient(ellipse at 20% 60%, rgba(201, 136, 42, 0.18) 0%, transparent 55%),
                radial-gradient(ellipse at 80% 30%, rgba(124, 74, 30, 0.35) 0%, transparent 50%);
            padding: 6rem 0 5rem;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: repeating-linear-gradient(-45deg,
                    transparent,
                    transparent 40px,
                    rgba(201, 136, 42, 0.04) 40px,
                    rgba(201, 136, 42, 0.04) 42px);
        }

        .hero-eyebrow {
            font-family: 'Lato', sans-serif;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--color-dorado);
            margin-bottom: 1rem;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.2rem, 5vw, 3.5rem);
            color: #fff;
            line-height: 1.15;
            margin-bottom: 1.2rem;
        }

        .hero-title em {
            color: var(--color-dorado-claro);
            font-style: italic;
        }

        .hero-lead {
            font-size: 1.05rem;
            color: #c8b49a;
            font-weight: 300;
            margin-bottom: 2.2rem;
            max-width: 480px;
        }

        .btn-hero-primary {
            background-color: var(--color-dorado);
            border: none;
            color: var(--color-tierra-oscuro);
            font-weight: 700;
            font-size: 0.82rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 0.75rem 1.8rem;
            border-radius: 2px;
            transition: background 0.2s, transform 0.15s;
        }

        .btn-hero-primary:hover {
            background-color: var(--color-dorado-claro);
            color: var(--color-tierra-oscuro);
            transform: translateY(-2px);
        }

        .btn-hero-outline {
            background: transparent;
            border: 1.5px solid rgba(201, 136, 42, 0.6);
            color: #e8d8c0;
            font-weight: 700;
            font-size: 0.82rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 0.75rem 1.8rem;
            border-radius: 2px;
            transition: border-color 0.2s, color 0.2s, transform 0.15s;
        }

        .btn-hero-outline:hover {
            border-color: var(--color-dorado-claro);
            color: var(--color-dorado-claro);
            transform: translateY(-2px);
        }

        /* ─── SEPARADOR DECORATIVO ─── */
        .section-divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.2rem;
        }

        .section-divider-line {
            flex: 1;
            height: 1px;
            background: linear-gradient(to right, transparent, var(--color-dorado));
        }

        .section-divider-line.reverse {
            background: linear-gradient(to left, transparent, var(--color-dorado));
        }

        .section-divider-diamond {
            width: 8px;
            height: 8px;
            background: var(--color-dorado);
            transform: rotate(45deg);
            flex-shrink: 0;
        }

        /* ─── SECCIÓN NOSOTROS ─── */
        .about-section {
            padding: 5rem 0;
            background-color: var(--color-crema);
        }

        .about-eyebrow {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--color-dorado);
            margin-bottom: 0.75rem;
        }

        .about-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            color: var(--color-tierra-oscuro);
            margin-bottom: 1.2rem;
            line-height: 1.2;
        }

        .about-text {
            color: var(--color-texto-claro);
            font-size: 1rem;
            line-height: 1.85;
            font-weight: 300;
        }

        .about-img-wrapper {
            position: relative;
        }

        .about-img-wrapper img {
            border-radius: 2px;
            display: block;
        }

        .about-img-wrapper::after {
            content: '';
            position: absolute;
            bottom: -14px;
            right: -14px;
            width: 100%;
            height: 100%;
            border: 2px solid var(--color-dorado);
            border-radius: 2px;
            z-index: -1;
        }

        .about-badge {
            position: absolute;
            bottom: 24px;
            left: -20px;
            background: var(--color-tierra-oscuro);
            color: var(--color-dorado-claro);
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            padding: 1rem 1.4rem;
            border-left: 3px solid var(--color-dorado);
            box-shadow: 4px 4px 20px rgba(0, 0, 0, 0.2);
        }

        .about-badge span {
            display: block;
            font-family: 'Lato', sans-serif;
            font-size: 0.7rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--color-dorado);
            margin-bottom: 2px;
        }

        /* ─── CARDS FEATURES ─── */
        .features-bar {
            background: var(--color-crema-oscuro);
            border-top: 1px solid rgba(201, 136, 42, 0.25);
            border-bottom: 1px solid rgba(201, 136, 42, 0.25);
            padding: 2.5rem 0;
        }

        .feature-item {
            text-align: center;
            padding: 0 1.5rem;
        }

        .feature-icon {
            font-size: 1.6rem;
            margin-bottom: 0.5rem;
            color: var(--color-dorado);
        }

        .feature-title {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            color: var(--color-tierra-oscuro);
            margin-bottom: 0.25rem;
        }

        .feature-desc {
            font-size: 0.82rem;
            color: var(--color-texto-claro);
            font-weight: 300;
        }

        /* ─── FOOTER ─── */
        footer {
            background-color: var(--color-tierra-oscuro);
            border-top: 3px solid var(--color-dorado);
            padding: 2.5rem 0;
        }

        .footer-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            color: var(--color-dorado-claro);
        }

        .footer-copy {
            font-size: 0.8rem;
            color: #a08060;
            margin: 0;
            letter-spacing: 0.5px;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                Las <span>Ollitas</span>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="public/menu.php">Menú</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="public/reservas.php">Reservas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="public/contacto.php">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="public/promociones.php">Promociones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin/login.php">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero-section">
        <div class="container position-relative">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <p class="hero-eyebrow">Restaurante Boliviano</p>
                    <h1 class="hero-title">
                        Bienvenido a <em><?php echo $config['nombre_restaurante']; ?></em>
                    </h1>
                    <p class="hero-lead mx-auto">
                        Comida tradicional boliviana con sabor casero, elaborada con ingredientes frescos y recetas de
                        siempre.
                    </p>
                    <div class="d-flex flex-wrap gap-3 justify-content-center">
                        <a href="public/menu.php" class="btn btn-hero-primary">Ver Menú</a>
                        <a href="public/promociones.php" class="btn btn-hero-outline">Ver Promociones</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURES BAR -->
    <div class="features-bar">
        <div class="container">
            <div class="row g-3 justify-content-center">
                <div class="col-6 col-md-3">
                    <div class="feature-item">
                        <div class="feature-icon">🍲</div>
                        <p class="feature-title">Cocina Tradicional</p>
                        <p class="feature-desc">Recetas heredadas con autenticidad</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="feature-item">
                        <div class="feature-icon">🌿</div>
                        <p class="feature-title">Ingredientes Frescos</p>
                        <p class="feature-desc">Seleccionados cada mañana</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="feature-item">
                        <div class="feature-icon">📅</div>
                        <p class="feature-title">Reservas</p>
                        <p class="feature-desc">Asegura tu mesa fácilmente</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="feature-item">
                        <div class="feature-icon">🎁</div>
                        <p class="feature-title">Promociones</p>
                        <p class="feature-desc">Descuentos y ofertas especiales</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SOBRE NOSOTROS -->
    <section class="about-section">
        <div class="container">
            <div class="row align-items-center g-5">

                <div class="col-md-6">
                    <div class="about-img-wrapper">
                        <img src="assets/img/pique-macho.jpg" class="img-fluid shadow w-100" alt="Pique Macho">
                        <div class="about-badge">
                            <span>Desde siempre</span>
                            Sabor Auténtico
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <p class="about-eyebrow">Sobre Nosotros</p>
                    <div class="section-divider mb-3">
                        <div class="section-divider-line"></div>
                        <div class="section-divider-diamond"></div>
                        <div class="section-divider-line reverse"></div>
                    </div>
                    <h2 class="about-title">
                        Una experiencia gastronómica familiar y auténtica
                    </h2>
                    <p class="about-text">
                        En Las Ollitas ofrecemos platos típicos bolivianos preparados con ingredientes frescos
                        y recetas tradicionales transmitidas con cariño de generación en generación.
                    </p>
                    <p class="about-text">
                        Nuestro objetivo es brindar una experiencia gastronómica auténtica y familiar,
                        donde cada bocado te transporte a los sabores del hogar boliviano.
                    </p>
                    <a href="public/menu.php" class="btn btn-hero-primary mt-3">Explorar el Menú</a>
                </div>

            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                <p class="footer-brand mb-0">Las Ollitas</p>
                <p class="footer-copy">© 2026 Restaurante Las Ollitas — Todos los derechos reservados</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>