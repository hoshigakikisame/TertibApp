<?php

?>
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

                        <?php foreach (ReportModel::getStatusChoices() as $status) : ?>
                            <div class="col-lg-2 col-auto border border-2 py-2 rounded-3 flex-grow-1 flex-lg-grow-0">
                                <div class="shadow-sm rounded-3 py-3 px-4 h-100">
                                    <h1 class="mb-0">
                                        <?php
                                        $count = 0;
                                        foreach ($reports as $report) {
                                            if ($report->getStatus() == $status) {
                                                $count++;
                                            }
                                        }
                                        echo $count;
                                        ?>
                                    </h1>
                                    <h6><?= $status ?> Reports</h6>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>

                    <div class="row mb-4 gap-4">
                        <h1>Recent Reports</h1>
                        <?php
                        /**
                         * @var ReportModel[] $reports
                         */
                        foreach ($reports as $report):
                        ?>
                            <div class="col-11 border border-2 ms-4 px-4 py-3 rounded-3">
                                <div class="row flex-column">
                                    <div class="col">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="badge text-bg-info"><?= $report->getStatus() ?></span>
                                            <span><?= GenericUtil::dateToHumanReadable($report->getReportDate()) ?></span>
                                        </div>
                                        <h6 class="mb-0"><span class="text-primary">#<?= $report->getIdReport() ?></span> You Reported Mahasiswa with Username <?= $report->getMahasiswaUsername() ?> </h6>
                                        <p><?= $report->getCodeOfConductName() ?></p>
                                    </div>
                                    <div class="col d-flex justify-content-end">
                                        <a class="btn btn-primary text-white justify-self-end" href="<?= App::get('root_uri') . '/report/detail/' . $report->getIdReport() ?>" role="button">Report
                                            Detail</a>
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