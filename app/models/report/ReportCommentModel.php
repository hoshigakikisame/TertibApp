<?php

class ReportCommentModel implements DBModel {
    protected int $idReportComment;
    protected int $idReport;
    protected int $idUser;
    protected string $content;
    protected string $imagePath;
    protected bool $isNew;
    protected string $createdAt;
    protected string $authorUsername;
    protected string $authorFirstName;
    protected string $authorLastName;
    protected string $authorImagePath;
    
    protected string $uniqueKey;
    public function __construct(
        $idReportComment, 
        $idReport, 
        $idUser, 
        $content, 
        $imagePath, 
        $isNew, 
        $createdAt,
        $authorUsername = '',
        $authorFirstName = '',
        $authorLastName = '',
        $authorImagePath = ''
    ) {
        $this->idReportComment = $idReportComment;
        $this->idReport = $idReport;
        $this->idUser = $idUser;
        $this->content = $content;
        $this->imagePath = $imagePath;
        $this->isNew = $isNew;
        $this->createdAt = $createdAt;
        $this->authorUsername = $authorUsername;
        $this->authorFirstName = $authorFirstName;
        $this->authorLastName = $authorLastName;
        $this->authorImagePath = $authorImagePath;
        $this->uniqueKey = Helper::generateRandomHex(8);
    }

    public static function fromStdClass($stdClass): ReportCommentModel {
        return new ReportCommentModel(
            $stdClass->id_report_comment,
            $stdClass->id_report,
            $stdClass->id_user,
            $stdClass->content,
            $stdClass->image_path,
            $stdClass->is_new,
            $stdClass->created_at,
            $stdClass->author_username,
            $stdClass->author_first_name,
            $stdClass->author_last_name,
            $stdClass->author_image_path
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

    public function getAuthorUsername() {
        return $this->authorUsername;
    }

    public function getAuthorFirstName() {
        return $this->authorFirstName;
    }

    public function getAuthorLastName() {
        return $this->authorLastName;
    }

    public function getAuthorImagePath() {
        return $this->authorImagePath;
    }

    public function getImageUrl()
    {
        $baseUrl = MediaStorageService::getInstance()->getAccessUrl();
        if ($this->imagePath == null || $this->imagePath == '') {
            return '';
        }
        return $baseUrl . $this->imagePath . '?v=' . $this->uniqueKey;
    }

    public function getAuthorImageUrl()
    {
        $baseUrl = MediaStorageService::getInstance()->getAccessUrl();
        if ($this->authorImagePath == null || $this->authorImagePath == '') {
            return $baseUrl . 'user_profile/blank_user.png';
        }
        return $baseUrl . $this->authorImagePath . '?v=' . $this->uniqueKey;
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
}