<?php ?>
<div class="">

    <div class="row-auto flex-column flex-lg-row position-relative">
        <!-- Start Sidebar -->
        <div class="col-auto sidebar shadow-sm">
            <?php Helper::importView('partials/nav_dashboard.view.php');
            ?>
        </div>
        <!-- End Sidebar -->

        <main class="col position-relative overflow-x-hidden">
            <div class="row justify-content-lg-end">
                <div class="col-lg-10 col px-2 px-lg-5 py-4" title="main" style="max-width: 100vw; ">
                    <div class="content p-lg-4 p-0">
                        <h1>Level Violation</h1>
                        <div class="row ms-2">
                            <div class="col-lg-2 col-auto border border-2 mt-3 py-2 px-2 rounded-3 flex-grow-1 flex-lg-grow-0">
                                <div class="shadow-sm rounded-3 py-3 px-lg-4 px-0 h-100">
                                    <h1 class="mb-0"><?= "12" ?></h1>
                                    <h6>Level Violation Totals</h6>
                                </div>
                            </div>
                        </div>
                        <div class="row flex-column gap-3 mt-4">
                            <div class="col justify-content-end d-flex">
                                <button type="button" class="btn border-none shadow-sm px-3 py-2 rounded-4 flex-shrink-1" data-bs-toggle="modal" data-bs-target="#modalAdd">
                                    <i class="bi bi-file-earmark-plus"></i>
                                </button>

                                <!-- pop up -->
                                <div class="modal fade" id="modalAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalAdd" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered ">
                                        <div class="modal-content modal-dialog-scrollable">
                                            <form action="<?= $newAdminEndpoint ?>" method="post">
                                                <div class="modal-header justify-content-center">
                                                    <h4 class="modal-title" id="modalAdd">ADD LEVEL VIOLATION</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="level" class="form-label">Level</label>
                                                        <input type="text" class="form-control" id="level" name="level" placeholder="Input Violation Level" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Name</label>
                                                        <input type="text" class="form-control" id="name" name="name_violation" placeholder="Input Violation Name" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="weight" class="form-label">Weight</label>
                                                        <input type="number" class="form-control" id="weight" name="weight" placeholder="Input Violation Weight" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Level</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Weight</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $no = 1;
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= "data" ?></td>
                                            <td><?= "data" ?></td>
                                            <td><?= "data" ?></td>

                                            <td>
                                                <!-- modal trigger -->
                                                <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#editModal">
                                                    edit
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content modal-dialog-scrollable">
                                                            <form action="<?= $edit ?>" method="post">
                                                                <div class="modal-header justify-content-center">
                                                                    <h1 class="modal-title fs-5" id="editModal">EDIT LEVEL VIOLATION</h1>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label for="level" class="form-label">Level</label>
                                                                        <input type="text" class="form-control" id="level" name="level" placeholder="Input Violation Level" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="name" class="form-label">Name</label>
                                                                        <input type="text" class="form-control" id="name" name="name_violation" placeholder="Input Violation Name" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="weight" class="form-label">Weight</label>
                                                                        <input type="number" class="form-control" id="weight" name="weight" placeholder="Input Violation Weight" required>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>