<?php
include 'conexion.php';
$stmt = $conexion->prepare("SELECT * FROM productos ORDER BY id ASC");
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-brand {
            font-size: 28px;
            font-weight: bold;
        }
        .btn-agregar-nav {
            margin-left: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="http://localhost/proyecto_integrador/Codigo/index.php">TechnoMarket</a>
            <a class="btn btn-success btn-agregar-nav" href="http://localhost/proyecto_integrador/Codigo/crear.php">Agregar</a>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Listado de Productos</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Categoría</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(count($productos) > 0) {
                                foreach($productos as $p) {
                                    echo "<tr>
                                            <td>" . str_pad($p['id'], 3, '0', STR_PAD_LEFT) . "</td>
                                            <td>" . htmlspecialchars($p['nombre']) . "</td>
                                            <td>" . htmlspecialchars($p['categoria']) . "</td>
                                            <td>$" . number_format($p['precio'], 2) . "</td>
                                            <td>" . $p['stock'] . " unidades</td>
                                            <td>
                                                <a href='editar.php?id=" . $p['id'] . "' class='btn btn-warning btn-sm'>Editar</a>
                                                <a href='eliminar.php?id=" . $p['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Eliminar este producto?\")'>Eliminar</a>
                                            </td>
                                          </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6' class='text-center'>No hay productos registrados</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>