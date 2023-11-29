<?php 
    /**
     * @template T
     */

    class UserModel {
        protected int $idUser;
        protected string $username;
        protected string $salt;
        protected string $passwordHash;
        protected string $email;
        protected string $role;
        protected string $imagePath = '/public/media/default/blank_user.png';
        
        /**
         * @var T
         */
        protected $roleDetail;

        public function __construct($idUser, $username, $salt, $passwordHash, $email, $role, $imagePath) {
            $this->idUser = $idUser;
            $this->username = $username;
            $this->salt = $salt;
            $this->passwordHash = $passwordHash;
            $this->email = $email;
            $this->role = $role;
            $this->imagePath = $imagePath;
        }

        public static function fromStdClass($stdClass): UserModel {
            return new UserModel(
                $stdClass->id_user,
                $stdClass->username,
                $stdClass->salt,
                $stdClass->password_hash,
                $stdClass->email,
                $stdClass->role,
                $stdClass->image_path
            );
        }

        public function getIdUser() {
            return $this->idUser;
        }

        public function getUsername() {
            return $this->username;
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

        public function setIdUser($idUser) {
            $this->idUser = $idUser;
        }

        public function setUsername($username) {
            $this->username = $username;
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

        /**
         * @param T $roleDetail
         */
        public function setRoleDetail($roleDetail) {
            $this->roleDetail = $roleDetail;
        }

        public function isAdmin() {
            return $this->role == 'admin';
        }
    }
