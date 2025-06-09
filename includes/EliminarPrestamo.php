<?php

require_once('database.php');

if (!empty($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "DELETE FROM tprestamos WHERE ID_Prestamo = ?";
    $deleteBook = executeQuery(false, $sql, [$id]);

    if ($deleteBook !== false) {
        echo '<p>Prestamo eliminado</p>';
    } else {
        echo '<p>Error al eliminar libro</p>';
    }
}

?>