<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'conexion.php';

if(!isset($_GET['id'])) {
    header("Location: http://localhost/proyecto_integrador/Codigo/index.php");
    exit();
}

$id = $_GET['id'];

$stmt = $conexion->prepare("SELECT * FROM productos WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$p = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$p) {
    header("Location: http://localhost/proyecto_integrador/Codigo/index.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = trim($_POST['nombre']);
    $categoria = trim($_POST['categoria']);
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    
    try {
        $stmt = $conexion->prepare("UPDATE productos SET nombre = :nombre, categoria = :categoria, precio = :precio, stock = :stock WHERE id = :id");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':categoria', $categoria);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':id', $id);
        
        $stmt->execute();
        header("Location: http://localhost/proyecto_integrador/Codigo/index.php");
        exit();
        
    } catch(PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="http://localhost/proyecto_integrador/Codigo/index.php">TechnoMarket</a>
            <a href="http://localhost/proyecto_integrador/Codigo/index.php" class="btn btn-outline-light btn-sm">Volver</a>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h4 class="mb-0">Editar Producto</h4></div>
                    <div class="card-body">
                        <?php if(isset($error)) echo '<div class="alert alert-danger">' . $error . '</div>'; ?>
                        <form method="POST" action="">
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
                                <input type="number" class="form-control" name="precio" step="0.01" min="0.01" value="<?php echo $p['precio']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Stock</label>
                                <input type="number" class="form-control" name="stock" min="1" value="<?php echo $p['stock']; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Guardar Cambios</button>
                            <a href="http://localhost/proyecto_integrador/Codigo/index.php" class="btn btn-secondary w-100 mt-2">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>