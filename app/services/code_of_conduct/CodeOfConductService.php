<?php
class CodeOfConductService
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
    public static function getInstance(): CodeOfConductService
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    public function getAllCodeOfConduct(): array {
        $rawCodeOfConducts = $this->db->findAll('tb_code_of_conduct');
        /**
         * @var CodeOfConductModel[] $rawCodeOfConducts
         */
        $codeOfConducts = [];

        if ($rawCodeOfConducts) {
            foreach ($rawCodeOfConducts as $rawCodeOfConduct) {
                $codeOfConducts[] = CodeOfConductModel::fromStdClass($rawCodeOfConduct);
            }
        }

        return $codeOfConducts;
    }
    public function getSingleCodeOfConduct(string $idCodeOfConduct): CodeOfConductModel | null
    {
        $rawCodeOfConducts = $this->db->findOne('tb_code_of_conduct', ['id_code_of_conduct' => $idCodeOfConduct]);
        if ($rawCodeOfConducts) {
            $codeOfConducts = CodeOfConductModel::fromStdClass($rawCodeOfConducts);
            return $codeOfConducts;
        }

        return null;
    }

    public function addNewCodeOfConduct(string $name, string $description, int $idViolationLevel): string {
        return $this->db->insert('tb_code_of_conduct', [
            'name' => $name,
            'description' => $description,
            'id_violation_level' => $idViolationLevel
        ]);
    }

    public function updateCodeOfConduct(string $name, string $description, int $idViolationLevel, $where = [])
    {
        $this->db->update('tb_code_of_conduct', [
            'name' => $name,
            'description' => $description,
            'id_violation_level' => $idViolationLevel
        ], $where);
    }

    public function deleteCodeOfConduct(string $idCodeOfConduct)
    {
        $this->db->delete('tb_code_of_conduct', ['id_code_of_conduct' => $idCodeOfConduct]);
    }
}