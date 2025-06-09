<?php
    require_once ('../includes/database.php');
    
    class Prestamo{

        private $FechaPrestamo;
        private $FechaEntrega;
        private $Usuario;
        private $Estado;
        private $Libro;

        public function __construct($FechaPrestamo, $FechaEntrega, $Usuario, $Estado, $Libro){
            $this->FechaPrestamo = $FechaPrestamo;
            $this->FechaEntrega = $FechaEntrega;
            $this->Usuario = $Usuario;
            $this->Estado = $Estado;
            $this->Libro = $Libro;
        }
        
        public function getFechaPrestamo() {
            return $this->FechaPrestamo;
        }
        
        public function getFechaEntrega() {
            return $this->FechaEntrega;
        }
        
        public function getUsuario() {
            return $this->Usuario;
        }
        
        public function getEstado() {
            return $this->Estado;
        }

        public function getLibro() {
            return $this->Libro;
        }
        
        public function setFechaPrestamo($FechaPrestamo) {
            $this->FechaPrestamo = $FechaPrestamo;
        }
    
        public function setFechaEntrega($FechaEntrega) {
            $this->FechaEntrega = $FechaEntrega;
        }
        
        public function setUsuario($Usuario) {
            $this->Usuario = $Usuario;
        }
        
        public function setEstado($Estado) {
            $this->Estado = $Estado;
        }

        public function setLibro($Libro){
            $this->Libro = $Libro;
        }
    }
?>