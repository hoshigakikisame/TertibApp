<?php

class ReportModel implements DBModel
{
    protected int $idReport;
    protected int $idCodeOfConduct;
    protected string $title;
    protected string $nidnDosen;
    protected string $usernameDosen;
    protected string $firstNameDosen;
    protected string $lastNameDosen;
    protected int|null $idAdmin;
    protected string|null $usernameAdmin;
    protected string|null $firstNameAdmin;
    protected string|null $lastNameAdmin;
    protected string $nimMahasiswa;
    protected string $usernameMahasiswa;
    protected string $firstNameMahasiswa;
    protected string $lastNameMahasiswa;
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

    public function __construct(
        $idReport, 
        $idCodeOfConduct, 
        $title, 
        $nidnDosen, 
        $usernameDosen,
        $firstNameDosen,
        $lastNameDosen,
        $idAdmin, 
        $usernameAdmin,
        $firstNameAdmin,
        $lastNameAdmin,
        $nimMahasiswa, 
        $usernameMahasiswa,
        $firstNameMahasiswa,
        $lastNameMahasiswa,
        $reportDate, 
        $content, 
        $status, 
        $imagePath, 
        $location
    )
    {
        $this->idReport = $idReport;
        $this->idCodeOfConduct = $idCodeOfConduct;
        $this->title = $title;
        $this->nidnDosen = $nidnDosen;
        $this->usernameDosen = $usernameDosen;
        $this->firstNameDosen = $firstNameDosen;
        $this->lastNameDosen = $lastNameDosen;
        $this->idAdmin = $idAdmin;
        $this->usernameAdmin = $usernameAdmin;
        $this->firstNameAdmin = $firstNameAdmin;
        $this->lastNameAdmin = $lastNameAdmin;
        $this->nimMahasiswa = $nimMahasiswa;
        $this->usernameMahasiswa = $usernameMahasiswa;
        $this->firstNameMahasiswa = $firstNameMahasiswa;
        $this->lastNameMahasiswa = $lastNameMahasiswa;
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
            $stdClass->username_dosen,
            $stdClass->first_name_dosen,
            $stdClass->last_name_dosen,
            $stdClass->id_admin,
            $stdClass->username_admin,
            $stdClass->first_name_admin,
            $stdClass->last_name_admin,
            $stdClass->nim_mahasiswa,
            $stdClass->username_mahasiswa,
            $stdClass->first_name_mahasiswa,
            $stdClass->last_name_mahasiswa,
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

    public function getUsernameDosen()
    {
        return $this->usernameDosen;
    }

    public function getFirstNameDosen()
    {
        return $this->firstNameDosen;
    }
    
    public function getLastNameDosen()
    {
        return $this->lastNameDosen;
    }

    public function getIdAdmin()
    {
        return $this->idAdmin;
    }

    public function getUsernameAdmin()
    {
        return $this->usernameAdmin;
    }

    public function getFirstNameAdmin()
    {
        return $this->firstNameAdmin;
    }

    public function getLastNameAdmin()
    {
        return $this->lastNameAdmin;
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

    public function getImageUrl()
    {
        $baseUrl = MediaStorageService::getInstance()->getAccessUrl();
        if ($this->imagePath == null || $this->imagePath == '') {
            return '';
        }
        $randomHex = Helper::generateRandomHex(8);
        return $baseUrl . $this->imagePath . '?v=' . $randomHex;
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

    /**
     * @param UserModel $user
     * @return bool
     */
    public function isParticipant($user): bool {
        $isParticipant = false;
        switch ($user->getRole()) {
            case 'dosen':
                /**
                 * @var DosenModel $dosenRole
                 */
                $dosenRole = $user->getRoleDetail();
                $isParticipant = $dosenRole->getNidn() == $this->getNidnDosen();
                break;
            case 'admin':
                /**
                 * @var AdminModel $adminRole
                 */
                $adminRole = $user->getRoleDetail();
                $isParticipant = $adminRole->getIdAdmin() == $this->getIdAdmin();
                break;
            default:
                $isParticipant = false;
                break;
        }

        return $isParticipant;
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
