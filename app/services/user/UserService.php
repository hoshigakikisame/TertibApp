<?php
class UserService
{

    private static $instances = [];

    /**
     * @var QueryBuilder
     */
    private $db;
    public function __construct(){
        $this->db = App::get('database');
        assert($this->db instanceof QueryBuilder);
    }


    protected function __clone(){}

    public function __wakeup(){
        throw new \Exception("Cannot unserialize a singleton.");
    }
    public static function getInstance(): UserService
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
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
    public function getSingleUser(array $where = [])
    {
        $rawUser = $this->db->findOne('tb_user', $where);
        if ($rawUser) {
            $user = UserModel::fromStdClass($rawUser);
            return $user;
        }
    }

    public function updateUserProfile($firstName, $lastName, $address, $phoneNumber, $where = [])
    {
        $this->db->update('tb_user', [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'address' => $address,
            'phone_number' => $phoneNumber
        ], $where);
    }

    public function updateUserPassword($idUser, $newPassword)
    {
        $this->db->update('tb_user', [
            'password_hash' => $newPassword
        ], [
            'id_user' => $idUser
        ]);
    }
}