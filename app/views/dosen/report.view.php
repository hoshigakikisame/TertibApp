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
                        <?= $flash ?>
                        <h1>Report</h1>
                        <div class="col-auto rounded-5 my-4 mx-2">
                            <form action="<?= $addNewReportEndpoint ?>" method="POST" enctype="multipart/form-data">
                                <div class="row-auto gap-5 d-flex flex-column flex-md-row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Judul</label>
                                            <input type="text" class="form-control" id="title" name="title" placeholder="Masukkan judul">
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="mahasiswa_list">Mahasiswa</label>
                                                <input type="text" class="form-control" list="mahasiswa_list" placeholder="Masukkan NIM atau Nama Mahasiswa" name="nim_mahasiswa" />
                                            </div>
                                            <datalist id="mahasiswa_list">
                                                <?php
                                                /**
                                                 * @var UserModel[] $users
                                                 */
                                                foreach ($users as $user) :
                                                    /**
                                                     * @var MahasiswaModel $mahasiswa
                                                     */
                                                    $mahasiswa = $user->getRoleDetail();
                                                ?>
                                                    <option value="<?= $mahasiswa->getNim() ?>" label="<?= $mahasiswa->getNim() ?> - <?= $user->getFirstName() ?> <?= $user->getLastName() ?>">
                                                    </option>
                                                <?php endforeach; ?>
                                            </datalist>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="code_of_conducts">Pelanggaran</label>
                                                <input type="text" class="form-control" list="code_of_conducts" placeholder="Masukkan Nama Pelanggaran" name="id_code_of_conduct" />
                                            </div>
                                            <datalist id="code_of_conducts" onchange="updatePelanggaran(event);">
                                                <?php
                                                /**
                                                 * @var CodeOfConductModel[] $codeOfConducts
                                                 */
                                                foreach ($codeOfConducts as $codeOfConduct) :
                                                    /**
                                                     * @var ViolationLevelModel $violationLevel
                                                     */
                                                    $violationLevel = $codeOfConduct->getViolationLevel();
                                                ?>
                                                    <option test="sliwik" value="<?= $codeOfConduct->getIdCodeOfConduct() ?>" label="<?= $codeOfConduct->getName() ?> - <?= $violationLevel->getName() ?> - <?= GenericUtil::intToRoman($violationLevel->getLevel()) ?>">
                                                    </option>
                                                <?php endforeach; ?>
                                            </datalist>
                                        </div>
                                        <div class="mb-3">
                                            <label for="Location" class="form-label">Masukkan Lokasi Pelanggaran</label>
                                            <input type="text" class="form-control" id="Location" placeholder="Masukkan Lokasi Pelanggaran" name="location">
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="mb-3 d-flex flex-column">
                                            <label for="formFile" class="form-label">Lampiran Pelanggaran</label>
                                            <label for="formFile" class="bg-light-subtle drop-area rounded-3 p-3">
                                                <input class="form-control" type="file" id="formFile" name="evidence_picture" hidden>
                                                <div class="img-view d-flex flex-column align-items-center justify-content-center  rounded-3 object-fit-cover">
                                                    <i class="bi bi-cloud-upload display-1"></i>
                                                    <p>Drag and drop or click here to upload image</p>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="deskripsi" class="form-label">Isi Pelanggaran</label>
                                            <textarea class="form-control" id="deskripsi" rows="3" placeholder="Isi Deskripsi Pelanggaran" name="content"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <p>Nb: Demi kenyamanan dan keamanan anda (Pelapor), data pribadi anda akan kami
                                        rahasiakan dan apabila mengandung informasi sensitif akan menjadi aduan pribadi
                                        (hanya dapat diakses melalui akun anda)</p>
                                </div>
                                <!-- Button trigger modal -->
                                <div class="row justify-content-end">
                                    <button class="btn btn-secondary col-4 text-white" type="submit" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Send Report</button>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class=" modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body text-center">
                                                <i class="bi bi-check-circle text-primary" style="font-size:min(60vh,300px);"></i>
                                                <h1>Aduan Anda Berhasil Terkirim</h1>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    function updatePelanggaran(e) {
        console.log(e);
        e.target.value = e.target;
    }


    const dropArea = document.querySelector(".drop-area");
    const inputFile = document.querySelector("input[type=file]");
    const imgView = document.querySelector(".img-view");

    function uploadImg() {
        let imgLink = URL.createObjectURL(inputFile.files[0]);
        imgView.style.backgroundImage = `url(${imgLink})`;
        imgView.textContent = "";
        imgView.style.border = 0;
    }

    inputFile.addEventListener('change', uploadImg)
    dropArea.addEventListener('dragover', (e) => {
        e.preventDefault();
    });
    dropArea.addEventListener('drop', (e) => {
        e.preventDefault();
        inputFile.files = e.dataTransfer.files;
        uploadImg();
    });
</script>