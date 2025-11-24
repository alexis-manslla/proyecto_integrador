<?php
include 'conexion.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $query = "DELETE FROM productos WHERE id = $id";
    
    if(mysqli_query($conexion, $query)) {
        header("Location: index.php?mensaje=eliminado");
    } else {
        echo "Error al eliminar: " . mysqli_error($conexion);
    }
} else {
    header("Location: index.php");
}

mysqli_close($conexion);
?>
```

## Estructura de archivos:
```
tu_carpeta/
├── estilos.css
├── conexion.php
├── index.php
└── eliminar.php