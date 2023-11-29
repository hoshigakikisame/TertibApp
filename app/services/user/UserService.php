<?php
class UserService
{

    private static $instances = [];

    /**
     * @var QueryBuilder
     */
    private $db;
    protected function __construct(){
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
    public function getSingleUser($username)
    {
        $rawUser = $this->db->findOne('tb_user', ['username' => $username]);
        if ($rawUser) {
            $user = UserModel::fromStdClass($rawUser);
            return $user;
        }
    }
}