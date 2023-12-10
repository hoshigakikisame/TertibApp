<?php
$user = Session::getInstance()->get('user');

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
                        <h1>Report Detail</h1>
                    </div>
                    <div class="row">
                        <div class="col">
                            <!-- start content -->
                            <div class="row">
                                <div class="col-auto">
                                    <img src="<?= $user->getImageUrl() ?>" class="rounded-circle img-profile" alt="">
                                </div>
                                <div class="col">
                                    <div class="content">
                                        <div class="info mb-2">
                                            <h6 class="mb-0"><?= $user->getFirstName() . " " . $user->getLastName() ?> <span class="badge bg-success fs-6">LG1234</span></h6>
                                            <p class="mb-0">Submited a Report: Nov 21, 2023</p>
                                        </div>
                                        <div class="content">
                                            <h5>Judul: Pelanggaran tata tertib pada bagian rambut</h5>
                                            <h5>NIM: 321349234</h5>
                                            <h5>Nama: Thoriq</h5>
                                            <h5>Pelanggaran: Mahasiswa berambut punk</h5>
                                            <h5>Lokasi: ruang kelas </h5>
                                            <h5>Deskripsi Pelanggaran: dasdsa</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End content -->
                            <div class="row mt-3">
                                <div class="col-auto">
                                    <img src="<?= $user->getImageUrl() ?>" class="rounded-circle img-profile" alt="">
                                </div>
                                <div class="col">
                                    <h6><?= $user->getFirstName() ?></h6>
                                    <form action="post">
                                        <div class="mb-3">
                                            <textarea class="form-control" name="comment" id="" rows="3" placeholder="Write Your Message"></textarea>
                                        </div>
                                        <div class="mb-3 float-end">
                                            <input class="opacity-0" id="upload" type="file" hidden>
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