<?php

class ReportService extends DBService {
    public function __construct()
    {
        parent::__construct('tb_report', 'view_report');
    }

    public static function getInstance(): self
    {
        return parent::getInstance();
    }

    public function getAllReport(): array {
        $rawReports = $this->getDB()->findAll($this->getView(), 'id_report', 'DESC');
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
        $rawReport = $this->getSingle($where);
        if ($rawReport) {
            $report = ReportModel::fromStdClass($rawReport);
            return $report;
        }

        return null;
    }

    public function getManyReport($where): array
    {
        if (empty($where)) {
            return $this->getAllReport();
        }
        $rawReports = $this->getDB()->findMany($this->getView(), $where, 'id_report', 'DESC');
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
    ): string {
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

        return $this->getDB()->insert($this->getTable(), $data);
    }

    public function updateReport(
        $idReport,
        $idCodeOfConduct,
        $status,
        $idAdmin = null
    ) {
        $data = [
            'id_code_of_conduct' => $idCodeOfConduct,
            'status' => $status,
            'id_admin' => $idAdmin
        ];

        return $this->getDB()->update($this->getTable(), $data, ['id_report' => $idReport]);
    }
}