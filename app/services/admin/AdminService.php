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

    public function getAllAdmin(int $page = 1): array
    {
        $rawAdmins = $this->getDB()->findAll($this->getTable(), 'id_admin', 'ASC', $page);
        $admins = [];

        if ($rawAdmins) {
            foreach ($rawAdmins as $rawAdmin) {
                $admins[] = AdminModel::fromStdClass($rawAdmin);
            }
        }

        return $admins;
    }
    public function getSingleAdmin(array $where): AdminModel|null
    {
        $rawAdmin = $this->getSingle($where);
        if ($rawAdmin) {
            $admin = AdminModel::fromStdClass($rawAdmin);
            return $admin;
        }

        return null;
    }

    public function addNewAdmin(int $idUser, string $title): string
    {
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

    public function getAdminNotification(AdminModel $adminRole)
    {
        $sql = "SELECT * FROM `tb_report_comment` WHERE id_report IN (SELECT id_report from tb_report WHERE id_admin = :id_admin) AND is_new = true AND id_user != :id_user";

        $rawReportComments = $this->getDB()->execute($sql, [
            'id_admin' => $adminRole->getIdAdmin(),
            'id_user' => $adminRole->getIdUser()
        ]);

        $reportComments = [];

        if ($rawReportComments) {
            foreach ($rawReportComments as $rawReportComment) {
                $reportComments[] = ReportCommentModel::fromStdClass($rawReportComment);
            }
        }

        return $reportComments;
    }

    public function getAdminNotificationCount(AdminModel $adminRole)
    {
        $sql = "SELECT COUNT(*) as count FROM `tb_report_comment` WHERE id_report IN (SELECT id_report from tb_report WHERE id_admin = :id_admin) AND is_new = true AND id_user != :id_user";

        $rawReportComments = $this->getDB()->execute($sql, [
            'id_admin' => $adminRole->getIdAdmin(),
            'id_user' => $adminRole->getIdUser()
        ]);

        if ($rawReportComments) {
            return $rawReportComments[0]->count;
        }

        return 0;
    }
}