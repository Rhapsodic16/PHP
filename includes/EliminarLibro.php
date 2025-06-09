<?php

require_once('database.php');

if (!empty($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM tprestamos WHERE TLibros_ID_Libros = ?";
    $verifyBook = executeQuery(true, $sql, [$id]);
    if(!empty($verifyBook)){
        echo '<h3>No se puede eliminar el libro debido a que fue prestado.</h3>
            <h3>Número de préstamo:'.$verifyBook[0]['ID_Prestamo'].' </h3>';
    }
    else {
        $sql = "DELETE FROM tlibros WHERE ID_Libros = ?";
        $deleteBook = executeQuery(false, $sql, [$id]);

        if ($deleteBook !== false) {
            echo '<p>Libro eliminado</p>';
        } else {
            echo '<p>Error al eliminar libro</p>';
        }
    }

}

?>