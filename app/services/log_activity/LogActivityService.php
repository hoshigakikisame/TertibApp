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

    public function getAllLogActivity(int $page = 1): array {
        $rawLogActivities = $this->getDB()->findAll($this->getTable(), 'id_log', 'ASC', $page);
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