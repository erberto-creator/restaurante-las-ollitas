<?php

include("../config/conexion.php");

if(isset($_POST['reservar'])){

    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $personas = $_POST['personas'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];

    $sql = "INSERT INTO reservas
    (nombre,telefono,personas,fecha,hora)
    VALUES
    ('$nombre','$telefono','$personas','$fecha','$hora')";

    if($conn->query($sql)){
        $mensaje = "Reserva realizada correctamente";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas - Las Ollitas</title>
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

        /* ─── LAYOUT PRINCIPAL ─── */
        .reserva-section {
            flex: 1;
            padding: 4rem 0 5rem;
        }

        /* ─── COLUMNA IZQUIERDA: INFO ─── */
        .info-panel {
            padding: 2rem 2.5rem 2rem 0;
        }

        .info-eyebrow {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--color-dorado);
            margin-bottom: 0.75rem;
        }

        .info-titulo {
            font-family: 'Playfair Display', serif;
            font-size: 2.4rem;
            color: var(--color-tierra-oscuro);
            line-height: 1.15;
            margin-bottom: 1rem;
        }

        .info-titulo em {
            font-style: italic;
            color: var(--color-dorado);
        }

        .info-divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .divider-line {
            flex: 1;
            height: 1px;
            background: linear-gradient(to right, var(--color-dorado), transparent);
        }

        .divider-diamond {
            width: 7px;
            height: 7px;
            background: var(--color-dorado);
            transform: rotate(45deg);
            flex-shrink: 0;
        }

        .info-desc {
            font-size: 0.92rem;
            color: var(--color-texto-claro);
            line-height: 1.8;
            font-weight: 300;
            margin-bottom: 2rem;
        }

        .info-detalle {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 1.2rem;
        }

        .info-icono {
            width: 40px;
            height: 40px;
            background: var(--color-tierra-oscuro);
            border: 1px solid rgba(201,136,42,0.35);
            border-radius: 2px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .info-label {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--color-dorado);
            margin-bottom: 2px;
        }

        .info-valor {
            font-size: 0.9rem;
            color: var(--color-texto-claro);
            font-weight: 300;
            margin: 0;
        }

        /* ─── FORMULARIO ─── */
        .form-card {
            background: #fff;
            border: 1px solid rgba(124,74,30,0.12);
            border-radius: 3px;
            padding: 2.5rem 2rem;
        }

        .form-titulo {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            color: var(--color-tierra-oscuro);
            margin-bottom: 0.4rem;
        }

        .form-subtitulo {
            font-size: 0.82rem;
            color: var(--color-texto-claro);
            font-weight: 300;
            margin-bottom: 1.8rem;
        }

        .form-label-custom {
            font-size: 0.68rem;
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
            transition: border-color 0.2s, background 0.2s;
            margin-bottom: 1.2rem;
        }

        .form-control-custom:focus {
            border-color: var(--color-dorado);
            background: #fff;
        }

        .form-row-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .btn-reservar {
            width: 100%;
            background: var(--color-tierra-oscuro);
            border: none;
            color: var(--color-dorado-claro);
            font-family: 'Lato', sans-serif;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            padding: 0.9rem;
            border-radius: 2px;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
            margin-top: 0.4rem;
        }

        .btn-reservar:hover {
            background: var(--color-tierra);
            transform: translateY(-2px);
        }

        /* ─── ALERTA ÉXITO ─── */
        .alerta-exito {
            background: #f0faf3;
            border: 1px solid rgba(45,90,61,0.25);
            border-left: 4px solid #2D5A3D;
            border-radius: 2px;
            padding: 1rem 1.2rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .alerta-exito-icono {
            font-size: 1.3rem;
            flex-shrink: 0;
        }

        .alerta-exito-texto {
            font-size: 0.88rem;
            font-weight: 700;
            color: #2D5A3D;
            margin: 0;
        }

        /* ─── FOOTER ─── */
        footer {
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

    <!-- CONTENIDO -->
    <div class="reserva-section">
        <div class="container">
            <div class="row align-items-start g-5">

                <!-- INFO IZQUIERDA -->
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="info-panel">
                        <p class="info-eyebrow">Reserva tu lugar</p>
                        <h1 class="info-titulo">Reserva tu <em>mesa</em> con nosotros</h1>
                        <div class="info-divider">
                            <div class="divider-diamond"></div>
                            <div class="divider-line"></div>
                        </div>
                        <p class="info-desc">
                            Asegura tu espacio en Las Ollitas y disfruta de una experiencia gastronómica
                            auténtica y familiar. Completá el formulario y nos pondremos en contacto contigo.
                        </p>

                        <div class="info-detalle">
                            <div class="info-icono">📍</div>
                            <div>
                                <p class="info-label">Dirección</p>
                                <p class="info-valor">Final Av. Achocalla, Viacha, Bolivia</p>
                            </div>
                        </div>

                        <div class="info-detalle">
                            <div class="info-icono">🕐</div>
                            <div>
                                <p class="info-label">Horario de atención</p>
                                <p class="info-valor">Lunes a Domingo · 11:00 – 22:00</p>
                            </div>
                        </div>

                        <div class="info-detalle">
                            <div class="info-icono">📞</div>
                            <div>
                                <p class="info-label">Teléfono</p>
                                <p class="info-valor">+591 73591187</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FORMULARIO DERECHA -->
                <div class="col-lg-7">
                    <div class="form-card">
                        <h2 class="form-titulo">Reservar Mesa</h2>
                        <p class="form-subtitulo">Completa los datos y confirmaremos tu reserva</p>

                        <?php if(isset($mensaje)){ ?>
                            <div class="alerta-exito">
                                <span class="alerta-exito-icono">✅</span>
                                <p class="alerta-exito-texto"><?php echo $mensaje; ?></p>
                            </div>
                        <?php } ?>

                        <form method="POST">

                            <label class="form-label-custom">Nombre completo</label>
                            <input
                                type="text"
                                name="nombre"
                                class="form-control-custom"
                                placeholder="Tu nombre completo"
                                required
                            >

                            <label class="form-label-custom">Teléfono</label>
                            <input
                                type="text"
                                name="telefono"
                                class="form-control-custom"
                                placeholder="+591 xxxxxxxx"
                                required
                            >

                            <label class="form-label-custom">Cantidad de personas</label>
                            <input
                                type="number"
                                name="personas"
                                class="form-control-custom"
                                placeholder="Ej: 4"
                                min="1"
                                required
                            >

                            <div class="form-row-2">
                                <div>
                                    <label class="form-label-custom">Fecha</label>
                                    <input
                                        type="date"
                                        name="fecha"
                                        class="form-control-custom"
                                        required
                                    >
                                </div>
                                <div>
                                    <label class="form-label-custom">Hora</label>
                                    <input
                                        type="time"
                                        name="hora"
                                        class="form-control-custom"
                                        required
                                    >
                                </div>
                            </div>

                            <button type="submit" name="reservar" class="btn-reservar">
                                Confirmar Reserva
                            </button>

                        </form>
                    </div>
                </div>

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