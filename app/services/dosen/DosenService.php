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
    public function getAllDosen(): array {
        $rawDosens = $this->getAll();
        $dosens = [];

        if ($rawDosens) {
            foreach ($rawDosens as $rawDosen) {
                $dosens[] = DosenModel::fromStdClass($rawDosen);
            }
        }

        return $dosens;
    }
    public function getSingleDosen($where): DosenModel | null
    {
        $rawDosen = $this->getSingle($where);
        if ($rawDosen) {
            $dosen = DosenModel::fromStdClass($rawDosen);
            return $dosen;
        }

        return null;
    }

    public function addNewDosen(int $nidn, int $idUser, string $title): string {
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
}