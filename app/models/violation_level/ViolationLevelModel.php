<?php 
class ViolationLevelModel {
    protected int $idViolationLevel;
    protected string $name;
    protected string $description;
    protected int $weight;

    public function __construct($idViolationLevel, $name, $description, $weight)
    {
        $this->idViolationLevel = $idViolationLevel;
        $this->name = $name;
        $this->description = $description;
        $this->weight = $weight;
    }

    public static function fromStdClass($stdClass): ViolationLevelModel
    {
        return new ViolationLevelModel(
            $stdClass->id_violation_level,
            $stdClass->name,
            $stdClass->description,
            $stdClass->weight
        );
    }

    // getters
    public function getIdViolationLevel()
    {
        return $this->idViolationLevel;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description; 
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

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setDescription($description) 
    {
        $this->description = $description;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }
}