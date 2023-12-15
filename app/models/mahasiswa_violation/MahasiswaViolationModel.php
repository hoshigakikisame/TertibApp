<?php 

class MahasiswaViolationModel implements DBModel {
    protected int $idMahasiswaViolation;
    protected string $nimMahasiswa;
    protected string $usernameMahasiswa;
    protected string $firstNameMahasiswa;
    protected string $lastNameMahasiswa;
    protected int $idReport;
    protected string $codeOfConductName;
    protected string $violationLevelName;
    protected int $violationLevelLevel;
    protected int $violationLevelWeight;
    /**
     * @var ReportModel
     */
    protected $report;

    public function __construct(
        $idMahasiswaViolation, 
        $nimMahasiswa,
        $usernameMahasiswa,
        $firstNameMahasiswa,
        $lastNameMahasiswa,
        $idReport,
        $codeOfConductName,
        $violationLevelName,
        $violationLevelLevel,
        $violationLevelWeight
    )
    {
        $this->idMahasiswaViolation = $idMahasiswaViolation;
        $this->nimMahasiswa = $nimMahasiswa;
        $this->usernameMahasiswa = $usernameMahasiswa;
        $this->firstNameMahasiswa = $firstNameMahasiswa;
        $this->lastNameMahasiswa = $lastNameMahasiswa;
        $this->idReport = $idReport;
        $this->codeOfConductName = $codeOfConductName;
        $this->violationLevelName = $violationLevelName;
        $this->violationLevelLevel = $violationLevelLevel;
        $this->violationLevelWeight = $violationLevelWeight;
    }

    public static function fromStdClass($stdClass): MahasiswaViolationModel
    {
        return new MahasiswaViolationModel(
            $stdClass->id_mahasiswa_violation,
            $stdClass->nim_mahasiswa,
            $stdClass->username_mahasiswa,
            $stdClass->first_name_mahasiswa,
            $stdClass->last_name_mahasiswa,
            $stdClass->id_report,
            $stdClass->code_of_conduct_name,
            $stdClass->violation_level_name,
            $stdClass->violation_level_level,
            $stdClass->violation_level_weight
        );
    }

    // getters
    public function getIdMahasiswaViolation()
    {
        return $this->idMahasiswaViolation;
    }

    public function getNimMahasiswa()
    {
        return $this->nimMahasiswa;
    }

    public function getUsernameMahasiswa()
    {
        return $this->usernameMahasiswa;
    }

    public function getFirstNameMahasiswa()
    {
        return $this->firstNameMahasiswa;
    }

    public function getLastNameMahasiswa()
    {
        return $this->lastNameMahasiswa;
    }

    public function getIdReport()
    {
        return $this->idReport;
    }

    public function getCodeOfConductName()
    {
        return $this->codeOfConductName;
    }

    public function getViolationLevelName()
    {
        return $this->violationLevelName;
    }

    public function getViolationLevelLevel()
    {
        return $this->violationLevelLevel;
    }

    public function getViolationLevelWeight()
    {
        return $this->violationLevelWeight;
    }

    public function getReport()
    {
        return $this->report;
    }

    // setters
    public function setIdMahasiswaViolation($idMahasiswaViolation)
    {
        $this->idMahasiswaViolation = $idMahasiswaViolation;
    }

    public function setNimMahasiswa($nimMahasiswa)
    {
        $this->nimMahasiswa = $nimMahasiswa;
    }

    public function setIdReport($idReport)
    {
        $this->idReport = $idReport;
    }
}