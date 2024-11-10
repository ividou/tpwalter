<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>

    <style>
        table, th, td {
            border: 1px solid;
        }

        table {
            width: 80%;
            border-collapse: collapse;
        }

        th.sort.asc::after {
            content: " 🔼";
        }

        th.sort.desc::after {
            content: " 🔽";
        }

        th.sort {
            cursor: pointer;
        }
    </style>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-4 text-center">
        <h2>Productos</h2>

        <div class="row g-4">
            <div class="col-auto text-start">
                <label for="num_registros" class="col-form-label">Mostrar: </label>
            </div>

            <div class="col-auto text-start">
                <select name="num_registros" id="num_registros" class="form-select">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>

            <div class="col-auto text-start">
                <label for="num_registros" class="col-form-label">registros</label>
            </div>

            <div class="col-md-4 col-xl-5"></div>

            <div class="col-6 col-md-1 text-end">
                <label for="campo" class="col-form-label">Buscar: </label>
            </div>

            <div class="col-6 col-md-3 text-end">
                <input type="text" name="campo" id="campo" class="form-control">
            </div>
        </div>

        <div class="row py-4">
            <div class="col">
                <table class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="sort asc">ID Producto</th>
                            <th class="sort asc">Nombre</th>
                            <th class="sort asc">Categoría</th>
                            <th class="sort asc">Marca</th>
                            <th class="sort asc">Precio</th>
                            <th class="sort asc">Stock</th>
                            <th class="sort asc">Descripción</th>
                            <!-- Eliminadas las columnas para los botones -->
                        </tr>
                    </thead>

                    <tbody id="content">
                        <!-- Contenido dinámico -->
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row justify-content-between">
            <div class="col-12 col-md-4">
                <label id="lbl-total"></label>
            </div>

            <div class="col-12 col-md-4" id="nav-paginacion"></div>

            <input type="hidden" id="pagina" value="1">
            <input type="hidden" id="orderCol" value="0">
            <input type="hidden" id="orderType" value="asc">
        </div>
    </div>

    <script>
        // Llamando a la función getData() al cargar la página
        document.addEventListener("DOMContentLoaded", getData);

        // Función para obtener datos con AJAX
        function getData() {
            let input = document.getElementById("campo").value;
            let num_registros = document.getElementById("num_registros").value;
            let content = document.getElementById("content");
            let pagina = document.getElementById("pagina").value || 1;
            let orderCol = document.getElementById("orderCol").value;
            let orderType = document.getElementById("orderType").value;

            let formaData = new FormData();
            formaData.append('campo', input);
            formaData.append('registros', num_registros);
            formaData.append('pagina', pagina);
            formaData.append('orderCol', orderCol);
            formaData.append('orderType', orderType);

            fetch("load.php", {
                method: "POST",
                body: formaData
            })
            .then(response => response.json())
            .then(data => {
                content.innerHTML = data.data;
                document.getElementById("lbl-total").innerHTML = `Mostrando ${data.totalFiltro} de ${data.totalRegistros} registros`;
                document.getElementById("nav-paginacion").innerHTML = data.paginacion;

                // Ajustar la paginación si no hay resultados
                if (data.data.includes('Sin resultados') && parseInt(pagina) !== 1) {
                    nextPage(1);
                }
            })
            .catch(err => console.log(err));
        }

        // Función para cambiar de página
        function nextPage(pagina) {
            document.getElementById('pagina').value = pagina;
            getData();
        }

        // Función para ordenar columnas
        function ordenar(e) {
            let elemento = e.target;
            let orderType = elemento.classList.contains("asc") ? "desc" : "asc";

            document.getElementById('orderCol').value = elemento.cellIndex;
            document.getElementById("orderType").value = orderType;
            elemento.classList.toggle("asc");
            elemento.classList.toggle("desc");

            getData();
        }

        // Event listeners para los eventos de cambio en el campo de búsqueda y el select
        document.getElementById("campo").addEventListener("keyup", getData);
        document.getElementById("num_registros").addEventListener("change", getData);

        // Event listener para ordenar las columnas
        let columns = document.querySelectorAll(".sort");
        columns.forEach(column => {
            column.addEventListener("click", ordenar);
        });
    </script>

    <!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
