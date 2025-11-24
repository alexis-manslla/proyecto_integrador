<?php
include 'conexion.php';
if(isset($_GET['id'])) {
    mysqli_query($conexion, "DELETE FROM productos WHERE id = " . $_GET['id']);
    header("Location: index.php?mensaje=eliminado");
} else {
    header("Location: index.php");
}
mysqli_close($conexion);
?>