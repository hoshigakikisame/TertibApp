<?php
class AdminService
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
    public static function getInstance(): AdminService
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    public function getAllAdmin() {
        $rawAdmins = $this->db->findAll('tb_admin');

        if ($rawAdmins) {
            $admins = [];
            foreach ($rawAdmins as $rawAdmin) {
                $admins[] = AdminModel::fromStdClass($rawAdmin);
            }
            return $admins;
        }
    }
    public function getSingleAdmin(string $idUser)
    {
        $rawAdmin = $this->db->findOne('tb_admin', ['id_user' => $idUser]);
        if ($rawAdmin) {
            $admin = AdminModel::fromStdClass($rawAdmin);
            return $admin;
        }
    }

    public function addNewAdmin(int $idUser, string $title): string {
        return $this->db->insert('tb_admin', [
            'id_user' => $idUser,
            'title' => $title
        ]);
    }

    public function updateAdminProfile($title, $where = [])
    {
        $this->db->update('tb_admin', [
            'title' => $title,
        ], $where);
    }
}