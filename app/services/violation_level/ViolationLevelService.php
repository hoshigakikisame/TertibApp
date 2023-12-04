<?php
class ViolationLevelService
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
    public static function getInstance(): ViolationLevelService
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    public function getAllViolationLevel() {
        $rawViolationLevels = $this->db->findAll('tb_violation_level');

        if ($rawViolationLevels) {
            /**
             * @var ViolationLevelModel[] $violationLevels
             */
            $violationLevels = [];
            foreach ($rawViolationLevels as $rawViolationLevel) {
                $violationLevels[] = ViolationLevelModel::fromStdClass($rawViolationLevel);
            }
            return $violationLevels;
        }
    }
    public function getSingleViolationLevel(string $idViolationLevel)
    {
        $rawViolationLevels = $this->db->findOne('tb_violation_level', ['id_violation_level' => $idViolationLevel]);
        if ($rawViolationLevels) {
            $violationLevels = ViolationLevelModel::fromStdClass($rawViolationLevels);
            return $violationLevels;
        }
    }

    public function addNewViolationLevel(string $level, string $name, int $weight): string {
        return $this->db->insert('tb_violation_level', [
            'level' => $level,
            'name' => $name,
            'weight' => $weight
        ]);
    }

    public function updateViolationLevel(string $level, string $name, int $weight, $where = [])
    {
        $this->db->update('tb_violation_level', [
            'level' => $level,
            'name' => $name,
            'weight' => $weight
        ], $where);
    }
}