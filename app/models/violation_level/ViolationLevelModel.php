<?php 
class ViolationLevelModel {
    protected int $idViolationLevel;
    protected int $level;
    protected string $name;
    protected int $weight;

    public function __construct($idViolationLevel, $level, $name, $weight)
    {
        $this->idViolationLevel = $idViolationLevel;
        $this->level = $level;
        $this->name = $name;
        $this->weight = $weight;
    }

    public static function fromStdClass($stdClass): ViolationLevelModel
    {
        return new ViolationLevelModel(
            $stdClass->id_violation_level,
            $stdClass->level,
            $stdClass->name,
            $stdClass->weight
        );
    }

    // getters
    public function getIdViolationLevel()
    {
        return $this->idViolationLevel;
    }

    public function getLevel()
    {
        return $this->level; 
    }

    public function getName()
    {
        return $this->name;
    }


    public function getWeight()
    {
        return $this->weight;
    }


    // setters
    public function setIdViolationLevel($idViolationLevel)
    {
        $this->idViolationLevel = $idViolationLevel;
    }

    public function setLevel($level) 
    {
        $this->level = $level;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }
}