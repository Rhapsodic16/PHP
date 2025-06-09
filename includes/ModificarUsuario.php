<?php

require_once ('database.php');
require_once ('../models/Usuarios.php');

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
    
    $Usuario= new Usuario(
        $Campos['Nombre'],
        $Campos['Correo'],
        NULL,
        2);

    $Usuario->setPassword($Campos['Password']);

    $sql = "UPDATE tusuarios SET Nombre = ?, Correo = ?, Password = ?, Rol_id = ? WHERE ID_Usuario = ?";

    $result = executeQuery(false, $sql, [
        $Usuario->getNombre(),
        $Usuario->getCorreo(),
        $Usuario->getPassword(),
        $Usuario->getRol(),
        $Campos["ID_Usuario"]
    ]);

    if ($result) {
        echo '<p class="sucess"><a href="../CRUD/BibliotecaCRUDUsuarios.php">Cambio regisgtrado</p>';
    }
    else {
        echo '<p>Error</p>';
    }
}
?>
