<?php 

class MahasiswaViolationModel implements DBModel {
    protected int $idMahasiswaViolation;
    protected string $nimMahasiswa;
    protected int $idReport;
    /**
     * @var ReportModel
     */
    protected $report;

    public function __construct($idMahasiswaViolation, $nimMahasiswa, $idReport)
    {
        $this->idMahasiswaViolation = $idMahasiswaViolation;
        $this->nimMahasiswa = $nimMahasiswa;
        $this->idReport = $idReport;
    }

    public static function fromStdClass($stdClass): MahasiswaViolationModel
    {
        return new MahasiswaViolationModel(
            $stdClass->id_mahasiswa_violation,
            $stdClass->nim_mahasiswa,
            $stdClass->id_report
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

    public function getIdReport()
    {
        return $this->idReport;
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