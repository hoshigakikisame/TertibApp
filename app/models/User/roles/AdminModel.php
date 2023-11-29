<?php 
    class AdminModel {
        protected int $idAdmin;
        protected string $firstName;
        protected string $lastName;
        protected string $idUser;

        public function __construct($idAdmin, $firstName, $lastName, $idUser) {
            $this->idAdmin = $idAdmin;
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->idUser = $idUser;
        }

        public static function fromStdClass($stdClass): AdminModel {
            return new AdminModel(
                $stdClass->id_admin,
                $stdClass->first_name,
                $stdClass->last_name,
                $stdClass->id_user
            );
        }

        public function getIdAdmin() {
            return $this->idAdmin;
        }

        public function getFirstName() {
            return $this->firstName;
        }

        public function getLastName() {
            return $this->lastName;
        }

        public function getIdUser() {
            return $this->idUser;
        }

        public function setIdAdmin($idAdmin) {
            $this->idAdmin = $idAdmin;
        }

        public function setFirstName($firstName) {
            $this->firstName = $firstName;
        }

        public function setLastName($lastName) {
            $this->lastName = $lastName;
        }

        public function setIdUser($idUser) {
            $this->idUser = $idUser;
        }
    }