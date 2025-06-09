<?php
    require_once('database.php');

    if (isset($_GET['buscar'])) {
        $term = $_GET['buscar'];
        $sql =  "SELECT ID_Usuario FROM tusuarios WHERE Nombre LIKE ? ";
        $idUsuario = executeQuery(true, $sql, ["%$term%"]);
        $sql = "SELECT ID_Estados FROM testados WHERE Estado LIKE ? ";
        $idEstado = executeQuery(true, $sql, ["%$term%"]);
        $sql = "SELECT ID_Libros FROM tlibros WHERE Nombre LIKE ? ";
        $idLibro = executeQuery(true, $sql, ["%$term%"]);

        if(!empty($idUsuario)){
            $sql = "SELECT * FROM tprestamos WHERE TUsuarios_ID_Usuario = ? ";
            $resultados = executeQuery(true, $sql, [$idUsuario[0]['ID_Usuario']]);
        }
        else if(!empty($idEstado)) {
            $sql = "SELECT * FROM tprestamos WHERE TEstados_ID_Estados = ? ";
            $resultados = executeQuery(true, $sql, [$idEstado[0]['ID_Estados']]);
        }
        else if(!empty($idLibro)) {
            $sql = "SELECT * FROM tprestamos WHERE TLibros_ID_Libros = ? ";
            $resultados = executeQuery(true, $sql, [$idLibro[0]['ID_Libros']]);
        } 
        else {
            $sql = "SELECT * FROM tprestamos WHERE ID_Prestamo LIKE ?";
            $resultados = executeQuery(true, $sql, ["%$term%"]);
        }
    } else if (isset($_GET['buscarFecha'])) {
        $termFecha = $_GET['buscarFecha'];
        $sql = "SELECT FechaPrestamo FROM tprestamos WHERE FechaPrestamo LIKE ? OR FechaEntrega LIKE ? ";
        $fecha = executeQuery(true, $sql, ["%$termFecha%", "%$termFecha%"]);
    
        if(!empty($fecha)) {
            $sql = "SELECT * FROM tprestamos WHERE FechaPrestamo = ? OR FechaEntrega = ?";
            $resultados = executeQuery(true, $sql, [$fecha[0]['FechaPrestamo'], $fecha[0]['FechaPrestamo']]);
        } 
    }
    else {
        $resultados = []; // Inicializar la variable $resultados
    }

?>

<div id="resultadoBusqueda">
    <h2>Resultados</h2>
    <?php
    // Mostrar los resultados
    if (!empty($resultados)) {
        echo '<div class="tabla">';
        echo '<table>';
        echo '<thead><tr>
                <th>ID</th>
                <th>Fecha de entrega</th>
                <th>Fecha de recibido</th>
                <th>ID</th>
                <th>Usuario</th>
                <th>Estado</th>
                <th>ID</th>
                <th>Libro</th>
            </tr>
            </thead>';
        echo '<tbody>';
        foreach ($resultados as $prestamo) {
            echo '<tr>';
            echo '<td>' . $prestamo['ID_Prestamo'] . '</td>';
            echo '<td>' . $prestamo['FechaPrestamo'] . '</td>';
            echo '<td>' . $prestamo['FechaEntrega'] . '</td>';
            echo '<td>' . $prestamo['TUsuarios_ID_Usuario'] . '</td>';

            $sql = "SELECT Nombre FROM tusuarios WHERE ID_Usuario = ?";
            $usuario = executeQuery(true, $sql,[$prestamo['TUsuarios_ID_Usuario']]);
            echo '<td>' . $usuario[0]['Nombre'] . '</td>';

            $sql = "SELECT Estado FROM testados WHERE ID_Estados = ?";
            $estado = executeQuery(true, $sql,[$prestamo['TEstados_ID_Estados']]);
            echo '<td>' . $estado[0]['Estado'] . '</td>';

            echo '<td>' . $prestamo['TLibros_ID_Libros'] . '</td>';

            $sql = "SELECT Nombre FROM tlibros WHERE ID_Libros = ?";
            $libro = executeQuery(true, $sql,[$prestamo['TLibros_ID_Libros']]);
            echo '<td>' . $libro[0]['Nombre'] . '</td>';

            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    } else {
        echo '<p>No se encontraron resultados.</p>';
    }
    ?>
</div>