<?php

class ReportService {
    private static $instances = [];

    /**
     * @var QueryBuilder
     */
    private $db;
    public function __construct(){
        $this->db = App::get('database');
        assert($this->db instanceof QueryBuilder);
    }


    protected function __clone(){}

    public function __wakeup(){
        throw new \Exception("Cannot unserialize a singleton.");
    }
    public static function getInstance(): ReportService
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    public function getAllReport(): array {
        $rawReports = $this->db->findAll('tb_report');
        $reports = [];

        if ($rawReports) {
            foreach ($rawReports as $rawReport) {
                $reports[] = ReportModel::fromStdClass($rawReport);
            }
        }

        return $reports;
    }
    public function getSingleReport($where): ReportModel | null
    {
        $rawReport = $this->db->findOne('tb_report', $where);
        if ($rawReport) {
            $report = ReportModel::fromStdClass($rawReport);
            return $report;
        }

        return null;
    }

    public function getManyReport($where): array
    {
        $rawReports = $this->db->findMany('tb_report', $where, 'id_report', 'DESC');
        $reports = [];

        if ($rawReports) {
            foreach ($rawReports as $rawReport) {
                $reports[] = ReportModel::fromStdClass($rawReport);
            }
        }

        return $reports;
    }

    public function addNewReport(
        $idCodeOfConduct,
        $title,
        $nidnDosen,
        $nimMahasiswa,
        $content,
        $status,
        $imagePath,
        $location
    ): bool {
        $data = [
            'id_code_of_conduct' => $idCodeOfConduct,
            'title' => $title,
            'nidn_dosen' => $nidnDosen,
            'nim_mahasiswa' => $nimMahasiswa,
            'content' => $content,
            'status' => $status,
            'image_path' => $imagePath,
            'location' => $location
        ];

        return $this->db->insert('tb_report', $data);
    }
}