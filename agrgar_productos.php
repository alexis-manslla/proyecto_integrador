<?php
include 'conexion.php';

// Procesar el formulario cuando se envía
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $categoria = mysqli_real_escape_string($conexion, $_POST['categoria']);
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    
    $query = "INSERT INTO productos (nombre, categoria, precio, stock) 
              VALUES ('$nombre', '$categoria', $precio, $stock)";
    
    if(mysqli_query($conexion, $query)) {
        header("Location: index.php?mensaje=agregado");
        exit();
    } else {
        $error = "Error al agregar producto: " . mysqli_error($conexion);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
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
        <h2>Agregar Nuevo Producto</h2>

        <?php if(isset($error)): ?>
            <div class="mensaje mensaje-error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="nombre">Nombre del Producto:</label>
                <input type="text" id="nombre" name="nombre" placeholder="Ej: Laptop Dell Inspiron 15" required>
            </div>

            <div class="form-group">
                <label for="categoria">Categoría:</label>
                <input type="text" id="categoria" name="categoria" placeholder="Ej: Electrónica" required>
            </div>

            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" step="0.01" placeholder="0.00" required>
            </div>

            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="number" id="stock" name="stock" placeholder="0" required>
            </div>

            <div class="botones">
                <button type="submit" class="btn-guardar">Agregar Producto</button>
                <a href="index.php" class="btn-cancelar">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>

<?php
mysqli_close($conexion);
?>