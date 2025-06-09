<?php 
    require_once('database.php');

    require_once('../models/Prestamos.php');

    $Campos = array();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        foreach($_POST as $key => $valor){
            $Campos[$key]= $valor;
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
                        $Campos['FechaPrestamo'],
                        $Campos['FechaEntrega'],
                        $Campos['Usuario'],
                        1,
                        $Campos['Libro'],);
        
        $sql = "INSERT INTO tprestamos (FechaPrestamo, FechaEntrega, TUsuarios_ID_Usuario, TLibros_ID_Libros, TEstados_ID_Estados) VALUES (?, ?, ?, ?, ?)";
        
        $result = executeQuery(false, $sql, [
            $Prestamo->getFechaPrestamo(),
            $Prestamo->getFechaEntrega(),
            $Prestamo->getUsuario(),
            $Prestamo->getLibro(),
            $Prestamo->getEstado()
        ]);
        
        if ($result) {
            echo '<p class="sucess"><a href="../CRUD/BibliotecaCRUDPedidos.php">Prestamo hecho</p>';
        }
        else {
            echo '<p>Error al agregar el pedido.</p>';
        }
    }
?>