<?php
    require_once('database.php');

    if (isset($_GET['buscar'])) {
        $term = $_GET['buscar'];
        $sql =  "SELECT ID_Genero FROM tgeneros WHERE Genero LIKE ? ";
        $idGenero = executeQuery(true, $sql, ["%$term%"]);
        $sqlAutor = "SELECT ID_Autor FROM tautores WHERE Autor LIKE ? ";
        $idAutor = executeQuery(true, $sqlAutor, ["%$term%"]);

        if(!empty($idGenero)){
            $sql = "SELECT * FROM tlibros WHERE Nombre LIKE ?  OR TGeneros_ID_Genero = ? ";
            $resultados = executeQuery(true, $sql, ["%$term%", $idGenero[0]['ID_Genero']]);
        }
        else if(!empty($idAutor)) {
            $id = $idAutor[0]['ID_Autor'];
            $sql = "SELECT * FROM tlibros WHERE Nombre LIKE ? OR TAutores_ID_Autor = ?";
            $resultados = executeQuery(true, $sql, ["%$term%", $id]);
        } else {
            $sql = "SELECT * FROM tlibros WHERE ID_Libros LIKE ? OR Nombre LIKE ? OR ISBN LIKE ?";
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
                <th>ISBN</th>
                <th>Género</th>
                <th>Autor</th>
                <th>Pedido</th>
                <th>Usuario</th>
            </tr>
            </thead>';
        echo '<tbody>';
        foreach ($resultados as $libro) {
            echo '<tr>';
            echo '<td>' . $libro['ID_Libros'] . '</td>';
            echo '<td>' . $libro['Nombre'] . '</td>';
            echo '<td>' . $libro['ISBN'] . '</td>';

            $sql = "SELECT Genero FROM tgeneros WHERE ID_Genero = ?";
            $Genero = executeQuery(true, $sql,[$libro['TGeneros_ID_Genero']]);
            echo '<td>' . $Genero[0]['Genero'] . '</td>';

            $sql = "SELECT Autor FROM tautores WHERE ID_Autor = ?";
            $Autor = executeQuery(true, $sql,[$libro['TAutores_ID_Autor']]);
            echo '<td>' . $Autor[0]['Autor'] . '</td>';

            $sql = "SELECT * FROM tprestamos WHERE TLibros_ID_Libros = ?";
            $Pedido = executeQuery(true, $sql, [$libro['ID_Libros']]);
            if($Pedido){
                $sql = "SELECT Nombre FROM tusuarios WHERE ID_Usuario in (SELECT TUsuarios_ID_Usuario FROM tprestamos WHERE TLibros_ID_Libros = ?)"; 
                $Usuario = executeQuery(true, $sql, [$libro['ID_Libros']]); 
                echo '<td>';
                foreach($Pedido as $pedido){
                    echo '<li>' .$pedido['ID_Prestamo']. '</li>';
                }
                echo '</td>';
                echo '<td>';
                foreach($Usuario as $usuario){
                    echo '<li>' .$usuario['Nombre']. '</li>';
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