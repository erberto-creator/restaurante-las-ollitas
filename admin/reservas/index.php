<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
}

include("../../config/conexion.php");

$sql = "SELECT * FROM reservas ORDER BY id DESC";

$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>

    <title>Reservas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .card-header {
            background: linear-gradient(135deg, #6f42c1, #0d6efd);
        }
        .table thead {
            background-color: #343a40;
            color: #fff;
        }
        .table tbody tr:hover {
            background-color: #e9ecef;
            transition: background-color 0.2s ease;
        }
        .badge-personas {
            background-color: #0d6efd;
            color: white;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
        }
    </style>

</head>

<body>

<div class="container mt-5 mb-5">

    <div class="card shadow-sm border-0">

        <div class="card-header text-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="bi bi-calendar-check me-2"></i>Reservas
                </h4>
                <a href="../dashboard.php" class="btn btn-light btn-sm">
                    <i class="bi bi-arrow-left me-1"></i>Volver
                </a>
            </div>
        </div>

        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">

                    <thead>
                        <tr>
                            <th class="text-center" style="width:60px;">#</th>
                            <th><i class="bi bi-person me-1"></i>Cliente</th>
                            <th><i class="bi bi-telephone me-1"></i>Teléfono</th>
                            <th class="text-center"><i class="bi bi-people me-1"></i>Personas</th>
                            <th><i class="bi bi-calendar me-1"></i>Fecha</th>
                            <th><i class="bi bi-clock me-1"></i>Hora</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php while($fila = $resultado->fetch_assoc()){ ?>

                        <tr>

                            <td class="text-center text-muted fw-bold"><?php echo $fila['id']; ?></td>

                            <td><?php echo $fila['nombre']; ?></td>

                            <td><?php echo $fila['telefono']; ?></td>

                            <td class="text-center">
                                <span class="badge-personas"><?php echo $fila['personas']; ?></span>
                            </td>

                            <td><?php echo $fila['fecha']; ?></td>

                            <td><?php echo $fila['hora']; ?></td>

                        </tr>

                        <?php } ?>

                    </tbody>

                </table>
            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>