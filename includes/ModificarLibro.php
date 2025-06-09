<?php

require_once ('database.php');
require_once ('../models/Libros.php');

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

    $Libro = new Libro( 
        $Campos["Nombre"],
        $Campos["ISBN"],
        $Campos["Autor"],
        $Campos["Genero"]
    );

    // Verifica si el libro ya existe por su ID
    $sql = "SELECT * FROM tlibros WHERE ID_Libros = ?";
    $existingBook = executeQuery(true, $sql, [$Campos["ID_Libros"]]);

    $autor = array();

    $sql = "SELECT * FROM tautores WHERE Autor = ?";

    $autor = executeQuery(true, $sql, [$Libro->getAutor()]);

    if(empty($autor)){
        $sql = "INSERT INTO tautores (Autor) Values (?)";

        $autor = executeQuery(false, $sql, [$Libro->getAutor()]);

        if($autor !== false){
            echo '<p>Autor registrado</p>';  
        }
        else {
            echo '<p>Error al ingresar el autor</p>';  
        }
    }

    $sql = "SELECT ID_Autor FROM tautores WHERE Autor = ?";

    $idautor = executeQuery(true, $sql, [$Libro->getAutor()]);

    if (!empty($existingBook)) {
        // Si existe, actualiza los datos
        $sqlUpdate = "UPDATE tlibros SET Nombre = ?, ISBN = ?, TGeneros_ID_Genero = ?, TAutores_ID_Autor = ? WHERE ID_Libros = ?";
        $result = executeQuery(false, $sqlUpdate, [
            $Libro->getNombre(),
            $Libro->getISBN(),
            $Libro->getGenero(),
            $idautor[0]['ID_Autor'],
            $Campos["ID_Libros"]
        ]);

        if ($result !== false) {
            echo '<p><a href="../CRUD/BibliotecaCRUDLibros.php">Libro actualizado</a></p>';
        } else {
            echo '<p>Error al actualizar el libro</p>';
        }
    } else {
        // Si no existe, puedes manejarlo según tus necesidades (puede ser un error o una inserción)
        echo '<p>Error: El libro no existe</p>';
    }
}
?>
