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
                        <h1>Notification</h1>
                        <?php
                        if (empty($newMahasiswaViolations)): ?>
                            <div class="col-xl-10 col">
                                <div class="row-auto flex-column p-3 bg-light-subtle rounded-3">
                                    <div class="col">
                                        <h5 class="text-left">No new notification</h5>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php
                        /**
                         * @var MahasiswaViolationModel[] $newMahasiswaViolations
                         */
                        foreach ($newMahasiswaViolations as $violation): ?>
                            <div class="col-xl-10 col" id="<?= $violation->getIdMahasiswaViolation() ?>">
                                <div class="row-auto flex-column p-3 bg-light-subtle rounded-3">
                                    <div class="col ">
                                        <h5>
                                            <span class="badge bg-danger">#<?= $violation->getIdMahasiswaViolation() ?>
                                            </span>
                                            You've Violated <span class="text-danger" ><?= $violation->getCodeOfConductName() ?></span> Code of Conduct
                                        </h5>
                                    </div>
                                    <div class="col"></div>
                                    <p class="text-wrap text-truncate">
                                    Kami ingin memberitahu bahwa Anda telah ada melanggar tata tertib kampus berdasarkan laporan yang ada. Kami menganggap serius setiap laporan ini untuk menjaga keamanan dan kenyamanan di lingkungan kampus <a target="_blank" href="<?= App::get('root_uri') . "/report/detail/" . $violation->getIdReport() ?>">Details</a>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>
        </main>
    </div>
</div>