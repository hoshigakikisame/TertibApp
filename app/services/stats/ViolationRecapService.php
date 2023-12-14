<?php

class ViolationRecapService extends DBService {
    public function __construct()
    {
        parent::__construct('vwrkp');
    }

    public static function getInstance(): self
    {
        return parent::getInstance();
    }

    public function getRecap(): array {
        $rawRecaps = $this->getAll();
        $recaps = [];

        if ($rawRecaps) {
            foreach ($rawRecaps as $rawRecap) {
                $reports[] = ViolationRecapModel::fromStdClass($rawRecap);
            }
        }

        return $reports;
    }
}