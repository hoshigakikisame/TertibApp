<?php
class UserService extends DBService
{
    public function __construct()
    {
        parent::__construct('tb_user');
    }

    public static function getInstance(): self
    {
        return parent::getInstance();
    }

    public function hashPassword($salt, $password)
    {
        /**
         * @var array
         */
        $config = App::get('config');
        $algorithm = $config['password_hash_algorithm'];
        $saltedPassword = $salt . $password;
        return password_hash($saltedPassword, $algorithm);
    }

    public function validatePassword($salt, $password, $hash)
    {
        $saltedPassword = $salt . $password;
        return password_verify($saltedPassword, $hash);
    }
    public function getSingleUser(array $where = []): UserModel | null
    {
        $rawUser = $this->getSingle($where);
        if ($rawUser) {
            $user = UserModel::fromStdClass($rawUser);
            return $user;
        }
        return null;
    }

    public function getManyUser(array $where = []): array
    {
        $rawUsers = $this->getDB()->findWhere($this->getTable(), $where);
        $users = [];
        if ($rawUsers) {
            foreach ($rawUsers as $rawUser) {
                $users[] = UserModel::fromStdClass($rawUser);
            }
        }
        return $users;
    }

    public function addNewUser(string $username, string $firstName, string $lastName, string $email, string $address, string $phoneNumber, string $role, string $salt, string $passwordHash): string
    {
        return $this->getDB()->insert($this->getTable(), [
            'username' => $username,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'address' => $address,
            'phone_number' => $phoneNumber,
            'role' => $role,
            'image_path' => '',
            'salt' => $salt,
            'password_hash' => $passwordHash
        ]);
    }

    public function updateUser(string $username, string $firstName, string $lastName, string $email, string $address, string $phoneNumber, string $role, string $salt = '', string $passwordHash = '', $where = []) {
        $options = [
            'username' => $username,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'address' => $address,
            'phone_number' => $phoneNumber,
            'role' => $role
        ];

        if ($passwordHash != '' && $salt != '') {
            $options['salt'] = $salt;
            $options['password_hash'] = $passwordHash;
        }
        
        $this->getDB()->update($this->getTable(), $options, $where);
    }

    public function updateUserProfile(string $firstName, string $lastName, string $address, string $phoneNumber, string $imagePath, $where = [])
    {
        $this->getDB()->update($this->getTable(), [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'address' => $address,
            'phone_number' => $phoneNumber,
            'image_path' => $imagePath
        ], $where);
    }

    public function updateUserPassword($idUser, $newPassword)
    {
        $this->getDB()->update($this->getTable(), [
            'password_hash' => $newPassword
        ], [
            'id_user' => $idUser
        ]);
    }

    public function refreshUserSession($idUser)
    {

        $adminService = AdminService::getInstance();
        $dosenService = DosenService::getInstance();

        $user = $this->getSingleUser([
            'id_user' => $idUser
        ]);

        if (!$user) {
            return;
        }

        switch ($user->getRole()) {
            case 'admin':
                $user->setRoleDetail($adminService->getSingleAdmin(['id_user' => $user->getIdUser()]));
                break;
            case 'dosen':
                $user->setRoleDetail($dosenService->getSingleDosen(['id_user' => $user->getIdUser()]));
                break;
            case 'mahasiswa':
                break;
            default:
                break;
        }

        Session::getInstance()->push('user', $user);
    }

    public function deleteUser($idUser)
    {
        $this->getDB()->delete($this->getTable(), [
            'id_user' => $idUser
        ]);
    }
}