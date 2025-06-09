<?php 
    require_once('database.php');

    require_once('../models/Usuarios.php');

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
        
        $Usuario= new Usuario(
                        $Campos['Nombre'],
                        $Campos['Correo'],
                        NULL,
                        2);
        
        $Usuario->setPassword($Campos['Password']);
        
        $sql = "INSERT INTO tusuarios (Nombre, Correo, Password, Rol_id) VALUES (?, ?, ?, ?)";
        
        $result = executeQuery(false, $sql, [
            $Usuario->getNombre(),
            $Usuario->getCorreo(),
            $Usuario->getPassword(),
            $Usuario->getRol(),
        ]);
        
        if ($result) {
            echo '<p><a href="../CRUD/BibliotecaCRUDUsuarios.php">Libro registrado</a></p>';
        }
    }
?>