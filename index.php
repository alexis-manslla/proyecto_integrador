<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Consultar todos los productos
$query = "SELECT * FROM productos ORDER BY id ASC";
$resultado = mysqli_query($conexion, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>TechnoMarket</h1>
            <div class="header-buttons">
                <a href="agregar.php" class="btn btn-agregar">Agregar Producto</a>
                <a href="disponibles.php" class="btn btn-disponibles">Ver Disponibles</a>
            </div>
        </header>

        <div class="content">
            <?php
            // Mostrar mensajes de éxito o error
            if(isset($_GET['mensaje'])) {
                if($_GET['mensaje'] == 'eliminado') {
                    echo '<div class="mensaje mensaje-exito">Producto eliminado correctamente</div>';
                } elseif($_GET['mensaje'] == 'actualizado') {
                    echo '<div class="mensaje mensaje-exito">Producto actualizado correctamente</div>';
                } elseif($_GET['mensaje'] == 'agregado') {
                    echo '<div class="mensaje mensaje-exito">Producto agregado correctamente</div>';
                }
            }
            ?>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Verificar si hay productos
                    if(mysqli_num_rows($resultado) > 0) {
                        // Mostrar cada producto
                        while($producto = mysqli_fetch_assoc($resultado)) {
                            echo "<tr>";
                            echo "<td>" . str_pad($producto['id'], 3, '0', STR_PAD_LEFT) . "</td>";
                            echo "<td>" . htmlspecialchars($producto['nombre']) . "</td>";
                            echo "<td>" . htmlspecialchars($producto['categoria']) . "</td>";
                            echo "<td>$" . number_format($producto['precio'], 2) . "</td>";
                            echo "<td>" . $producto['stock'] . " unidades</td>";
                            echo "<td class='action-buttons'>";
                            echo "<a href='modificar.php?id=" . $producto['id'] . "' class='btn-modificar'>Modificar</a>";
                            echo "<a href='eliminar.php?id=" . $producto['id'] . "' class='btn-eliminar' onclick='return confirm(\"¿Estás seguro de eliminar este producto?\")'>Eliminar</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' style='text-align: center;'>No hay productos registrados</td></tr>";
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