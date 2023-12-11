<?php
$user = Session::getInstance()->get('user');

/**
 * @var ReportModel $report
 * @var UserModel $mahasiswaUser
 * @var UserModel $dosenUser
 * @var CodeOfConductModel $codeOfConduct
 */
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
                        <?= $flash ?>
                        <h1>Report Detail</h1>
                    </div>
                    <div class="row">
                        <div class="col">
                            <!-- start content -->
                            <div class="row">
                                <div class="col-auto">
                                    <img src="<?= $dosenUser->getImageUrl() ?>" class="rounded-circle img-profile" alt="">
                                </div>
                                <div class="col">
                                    <div class="content">
                                        <div class="info mb-2">
                                            <h6 class="mb-0">
                                                <?= $dosenUser->getFirstName() . " " . $dosenUser->getLastName() ?> <span class="badge bg-success fs-6">#<?= $report->getIdReport() ?></span>
                                            </h6>
                                            <p class="mb-0">Submited a Report on
                                                <?= GenericUtil::dateToHumanReadable($report->getReportDate()) ?>
                                            </p>
                                        </div>
                                        <hr>
                                        <div class="content">
                                            <div class="row">
                                                <div class="col-2">
                                                    <h6 class="fw-bold">Judul</h6>
                                                </div>
                                                <div class="col">
                                                    <h6>: <?= $report->getTitle() ?></h6>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-2">
                                                    <h6 class="fw-bold">NIM</h6>
                                                </div>
                                                <div class="col">
                                                    <h6>: <?= $report->getNimMahasiswa() ?></h6>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-2">
                                                    <h6 class="fw-bold">Mahasiswa</h6>
                                                </div>
                                                <div class="col">
                                                    <h6>: <?= $mahasiswaUser->getFirstName() . " " . $mahasiswaUser->getLastName() ?></h6>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-2">
                                                    <h6 class="fw-bold">Nama Pelanggaran</h6>
                                                </div>
                                                <div class="col">
                                                    <h6>: <?= $codeOfConduct->getName() ?></h6>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-2">
                                                    <h6 class="fw-bold">Deskripsi Pelanggaran</h6>
                                                </div>
                                                <div class="col">
                                                    <h6>: <?= $codeOfConduct->getDescription() ?></h6>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-2">
                                                    <h6 class="fw-bold">Lokasi</h6>
                                                </div>
                                                <div class="col">
                                                    <h6>: <?= $report->getLocation() ?></h6>
                                                </div>
                                            </div>
                                            <!-- divider -->
                                            <hr>
                                            <h6 class="fw-bold">Detail Pelanggaran</h6>
                                            <p><?= $report->getContent() ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End content -->

                            <!-- start comment -->
                            <?php 
                            /**
                             * @var ReportCommentModel[] $reportComments
                             */
                            foreach ($reportComments as $comment): 
                                $user = $comment->getUser();
                            ?>
                            <div class="row my-3">
                                <div class="col-auto">
                                    <img src="<?= $user->getImageUrl() ?>" class="rounded-circle img-profile" alt="">
                                </div>
                                <div class="col">
                                    <div class="content">
                                        <div class="info mb-2">
                                            <h6 class="mb-0">
                                                <?= $user->getUsername() ?>
                                            </h6>
                                            <p class="mb-0">
                                                <?= GenericUtil::dateToHumanReadable($comment->getCreatedAt()) ?>
                                            </p>
                                        </div>
                                        <hr>
                                        <div class="content">
                                            <p><?= $comment->getContent() ?></p>
                                        </div>
                                        <img style="height: 200px" src="<?= $comment->getImageUrl() ?>" alt="">
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <!-- End comment -->

                            <?php 
                            /**
                             * @var UserModel $currentUser
                             */
                            $currentUser = Session::getInstance()->get('user'); ?>
                            <div class="row mt-3">
                                <div class="col-auto">
                                    <img src="<?= $currentUser->getImageUrl() ?>" class="rounded-circle img-profile" alt="">
                                </div>
                                <div class="col">
                                    <h6>
                                        <?= $currentUser->getUsername() ?>
                                    </h6>
                                    <form method="post" action="<?= $addNewReportCommentEndpoint ?>" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <textarea class="form-control" name="content" id="" rows="3" placeholder="Write Your Message"></textarea>
                                        </div>
                                        <div class="mb-3 float-end">
                                            <input class="opacity-0" id="upload" type="file" name="attachment_picture" hidden>
                                            <label for="upload" class="btn btn-primary text-white"><i class="bi bi-cloud-arrow-up"></i></label>
                                            <button type="submit" class="btn btn-primary text-white"><i class="bi bi-send"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <!-- for admin -->
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>