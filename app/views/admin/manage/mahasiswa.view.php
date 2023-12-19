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
                        <?= $flash ?>
                        <h1>Mahasiswa Account</h1>
                        <div class="row gap-4">
                            <div class="col-lg-2 col-auto border border-2 mt-3 py-2 px-2 rounded-3 flex-grow-1 flex-lg-grow-0">
                                <div class="shadow-sm rounded-3 py-3 px-lg-4 px-0 h-100">
                                    <h1 class="mb-0">
                                        <?= $usersCount ?>
                                    </h1>
                                    <h6>Account Total</h6>
                                </div>
                            </div>

                            <?php
                            for ($i = 0; $i < count(MahasiswaModel::getProdiChoices()); $i++) :
                                $prodi = MahasiswaModel::getProdiChoices()[$i];
                                $memberCount = 0;
                                foreach ($users as $user) {
                                    $mahasiswaRole = $user->getRoleDetail();
                                    if ($mahasiswaRole->getProdi() == $prodi) {
                                        $memberCount++;
                                    }
                                }
                            ?>
                                <div class="col-lg-2 col-auto border border-2 mt-3 py-2 px-2 rounded-3 flex-grow-1 flex-lg-grow-0">
                                    <div class="shadow-sm rounded-3 py-3 px-lg-4 px-0 h-100">
                                        <h1 class="mb-0">
                                            <?= $memberCount ?>
                                        </h1>
                                        <h6>
                                            <?= $prodi ?>
                                        </h6>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>

                        <div class="row flex-column gap-3 mt-4">
                            <div class="col justify-content-end d-flex">
                                <button type="button" id="btnPress" class="btn border-none shadow-sm px-3 py-2 rounded-4 flex-shrink-1" data-bs-toggle="modal" data-bs-target="#modalAdd">
                                    <i class="bi bi-person-plus"></i>
                                </button>

                                <!-- pop up -->
                                <div class="modal fade" id="modalAdd" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalAdd" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered ">
                                        <div class="modal-content modal-dialog-scrollable">
                                            <form action="<?= $newMahasiswaEndpoint ?>" method="post">
                                                <div class="modal-header justify-content-center">
                                                    <h4 class="modal-title" id="modalAdd">ADD MAHASISWA</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="username" class="form-label">Username</label>
                                                        <input type="text" class="form-control" id="username" name="username" placeholder="Input Mahasiswa Username" required>
                                                    </div>
                                                    <div class="mb-3" title="flashIdentity">
                                                        <label for="identity" class="form-label">NIM</label>
                                                        <input type="number" class="form-control" id="identity" name="nim" placeholder="Input Mahasiswa NIM">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="firstname" class="form-label">Firstname</label>
                                                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Input Mahasiswa Firstname">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="lastname" class="form-label">Lastname</label>
                                                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Input Mahasiswa Lastname">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="prodi" class="form-label">Prodi</label>
                                                        <select class="form-select" id="prodi" aria-label="Default select example" name="prodi">
                                                            <?php foreach (MahasiswaModel::getProdiChoices() as $prodi) : ?>
                                                                <option value="<?= $prodi ?>">
                                                                    <?= $prodi ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="email" class="form-control" id="email" name="email" placeholder="Input Mahasiswa Email Address">
                                                    </div>
                                                    <div class="mb-3" title="flashTelepon">
                                                        <label for="noTelp" class="form-label">No. Telp</label>
                                                        <input type="number" class="form-control" id="noTelp" name="no_telp" placeholder="Input Mahasiswa Number">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="address" class="form-label">Address</label>
                                                        <input type="text" class="form-control" id="address" name="address" placeholder="Input Mahasiswa Address">
                                                    </div>
                                                    <div class="mb-3" title="flash">
                                                        <label for="password" class="form-label">Password</label>
                                                        <input type="password" class="form-control" id="newPassword" name="password" placeholder="Input Mahasiswa Password">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="confirmPassword" class="form-label">Confirm
                                                            Password</label>
                                                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Retype Mahasiswa Password">
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
                                            <th scope="col">Username</th>
                                            <th scope="col">NIM</th>
                                            <th scope="col">Firstname</th>
                                            <th scope="col">Lastname</th>
                                            <th class="col">Prodi</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone Number</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        /**
                                         * @var UserModel[] $users
                                         */
                                        foreach ($users as $user) :
                                            /**
                                             * @var MahasiswaModel $mahasiswaRole
                                             */
                                            $mahasiswaRole = $user->getRoleDetail();
                                        ?>
                                            <tr>
                                                <td>
                                                    <?= $user->getUsername() ?>
                                                </td>
                                                <td>
                                                    <?= $mahasiswaRole->getNim() ?>
                                                </td>
                                                <td>
                                                    <?= $user->getFirstName() ?>
                                                </td>
                                                <td>
                                                    <?= $user->getLastName() ?>
                                                </td>
                                                <td>
                                                    <?= $mahasiswaRole->getProdi() ?>
                                                </td>
                                                <td>
                                                    <?= $user->getEmail() ?>
                                                </td>
                                                <td>
                                                    <?= $user->getPhoneNumber() ?>
                                                </td>
                                                <td>
                                                    <?= $user->getAddress() ?>
                                                </td>

                                                <td>
                                                    <div class="d-flex" id="action_wrapper">

                                                        <!-- Modal trigger edit-->
                                                        <button type="button" id="btnPress" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#editModal" onclick="editActionButton('<?= $user->getIdUser() ?>', '<?= $user->getUsername() ?>', '<?= $mahasiswaRole->getNim() ?>', '<?= $user->getFirstName() ?>', '<?= $user->getLastName() ?>', '<?= $mahasiswaRole->getProdi() ?>', '<?= $user->getEmail() ?>', '<?= $user->getPhoneNumber() ?>', '<?= $user->getAddress() ?>')">
                                                            edit
                                                        </button>
                                                        <!-- Modal Trigger delete-->
                                                        <button type="button" id="btnPress" class="btn btn-link text-secondary" data-bs-toggle="modal" title="" data-bs-target="#deleteModal" onclick="deleteButtonAction('<?= $user->getIdUser() ?>', '<?= $user->getFirstName() ?>', '<?= $user->getLastName() ?>', '<?= $mahasiswaRole->getNim() ?>')">
                                                            delete
                                                        </button>
                                                        <!-- Modal -->
                                                    </div>

                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php Helper::importView('partials/pagination_control.view.php', [
                            'prevPage' => $prevPage,
                            'currentPage' => $currentPage,
                            'pageCount' => $pageCount,
                            'nextPage' => $nextPage
                        ]); ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="<?= App::get("root_uri") . "/public/js/script.js" ?>"></script>
<script>
    const addModal = document.getElementById('modalAdd')
    addModal.addEventListener('hidden.bs.modal', event => {
        $("div[role=alert]").remove();
        removeVal("input");
    })


    function editActionButton(idUser, username, nim, firstname, lastname, prodi, email, noTelp, address) {
        const modal = /*html*/ `
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-dialog-scrollable">
            <form action="<?= $updateMahasiswaEndpoint ?>" method="post">
                <div class="modal-header justify-content-center">
                    <h1 class="modal-title fs-5" id="editModal">UPDATE MAHASISWA</h1>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="id_user" name="id_user" value="${idUser}">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Input Mahasiswa Username" value="${username}" required>
                    </div>
                    <div class="mb-3" title="flashIdentity">
                        <label for="identity" class="form-label">NIM</label>
                        <input type="number" class="form-control" id="identity" name="nim" value="${nim}" placeholder="Input Mahasiswa NIM">
                    </div>
                    <div class="mb-3">
                        <label for="firstname" class="form-label">Firstname</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" value="${firstname}"
                            placeholder="Input Mahasiswa Firstname">
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Lastname</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" value="${lastname}"
                            placeholder="Input Mahasiswa Lastname">
                    </div>

                    <div class="mb-3">
                        <label for="level" class="form-label">Prodi</label>
                        <select class="form-select" id="level" aria-label="Default select example" name="prodi">
                            <?php
                            foreach (MahasiswaModel::getProdiChoices() as $prodi) : ?>
                                    <option value="<?= $prodi ?>" ${'<?= $prodi; ?>' == prodi ? "selected" : ""}><?= $prodi ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="${email}"
                            placeholder="Input Mahasiswa Email Address">
                    </div>
                    <div class="mb-3" title="flashTelepon">
                        <label for="noTelp" class="form-label">No. Telp</label>
                        <input type="number" class="form-control" id="noTelp" name="no_telp" value="${noTelp}"
                            placeholder="Input Mahasiswa Number">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="${address}" placeholder="Input Mahasiswa Number">
                    </div>
                    <div class="mb-3" title="flash">
                        <label for="newPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="newPassword" name="password"
                            placeholder="Input Mahasiswa Password">
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                            placeholder="Retype Mahasiswa Password">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-secondary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
`

        $('#action_wrapper').append(modal)
        $('#editModal').modal('show')
        const myModalEl = document.getElementById('editModal')
        myModalEl.addEventListener('hidden.bs.modal', event => {
            $('#editModal').remove();
            $("div[role=alert]").remove();
        })
    }

    function deleteButtonAction(idUser, firstname, lastname, nim) {
        const modal = /*html*/ `
<div class="modal fade" id="deleteModal" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= $deleteMahasiswaEndpoint ?>" method="post">
                <div class="modal-header justify-content-center">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">DELETE Mahasiswa</h1>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_user" value="${idUser}">
                    <input type="hidden" id="identity" value="${nim}" name="nim">
                    <p class="">Are You Sure Want to Delete ${firstname} ${lastname} From Mahasiswa Account? </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>
        `

        $('#action_wrapper').append(modal)
        $('#deleteModal').modal('show')
        const myModalEl = document.getElementById('deleteModal')
        myModalEl.addEventListener('hidden.bs.modal', event => {
            $('#deleteModal').remove();
        })

    }
</script>
<script src="<?= App::get("root_uri") . "/public/js/script_password.js" ?>"></script>