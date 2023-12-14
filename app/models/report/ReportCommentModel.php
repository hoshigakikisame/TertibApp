<?php

class ReportCommentModel implements DBModel {
    protected int $idReportComment;
    protected int $idReport;
    protected int $idUser;
    protected string $content;
    protected string $imagePath;
    protected bool $isNew;
    protected string $createdAt;
    protected $user;
    
    public function __construct($idReportComment, $idReport, $idUser, $content, $imagePath, $isNew, $createdAt) {
        $this->idReportComment = $idReportComment;
        $this->idReport = $idReport;
        $this->idUser = $idUser;
        $this->content = $content;
        $this->imagePath = $imagePath;
        $this->isNew = $isNew;
        $this->createdAt = $createdAt;
    }

    public static function fromStdClass($stdClass): ReportCommentModel {
        return new ReportCommentModel(
            $stdClass->id_report_comment,
            $stdClass->id_report,
            $stdClass->id_user,
            $stdClass->content,
            $stdClass->image_path,
            $stdClass->is_new,
            $stdClass->created_at
        );
    }

    // getters
    public function getIdReportComment() {
        return $this->idReportComment;
    }

    public function getIdReport() {
        return $this->idReport;
    }

    public function getIdUser() {
        return $this->idUser;
    }

    public function getContent() {
        return $this->content;
    }

    public function getImagePath() {
        return $this->imagePath;
    }

    public function getIsNew() {
        return $this->isNew;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function getUser() {
        return $this->user;
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

    public function getReferenceUrl()
    {
        return App::get('root_uri') . '/report/detail/' . $this->idReport . '#' . $this->idReportComment;
    }

    // setters
    public function setIdReportComment($idReportComment) {
        $this->idReportComment = $idReportComment;
    }

    public function setIdReport($idReport) {
        $this->idReport = $idReport;
    }

    public function setIdUser($idUser) {
        $this->idUser = $idUser;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function setImagePath($imagePath) {
        $this->imagePath = $imagePath;
    }

    public function setIsNew($isNew) {
        $this->isNew = $isNew;
    }

    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }

    public function setUser($user) {
        $this->user = $user;
    }
}