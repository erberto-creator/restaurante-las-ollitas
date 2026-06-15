<?php

include("../config/conexion.php");

if (isset($_POST['enviar'])) {

    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $mensaje = $_POST['mensaje'];

    $sql = "INSERT INTO mensajes(

    nombre,
    correo,
    mensaje

    )

    VALUES(

    '$nombre',
    '$correo',
    '$mensaje'

    )";

    if ($conn->query($sql)) {

        echo "<script>
        alert('Mensaje enviado correctamente');
        </script>";

    }

}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Las Ollitas</title>
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

        .nav-link {
            color: #e8d8c0 !important;
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 0.5rem 1rem !important;
            position: relative;
            transition: color 0.2s;
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

        /* ─── HEADER ─── */
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
            margin-bottom: 0.75rem;
        }

        .page-divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            max-width: 280px;
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

        /* ─── SECCIÓN CONTACTO ─── */
        .contacto-section {
            padding: 2rem 0 4rem;
        }

        /* ─── INFO ─── */
        .info-titulo {
            font-family: 'Playfair Display', serif;
            font-size: 1.7rem;
            color: var(--color-tierra-oscuro);
            margin-bottom: 2rem;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 1.6rem;
        }

        .info-icono {
            width: 42px;
            height: 42px;
            background: var(--color-tierra-oscuro);
            border: 1px solid var(--color-dorado);
            border-radius: 2px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .info-label {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--color-dorado);
            margin-bottom: 2px;
        }

        .info-valor {
            font-size: 0.95rem;
            color: var(--color-texto-claro);
            font-weight: 300;
            margin: 0;
            line-height: 1.5;
        }

        .btn-whatsapp {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #25A653;
            color: #fff;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 0.65rem 1.4rem;
            border-radius: 2px;
            text-decoration: none;
            transition: background 0.2s, transform 0.15s;
            margin-top: 0.5rem;
        }

        .btn-whatsapp:hover {
            background: #1d8c45;
            color: #fff;
            transform: translateY(-2px);
        }

        /* ─── FORMULARIO ─── */
        .form-card {
            background: #fff;
            border: 1px solid rgba(124,74,30,0.12);
            border-radius: 3px;
            padding: 2.2rem 2rem;
        }

        .form-titulo {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            color: var(--color-tierra-oscuro);
            margin-bottom: 1.8rem;
        }

        .form-label-custom {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--color-texto-claro);
            margin-bottom: 5px;
            display: block;
        }

        .form-control-custom {
            width: 100%;
            background: var(--color-crema);
            border: 1px solid rgba(124,74,30,0.2);
            border-radius: 2px;
            padding: 0.7rem 0.9rem;
            font-family: 'Lato', sans-serif;
            font-size: 0.92rem;
            color: var(--color-texto);
            outline: none;
            transition: border-color 0.2s;
            margin-bottom: 1.2rem;
        }

        .form-control-custom:focus {
            border-color: var(--color-dorado);
            background: #fff;
        }

        textarea.form-control-custom {
            resize: vertical;
            min-height: 130px;
        }

        .btn-enviar {
            width: 100%;
            background: var(--color-tierra-oscuro);
            border: none;
            color: var(--color-dorado-claro);
            font-family: 'Lato', sans-serif;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            padding: 0.85rem;
            border-radius: 2px;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
        }

        .btn-enviar:hover {
            background: var(--color-tierra);
            transform: translateY(-2px);
        }

        /* ─── MAPA ─── */
        .mapa-section {
            padding: 1rem 0 5rem;
        }

        .mapa-titulo {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: var(--color-tierra-oscuro);
            text-align: center;
            margin-bottom: 2rem;
        }

        .mapa-wrapper {
            border: 2px solid var(--color-dorado);
            border-radius: 3px;
            overflow: hidden;
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
        <div class="container">
            <a class="navbar-brand" href="../index.php">
                Las <span>Ollitas</span>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="menu.php">Menú</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="promociones.php">Promociones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="galeria.php">Galería</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reservas.php">Reservas</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- HEADER -->
    <div class="page-header">
        <p class="page-eyebrow">Restaurante Las Ollitas</p>
        <h1 class="page-title">Contáctanos</h1>
        <div class="page-divider">
            <div class="divider-line"></div>
            <div class="divider-diamond"></div>
            <div class="divider-line reverse"></div>
        </div>
    </div>

    <!-- CONTACTO -->
    <div class="container contacto-section">
        <div class="row g-5 align-items-start">

            <!-- INFORMACIÓN -->
            <div class="col-md-6">
                <h2 class="info-titulo">Información de contacto</h2>

                <div class="info-item">
                    <div class="info-icono">📍</div>
                    <div>
                        <p class="info-label">Dirección</p>
                        <p class="info-valor">Final Av. Achocalla, Viacha, Bolivia</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icono">📞</div>
                    <div>
                        <p class="info-label">Teléfono</p>
                        <p class="info-valor">+591 73591187</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icono">✉️</div>
                    <div>
                        <p class="info-label">Correo electrónico</p>
                        <p class="info-valor">restaurante.las.ollitas@gmail.com</p>
                    </div>
                </div>

                <!-- WHATSAPP -->
                <a href="https://wa.me/59173591187" target="_blank" class="btn-whatsapp">
                    💬 &nbsp;Escribir por WhatsApp
                </a>
            </div>

            <!-- FORMULARIO -->
            <div class="col-md-6">
                <div class="form-card">
                    <h3 class="form-titulo">Envíanos un mensaje o sugerencia</h3>

                    <form method="POST">

                        <label class="form-label-custom">Nombre</label>
                        <input type="text" name="nombre" class="form-control-custom" placeholder="Tu nombre completo" required>

                        <label class="form-label-custom">Correo electrónico</label>
                        <input type="email" name="correo" class="form-control-custom" placeholder="tucorreo@ejemplo.com" required>

                        <label class="form-label-custom">Mensaje</label>
                        <textarea name="mensaje" class="form-control-custom" placeholder="Escribe tu mensaje o sugerencia aquí..." required></textarea>

                        <button type="submit" name="enviar" class="btn-enviar">
                            Enviar mensaje
                        </button>

                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- MAPA -->
    <div class="container mapa-section">
        <h2 class="mapa-titulo">Nuestra Ubicación</h2>
        <div class="mapa-wrapper">
            <iframe
                src="https://www.google.com/maps?q=Final+Av+Achocalla+Viacha+Bolivia&output=embed"
                width="100%"
                height="420"
                style="border:0; display:block;"
                allowfullscreen=""
                loading="lazy">
            </iframe>
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