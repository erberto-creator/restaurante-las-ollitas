<?php

include("../config/conexion.php");

$sql = "SELECT * FROM platos
WHERE categoria_id = 1
OR categoria_id = 3";

$resultado = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comidas - Las Ollitas</title>
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

        /* ─── CARDS DE PLATOS ─── */
        .platos-grid {
            padding: 2rem 0 5rem;
        }

        .plato-card {
            background: #fff;
            border: 1px solid rgba(124,74,30,0.12);
            border-radius: 3px;
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
            transition: transform 0.22s, box-shadow 0.22s;
        }

        .plato-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 40px rgba(78,45,13,0.15);
        }

        .plato-img-wrapper {
            position: relative;
            overflow: hidden;
        }

        .plato-img-wrapper img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
            transition: transform 0.4s;
        }

        .plato-card:hover .plato-img-wrapper img {
            transform: scale(1.04);
        }

        .plato-img-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 60px;
            background: linear-gradient(to top, rgba(78,45,13,0.45), transparent);
        }

        .plato-body {
            padding: 1.4rem 1.5rem 1.5rem;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .plato-nombre {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            color: var(--color-tierra-oscuro);
            margin-bottom: 0.5rem;
            line-height: 1.3;
        }

        .plato-descripcion {
            font-size: 0.88rem;
            color: var(--color-texto-claro);
            line-height: 1.7;
            font-weight: 300;
            flex: 1;
            margin-bottom: 1.2rem;
        }

        .plato-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid var(--color-crema-oscuro);
            padding-top: 1rem;
        }

        .plato-precio {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            color: var(--color-tierra);
            font-weight: 700;
        }

        .plato-precio span {
            font-family: 'Lato', sans-serif;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 1px;
            color: var(--color-dorado);
            margin-right: 3px;
        }

        .plato-badge {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--color-tierra);
            background: var(--color-crema-oscuro);
            padding: 3px 10px;
            border-radius: 2px;
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
            <a href="menu.php" class="btn-volver">← Volver al Menú</a>
        </div>
    </nav>

    <!-- HEADER -->
    <div class="page-header">
        <p class="page-eyebrow">Restaurante Las Ollitas</p>
        <h1 class="page-title">Comidas</h1>
        <div class="page-divider">
            <div class="divider-line"></div>
            <div class="divider-diamond"></div>
            <div class="divider-line reverse"></div>
        </div>
    </div>

    <!-- GRID DE PLATOS -->
    <div class="container platos-grid">
        <div class="row g-4">

            <?php while($fila = $resultado->fetch_assoc()){ ?>

            <div class="col-md-4">
                <div class="plato-card">

                    <div class="plato-img-wrapper">
                        <img
                            src="../uploads/<?php echo $fila['imagen']; ?>"
                            alt="<?php echo $fila['nombre']; ?>"
                        >
                        <div class="plato-img-overlay"></div>
                    </div>

                    <div class="plato-body">
                        <h3 class="plato-nombre"><?php echo $fila['nombre']; ?></h3>
                        <p class="plato-descripcion"><?php echo $fila['descripcion']; ?></p>
                        <div class="plato-footer">
                            <p class="plato-precio mb-0">
                                <span>Bs.</span><?php echo $fila['precio']; ?>
                            </p>
                            <span class="plato-badge">Disponible</span>
                        </div>
                    </div>

                </div>
            </div>

            <?php } ?>

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