<?php
class AdminService extends DBService
{

    public function __construct()
    {
        parent::__construct('tb_admin');
    }

    public static function getInstance(): self
    {
        return parent::getInstance();
    }

    public function getAllAdmin(): array {
        $rawAdmins = $this->getAll();
        $admins = [];

        if ($rawAdmins) {
            foreach ($rawAdmins as $rawAdmin) {
                $admins[] = AdminModel::fromStdClass($rawAdmin);
            }
        }

        return $admins;
    }
    public function getSingleAdmin(array $where): AdminModel | null
    {
        $rawAdmin = $this->getSingle($where);
        if ($rawAdmin) {
            $admin = AdminModel::fromStdClass($rawAdmin);
            return $admin;
        }

        return null;
    }

    public function addNewAdmin(int $idUser, string $title): string {
        return $this->getDB()->insert($this->getTable(), [
            'id_user' => $idUser,
            'title' => $title
        ]);
    }

    public function updateAdminProfile($title, $where = [])
    {
        $this->getDB()->update($this->getTable(), [
            'title' => $title,
        ], $where);
    }
}