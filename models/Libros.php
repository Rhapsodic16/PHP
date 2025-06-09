<?php
    require_once ('../includes/database.php');
    class Libro{
        private $Nombre;
        private $ISBN;
        private $Autor;
        private $Genero;

        public function __construct($Nombre, $ISBN, $Autor, $Genero){
            $this->Nombre = $Nombre;
            $this->ISBN = $ISBN;
            $this->Autor = $Autor;
            $this->Genero = $Genero;
        }

        public function getNombre() {
            return $this->Nombre;
        }
        
        public function getISBN() {
            return $this->ISBN;
        }
        
        
        public function getAutor() {
            return $this->Autor;
        }

        
        public function getGenero() {
            return $this->Genero;
        }
        
        public function setNombre($Nombre) {
            $this->Nombre = $Nombre;
        }
    
        public function setISBN($ISBN) {
            $this->ISBN = $ISBN;
        }
        
        public function setAutor($Autor) {
            $this->Autor = $Autor;
        }
        
        public function setGenero($Genero) {
            $this->Genero = $Genero;
        }        
    }
?>