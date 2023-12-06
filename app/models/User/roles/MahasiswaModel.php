<?php

class MahasiswaModel {
    protected string $nim;
    protected string $idUser;
    protected string $prodi;

    public function __construct($nim, $idUser, $prodi) {
        $this->nim = $nim;
        $this->idUser = $idUser;
        $this->prodi = $prodi;
    }

    public static function fromStdClass($stdClass): MahasiswaModel {
        return new MahasiswaModel(
            $stdClass->nim,
            $stdClass->id_user,
            $stdClass->prodi
        );
    }

    public function getNim() {
        return $this->nim;
    }

    public function getIdUser() {
        return $this->idUser;
    }

    public function getProdi() {
        return $this->prodi;
    }

    public static function getProdiChoices(): array {
        return [
            'Teknik Informatika',
            'Sistem Informasi Bisnis',
            'Pengembangan Piranti Lunak Situs'
        ];
    }

    public function setNim($nim) {
        $this->nim = $nim;
    }

    public function setIdUser($idUser) {
        $this->idUser = $idUser;
    }

    public function setProdi($prodi) {
        $this->prodi = $prodi;
    }

}