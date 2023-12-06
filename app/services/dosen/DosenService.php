<?php
class DosenService
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
    public static function getInstance(): DosenService
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    public function getAllDosen(): array {
        $rawDosens = $this->db->findAll('tb_dosen');
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
        $rawDosen = $this->db->findOne('tb_dosen', $where);
        if ($rawDosen) {
            $dosen = DosenModel::fromStdClass($rawDosen);
            return $dosen;
        }

        return null;
    }

    public function addNewDosen(int $nidn, int $idUser, string $title): string {
        return $this->db->insert('tb_dosen', [
            'nidn' => $nidn,
            'id_user' => $idUser,
            'title' => $title
        ]);
    }

    public function updateDosenProfile($nidn, $title, $where = [])
    {
        $this->db->update('tb_dosen', [
            'nidn' => $nidn,
            'title' => $title,
        ], $where);
    }
}