<?php
include 'conexion.php';

// Verificar si se recibió un ID
if(!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

// Obtener los datos del producto
$query = "SELECT * FROM productos WHERE id = $id";
$resultado = mysqli_query($conexion, $query);

if(mysqli_num_rows($resultado) == 0) {
    header("Location: index.php");
    exit();
}

$producto = mysqli_fetch_assoc($resultado);

// Procesar el formulario cuando se envía
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $categoria = mysqli_real_escape_string($conexion, $_POST['categoria']);
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    
    $query_update = "UPDATE productos SET 
                     nombre = '$nombre', 
                     categoria = '$categoria', 
                     precio = $precio, 
                     stock = $stock 
                     WHERE id = $id";
    
    if(mysqli_query($conexion, $query_update)) {
        header("Location: index.php?mensaje=actualizado");
        exit();
    } else {
        $error = "Error al actualizar: " . mysqli_error($conexion);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Producto</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        .form-container {
            max-width: 600px;
            margin: 30px auto;
            background: white;
            padding: 30px;
            border: 1px solid #ddd;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        .botones {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }

        .btn-guardar {
            background: #28a745;
            color: white;
            padding: 12px 30px;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-cancelar {
            background: #6c757d;
            color: white;
            padding: 12px 30px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Modificar Producto</h2>

        <?php if(isset($error)): ?>
            <div class="mensaje mensaje-error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="nombre">Nombre del Producto:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required>
            </div>

            <div class="form-group">
                <label for="categoria">Categoría:</label>
                <input type="text" id="categoria" name="categoria" value="<?php echo htmlspecialchars($producto['categoria']); ?>" required>
            </div>

            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" step="0.01" value="<?php echo $producto['precio']; ?>" required>
            </div>

            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="number" id="stock" name="stock" value="<?php echo $producto['stock']; ?>" required>
            </div>

            <div class="botones">
                <button type="submit" class="btn-guardar">Guardar Cambios</button>
                <a href="index.php" class="btn-cancelar">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>

<?php
mysqli_close($conexion);
?>