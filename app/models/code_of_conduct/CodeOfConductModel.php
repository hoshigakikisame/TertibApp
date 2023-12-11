<?php 

class CodeOfConductModel implements DBModel {
    protected int $idCodeOfConduct;
    protected string $name;
    protected string $description;
    protected int $idViolationLevel;
    
    /**
     * @var ViolationLevelModel
     */
    protected $violationLevel;
    
    public function __construct($idCodeOfConduct, $name, $description, $idViolationLevel)
    {
        $this->idCodeOfConduct = $idCodeOfConduct;
        $this->name = $name;
        $this->description = $description;
        $this->idViolationLevel = $idViolationLevel;
    }

    public static function fromStdClass($stdClass): CodeOfConductModel
    {
        return new CodeOfConductModel(
            $stdClass->id_code_of_conduct,
            $stdClass->name,
            $stdClass->description,
            $stdClass->id_violation_level
        );
    }

    // getters
    public function getIdCodeOfConduct()
    {
        return $this->idCodeOfConduct;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description; 
    }

    public function getIdViolationLevel()
    {
        return $this->idViolationLevel;
    }

    public function getViolationLevel()
    {
        return $this->violationLevel;
    }

    // setters
    public function setIdCodeOfConduct($idCodeOfConduct)
    {
        $this->idCodeOfConduct = $idCodeOfConduct;
    }

    public function setName($name) 
    {
        $this->name = $name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setIdViolationLevel($idViolationLevel)
    {
        $this->idViolationLevel = $idViolationLevel;
    }

    public function setViolationLevel($violationLevel)
    {
        $this->violationLevel = $violationLevel;
    }
}