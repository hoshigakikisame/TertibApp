<?php
class ViolationLevelService extends DBService
{
    public function __construct()
    {
        parent::__construct('tb_violation_level');
    }

    public static function getInstance(): self
    {
        return parent::getInstance();
    }

    public function getAllViolationLevel(int $page = 0): array
    {
        $rawViolationLevels = $this->getDB()->findAll($this->getTable(), 'id_violation_level', 'ASC', $page);
        /**
         * @var ViolationLevelModel[] $violationLevels
         */
        $violationLevels = [];

        if ($rawViolationLevels) {
            foreach ($rawViolationLevels as $rawViolationLevel) {
                $violationLevels[] = ViolationLevelModel::fromStdClass($rawViolationLevel);
            }
        }

        return $violationLevels;
    }
    public function getSingleViolationLevel(array $where)
    {
        $rawViolationLevels = parent::getSingle($where);
        if ($rawViolationLevels) {
            $violationLevels = ViolationLevelModel::fromStdClass($rawViolationLevels);
            return $violationLevels;
        }
    }

    public function addNewViolationLevel(string $level, string $name, int $weight): string
    {
        return parent::getDB()->insert(parent::getTable(), [
            'level' => $level,
            'name' => $name,
            'weight' => $weight
        ]);
    }

    public function updateViolationLevel(string $level, string $name, int $weight, $where = [])
    {
        parent::getDB()->update(parent::getTable(), [
            'level' => $level,
            'name' => $name,
            'weight' => $weight
        ], $where);
    }

    public function deleteViolationLevel($where = [])
    {
        parent::getDB()->delete(parent::getTable(), $where);
    }
}