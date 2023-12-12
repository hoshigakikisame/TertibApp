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
                        <div class="col-3">
                            <!-- for admin -->
                            <div class="row-auto">
                                <div class="col-auto d-flex flex-column gap-2">
                                    <div class="img d-flex align-items-center gap-3">
                                        <img src="<?= $user->getImageUrl() ?>" class="rounded-circle img-profile" alt="">
                                        <h6>
                                            <?= $user->getFirstName() . " " . $user->getLastName() ?>
                                        </h6>
                                    </div>

                                    <div class="info">
                                        <p>participant</p>
                                        <div class="participant">
                                            <img src="" alt="">
                                            <img src="" alt="">
                                            <img src="" alt="">
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <h6 class="fw-bold">Report id</h6>
                                            </div>
                                            <div class="col">
                                                <h6>: <span class="badge bg-secondary">21312</span></h6>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <h6 class="fw-bold">Reported To</h6>
                                            </div>
                                            <div class="col">
                                                <h6>: admin></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="action row border-top">
                                        <form action="post" class='col py-3'>
                                            <div class="input-group mb-3">
                                                <label class="input-group-text" for="inputGroupSelect01">Status</label>
                                                <select class="form-select" id="inputGroupSelect01">
                                                    <option selected>Choose...</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </div>
                                            <div class="input-group mb-3">
                                                <label class="input-group-text" for="inputGroupSelect01">Point</label>
                                                <select class="form-select" id="inputGroupSelect01">
                                                    <option selected>Choose...</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </div>
                                            <div class="input-group mb-3 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-secondary text-white">
                                                    Submit
                                                </button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>