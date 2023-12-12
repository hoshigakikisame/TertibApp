<?php
class AdminModel implements DBModel
{
    protected int $idAdmin;
    protected string $title;
    protected string $idUser;

    public function __construct($idAdmin, $title, $idUser)
    {
        $this->idAdmin = $idAdmin;
        $this->title = $title;
        $this->idUser = $idUser;
    }

    public static function fromStdClass($stdClass): AdminModel
    {
        return new AdminModel(
            $stdClass->id_admin,
            $stdClass->title,
            $stdClass->id_user
        );
    }

    public function getIdAdmin()
    {
        return $this->idAdmin;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getIdUser()
    {
        return $this->idUser;
    }

    public function setIdAdmin($idAdmin)
    {
        $this->idAdmin = $idAdmin;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }
}