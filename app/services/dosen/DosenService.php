<?php
class DosenService extends DBService
{

    public function __construct()
    {
        parent::__construct('tb_dosen');
    }

    public static function getInstance(): self
    {
        return parent::getInstance();
    }
    public function getAllDosen(int $page = 0): array
    {
        $rawDosens = $this->getDB()->findAll($this->getTable(), 'nidn', 'ASC', $page);
        $dosens = [];

        if ($rawDosens) {
            foreach ($rawDosens as $rawDosen) {
                $dosens[] = DosenModel::fromStdClass($rawDosen);
            }
        }

        return $dosens;
    }
    public function getSingleDosen($where): DosenModel|null
    {
        $rawDosen = $this->getSingle($where);
        if ($rawDosen) {
            $dosen = DosenModel::fromStdClass($rawDosen);
            return $dosen;
        }

        return null;
    }

    public function addNewDosen(int $nidn, int $idUser, string $title): string
    {
        return $this->getDB()->insert($this->getTable(), [
            'nidn' => $nidn,
            'id_user' => $idUser,
            'title' => $title
        ]);
    }

    public function updateDosenProfile($title, $where = [])
    {
        $this->getDB()->update($this->getTable(), [
            'title' => $title,
        ], $where);
    }

    public function updateDosen($nidn, $title, $where = [])
    {
        $this->getDB()->update($this->getTable(), [
            'nidn' => $nidn,
            'title' => $title,
        ], $where);
    }

    public function getDosenNotification(DosenModel $dosenRole)
    {
        $sql = "SELECT * FROM `tb_report_comment` WHERE id_report IN (SELECT id_report from tb_report WHERE nidn_dosen = :nidn_dosen) AND is_new = true AND id_user != :id_user";

        $rawReportComments = $this->getDB()->execute($sql, [
            'nidn_dosen' => $dosenRole->getNidn(),
            'id_user' => $dosenRole->getIdUser(),
        ]);

        $reportComments = [];

        if ($rawReportComments) {
            foreach ($rawReportComments as $rawReportComment) {
                $reportComments[] = ReportCommentModel::fromStdClass($rawReportComment);
            }
        }

        return $reportComments;
    }

    public function getDosenNotificationCount(DosenModel $dosenRole)
    {
        $sql = "SELECT COUNT(*) as count FROM `tb_report_comment` WHERE id_report IN (SELECT id_report from tb_report WHERE nidn_dosen = :nidn_dosen) AND is_new = true AND id_user != :id_user";

        $rawReportComments = $this->getDB()->execute($sql, [
            'nidn_dosen' => $dosenRole->getNidn(),
            'id_user' => $dosenRole->getIdUser(),
        ]);

        if ($rawReportComments) {
            return $rawReportComments[0]->count;
        }

        return 0;
    }
}