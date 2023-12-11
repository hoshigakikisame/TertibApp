<?php

class ReportCommentModel implements DBModel {
    protected int $idReportComment;
    protected int $idReport;
    protected int $idUser;
    protected string $content;
    protected string $imagePath;
    protected bool $isNew;
    
    public function __construct($idReportComment, $idReport, $idUser, $content, $imagePath, $isNew) {
        $this->idReportComment = $idReportComment;
        $this->idReport = $idReport;
        $this->idUser = $idUser;
        $this->content = $content;
        $this->imagePath = $imagePath;
        $this->isNew = $isNew;
    }

    public static function fromStdClass($stdClass): ReportCommentModel {
        return new ReportCommentModel(
            $stdClass->id_report_comment,
            $stdClass->id_report,
            $stdClass->id_user,
            $stdClass->content,
            $stdClass->image_path,
            $stdClass->is_new
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
}