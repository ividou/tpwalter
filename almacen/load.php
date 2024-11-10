<?php

require 'config.php';

// Columnas a mostrar en la tabla
$columns = ["id_producto", "Nombre", "Categoria", "Marca", "Precio", "stock", "descripcion"];

// Nombre de la tabla
$table = "Productos";

// Clave principal de la tabla
$id = 'id_producto';

// Campo a buscar
$campo = isset($_POST['campo']) ? $conn->real_escape_string($_POST['campo']) : null;

// Filtrado
$where = '';

if ($campo != null) {
    $where = "WHERE (";

    $cont = count($columns);
    for ($i = 0; $i < $cont; $i++) {
        $where .= $columns[$i] . " LIKE '%" . $campo . "%' OR ";
    }
    $where = substr_replace($where, "", -3);
    $where .= ")";
}

// Limites
$limit = isset($_POST['registros']) ? $conn->real_escape_string($_POST['registros']) : 10;
$pagina = isset($_POST['pagina']) ? $conn->real_escape_string($_POST['pagina']) : 0;

if (!$pagina) {
    $inicio = 0;
    $pagina = 1;
} else {
    $inicio = ($pagina - 1) * $limit;
}

$sLimit = "LIMIT $inicio , $limit";

// Ordenamiento
$sOrder = "";
if (isset($_POST['orderCol'])) {
    $orderCol = $_POST['orderCol'];
    $orderType = isset($_POST['orderType']) ? $_POST['orderType'] : 'asc';

    $sOrder = "ORDER BY " . $columns[intval($orderCol)] . ' ' . $orderType;
}

// Consulta
$sql = "SELECT SQL_CALC_FOUND_ROWS " . implode(", ", $columns) . "
FROM $table
$where
$sOrder
$sLimit";
$resultado = $conn->query($sql);
$num_rows = $resultado->num_rows;

// Consulta para total de registros filtrados
$sqlFiltro = "SELECT FOUND_ROWS()";
$resFiltro = $conn->query($sqlFiltro);
$row_filtro = $resFiltro->fetch_array();
$totalFiltro = $row_filtro[0];

// Consulta para total de registros
$sqlTotal = "SELECT count($id) FROM $table";
$resTotal = $conn->query($sqlTotal);
$row_total = $resTotal->fetch_array();
$totalRegistros = $row_total[0];

// Mostrando resultados
$output = [];
$output['totalRegistros'] = $totalRegistros;
$output['totalFiltro'] = $totalFiltro;
$output['data'] = '';
$output['paginacion'] = '';

if ($num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $output['data'] .= '<tr>';
        $output['data'] .= '<td>' . $row['id_producto'] . '</td>';
        $output['data'] .= '<td>' . $row['Nombre'] . '</td>';
        $output['data'] .= '<td>' . $row['Categoria'] . '</td>';
        $output['data'] .= '<td>' . $row['Marca'] . '</td>';
        $output['data'] .= '<td>' . $row['Precio'] . '</td>';
        $output['data'] .= '<td>' . $row['stock'] . '</td>';
        $output['data'] .= '<td>' . $row['descripcion'] . '</td>';
        $output['data'] .= '</tr>';
    }
} else {
    $output['data'] .= '<tr>';
    $output['data'] .= '<td colspan="9">Sin resultados</td>';
    $output['data'] .= '</tr>';
}

// Paginación
if ($totalRegistros > 0) {
    $totalPaginas = ceil($totalFiltro / $limit);

    $output['paginacion'] .= '<nav>';
    $output['paginacion'] .= '<ul class="pagination">';

    $numeroInicio = max(1, $pagina - 4);
    $numeroFin = min($totalPaginas, $numeroInicio + 9);

    for ($i = $numeroInicio; $i <= $numeroFin; $i++) {
        $output['paginacion'] .= '<li class="page-item' . ($pagina == $i ? ' active' : '') . '">';
        $output['paginacion'] .= '<a class="page-link" href="#" onclick="nextPage(' . $i . ')">' . $i . '</a>';
        $output['paginacion'] .= '</li>';
    }

    $output['paginacion'] .= '</ul>';
    $output['paginacion'] .= '</nav>';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
?>
