<?php
class MahasiswaService
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
    public static function getInstance(): MahasiswaService
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    public function getAllMahasiswa(): array {
        $rawMahasiswas = $this->db->findAll('tb_mahasiswa');
        $mahasiswas = [];

        if ($rawMahasiswas) {
            foreach ($rawMahasiswas as $rawMahasiswa) {
                $mahasiswas[] = MahasiswaModel::fromStdClass($rawMahasiswa);
            }
        }

        return $mahasiswas;
    }
    public function getSingleMahasiswa(string $idUser): MahasiswaModel | null
    {
        $rawMahasiswa = $this->db->findOne('tb_mahasiswa', ['id_user' => $idUser]);
        if ($rawMahasiswa) {
            $mahasiswa = MahasiswaModel::fromStdClass($rawMahasiswa);
            return $mahasiswa;
        }

        return null;
    }

    public function getSingleMahasiswaByNim(string $nim): MahasiswaModel | null
    {
        $rawMahasiswa = $this->db->findOne('tb_mahasiswa', ['nim' => $nim]);
        if ($rawMahasiswa) {
            $mahasiswa = MahasiswaModel::fromStdClass($rawMahasiswa);
            return $mahasiswa;
        }

        return null;
    }

    public function addNewMahasiswa(int $nim, int $idUser, string $prodi): string {
        return $this->db->insert('tb_mahasiswa', [
            'nim' => $nim,
            'id_user' => $idUser,
            'prodi' => $prodi
        ]);
    }

    public function updateMahasiswaProfile($nim, $prodi, $where = [])
    {
        $this->db->update('tb_mahasiswa', [
            'nim' => $nim,
            'prodi' => $prodi,
        ], $where);
    }
}