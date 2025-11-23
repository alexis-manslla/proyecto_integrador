<?php
$servidor = "localhost";
$usuario = "root";  // Cambia esto si tu usuario es diferente
$password = "";     // Cambia esto si tienes contraseña
$base_datos = "gestion_productos";

// Crear conexión
$conexion = mysqli_connect($servidor, $usuario, $password, $base_datos);

// Verificar conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Opcional: establecer charset utf8
mysqli_set_charset($conexion, "utf8");
?>