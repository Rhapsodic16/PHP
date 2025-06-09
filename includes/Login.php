<?php

    require_once ('database.php');

    require_once 'models/Usuarios.php';

    $Campos = array();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        foreach ($_POST as $key => $valor) {
            $Campos[$key] = $valor;
        }
    
        $sql = "SELECT * FROM users where Correo = ?";

        $result = executeQuery(true, $sql, [
            $Campos['Email'],
        ]);

        if (empty($result)) {
            echo "<p class='error'>Los campos están vacios.</p>";
        exit;
    }

    if ($result) {
        $Usuario = new Usuario(  
            $result[0]['id'],
            $result[0]['Name'],
            $result[0]['Username'],
            $result[0]['Email'],
            $result[0]['Password'],
            $result[0]['Avatar']
        );

    session_start();

    if (password_verify($Campos['Password'], $result[0]['Password'])) {
      
        $_SESSION['loggedin'] = true;
        $_SESSION['user'] = $Usuario;

        echo "<p class='sucess'>Autenticado correctamente</p>";
      
        header('Location: /app', true);
        exit;
    } 
    else {
        echo "<p class='error'>Creedenciales de inicio de sesión invalidas</p>";
        exit;
    }
  }
}
?>