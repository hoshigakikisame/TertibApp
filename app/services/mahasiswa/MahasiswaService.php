<?php
class MahasiswaService extends DBService
{

    public function __construct()
    {
        parent::__construct('tb_mahasiswa');
    }

    public static function getInstance(): self
    {
        return parent::getInstance();
    }

    public function getAllMahasiswa(): array {
        $rawMahasiswas = $this->getAll();
        $mahasiswas = [];

        if ($rawMahasiswas) {
            foreach ($rawMahasiswas as $rawMahasiswa) {
                $mahasiswas[] = MahasiswaModel::fromStdClass($rawMahasiswa);
            }
        }

        return $mahasiswas;
    }
    public function getSingleMahasiswa($where): MahasiswaModel | null
    {
        $rawMahasiswa = $this->getSingle($where);
        if ($rawMahasiswa) {
            $mahasiswa = MahasiswaModel::fromStdClass($rawMahasiswa);
            return $mahasiswa;
        }

        return null;
    }

    public function addNewMahasiswa(int $nim, int $idUser, string $prodi): string {
        return $this->getDB()->insert($this->getTable(), [
            'nim' => $nim,
            'id_user' => $idUser,
            'prodi' => $prodi
        ]);
    }

    public function updateMahasiswaProfile($nim, $prodi, $where = [])
    {
        $this->getDB()->update($this->getTable(), [
            'nim' => $nim,
            'prodi' => $prodi,
        ], $where);
    }
}