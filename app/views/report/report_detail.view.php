<?php

/**
 * @var UserModel $user
 */
$user = Session::getInstance()->get('user');
$isMahasiswa = $user->getRole() == 'mahasiswa';

/**
 * @var ReportModel $report
 * @var UserModel $mahasiswaUser
 * @var UserModel $dosenUser
 * @var UserModel|null $adminUser
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
                                    <img src="<?= GenericUtil::optionalImageRedaction($report->getDosenImageUrl(), $isMahasiswa) ?>" class="rounded-circle img-profile" alt="">
                                </div>
                                <div class="col">
                                    <div class="content">
                                        <div class="info mb-2">
                                            <h6 class="mb-0">
                                                <?= GenericUtil::optionalTextRedaction($report->getDosenFirstName() . " " . $report->getDosenLastName(), $isMahasiswa) ?> <span class="badge bg-success fs-6">#<?= $report->getIdReport() ?></span>
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
                                                    <h6>: <?= $report->getMahasiswaFirstName() . " " . $report->getMahasiswaLastName() ?></h6>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-2">
                                                    <h6 class="fw-bold">Pelanggaran</h6>
                                                </div>
                                                <div class="col">
                                                    <h6>: <?= $report->getCodeOfConductName() ?></h6>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-2">
                                                    <h6 class="fw-bold">Deskripsi</h6>
                                                </div>
                                                <div class="col">
                                                    <h6>: <?= $report->getCodeOfConductDescription() ?></h6>
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
                                            <img style="max-height: 300px" src="<?= $report->getImageUrl() ?>" alt="">
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
                            foreach ($reportComments as $comment) :
                            ?>
                                <div class="row my-3" id="<?= $comment->getIdReportComment() ?>">
                                    <div class="col-auto">
                                        <img src="<?= GenericUtil::optionalImageRedaction($comment->getAuthorImageUrl(), $isMahasiswa) ?>" class="rounded-circle img-profile" alt="">
                                    </div>
                                    <div class="col">
                                        <div class="content">
                                            <div class="info mb-2">
                                                <h6 class="mb-0">
                                                    <?= GenericUtil::optionalTextRedaction($comment->getAuthorUsername(), $isMahasiswa) ?>
                                                </h6>
                                                <p class="mb-0">
                                                    <?= GenericUtil::dateToHumanReadable($comment->getCreatedAt()) ?>
                                                </p>
                                            </div>
                                            <hr>
                                            <div class="content">
                                                <p><?= $comment->getContent() ?></p>
                                            </div>
                                            <img style="max-height: 200px" src="<?= $comment->getImageUrl() ?>" alt="">
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <!-- End comment -->

                            <?php
                            /**
                             * @var UserModel $currentUser
                             */
                            $currentUser = Session::getInstance()->get('user');

                            if ($report->isParticipant($currentUser) && !$report->isAlreadyClosed() && $currentUser->getRole() != 'mahasiswa') :
                            ?>
                                <div class="row mt-3">
                                    <div class="col-auto">
                                        <img src="<?= $currentUser->getImageUrl() ?>" class="rounded-circle border border-white img-profile" alt="">
                                    </div>
                                    <div class="col">
                                        <h6>
                                            <?= $currentUser->getUsername() ?>
                                        </h6>
                                        <form method="post" action="<?= $addNewReportCommentEndpoint ?>" enctype="multipart/form-data">
                                            <div class="img-comment-preview d-none">
                                                <img src="" alt="" width="100px">
                                            </div>
                                            <div class="mb-3" title="flashComment">
                                                <textarea class="form-control" name="content" id="" rows="3" placeholder="Write Your Message"></textarea>
                                            </div>

                                            <div class="mb-3 float-end">
                                                <label for="upload" class="btn btn-primary text-white"><i class="bi bi-cloud-arrow-up"></i></label>
                                                <input class="opacity-0" id="upload" type="file" name="attachment_picture" hidden>
                                                <button type="submit" class="btn btn-primary text-white" onclick="checkComment(event,$(this))"><i class="bi bi-send"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <?php endif; ?>

                        </div>
                        <div class="col-3">
                            <!-- for admin -->

                            <div class="row-auto">
                                <div class="col-auto d-flex flex-column gap-2">
                                    <div class="img d-flex align-items-center gap-3">
                                        <img src="<?= GenericUtil::optionalImageRedaction($report->getDosenImageUrl(), $isMahasiswa) ?>" class="border border-white rounded-circle img-profile" alt="">
                                        <h6>
                                            <?= GenericUtil::optionalTextRedaction($report->getDosenFirstName() . " " . $report->getDosenLastName(), $isMahasiswa) ?>
                                        </h6>
                                    </div>

                                    <div class="info">
                                        <p class="mb-1">participant</p>
                                        <div class="participant">
                                            <img src="<?= GenericUtil::optionalImageRedaction($report->getDosenImageUrl(), $isMahasiswa) ?>" class="border border-white rounded-circle img-profile-sm" alt="">
                                            <img src="<?= GenericUtil::optionalImageRedaction($report->getAdminImageUrl() ?? '', $isMahasiswa) ?>" class="border border-white rounded-circle img-profile-sm" alt="">
                                            <img src="<?= $report->getMahasiswaImageUrl() ?? '' ?>" class="border border-white rounded-circle img-profile-sm" alt="">
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-5">
                                                <h6 class="fw-bold">Report id</h6>
                                            </div>
                                            <div class="col">
                                                <h6><span class="badge bg-success">#<?= $report->getIdReport() ?></span></h6>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <h6 class="fw-bold">Managed by</h6>
                                            </div>
                                            <div class="col">
                                                <h6><?= GenericUtil::optionalTextRedaction($report->getAdminUsername() ?? 'No One Yet', $isMahasiswa) ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="action row border-top ">
                                        <form action="<?= $updateReportDetailEndpoint ?>" method="post" id="updateReportDetailForm" class='col py-3'>
                                            <div class="input-group mb-3">
                                                <?php
                                                $view = 'input-group';
                                                $action = 'disabled readonly';
                                                if ($currentUser->isAdmin()) {
                                                    $view = 'input-group-text';
                                                    $action = '';
                                                } ?>
                                                <label class="<?= $view ?>" for="inputGroupSelect01">Status</label>
                                                <select class="form-select" id="inputGroupSelect01" name="status" <?= $action ?>>
                                                    <?php foreach (ReportModel::getStatusChoices() as $status) : ?>
                                                        <option value="<?= $status ?>" <?= $status == $report->getStatus() ? "selected" : "" ?>><?= $status ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="input-group mb-3">
                                                <label class="<?= $view ?>" for="inputGroupSelect02">Code of Conduct</label>
                                                <select class="form-select" id="inputGroupSelect02" name="id_code_of_conduct" <?= $action ?>>
                                                    <?php
                                                    /**
                                                     * @var CodeOfConductModel[] $codeOfConducts
                                                     */
                                                    foreach ($codeOfConducts as $codeOfConduct) : ?>
                                                        <option value="<?= $codeOfConduct->getIdCodeOfConduct() ?>" <?= $codeOfConduct->getIdCodeOfConduct() == $report->getIdCodeOfConduct() ? "selected" : "" ?>><?= $codeOfConduct->getName() ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <hr>
                                            <div class="input-group mb-3 d-flex justify-content-end" id="action_wrapper">
                                                <?php
                                                /**
                                                 * @var UserModel $currentUser
                                                 */
                                                $currentUser = Session::getInstance()->get('user');
                                                if ($currentUser->isAdmin()) : ?>
                                                    <button type="button" onclick="checkVal($(this),$('#inputGroupSelect01').val() )" class="btn btn-secondary text-white" data-bs-toggle="modal" data-bs-target="#modalConfirmation">
                                                        Save
                                                    </button>
                                                <?php endif; ?>
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

<script src="<?= App::get("root_uri") . "/public/js/script.js" ?>"></script>
<script>
    function checkVal(elemen) {
        const val = $('#inputGroupSelect01').val();
        if (val == 'Invalid' || val == 'Valid') {
            modalConfirmation(elemen, val);
        } else {
            elemen.parents('form').submit();
        }
    }

    function modalConfirmation(elemen, status) {
        const modal = /*html*/ `
        <!-- Modal -->
<div class="modal fade" id="modalConfirmation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            
            <div class="modal-body text-center">
            <i class="bi bi-patch-question text-primary" style="font-size:200px"></i>
            <h4 class="w-75 px-3 mx-auto">mengganti status ke ${status} sama dengan menutup report, apakah anda yakin?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id='save' class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>`

        $('#action_wrapper').append(modal)
        $('#modalConfirmation').modal('show')

        $('button[type="button"]#save').click(function(e) {
            console.log(elemen.parents('form'))
            elemen.parents('form').submit();
            $('#modalConfirmation').modal('hide')
        });


        const myModalEl = document.getElementById('modalConfirmation')
        myModalEl.addEventListener('hidden.bs.modal', event => {
            $('#modalConfirmation').remove();
        })


    }

    function checkComment(event, elemen) {
        event.preventDefault();
        let comment = elemen.parent().siblings().find('textarea').val();
        if (comment.length == 0) {
            $("div[role=alert]").remove();
            let flash = flashAlert('warning', 'You dont input the comment text', 'please fill the comment and send again')
            $('div[title=flashComment]').before(flash);
        } else {
            elemen.parents('form').submit();
        }
    }

    function imgPreviewComment() {
        const input = document.getElementById('upload');
        const preview = document.querySelector('.img-comment-preview');
        const imgPreview = preview.querySelector('img');

        input.addEventListener('change', function() {
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();

                imgPreview.style.display = 'block';

                preview.classList.remove('d-none');

                reader.addEventListener('load', function() {
                    imgPreview.setAttribute('src', this.result);
                });

                reader.readAsDataURL(file);
            } else {
                imgPreview.style.display = null;
                imgPreview.setAttribute('src', '');
            }
        });
    }

    imgPreviewComment();
</script>