<?php
include 'conexion.php';
if(!isset($_GET['id'])) { header("Location: index.php"); exit(); }

$id = $_GET['id'];
$resultado = mysqli_query($conexion, "SELECT * FROM productos WHERE id = $id");
if(mysqli_num_rows($resultado) == 0) { header("Location: index.php"); exit(); }
$p = mysqli_fetch_assoc($resultado);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $categoria = mysqli_real_escape_string($conexion, $_POST['categoria']);
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    
    if(mysqli_query($conexion, "UPDATE productos SET nombre='$nombre', categoria='$categoria', precio=$precio, stock=$stock WHERE id=$id")) {
        header("Location: index.php?mensaje=actualizado");
        exit();
    } else {
        $error = "Error: " . mysqli_error($conexion);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">TechnoMarket</a>
            <a href="index.php" class="btn btn-outline-light btn-sm">Volver al Inicio</a>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h4 class="mb-0">Modificar Producto</h4></div>
                    <div class="card-body">
                        <?php if(isset($error)) echo '<div class="alert alert-danger">' . $error . '</div>'; ?>
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombre" value="<?php echo htmlspecialchars($p['nombre']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Categoría</label>
                                <input type="text" class="form-control" name="categoria" value="<?php echo htmlspecialchars($p['categoria']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Precio</label>
                                <input type="number" class="form-control" name="precio" step="0.01" value="<?php echo $p['precio']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Stock</label>
                                <input type="number" class="form-control" name="stock" value="<?php echo $p['stock']; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Guardar</button>
                            <a href="index.php" class="btn btn-secondary w-100 mt-2">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php mysqli_close($conexion); ?>