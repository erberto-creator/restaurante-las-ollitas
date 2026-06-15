<?php
session_start();

if(
    !isset($_SESSION['admin'])
    ||
    !isset($_SESSION['token'])
    ){
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - Las Ollitas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            overflow-x:hidden;
            font-family: Arial, sans-serif;

            background-image:url('../assets/img/restaurante.jpg');

            background-size:cover;
            background-position:center;
            background-attachment:fixed;
        }

        .overlay{
            background:rgba(0,0,0,0.75);
            min-height:100vh;
        }

        /* SIDEBAR */

        .sidebar{
            width:260px;
            height:100vh;
            background:rgba(46, 102, 179, 0.88);
            position:fixed;
            padding-top:20px;
            backdrop-filter:blur(8px);
            border-right:2px solid #ffc107;
        }

        .sidebar h2{
            color:#23bcc4;
            text-align:center;
            margin-bottom:30px;
            font-weight:bold;
            font-size:32px;
        }

        .sidebar a{
            display:block;
            color:white;
            padding:15px 25px;
            text-decoration:none;
            transition:0.3s;
            font-size:18px;
            border-left:4px solid transparent;
        }

        .sidebar a:hover{
            background:#ffc107;
            color:blue;
            padding-left:35px;
            border-left:4px solid white;
        }

        /* CONTENIDO */

        .content{
            margin-left:260px;
            padding:30px;
            color:white;
        }

        .title{
            font-size:42px;
            font-weight:bold;
            margin-bottom:35px;
            color:#ffc107;
            text-shadow:2px 2px 10px black;
        }

        /* TARJETAS */

        .menu-card{
            position:relative;
            height:240px;
            border-radius:25px;
            overflow:hidden;
            cursor:pointer;
            transition:0.4s;
            box-shadow:0 10px 30px rgba(0,0,0,0.5);
        }

        .menu-card:hover{
            transform:translateY(-10px) scale(1.03);
        }

        .menu-card img{
            width:100%;
            height:100%;
            object-fit:cover;
        }

        .menu-overlay{
            position:absolute;
            top:0;
            left:0;
            width:100%;
            height:100%;
            background:rgba(0,0,0,0.45);

            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;

            text-align:center;
            color:white;
        }

        .menu-overlay i{
            font-size:55px;
            margin-bottom:15px;
            color:#ffc107;
            text-shadow:2px 2px 10px black;
        }

        .menu-overlay h3{
            font-size:30px;
            font-weight:bold;
            text-shadow:2px 2px 10px black;
        }

        .menu-overlay p{
            font-size:15px;
            text-shadow:2px 2px 10px black;
        }

        /* BIENVENIDA */

        .welcome{
            margin-top:40px;
            background:rgba(255,255,255,0.12);
            padding:40px;
            border-radius:25px;
            backdrop-filter:blur(10px);
            border:1px solid rgba(255,255,255,0.2);
        }

        .welcome h2{
            color:#ffc107;
            margin-bottom:15px;
            font-size:35px;
        }

        .welcome p{
            font-size:18px;
        }

    </style>

</head>

<body>

<div class="overlay">

    <!-- SIDEBAR -->

    <div class="sidebar">

        <h2>
            Las Ollitas
        </h2>

        <a href="dashboard.php">
            <i class="fa fa-house"></i>
            Dashboard
        </a>

        <a href="categorias/index.php">
            <i class="fa fa-list"></i>
            Categorías
        </a>

        <a href="platos/index.php">
            <i class="fa fa-bowl-food"></i>
            Platos
        </a>

        <a href="promociones/index.php">
            <i class="fa fa-tags"></i>
            Promociones
        </a>

        <a href="galeria/index.php">
            <i class="fa fa-image"></i>
            Galería
        </a>

        <a href="reservas/index.php">
            <i class="fa fa-calendar"></i>
            Reservas
        </a>

        <!-- NUEVO MODULO MENSAJES -->

        <a href="mensajes/index.php">
            <i class="fa fa-envelope"></i>
            Mensajes
        </a>

        <a href="logout.php">
            <i class="fa fa-right-from-bracket"></i>
            Cerrar Sesión
        </a>

    </div>

    <!-- CONTENIDO -->

    <div class="content">

        <div class="title">
            Panel Administrativo
        </div>

        <div class="row">

            <!-- CATEGORIAS -->

            <div class="col-md-4 mb-4">

                <a href="categorias/index.php">

                    <div class="menu-card">

                        <img src="../assets/img/categorias.jpg">

                        <div class="menu-overlay">

                            <i class="fa fa-list"></i>

                            <h3>
                                Categorías
                            </h3>

                            <p>
                                Gestiona categorías típicas
                            </p>

                        </div>

                    </div>

                </a>

            </div>

            <!-- PLATOS -->

            <div class="col-md-4 mb-4">

                <a href="platos/index.php">

                    <div class="menu-card">

                        <img src="../assets/img/platos.jpg">

                        <div class="menu-overlay">

                            <i class="fa fa-bowl-food"></i>

                            <h3>
                                Platos
                            </h3>

                            <p>
                                Administra platos bolivianos
                            </p>

                        </div>

                    </div>

                </a>

            </div>

            <!-- PROMOCIONES -->

            <div class="col-md-4 mb-4">

                <a href="promociones/index.php">

                    <div class="menu-card">

                        <img src="../assets/img/promociones.jpg">

                        <div class="menu-overlay">

                            <i class="fa fa-tags"></i>

                            <h3>
                                Promociones
                            </h3>

                            <p>
                                Ofertas y descuentos
                            </p>

                        </div>

                    </div>

                </a>

            </div>

            <!-- GALERIA -->

            <div class="col-md-6 mb-4">

                <a href="galeria/index.php">

                    <div class="menu-card">

                        <img src="../assets/img/galeria.jpg">

                        <div class="menu-overlay">

                            <i class="fa fa-image"></i>

                            <h3>
                                Galería
                            </h3>

                            <p>
                                Fotos del restaurante
                            </p>

                        </div>

                    </div>

                </a>

            </div>

            <!-- RESERVAS -->

            <div class="col-md-3 mb-4">

                <a href="reservas/index.php">

                    <div class="menu-card">

                        <img src="../assets/img/reservas.jpg">

                        <div class="menu-overlay">

                            <i class="fa fa-calendar"></i>

                            <h3>
                                Reservas
                            </h3>

                            <p>
                                Controla reservas online
                            </p>

                        </div>

                    </div>

                </a>

            </div>

            <!-- MENSAJES -->

            <div class="col-md-3 mb-4">

                <a href="mensajes/index.php">

                    <div class="menu-card">

                        <img src="../assets/img/mensajes.jpg">

                        <div class="menu-overlay">

                            <i class="fa fa-envelope"></i>

                            <h3>
                                Mensajes
                            </h3>

                            <p>
                                Consultas de clientes
                            </p>

                        </div>

                    </div>

                </a>

            </div>

        </div>

        <!-- BIENVENIDA -->

        <div class="welcome">

            <h2>
                Bienvenido Administrador
            </h2>

            <p>
                Administra el restaurante Las Ollitas,
                sus platos típicos bolivianos, promociones,
                reservas, mensajes y galería desde este panel profesional.
            </p>

        </div>

    </div>

</div>

</body>
</html>