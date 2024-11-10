<?php
// Inicia la sesión
session_start();

// Incluye la configuración de la base de datos
require '../almacenadmin/config/database.php';

// Consulta para obtener las pistas y sus respectivas descripciones y autos
$sqlProductos = "SELECT p.id_producto, p.Nombre, p.Categoria, p.Marca, p.Precio, p.stock, p.descripcion 
FROM productos AS p";

// Ejecuta la consulta y almacena los resultados
$productos = $conn->query($sqlProductos);

// Define el directorio donde se guardarán las vistas de las pistas
$dir = "vistas/";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Modal</title>

    <link href="../almacenadmin/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../almacenadmin/assets/css/all.min.css" rel="stylesheet">
</head>

<body>

    <div class="container py-3">

        <h2 class="text-center"> Productos </h2>
        <hr>

        <!-- Muestra mensajes de sesión si existen -->
        <?php if (isset($_SESSION['msg']) && isset($_SESSION['color'])) { ?>
            <div class="alert alert-<?= $_SESSION['color']; ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['msg']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php 
            // Limpia los mensajes de sesión después de mostrarlos
            unset($_SESSION['color']);
            unset($_SESSION['msg']);
        } ?>

        <div class="row g-4">
            <div class="col-auto">
                <label for="num_registros" class="col-form-label">Mostrar: </label>
            </div>
            <div class="col-auto">
                <select name="num_registros" id="num_registros" class="form-select">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </div>
            <div class="col-auto">
                <label for="num_registros" class="col-form-label">registros </label>
            </div>
            <div class="col-5"></div>
            <div class="col-auto">
                <label for="campo" class="col-form-label">Buscar: </label>
            </div>
            <div class="col-auto">
                <input type="text" name="campo" id="campo" class="form-control">
            </div>
        </div>

        <hr>

        <div class="row justify-content-between align-items-center">
            <div class="col-auto">
                <a href="../contexto-de-apilamiento.html" class="btn btn-primary">
                    <i class="fa-solid fa-arrow-left"></i> Volver a la página Principal
                </a>
            </div>
            <div class="col-auto">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoModal">
                    <i class="fa-solid fa-square-plus"></i> Nuevo Registro
                </a>
            </div>
        </div>

        <table class="table table-sm table-striped table-hover mt-4">
            <thead class="table-dark">
                <tr>
                    <th class="sort asc">id</th>
                    <th class="sort asc">Nombre</th>
                    <th class="sort asc">Descripcion</th>
                    <th class="sort asc">Marca</th>
                    <th class="sort asc">Categoria</th>
                    <th class="sort asc">Precio</th>
                    <th class="sort asc">stock</th>
                    <th>Imagen Producto</th>
                    <th class="sort asc">Accion</th>
                </tr>
            </thead>

            <tbody id="content">
                <?php while ($row_producto = $productos->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row_producto['id_producto']; ?></td>
                        <td><?= $row_producto['Nombre']; ?></td>
                        <td><?= $row_producto['descripcion']; ?></td>
                        <td><?= $row_producto['Marca']; ?></td>
                        <td><?= $row_producto['Categoria']; ?></td>
                        <td><?= $row_producto['Precio']; ?></td>
                        <td><?= $row_producto['stock']; ?></td>
                        <td><img src="<?= $dir . $row_producto['id_producto']; ?>.jpg" alt="Vista de producto" style="width: 100px;"></td>
                        <td>
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editaModal" data-bs-id="<?= $row_producto['id_producto']; ?>">Editar</button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminaModal" data-id="<?= $producto['id_producto']; ?>">Eliminar</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="row">
            <div class="col-6">
                <label id="lbl-total"></label>
            </div>
            <div class="col-6" id="nav-paginacion"></div>

            <input type="hidden" id="pagina" value="1">
            <input type="hidden" id="orderCol" value="0">
            <input type="hidden" id="orderType" value="asc">
        </div>

        <?php 
        // Consulta para obtener todos los autos para el modal de nuevo registro
        $sqlProductos = "SELECT id_producto, Nombre FROM productos";
        $productos = $conn->query($sqlProductos);
        ?>
    </div>

    <!-- Inclusión de modales para crear, editar y eliminar registros -->
    <?php include 'nuevoModal.php'; ?>
    <?php $productos->data_seek(0); ?>
    <?php include 'editaModal.php'; ?>
    <?php include 'eliminaModal.php'; ?>

    <script>
        let nuevoModal = document.getElementById('nuevoModal');
        let editarModal = document.getElementById('editaModal');
        let eliminaModal = document.getElementById('eliminaModal');

        // Enfoque automático en el campo de nombre cuando se abre el modal para nuevo registro
        nuevoModal.addEventListener('shown.bs.modal', event => {
            nuevoModal.querySelector('.modal-body #nombre').focus();
        });

        // Limpia los campos del modal de nuevo registro cuando se cierra
        nuevoModal.addEventListener('hide.bs.modal', event => {
            nuevoModal.querySelector('.modal-body #nombre').value = "";
            nuevoModal.querySelector('.modal-body #descripcion').value = "";
            nuevoModal.querySelector('.modal-body #marca').value = ""; // Modificado para reflejar los campos correctos
            nuevoModal.querySelector('.modal-body #categoria').value = ""; // Modificado para reflejar los campos correctos
            nuevoModal.querySelector('.modal-body #precio').value = ""; // Modificado para reflejar los campos correctos
            nuevoModal.querySelector('.modal-body #stock').value = ""; // Modificado para reflejar los campos correctos
        });

        // Limpia los campos del modal de edición cuando se cierra
        editarModal.addEventListener('hide.bs.modal', event => {
            editarModal.querySelector('.modal-body #id').value = ""; // Asegúrate de limpiar el ID
            editarModal.querySelector('.modal-body #nombre').value = "";
            editarModal.querySelector('.modal-body #descripcion').value = "";
            editarModal.querySelector('.modal-body #marca').value = ""; // Modificado para reflejar los campos correctos
            editarModal.querySelector('.modal-body #categoria').value = ""; // Modificado para reflejar los campos correctos
            editarModal.querySelector('.modal-body #precio').value = ""; // Modificado para reflejar los campos correctos
            editarModal.querySelector('.modal-body #stock').value = ""; // Modificado para reflejar los campos correctos
            editarModal.querySelector('.modal-body #img_vista').src = ""; // Asegúrate de limpiar el src de la imagen
        });

        // Rellena el modal de edición con los datos correspondientes
        editarModal.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget; // Botón que activó el modal
            let id = button.getAttribute('data-bs-id'); // Obtiene el ID del registro

            let inputId = editarModal.querySelector('.modal-body #id');
            let inputNombre = editarModal.querySelector('.modal-body #nombre');
            let inputDescripcion = editarModal.querySelector('.modal-body #descripcion');
            let inputMarca = editarModal.querySelector('.modal-body #marca'); // Modificado para reflejar los campos correctos
            let inputCategoria = editarModal.querySelector('.modal-body #categoria'); // Modificado para reflejar los campos correctos
            let inputPrecio = editarModal.querySelector('.modal-body #precio'); // Modificado para reflejar los campos correctos
            let inputStock = editarModal.querySelector('.modal-body #stock'); // Modificado para reflejar los campos correctos
            let imgVista = editarModal.querySelector('.modal-body #img_vista');

            // Realiza la consulta para obtener los datos del producto a editar
            fetch('get_producto.php?id=' + id)
                .then(response => response.json())
                .then(data => {
                    inputId.value = data.id_producto;
                    inputNombre.value = data.Nombre;
                    inputDescripcion.value = data.descripcion;
                    inputMarca.value = data.Marca; // Modificado para reflejar los campos correctos
                    inputCategoria.value = data.Categoria; // Modificado para reflejar los campos correctos
                    inputPrecio.value = data.Precio; // Modificado para reflejar los campos correctos
                    inputStock.value = data.stock; // Modificado para reflejar los campos correctos
                    imgVista.src = "vistas/" + data.id_producto + ".jpg"; // Muestra la imagen del producto
                });
        });
    </script>

    <script src="../almacenadmin/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
