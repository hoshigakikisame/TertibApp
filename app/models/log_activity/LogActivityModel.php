<?php

class LogActivityModel implements DBModel
{
    protected int $idLog;
    protected string $method;
    protected string $activity;
    protected string $createdAt;

    public function __construct($idLog, $method, $activity, $createdAt)
    {
        $this->idLog = $idLog;
        $this->method = $method;
        $this->activity = $activity;
        $this->createdAt = $createdAt;
    }

    public static function fromStdClass($stdClass): LogActivityModel
    {
        return new LogActivityModel(
            $stdClass->id_log,
            $stdClass->method,
            $stdClass->activity,
            $stdClass->created_at
        );
    }

    // getters
    public function getIdLog()
    {
        return $this->idLog;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getActivity()
    {
        return $this->activity;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    // setters
    public function setIdLog($idLog)
    {
        $this->idLog = $idLog;
    }

    public function setMethod($method)
    {
        $this->method = $method;
    }

    public function setActivity($activity)
    {
        $this->activity = $activity;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }
}