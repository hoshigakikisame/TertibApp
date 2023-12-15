<?php
class MahasiswaViolationService extends DBService
{

    public function __construct()
    {
        parent::__construct('view_mahasiswa_violation');
    }

    public static function getInstance(): self
    {
        return parent::getInstance();
    }

    public function getAllMahasiswaViolation(): array {
        $rawViolations = $this->getAll();
        $violations = [];

        if ($rawViolations) {
            foreach ($rawViolations as $rawViolation) {
                $violations[] = MahasiswaViolationModel::fromStdClass($rawViolation);
            }
        }

        return $violations;
    }

    public function getManyMahasiswaViolation($where): array {
        if (empty($where)) {
            return $this->getAllMahasiswaViolation();
        }
        $rawViolations = $this->getDB()->findMany($this->getTable(), $where, 'id_mahasiswa_violation', 'DESC');
        $violations = [];

        if ($rawViolations) {
            foreach ($rawViolations as $rawViolation) {
                $violations[] = MahasiswaViolationModel::fromStdClass($rawViolation);
            }
        }

        return $violations;
    }

    public function getSingleMahasiswaViolation($where): MahasiswaViolationModel | null
    {
        $rawViolation = $this->getSingle($where);
        if ($rawViolation) {
            $violation = MahasiswaViolationModel::fromStdClass($rawViolation);
            return $violation;
        }

        return null;
    }

    public function addNewMahasiswaViolation(string $nimMahasiswa, int $idReport): string {
        return $this->getDB()->insert($this->getTable(), [
            'nim_mahasiswa' => $nimMahasiswa,
            'id_report' => $idReport,
        ]);
    }

    /**
     * @param MahasiswaViolationModel[] $mahasiswaViolations
     */
    public function markNewMahasiswaViolationAsRead(array $mahasiswaViolations) {
        $ids = [];
        foreach ($mahasiswaViolations as $mahasiswaViolation) {
            $ids[] = $mahasiswaViolation->getIdMahasiswaViolation();
        }

        return $this->getDB()->execute("UPDATE {$this->getTable()} SET is_new = false WHERE id_mahasiswa_violation IN (" . implode(',', $ids) . ")");
    }
}