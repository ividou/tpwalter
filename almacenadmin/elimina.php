<?php
session_start();
require '../almacenadmin/config/database.php';

// Verifica que se haya enviado un ID de producto válido
if (isset($_POST['id_producto']) && is_numeric($_POST['id_producto'])) {
    $idProducto = intval($_POST['id_producto']);
    
    // Prepara y ejecuta la consulta de eliminación
    $stmt = $conn->prepare("DELETE FROM productos WHERE id_producto = ?");
    $stmt->bind_param("i", $idProducto);

    if ($stmt->execute()) {
        $_SESSION['msg'] = "Producto eliminado correctamente.";
        $_SESSION['color'] = "success";
    } else {
        $_SESSION['msg'] = "Error al eliminar el producto.";
        $_SESSION['color'] = "danger";
    }
    
    $stmt->close();
} else {
    $_SESSION['msg'] = "ID de producto no válido.";
    $_SESSION['color'] = "warning";
}

// Redirige al index
header("Location: index.php");
exit();
