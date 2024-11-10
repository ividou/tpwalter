<?php
session_start();
require '../almacenadmin/config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $marca = $_POST['marca'];
    $categoria = $_POST['categoria'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $sql = "UPDATE productos SET Nombre=?, descripcion=?, Marca=?, Categoria=?, Precio=?, stock=? WHERE id_producto=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdiii", $nombre, $descripcion, $marca, $categoria, $precio, $stock, $id);

    if ($stmt->execute()) {
        $_SESSION['msg'] = "Producto actualizado con éxito.";
        $_SESSION['color'] = "success";
    } else {
        $_SESSION['msg'] = "Error al actualizar el producto.";
        $_SESSION['color'] = "danger";
    }

    $stmt->close();
    $conn->close();
    header("Location: index.php"); // Redirige a index.php
    exit;
}
