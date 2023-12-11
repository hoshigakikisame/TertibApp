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
                        <?= $flash ?>
                        <h1>Admin Account</h1>
                        <div class="row ms-2">
                            <div class="col-lg-2 col-auto border border-2 mt-3 py-2 px-2 rounded-3 flex-grow-1 flex-lg-grow-0">
                                <div class="shadow-sm rounded-3 py-3 px-lg-4 px-0 h-100">
                                    <h1 class="mb-0"><?= $usersCount ?></h1>
                                    <h6>Account Admin</h6>
                                </div>
                            </div>
                        </div>
                        <div class="row flex-column gap-3 mt-4">
                            <div class="col justify-content-end d-flex">
                                <!-- Modal Trigger Add -->
                                <button type="button" id="btnPress" class="btn border-none shadow-sm px-3 py-2 rounded-4 flex-shrink-1" data-bs-toggle="modal" data-bs-target="#modalAdd">
                                    <i class="bi bi-person-plus"></i>
                                </button>

                                <!-- pop up -->
                                <div class="modal fade" id="modalAdd" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalAdd" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered ">
                                        <div class="modal-content modal-dialog-scrollable">
                                            <form action="<?= $newAdminEndpoint ?>" method="post">
                                                <div class="modal-header justify-content-center">
                                                    <h4 class="modal-title" id="modalAdd">ADD ADMIN</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="username" class="form-label">Username</label>
                                                        <input type="text" class="form-control" id="username" name="username" placeholder="Input Admin Username" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="firstname" class="form-label">Firstname</label>
                                                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Input Admin Firstname" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="lastname" class="form-label">Lastname</label>
                                                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Input Admin Lastname" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="title" class="form-label">Title</label>
                                                        <input type="text" class="form-control" id="title" name="title" placeholder="Input Admin Title" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="email" class="form-control" id="email" name="email" placeholder="Input Admin Email Address" required>
                                                    </div>
                                                    <div class="mb-3" title="flashTelepon">
                                                        <label for="noTelp" class="form-label">No. Telp</label>
                                                        <input type="number" class="form-control" id="noTelp" name="no_telp" placeholder="Input Admin Number" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="address" class="form-label">Address</label>
                                                        <input type="text" class="form-control" id="address" name="address" placeholder="Input Admin Address" required>
                                                    </div>
                                                    <div class="mb-3" title="flash">
                                                        <label for="newPassword" class="form-label">Password</label>
                                                        <input type="password" class="form-control" id="newPassword" name="password" placeholder="Input Admin Password" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                                                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Retype Admin Password" required>
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
                                <table class="table align-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col">Username</th>
                                            <th scope="col">First Name</th>
                                            <th scope="col">Last Name</th>
                                            <th scope="col">Title</th>
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
                                             * @var AdminModel $adminRole
                                             */
                                            $adminRole = $user->getRoleDetail();
                                        ?>
                                            <tr>
                                                <td><?= $user->getUsername() ?></td>
                                                <td><?= $user->getFirstName() ?></td>
                                                <td><?= $user->getLastName() ?></td>
                                                <td><?= $adminRole->getTitle() ?></td>
                                                <td><?= $user->getEmail() ?></td>
                                                <td><?= $user->getPhoneNumber() ?></td>
                                                <td><?= $user->getAddress() ?></td>
                                                <td>
                                                    <div class="d-flex" id="action_wrapper">
                                                        <!-- Modal Trigger edit -->
                                                        <button type="button" id="btnPress" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#editModal" title="<?= $user->getIdUser() ?>" onclick="editButtonAction(<?= $user->getIdUser() ?>,'<?= $user->getUsername() ?>','<?= $user->getFirstName() ?>','<?= $user->getLastName() ?>','<?= $adminRole->getTitle() ?>','<?= $user->getEmail() ?>','<?= $user->getPhoneNumber() ?>','<?= $user->getAddress() ?>')">
                                                            edit
                                                        </button>
                                                        <!-- Modal Trigger delete-->
                                                        <button type="button" id="btnPress" class="btn btn-link text-secondary" data-bs-toggle="modal" title="<?= $user->getIdUser() ?>" data-bs-target="#deleteModal" onclick="deleteButtonAction(<?= $user->getIdUser() ?>,'<?= $user->getUsername() ?>')">
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


    function editButtonAction(id_user, username, firstname, lastname, title, email, phoneNumber, address) {
        const modal = /*template*/ `
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content modal-dialog-scrollable">
             <form action="<?= $updateAdminEndpoint ?>" method="post">
                 <div class="modal-header justify-content-center">
                     <h1 class="modal-title fs-5" id="editModal">EDIT ADMIN</h1>
                 </div>
                 <div class="modal-body">
                     <input type="hidden" name="id_user" value="${id_user}">
                     <div class="mb-3">
                         <label for="username" class="form-label">Username</label>
                         <input type="text" class="form-control" id="username" name="username"
                             placeholder="Input Admin Username" value="${username}" required>
                     </div>
                     <div class="mb-3">
                         <label for="firstname" class="form-label">Firstname</label>
                         <input type="text" class="form-control" id="firstname" name="firstname"
                             placeholder="Input Admin Firstname" value="${firstname}" required>
                     </div>
                     <div class="mb-3">
                         <label for="lastname" class="form-label">Lastname</label>
                         <input type="text" class="form-control" id="lastname" name="lastname"
                             placeholder="Input Admin Lastname" value="${lastname}" required>
                     </div>
                     <div class="mb-3">
                         <label for="title" class="form-label">Title</label>
                         <input type="text" class="form-control" id="title" name="title" placeholder="Input Admin Title"
                            value="${title}" required>
                     </div>
                     <div class="mb-3">
                         <label for="email" class="form-label">Email</label>
                         <input type="email" class="form-control" id="email" name="email"
                            value="${email}" placeholder="Input Admin Email Address"  readonly>
                     </div>
                     <div class="mb-3" title="flashTelepon">
                         <label for="noTelp" class="form-label">No. Telp</label>
                         <input type="number" class="form-control" id="noTelp" name="no_telp"
                            value="${phoneNumber}" placeholder="Input Admin Number" required>
                     </div>
                     <div class="mb-3">
                         <label for="address" class="form-label">Address</label>
                         <input type="text" class="form-control" id="address" name="address"
                            value="${address}" placeholder="Input Admin Address" required>
                     </div>
                     <div class="mb-3" title="flash">
                         <label for="newPassword" class="form-label">Password</label>
                         <input type="password" class="form-control" id="newPassword" name="password"
                             placeholder="Input Admin Password">
                     </div>
                     <div class="mb-3">
                         <label for="confirmPassword" class="form-label">Confirm Password</label>
                         <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                             placeholder="Retype Admin Password">
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                         <button type="submit" class="btn btn-secondary">Save</button>
                     </div>
                 </div>
             </form>
         </div>
     </div>
 </div>`
        $('#action_wrapper').append(modal)
        $('#editModal').modal('show')
        const myModalEl = document.getElementById('editModal')
        myModalEl.addEventListener('hidden.bs.modal', event => {
            $('#editModal').remove();
            $("div[role=alert]").remove();
        })
    }


    function deleteButtonAction(user_id, username) {
        const modal = /*html */ `
<div class="modal fade" id="deleteModal" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= $deleteAdminEndpoint ?>" method="post">
                <div class="modal-header justify-content-center">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">DELETE ADMIN</h1>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_user" value="<?= $user->getIdUser() ?>">
                    <p class="">Are You Sure Want to Delete ${username} From Admin Account? </p>
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