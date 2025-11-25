<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'conexion.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = trim($_POST['nombre']);
    $categoria = trim($_POST['categoria']);
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    
    try {
        $stmt = $conexion->prepare("INSERT INTO productos (nombre, categoria, precio, stock) VALUES (:nombre, :categoria, :precio, :stock)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':categoria', $categoria);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':stock', $stock);
        
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
    <title>Crear Producto</title>
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
                    <div class="card-header"><h4 class="mb-0">Crear Producto</h4></div>
                    <div class="card-body">
                        <?php if(isset($error)) echo '<div class="alert alert-danger">' . $error . '</div>'; ?>
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Categoría</label>
                                <input type="text" class="form-control" name="categoria" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Precio</label>
                                <input type="number" class="form-control" name="precio" step="0.01" min="0.01" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Stock</label>
                                <input type="number" class="form-control" name="stock" min="1" required>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Crear</button>
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