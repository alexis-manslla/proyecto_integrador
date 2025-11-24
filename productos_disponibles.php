<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Consultar solo productos con stock mayor a 0
$query = "SELECT * FROM productos WHERE stock > 0 ORDER BY stock DESC";
$resultado = mysqli_query($conexion, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos Disponibles</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        .stock-alto {
            background: #d4edda;
            color: #155724;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
        }

        .stock-medio {
            background: #fff3cd;
            color: #856404;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
        }

        .stock-bajo {
            background: #f8d7da;
            color: #721c24;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
        }

        .btn-volver {
            background: #6c757d;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Productos Disponibles</h1>
            <div class="header-buttons">
                <a href="index.php" class="btn btn-disponibles">Volver al Inicio</a>
            </div>
        </header>

        <div class="content">
            <a href="index.php" class="btn-volver">← Volver</a>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Verificar si hay productos disponibles
                    if(mysqli_num_rows($resultado) > 0) {
                        // Mostrar cada producto
                        while($producto = mysqli_fetch_assoc($resultado)) {
                            // Determinar el estado del stock
                            $stock = $producto['stock'];
                            if($stock > 20) {
                                $clase_stock = "stock-alto";
                                $estado = "Stock Alto";
                            } elseif($stock > 10) {
                                $clase_stock = "stock-medio";
                                $estado = "Stock Medio";
                            } else {
                                $clase_stock = "stock-bajo";
                                $estado = "Stock Bajo";
                            }

                            echo "<tr>";
                            echo "<td>" . str_pad($producto['id'], 3, '0', STR_PAD_LEFT) . "</td>";
                            echo "<td>" . htmlspecialchars($producto['nombre']) . "</td>";
                            echo "<td>" . htmlspecialchars($producto['categoria']) . "</td>";
                            echo "<td>$" . number_format($producto['precio'], 2) . "</td>";
                            echo "<td>" . $stock . " unidades</td>";
                            echo "<td><span class='$clase_stock'>$estado</span></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' style='text-align: center;'>No hay productos disponibles en stock</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php
// Cerrar conexión
mysqli_close($conexion);
?>
```