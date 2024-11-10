<!-- Modal para eliminar producto -->
<div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminaModalLabel">Confirmar eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar este producto?
            </div>
            <div class="modal-footer">
                <form action="elimina.php" method="POST">
                    <!-- Campo oculto para enviar el ID del producto -->
                    <input type="hidden" name="id_producto" id="id_producto_eliminar">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script para pasar el ID al modal -->
<script>
    var eliminaModal = document.getElementById('eliminaModal');
    eliminaModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Botón que activó el modal
        var idProducto = button.getAttribute('data-id'); // Extrae el ID del atributo data-id
        var inputId = document.getElementById('id_producto_eliminar'); // Campo oculto en el formulario
        inputId.value = idProducto; // Asigna el valor al input
    });
</script>
