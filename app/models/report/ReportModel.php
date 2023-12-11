<?php

class ReportModel implements DBModel
{
    protected int $idReport;
    protected int $idCodeOfConduct;
    protected string $title;
    protected string $nidnDosen;
    protected int|null $idAdmin;
    protected string $nimMahasiswa;
    protected string $reportDate;
    protected string $content;
    protected string $status;
    protected string $imagePath;
    // final look of this property, should be like this: https://res.cloudinary.com/dfbwr0uv7/image/upload/report/2a574124289bc1a148e67d0f1b32e520.jpeg
    protected string $location;

    /**
     * @var CodeOfConductModel
     */
    protected $codeOfConduct;
    /**
     * @var UserModel $dosen
     */
    protected $dosen;

    /**
     * @var UserModel $admin
     */
    protected $admin;

    /**
     * @var UserModel $mahasiswa
     */
    protected $mahasiswa;

    public function __construct($idReport, $idCodeOfConduct, $title, $nidnDosen, $idAdmin, $nimMahasiswa, $reportDate, $content, $status, $imagePath, $location)
    {
        $this->idReport = $idReport;
        $this->idCodeOfConduct = $idCodeOfConduct;
        $this->title = $title;
        $this->nidnDosen = $nidnDosen;
        $this->idAdmin = $idAdmin;
        $this->nimMahasiswa = $nimMahasiswa;
        $this->reportDate = $reportDate;
        $this->content = $content;
        $this->status = $status;
        $this->imagePath = $imagePath;
        $this->location = $location;
    }

    public static function fromStdClass($stdClass): ReportModel
    {
        return new ReportModel(
            $stdClass->id_report,
            $stdClass->id_code_of_conduct,
            $stdClass->title,
            $stdClass->nidn_dosen,
            $stdClass->id_admin,
            $stdClass->nim_mahasiswa,
            $stdClass->report_date,
            $stdClass->content,
            $stdClass->status,
            $stdClass->image_path,
            $stdClass->location
        );
    }

    // getters
    public function getIdReport()
    {
        return $this->idReport;
    }

    public function getIdCodeOfConduct()
    {
        return $this->idCodeOfConduct;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getNidnDosen()
    {
        return $this->nidnDosen;
    }

    public function getIdAdmin()
    {
        return $this->idAdmin;
    }

    public function getNimMahasiswa()
    {
        return $this->nimMahasiswa;
    }

    public function getReportDate()
    {
        return $this->reportDate;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getImagePath()
    {
        return $this->imagePath;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function getCodeOfConduct()
    {
        return $this->codeOfConduct;
    }

    public static function getStatusChoices(): array
    {
        return [
            'New',
            'Needs More Information',
            'On Process',
            'Valid',
            'Invalid'
        ];
    }

    public function getDosen()
    {
        return $this->dosen;
    }

    public function getAdmin()
    {
        return $this->admin;
    }

    public function getMahasiswa()
    {
        return $this->mahasiswa;
    }

    // setters
    public function setIdReport($idReport)
    {
        $this->idReport = $idReport;
    }

    public function setIdCodeOfConduct($idCodeOfConduct)
    {
        $this->idCodeOfConduct = $idCodeOfConduct;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setNidnDosen($nidnDosen)
    {
        $this->nidnDosen = $nidnDosen;
    }

    public function setIdAdmin($idAdmin)
    {
        $this->idAdmin = $idAdmin;
    }

    public function setNimMahasiswa($nimMahasiswa)
    {
        $this->nimMahasiswa = $nimMahasiswa;
    }

    public function setReportDate($reportDate)
    {
        $this->reportDate = $reportDate;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;
    }

    public function setLocation($location)
    {
        $this->location = $location;
    }

    public function setCodeOfConduct($codeOfConduct)
    {
        $this->codeOfConduct = $codeOfConduct;
    }

    public function setDosen($dosen)
    {
        $this->dosen = $dosen;
    }

    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }

    public function setMahasiswa($mahasiswa)
    {
        $this->mahasiswa = $mahasiswa;
    }
}
