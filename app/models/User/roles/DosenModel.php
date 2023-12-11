<?php
class DosenModel implements DBModel
{
    protected string $nidn;
    protected string $title;
    protected string $idUser;

    public function __construct($nidn, $title, $idUser)
    {
        $this->nidn = $nidn;
        $this->title = $title;
        $this->idUser = $idUser;
    }

    public static function fromStdClass($stdClass): DosenModel
    {
        return new DosenModel(
            $stdClass->nidn,
            $stdClass->title,
            $stdClass->id_user
        );
    }

    public function getNidn()
    {
        return $this->nidn;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getIdUser()
    {
        return $this->idUser;
    }

    public function setNidn($nidn)
    {
        $this->nidn = $nidn;
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