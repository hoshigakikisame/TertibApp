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
    protected string $dosenUsername;
    protected string $dosenFirstName;
    protected string $dosenLastName;
    protected string $dosenImagePath;
    protected string $adminUsername;
    protected string $adminFirstName;
    protected string $adminLastName;
    protected string $adminImagePath;
    protected string $mahasiswaUsername;
    protected string $mahasiswaFirstName;
    protected string $mahasiswaLastName;
    protected string $mahasiswaImagePath;
    protected string $codeOfConductName;
    protected string $codeOfConductDescription;
    protected string $violationLevelName;
    protected int $violationLevelLevel;
    protected int $violationLevelWeight;
    protected string $uniqueKey;
    public function __construct(
        $idReport, 
        $idCodeOfConduct, 
        $title, 
        $nidnDosen, 
        $idAdmin, 
        $nimMahasiswa, 
        $reportDate, 
        $content, 
        $status, 
        $imagePath, 
        $location,
        $dosenUsername = '',
        $dosenFirstName = '',
        $dosenLastName = '',
        $dosenImagePath = '',
        $adminUsername = '',
        $adminFirstName = '',
        $adminLastName = '',
        $adminImagePath = '',
        $mahasiswaUsername = '',
        $mahasiswaFirstName = '',
        $mahasiswaLastName = '',
        $mahasiswaImagePath = '',
        $codeOfConductName = '',
        $codeOfConductDescription = '',
        $violationLevelName = '',
        $violationLevelLevel = 0,
        $violationLevelWeight = 0
    )
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
        $this->dosenUsername = $dosenUsername;
        $this->dosenFirstName = $dosenFirstName;
        $this->dosenLastName = $dosenLastName;
        $this->dosenImagePath = $dosenImagePath;
        $this->adminUsername = $adminUsername;
        $this->adminFirstName = $adminFirstName;
        $this->adminLastName = $adminLastName;
        $this->adminImagePath = $adminImagePath;
        $this->mahasiswaUsername = $mahasiswaUsername;
        $this->mahasiswaFirstName = $mahasiswaFirstName;
        $this->mahasiswaLastName = $mahasiswaLastName;
        $this->mahasiswaImagePath = $mahasiswaImagePath;
        $this->codeOfConductName = $codeOfConductName;
        $this->codeOfConductDescription = $codeOfConductDescription;
        $this->violationLevelName = $violationLevelName;
        $this->violationLevelLevel = $violationLevelLevel;
        $this->violationLevelWeight = $violationLevelWeight;
        $this->uniqueKey = Helper::generateRandomHex(8);
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
            $stdClass->location,
            $stdClass->dosen_username,
            $stdClass->dosen_first_name,
            $stdClass->dosen_last_name,
            $stdClass->dosen_image_path,
            $stdClass->admin_username,
            $stdClass->admin_first_name,
            $stdClass->admin_last_name,
            $stdClass->admin_image_path,
            $stdClass->mahasiswa_username,
            $stdClass->mahasiswa_first_name,
            $stdClass->mahasiswa_last_name,
            $stdClass->mahasiswa_image_path,
            $stdClass->code_of_conduct_name,
            $stdClass->code_of_conduct_description,
            $stdClass->violation_level_name,
            $stdClass->violation_level_level,
            $stdClass->violation_level_weight
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

    public function getDosenUsername()
    {
        return $this->dosenUsername;
    }

    public function getDosenFirstName()
    {
        return $this->dosenFirstName;
    }

    public function getDosenLastName()
    {
        return $this->dosenLastName;
    }

    public function getDosenImagePath()
    {
        return $this->dosenImagePath;
    }

    public function getAdminUsername()
    {
        return $this->adminUsername;
    }

    public function getAdminFirstName()
    {
        return $this->adminFirstName;
    }

    public function getAdminLastName()
    {
        return $this->adminLastName;
    }

    public function getAdminImagePath()
    {
        return $this->adminImagePath;
    }

    public function getMahasiswaUsername()
    {
        return $this->mahasiswaUsername;
    }

    public function getMahasiswaFirstName()
    {
        return $this->mahasiswaFirstName;
    }

    public function getMahasiswaLastName()
    {
        return $this->mahasiswaLastName;
    }

    public function getMahasiswaImagePath()
    {
        return $this->mahasiswaImagePath;
    }

    public function getCodeOfConductName()
    {
        return $this->codeOfConductName;
    }

    public function getCodeOfConductDescription()
    {
        return $this->codeOfConductDescription;
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
        return $baseUrl . $this->imagePath . '?v=' . $this->uniqueKey;
    }

    public function getDosenImageUrl()
    {
        $baseUrl = MediaStorageService::getInstance()->getAccessUrl();
        if ($this->dosenImagePath == null || $this->dosenImagePath == '') {
            return $baseUrl . 'user_profile/blank_user.png';
        }
        return $baseUrl . $this->dosenImagePath . '?v=' . $this->uniqueKey;
    }

    public function getAdminImageUrl()
    {
        $baseUrl = MediaStorageService::getInstance()->getAccessUrl();
        if ($this->adminImagePath == null || $this->adminImagePath == '') {
            return $baseUrl . 'user_profile/blank_user.png';
        }
        return $baseUrl . $this->adminImagePath . '?v=' . $this->uniqueKey;
    }

    public function getMahasiswaImageUrl()
    {
        $baseUrl = MediaStorageService::getInstance()->getAccessUrl();
        if ($this->mahasiswaImagePath == null || $this->mahasiswaImagePath == '') {
            return $baseUrl . 'user_profile/blank_user.png';
        }
        return $baseUrl . $this->mahasiswaImagePath . '?v=' . $this->uniqueKey;
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
