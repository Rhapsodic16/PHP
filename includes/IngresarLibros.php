<?php

require_once ('database.php');

require_once('../models/Libros.php');

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

    
    $autor = array();

    $sql = "SELECT * FROM tautores WHERE Autor = ?";

    $autor = executeQuery(true, $sql, [$Libro->getAutor()]);

    if(empty($autor)){
        $sql = "INSERT INTO tautores (Autor) Values (?)";

        $autor = executeQuery(false, $sql, [$Libro->getAutor()]);

        if($autor !== false){ 
        }
        else {
            echo '<p>Error al ingresar el autor</p>';  
        }
    }

    $sql = "SELECT ID_Autor FROM tautores WHERE Autor = ?";

    $idautor = executeQuery(true, $sql, [$Libro->getAutor()]);

    $sql = "INSERT INTO tlibros (Nombre, ISBN, TGeneros_ID_Genero, TAutores_ID_Autor) Values (?, ?, ?, ?)";

    $result = executeQuery(false, $sql, [
        $Libro->getNombre(),
        $Libro->getISBN(),
        $Libro->getGenero(),
        $idautor[0]['ID_Autor']
    ]);

    if ($result !== false){
        echo '<p><a href="../CRUD/BibliotecaCRUDLibros.php">Libro registrado</a></p>';
    }
}
?>