<?php

?>
<!-- this template for dashboar view -->
<div class="">
    <div class="row-auto flex-column flex-lg-row position-relative">
        <!-- Start Sidebar -->
        <div class="col-auto sidebar shadow-sm">
            <?php Helper::importView('partials/nav_dashboard.view.php');
            ?>
        </div>
        <!-- End Sidebar -->

        <main class="col-auto position-relative">
            <div class="row justify-content-end px-auto">
                <div class="col-lg-10 col px-5 py-4" title="main">
                    <div class="row mb-4">
                        <p class='mb-0 text-warning'>Hi, <?= $firstname ?></p>
                        <h1>Welcome to Tertib App</h1>
                    </div>
                    <div class="row px-4 gap-lg-5 gap-1 mb-4">
                        <div class="col-lg-2 col-auto border border-2 py-2 rounded-3 flex-grow-1 flex-lg-grow-0">
                            <div class="shadow-sm rounded-3 py-3 px-4 h-100">
                                <h1 class="mb-0"><?= $totalViolations ?></h1>
                                <h6>Violation</h6>
                            </div>
                        </div>
                        <div class="col-lg-2 col-auto border border-2 py-2 rounded-3 flex-grow-1 flex-lg-grow-0">
                            <div class="shadow-sm rounded-3 py-3 px-4 h-100 ">
                                <h1 class="mb-0"><?= $totalPoints ?></h1>
                                <h6>Points</h6>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4 gap-4">
                        <h1>Recent Violations</h1>
                        <?php
                        /**
                         * @var MahasiswaViolationModel[] $mahasiswaViolations
                         */
                        foreach ($mahasiswaViolations as $violation) : ?>
                            <div class="col-11 border border-2 ms-4 px-4 py-3 rounded-3">
                                <div class="row flex-column">
                                    <div class="col">
                                        <div class="d-flex justify-content-left mb-2">
                                            <span class="badge text-bg-dark me-2"><?= $violation->getViolationLevelName() ?></span>
                                            <span class="badge text-bg-warning me-2">Level <?= $violation->getViolationLevelLevel() ?></span>
                                            <span class="badge text-bg-danger me-2">+<?= $violation->getViolationLevelWeight() ?></span>
                                        </div>
                                        <h6 class="mb-0">
                                            <span class="text-primary">#<?= $violation->getIdMahasiswaViolation() ?></span>
                                            <span><?= $violation->getFirstNameMahasiswa() . " " . $violation->getLastNameMahasiswa() ?></span>
                                        </h6>
                                        <p><?= $violation->getCodeOfConductName() ?></p>
                                    </div>
                                    <div class="col d-flex justify-content-end">
                                        <a class="btn btn-primary text-white justify-self-end" href="<?= App::get('root_uri') . '/report/detail/'  . $violation->getIdReport() ?>" role="button">Detail</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>