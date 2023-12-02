<?php

    class UserModel {
        protected int $idUser;
        protected string $username;
        protected string $firstName;
        protected string $lastName;
        protected string $salt;
        protected string $passwordHash;
        protected string $email;
        protected string $role;
        protected string $phoneNumber;
        protected string $address;
        protected string $imagePath = '/public/media/default/blank_user.png';
        
        protected $roleDetail;

        public function __construct($idUser, $username, $firstName, $lastName, $salt, $passwordHash, $email, $role, $imagePath, $phoneNumber, $address) {
            $this->idUser = $idUser;
            $this->username = $username;
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->salt = $salt;
            $this->passwordHash = $passwordHash;
            $this->email = $email;
            $this->role = $role;
            $this->imagePath = $imagePath;
            $this->phoneNumber = $phoneNumber;
            $this->address = $address;
        }

        public static function fromStdClass($stdClass): UserModel {
            return new UserModel(
                $stdClass->id_user,
                $stdClass->username,
                $stdClass->first_name,
                $stdClass->last_name,
                $stdClass->salt,
                $stdClass->password_hash,
                $stdClass->email,
                $stdClass->role,
                $stdClass->image_path,
                $stdClass->phone_number,
                $stdClass->address
            );
        }

        public function getIdUser() {
            return $this->idUser;
        }

        public function getUsername() {
            return $this->username;
        }

        public function getFirstName() {
            return $this->firstName;
        }

        public function getLastName() {
            return $this->lastName;
        }

        public function getSalt() {
            return $this->salt;
        }

        public function getPasswordHash() {
            return $this->passwordHash;
        }

        public function getEmail() {
            return $this->email;
        }
        public function getRole() {
            return $this->role;
        }
        
        public function getImagePath() {
            return $this->imagePath;
        }

        /**
         * @return T
         */
        public function getRoleDetail() {
            return $this->roleDetail;
        }

        public function getPhoneNumber() {
            return $this->phoneNumber;
        }

        public function getAddress() {
            return $this->address;
        }

        public function getImageUrl() {
            $baseUrl = MediaStorageService::getInstance()->getAccessUrl();
            return $baseUrl . $this->imagePath;
        }

        public function setIdUser($idUser) {
            $this->idUser = $idUser;
        }

        public function setUsername($username) {
            $this->username = $username;
        }

        public function setFirstName($firstName) {
            $this->firstName = $firstName;
        }

        public function setLastName($lastName) {
            $this->lastName = $lastName;
        }

        public function setSalt($salt) {
            $this->salt = $salt;
        }

        public function setPasswordHash($passwordHash) {
            $this->passwordHash = $passwordHash;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function setRole($role) {
            $this->role = $role;
        }

        public function setImagePath($imagePath) {
            $this->imagePath = $imagePath;
        }

        public function setRoleDetail($roleDetail) {
            $this->roleDetail = $roleDetail;
        }

        public function setPhoneNumber($phoneNumber) {
            $this->phoneNumber = $phoneNumber;
        }

        public function setAddress($address) {
            $this->address = $address;
        }

        public function isAdmin() {
            return $this->role == 'admin';
        }
    }
