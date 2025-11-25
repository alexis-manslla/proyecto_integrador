<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'conexion.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        $stmt = $conexion->prepare("DELETE FROM productos WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        header("Location: http://localhost/proyecto_integrador/Codigo/index.php");
        exit();
    } catch(PDOException $e) {
        echo "Error al eliminar: " . $e->getMessage();
    }
} else {
    header("Location: http://localhost/proyecto_integrador/Codigo/index.php");
    exit();
}
?>