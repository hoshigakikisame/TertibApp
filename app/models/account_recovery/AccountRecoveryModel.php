<?php 
    class AccountRecoveryModel {
        protected int $idAccountRecovery;
        protected string $idUser;
        protected string $token;
        protected string $validUntil;

        public function __construct($idAccountRecovery, $idUser, $token, $validUntil) {
            $this->idAccountRecovery = $idAccountRecovery;
            $this->idUser = $idUser;
            $this->token = $token;
            $this->validUntil = $validUntil;
        }

        public static function fromStdClass($stdClass): AccountRecoveryModel {
            return new AccountRecoveryModel(
                $stdClass->id_account_recovery,
                $stdClass->id_user,
                $stdClass->token,
                $stdClass->valid_until
            );
        }

        // getters
        public function getIdAccountRecovery() {
            return $this->idAccountRecovery;
        }

        public function getIdUser() {
            return $this->idUser;
        }

        public function getToken() {
            return $this->token;
        }

        public function getValidUntil() {
            return $this->validUntil;
        }

        // setters
        public function setIdAccountRecovery($idAccountRecovery) {
            $this->idAccountRecovery = $idAccountRecovery;
        }

        public function setIdUser($idUser) {
            $this->idUser = $idUser;
        }

        public function setToken($token) {
            $this->token = $token;
        }

        public function setValidUntil($validUntil) {
            $this->validUntil = $validUntil;
        }
    }