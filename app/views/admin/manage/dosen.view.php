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
                        <h1>Dosen Account</h1>
                        <div class="row gap-4">
                            <div
                                class="col-lg-2 col-auto border border-2 mt-3 py-2 px-2 rounded-3 flex-grow-1 flex-lg-grow-0">
                                <div class="shadow-sm rounded-3 py-3 px-lg-4 px-0 h-100">
                                    <h1 class="mb-0">
                                        <?= $usersCount ?>
                                    </h1>
                                    <h6>Account Total</h6>
                                </div>
                            </div>
                        </div>

                        <div class="row flex-column gap-3 mt-4">
                            <div class="col justify-content-end d-flex">
                                <button type="button"
                                    class="btn border-none shadow-sm px-3 py-2 rounded-4 flex-shrink-1"
                                    data-bs-toggle="modal" id="btnPress" data-bs-target="#modalAdd">
                                    <i class="bi bi-person-plus"></i>
                                </button>

                                <!-- pop up -->
                                <div class="modal fade" id="modalAdd" data-bs-backdrop="static" data-bs-keyboard="false"
                                    tabindex="-1" aria-labelledby="modalAdd" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered ">
                                        <div class="modal-content modal-dialog-scrollable">
                                            <form action="<?= $newDosenEndpoint ?>" method="post">
                                                <div class="modal-header justify-content-center">
                                                    <h4 class="modal-title" id="modalAdd">ADD DOSEN</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="username" class="form-label">Username</label>
                                                        <input type="text" class="form-control" id="username"
                                                            name="username" placeholder="Input Dosen Username" required>
                                                    </div>
                                                    <div class="mb-3" title="flashIdentity">
                                                        <label for="identity" class="form-label">NIDN</label>
                                                        <input type="text" class="form-control" id="identity"
                                                            name="nidn" placeholder="Input Dosen NIDN">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="firstname" class="form-label">Firstname</label>
                                                        <input type="text" class="form-control" id="firstname"
                                                            name="firstname" placeholder="Input Dosen Firstname">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="lastname" class="form-label">Lastname</label>
                                                        <input type="text" class="form-control" id="lastname"
                                                            name="lastname" placeholder="Input Dosen Lastname">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="title" class="form-label">Title</label>
                                                        <input type="text" class="form-control" id="title" name="title"
                                                            placeholder="Input Dosen Title">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="email" class="form-control" id="email" name="email"
                                                            placeholder="Input Dosen Email">
                                                    </div>
                                                    <div class="mb-3" title="flashTelepon">
                                                        <label for="noTelp" class="form-label">No. Telp</label>
                                                        <input type="number" class="form-control" id="noTelp"
                                                            name="no_telp" placeholder="Input Dosen Number">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="address" class="form-label">Address</label>
                                                        <input type="text" class="form-control" id="address"
                                                            name="address" placeholder="Input Dosen Number">
                                                    </div>
                                                    <div class="mb-3" title="flash">
                                                        <label for="password" class="form-label">Password</label>
                                                        <input type="password" class="form-control" id="newPassword"
                                                            name="password" placeholder="Input Dosen Password">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="confirmPassword" class="form-label">Confirm
                                                            Password</label>
                                                        <input type="password" class="form-control" id="confirmPassword"
                                                            name="confirmPassword" placeholder="Retype Dosen Password">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
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
                                            <th scope="col">NIDN</th>
                                            <th scope="col">Firstname</th>
                                            <th scope="col">Lastname</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Phone Number</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        /**
                                         * @var UserModel[] $users
                                         */
                                        foreach ($users as $user):
                                            /**
                                             * @var DosenModel $dosenRole
                                             */
                                            $dosenRole = $user->getRoleDetail();
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $user->getUsername() ?>
                                                </td>
                                                <td>
                                                    <?= $dosenRole->getNidn() ?>
                                                </td>
                                                <td>
                                                    <?= $user->getFirstName() ?>
                                                </td>
                                                <td>
                                                    <?= $user->getLastName() ?>
                                                </td>
                                                <td>
                                                    <?= $dosenRole->getTitle() ?>
                                                </td>
                                                <td>
                                                    <?= $user->getEmail() ?>
                                                </td>
                                                <td>
                                                    <?= $user->getAddress() ?>
                                                </td>
                                                <td>
                                                    <?= $user->getPhoneNumber() ?>
                                                </td>

                                                <td>
                                                    <div class="d-flex" id="action_wrapper">

                                                        <!-- Edit Modal trigger -->
                                                        <button type="button" id="btnPress" class="btn btn-link"
                                                            data-bs-toggle="modal" data-bs-target="#editModal"
                                                            onclick="editActionButton('<?= $user->getIdUser() ?>', '<?= $user->getUsername() ?>', '<?= $dosenRole->getNidn() ?>', '<?= $user->getFirstName() ?>', '<?= $user->getLastName() ?>', '<?= $dosenRole->getTitle() ?>', '<?= $user->getEmail() ?>', '<?= $user->getPhoneNumber() ?>', '<?= $user->getAddress() ?>')">
                                                            edit
                                                        </button>
                                                        <!-- Delete Modal trigger -->
                                                        <button type="button" class="btn btn-link text-secondary"
                                                            onclick="deleteActionButton('<?= $user->getIdUser() ?>', '<?= $user->getFirstName() ?>', '<?= $user->getLastName() ?>')">
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

<script>
    const addModal = document.getElementById('modalAdd')
    addModal.addEventListener('hidden.bs.modal', event => {
        $("div[role=alert]").remove();
        removeVal("input");
    })

    function editActionButton(idUser, username, nidn, firstname, lastname, title, email, noTelp, address) {
        const modal = /*html*/ `
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-dialog-scrollable">
            <form action="<?= $updateDosenEndpoint ?>" method="post">
                <div class="modal-header justify-content-center">
                    <h1 class="modal-title fs-5" id="editModal">EDIT DOSEN</h1>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="id_user" name="id_user" value="${idUser}">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Input Dosen Username" value="${username}" required>
                    </div>
                    <div class="mb-3" title="flashIdentity">
                        <label for="identity" class="form-label">NIDN</label>
                        <input type="text" class="form-control" id="identity" name="nidn" placeholder="Input Dosen NIDN" value="${nidn}">
                    </div>
                    <div class="mb-3">
                        <label for="firstname" class="form-label">Firstname</label>
                        <input type="text" class="form-control" id="firstname" name="firstname"
                            placeholder="Input Dosen Firstname" value="${firstname}">
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Lastname</label>
                        <input type="text" class="form-control" id="lastname" name="lastname"
                            placeholder="Input Dosen Lastname" value="${lastname}">
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="${title}" placeholder="Input Dosen Title">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Input Dosen Email Address" value="${email}">
                    </div>
                    <div class="mb-3" title="flashTelepon">
                        <label for="noTelp" class="form-label">No. Telp</label>
                        <input type="number" class="form-control" id="noTelp" name="no_telp"
                            placeholder="Input Dosen Number" value="${noTelp}">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="${address}" placeholder="Input Dosen Number">
                    </div>
                    <div class="mb-3" title="flash">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="newPassword" name="password"
                            placeholder="Input Dosen Password">
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                            placeholder="Retype Dosen Password">
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
        })

    }

    function deleteActionButton(idUser, firstname, lastname) {
        modal = /*html*/ `
        <div class="modal fade" id="deleteModal" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= $deleteDosenEndpoint ?>" method="post">
                <div class="modal-header justify-content-center">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">DELETE DOSEN</h1>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_user" value="${idUser}">
                    <p class="">Are You Sure Want to Delete ${firstname} ${lastname} From Dosen Account? </p>
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