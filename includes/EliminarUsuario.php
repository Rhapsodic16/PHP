<?php

require_once('database.php');

if (!empty($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "SELECT * FROM tprestamos WHERE TUsuarios_ID_Usuario = ?";
    $verifyUser = executeQuery(true, $sql, [$id]);
    if(!empty($verifyUser)){
        echo '<h3>No se puede eliminar el usuario debido a que tiene un préstamo.</h3>
            <h3>Número de préstamo:'.$verifyUser[0]['ID_Prestamo'].' </h3>';
    }
    else {
        $sql = "DELETE FROM tusuarios WHERE ID_Usuario = ?";
        $deleteBook = executeQuery(false, $sql, [$id]);

        if ($deleteBook !== false) {
            echo '<p>Usuario eliminado</p>';
        } else {
        echo '<p>Error al eliminar libro</p>';
        }
    }
    
}

?>