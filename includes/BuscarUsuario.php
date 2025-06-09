<?php
    require_once('database.php');

    if (isset($_GET['buscar'])) {
        $term = $_GET['buscar'];
        $sql =  "SELECT id FROM rol WHERE Rol like ? ";

        $idRol = executeQuery(true, $sql, ["%$term%"]);

        if($idRol){
            $sql = "SELECT * FROM tusuarios WHERE Nombre LIKE ? OR Correo LIKE ? OR ID_Usuario = ? OR Rol_id = ?";
            $resultados = executeQuery(true, $sql, ["%$term%", "%$term%", "%$term%", $idRol[0]['id']]);
        }
        else {
            $sql = "SELECT * FROM tusuarios WHERE Nombre LIKE ? OR Correo LIKE ? OR ID_Usuario LIKE ? ";
            $resultados = executeQuery(true, $sql, ["%$term%", "%$term%", "%$term%"]);
        }

    } else {
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
                <th>Nombre</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Pedido</th>
                <th>Libro</th>
            </tr>
            </thead>';
        echo '<tbody>';
        foreach ($resultados as $usuario) {
            echo '<tr>';
            echo '<td>' . $usuario['ID_Usuario'] . '</td>';
            echo '<td>' . $usuario['Nombre'] . '</td>';
            echo '<td>' . $usuario['Correo'] . '</td>';
            $sql = "SELECT Rol FROM rol WHERE id = ?";
            $Rol = executeQuery(true, $sql,[$usuario['Rol_id']]);
            echo '<td>' . $Rol[0]['Rol'] . '</td>';
            $sql = "SELECT * FROM tprestamos WHERE TUsuarios_ID_Usuario = ?";
            $Pedido = executeQuery(true, $sql, [$usuario['ID_Usuario']]);
            if($Pedido){
                $sql = "SELECT Nombre FROM tlibros WHERE ID_Libros in (SELECT TLibros_ID_Libros FROM tprestamos WHERE TUsuarios_ID_Usuario = ?)"; 
                $Libro = executeQuery(true, $sql, [$usuario['ID_Usuario']]); 
                echo '<td>';
                foreach($Pedido as $pedido){
                    echo '<li>' .$pedido['ID_Prestamo']. '</li>';
                }
                echo '</td>';
                echo '<td>';
                foreach($Libro as $libro){
                    echo '<li>' .$libro['Nombre']. '</li>';
                }
                echo '</td>';
            }else{
                echo '<td>No tiene prestamos</td>';
            }
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