<?php
class CodeOfConductService extends DBService
{

    public function __construct()
    {
        parent::__construct('tb_code_of_conduct');
    }

    public static function getInstance(): self
    {
        return parent::getInstance();
    }

    public function getAllCodeOfConduct(): array {
        $rawCodeOfConducts = $this->getAll();
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
    public function getSingleCodeOfConduct(array $where): CodeOfConductModel | null
    {
        $rawCodeOfConducts = $this->getSingle($where);
        if ($rawCodeOfConducts) {
            $codeOfConducts = CodeOfConductModel::fromStdClass($rawCodeOfConducts);
            return $codeOfConducts;
        }

        return null;
    }

    public function addNewCodeOfConduct(string $name, string $description, int $idViolationLevel): string {
        return $this->getDB()->insert($this->getTable(), [
            'name' => $name,
            'description' => $description,
            'id_violation_level' => $idViolationLevel
        ]);
    }

    public function updateCodeOfConduct(string $name, string $description, int $idViolationLevel, $where = [])
    {
        $this->getDB()->update($this->getTable(), [
            'name' => $name,
            'description' => $description,
            'id_violation_level' => $idViolationLevel
        ], $where);
    }

    public function deleteCodeOfConduct(string $idCodeOfConduct)
    {
        $this->getDB()->delete($this->getTable(), ['id_code_of_conduct' => $idCodeOfConduct]);
    }
}