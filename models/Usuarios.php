<?php
    require_once ('../includes/database.php');
    class Usuario{
        private $Nombre;
        private $Correo;
        private $Password;
        private $Rol;

        public function __construct($Nombre, $Correo, $Password, $Rol){
            $this->Nombre = $Nombre;
            $this->Correo = $Correo;
            $this->Password = $Password;
            $this->Rol = $Rol;
        }
        
        public function getNombre() {
            return $this->Nombre;
        }
        
        public function getCorreo() {
            return $this->Correo;
        }
        
        
        public function getPassword() {
            return $this->Password;
        }

        
        public function getRol() {
            return $this->Rol;
        }
        
        public function setNombre($Nombre) {
            $this->Nombre = $Nombre;
        }
    
        public function setISBN($Correo) {
            $this->Correo = $Correo;
        }
        
        public function setPassword($Password) {
            $this->Password = password_hash($Password, PASSWORD_BCRYPT);
        }
        
        public function setRol($Rol) {
            $this->Rol = $Rol;
        } 
    }
?>