<?php

class LogActivityService extends DBService {
    public function __construct()
    {
        parent::__construct('tb_log');
    }

    public static function getInstance(): self
    {
        return parent::getInstance();
    }

    public function getAllLogActivity(): array {
        // $rawLogActivities = $this->getDB()->findAll('tb_log');
        // $reports = [];

        // if ($rawReports) {
        //     foreach ($rawReports as $rawReport) {
        //         $reports[] = ReportModel::fromStdClass($rawReport);
        //     }
        // }

        // return $reports;
        $rawLogActivities = $this->getAll();
        /**
         * @var LogActivityModel[] $rawCodeOfConducts
         */
        $logActivities = [];

        if ($rawLogActivities) {
            foreach ($rawLogActivities as $rawLogActivity) {
                $logActivities[] = LogActivityModel::fromStdClass($rawLogActivity);
            }
        }

        return $logActivities;
    }
}