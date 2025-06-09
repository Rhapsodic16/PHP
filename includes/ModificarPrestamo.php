<?php

require_once ('database.php');
require_once ('../models/Prestamos.php');

$Campos = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    foreach ($_POST as $key => $valor){
        $Campos[$key] = $valor;
    }

    foreach($_FILES as $key => $valor) {
        $Campos[$key] = $valor;
    }   

    foreach($Campos as $key => $valor) {  
        if (is_array($valor)) {
            foreach($valor as $file => $file_valor) {
                $Campos[$file] = $file_valor;
            }
        }
    }

    $Prestamo = new Prestamo( 
        $Campos["FechaPrestamo"],
        $Campos["FechaEntrega"],
        $Campos["Usuario"],
        $Campos["Estado"],
        $Campos['Libro']
    );

    $sql = "UPDATE tprestamos SET FechaPrestamo = ?, FechaEntrega = ?, TUsuarios_ID_Usuario = ?, TLibros_ID_Libros = ?, TEstados_ID_Estados = ? WHERE ID_Prestamo = ?";

    $result = executeQuery(false, $sql, [
        $Prestamo->getFechaPrestamo(),
        $Prestamo->getFechaEntrega(),
        $Prestamo->getUsuario(),
        $Prestamo->getLibro(),
        $Prestamo->getEstado(),
        $Campos["ID_Prestamo"]
    ]);

    if ($result) {
        echo '<p class="sucess"><a href="../CRUD/BibliotecaCRUDPedidos.php">Cambio registrado</p>';
    }
    else {
        echo '<p>Error</p>';
    }
}
?>
