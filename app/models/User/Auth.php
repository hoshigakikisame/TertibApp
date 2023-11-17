<?php 
    class Auth {
        protected $idUser;
        protected $username;
        protected $role;

        public function __construct($idUser, $username, $role) {
            $this->idUser = $idUser;
            $this->username = $username;
            $this->role = $role;
        }

        public function getIdUser() {
            return $this->idUser;
        }

        public function getUsername() {
            return $this->username;
        }

        public function getRole() {
            return $this->role;
        }

        public function setIdUser($idUser) {
            $this->idUser = $idUser;
        }

        public function setUsername($username) {
            $this->username = $username;
        }

        public function setRole($role) {
            $this->role = $role;
        }

        public function isAdmin() {
            return $this->role == 'admin';
        }
    }
