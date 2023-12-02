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
                <div class="col-lg-10 col px-2 px-lg-5 py-4" title="main">
                    <div class="content p-lg-4 p-0">
                        <h1>Lecture Account</h1>
                        <div class="row gap-4">
                            <div class="col-lg-2 col-auto border border-2 mt-3 py-2 px-2 rounded-3 flex-grow-1 flex-lg-grow-0">
                                <div class="shadow-sm rounded-3 py-3 px-lg-4 px-0 h-100">
                                    <h1 class="mb-0">120</h1>
                                    <h6>Account Total</h6>
                                </div>
                            </div>
                            <div class="col-lg-2 col-auto border border-2 mt-3 py-2 px-2 rounded-3 flex-grow-1 flex-lg-grow-0">
                                <div class="shadow-sm rounded-3 py-3 px-lg-4 px-0 h-100">
                                    <h1 class="mb-0">120</h1>
                                    <h6>Informatic Lecture</h6>
                                </div>
                            </div>
                            <div class="col-lg-2 col-auto border border-2 mt-3 py-2 px-2 rounded-3 flex-grow-1 flex-lg-grow-0">
                                <div class="shadow-sm rounded-3 py-3 px-lg-4 px-0 h-100">
                                    <h1 class="mb-0">120</h1>
                                    <h6>SIB Lecture</h6>
                                </div>
                            </div>
                            <div class="col-lg-2 col-auto border border-2 mt-3 py-2 px-2 rounded-3 flex-grow-1 flex-lg-grow-0">
                                <div class="shadow-sm rounded-3 py-3 px-lg-4 px-0 h-100">
                                    <h1 class="mb-0">120</h1>
                                    <h6>PPLS Lecture</h6>
                                </div>
                            </div>
                        </div>

                        <div class="row flex-column gap-3 mt-4">
                            <div class="col justify-content-end d-flex">
                                <button type="button" class="btn border-none shadow-sm px-3 py-2 rounded-4 flex-shrink-1" data-bs-toggle="modal" data-bs-target="#modalAdd">
                                    <i class="bi bi-person-plus"></i>
                                </button>

                                <!-- pop up -->
                                <div class="modal fade" id="modalAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalAdd" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered ">
                                        <div class="modal-content modal-dialog-scrollable">
                                            <form action="" method="post">
                                                <div class="modal-header justify-content-center">
                                                    <h4 class="modal-title" id="modalAdd">ADD LECTURE</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="NIDN" class="form-label">NIDN</label>
                                                        <input type="text" class="form-control" id="NIDN" name="NIDN" placeholder="Input lecture NIDN">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="firstname" class="form-label">Firstname</label>
                                                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Input Lecture Firstname">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="lastname" class="form-label">Lastname</label>
                                                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Input Lecture Lastname">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="email" class="form-control" id="email" name="email" placeholder="Input Lecture Email">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="prodi" class="form-label">Prodi</label>
                                                        <select class="form-select" id="prodi" aria-label="Default select example">
                                                            <option selected>Choose Lecture Studi Program</option>
                                                            <option value="1">One</option>
                                                            <option value="2">Two</option>
                                                            <option value="3">Three</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="noTelp" class="form-label">No. Telp</label>
                                                        <input type="number" class="form-control" id="noTelp" name="noTelp" placeholder="Input Lecture Number">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="password" class="form-label">Password</label>
                                                        <input type="password" class="form-control" id="password" name="password" placeholder="Input Lecture Password">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                                                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Retype Lecture Password">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
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
                                            <th scope="col">NIDN</th>
                                            <th scope="col">Firstname</th>
                                            <th scope="col">Lastname</th>
                                            <th scope="col">Email</th>
                                            <th class="col">Study Program</th>
                                            <th scope="col">Phone Number</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>92319</td>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                            <td>@mdo</td>
                                            <td>@mdo</td>

                                            <td>
                                                <!-- modal trigger -->
                                                <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#editModal">
                                                    edit
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content modal-dialog-scrollable">
                                                            <form action="" method="post">
                                                                <div class="modal-header justify-content-center">
                                                                    <h1 class="modal-title fs-5" id="editModal">EDIT LECTURE</h1>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label for="NIM" class="form-label">NIM</label>
                                                                        <input type="text" class="form-control" id="NIM" name="NIM" placeholder="Input Lecture NIM">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="firstname" class="form-label">Firstname</label>
                                                                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Input Lecture Firstname">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="lastname" class="form-label">Lastname</label>
                                                                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Input Lecture Lastname">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="email" class="form-label">Email</label>
                                                                        <input type="email" class="form-control" id="email" name="email" placeholder="Input Lecture Email Address">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="prodi" class="form-label">Prodi</label>
                                                                        <select class="form-select" id="prodi" aria-label="Default select example">
                                                                            <option selected>Choose Lecture Studi Program</option>
                                                                            <option value="1">One</option>
                                                                            <option value="2">Two</option>
                                                                            <option value="3">Three</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="noTelp" class="form-label">No. Telp</label>
                                                                        <input type="number" class="form-control" id="noTelp" name="noTelp" placeholder="Input Lecture Number">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="password" class="form-label">Password</label>
                                                                        <input type="password" class="form-control" id="password" name="password" placeholder="Input Lecture Password">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                                                                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Retype Lecture Password">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="button" class="btn btn-secondary">Save</button>
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