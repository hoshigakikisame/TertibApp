<?php
class ViolationRecapModel {
    protected int $idCodeOfConduct;
    protected string $codeOfConductName;
    protected int $year;
    protected int $totalJanuary;
    protected int $totalFebruary;
    protected int $totalMarch;
    protected int $totalApril;
    protected int $totalMay;
    protected int $totalJune;
    protected int $totalJuly;
    protected int $totalAugust;
    protected int $totalSeptember;
    protected int $totalOctober;
    protected int $totalNovember;
    protected int $totalDecember;
    protected int $total;

    public function __construct(
        $idCodeOfConduct,
        $codeOfConductName,
        $year,
        $totalJanuary,
        $totalFebruary,
        $totalMarch,
        $totalApril,
        $totalMay,
        $totalJune,
        $totalJuly,
        $totalAugust,
        $totalSeptember,
        $totalOctober,
        $totalNovember,
        $totalDecember,
        $total
    ) {
        $this->idCodeOfConduct = $idCodeOfConduct;
        $this->codeOfConductName = $codeOfConductName;
        $this->year = $year;
        $this->totalJanuary = $totalJanuary;
        $this->totalFebruary = $totalFebruary;
        $this->totalMarch = $totalMarch;
        $this->totalApril = $totalApril;
        $this->totalMay = $totalMay;
        $this->totalJune = $totalJune;
        $this->totalJuly = $totalJuly;
        $this->totalAugust = $totalAugust;
        $this->totalSeptember = $totalSeptember;
        $this->totalOctober = $totalOctober;
        $this->totalNovember = $totalNovember;
        $this->totalDecember = $totalDecember;
        $this->total = $total;
    }

    // fromstd
    public static function fromStdClass($stdObject): self {
        return new ViolationRecapModel(
            $stdObject->id_code_of_conduct,
            $stdObject->tata_tertib,
            $stdObject->tahun ?? date('Y'),
            $stdObject->januari,
            $stdObject->februari,
            $stdObject->maret,
            $stdObject->april,
            $stdObject->mei,
            $stdObject->juni,
            $stdObject->juli,
            $stdObject->agustus,
            $stdObject->september,
            $stdObject->oktober,
            $stdObject->november,
            $stdObject->desember,
            $stdObject->total_tahun
        );
    }

    // getters
    public function getIdCodeOfConduct() {
        return $this->idCodeOfConduct;
    }

    public function getCodeOfConductName() {
        return $this->codeOfConductName;
    }

    public function getYear() {
        return $this->year;
    }

    public function getTotalJanuary() {
        return $this->totalJanuary;
    }

    public function getTotalFebruary() {
        return $this->totalFebruary;
    }

    public function getTotalMarch() {
        return $this->totalMarch;
    }

    public function getTotalApril() {
        return $this->totalApril;
    }

    public function getTotalMay() {
        return $this->totalMay;
    }

    public function getTotalJune() {
        return $this->totalJune;
    }

    public function getTotalJuly() {
        return $this->totalJuly;
    }

    public function getTotalAugust() {
        return $this->totalAugust;
    }

    public function getTotalSeptember() {
        return $this->totalSeptember;
    }

    public function getTotalOctober() {
        return $this->totalOctober;
    }

    public function getTotalNovember() {
        return $this->totalNovember;
    }

    public function getTotalDecember() {
        return $this->totalDecember;
    }

    public function getTotal() {
        return $this->total;
    }
}