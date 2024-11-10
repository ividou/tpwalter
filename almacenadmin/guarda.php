<?php
session_start();
require '../almacenadmin/config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $marca = $_POST['marca'];
    $categoria = $_POST['categoria'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $sql = "INSERT INTO productos (Nombre, descripcion, Marca, Categoria, Precio, stock) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdii", $nombre, $descripcion, $marca, $categoria, $precio, $stock);

    if ($stmt->execute()) {
        $_SESSION['msg'] = "Producto creado con éxito.";
        $_SESSION['color'] = "success";
    } else {
        $_SESSION['msg'] = "Error al crear el producto.";
        $_SESSION['color'] = "danger";
    }

    $stmt->close();
    $conn->close();
    header("Location: index.php"); // Redirige a index.php
    exit;
}
