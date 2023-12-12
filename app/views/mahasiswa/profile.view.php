<div class="">
    <div class="row-auto flex-column flex-lg-row position-relative">
        <div class="col-auto sidebar shadow-sm">
            <?php Helper::importView('partials/nav_dashboard.view.php');
            ?>
        </div>

        <main class="col-auto position-relative">
            <div class="row justify-content-end px-auto">
                <div class="col-lg-10 col ">
                    <?= $flash ?>
                </div>
                <div class="col-lg-10 col px-5 py-4" title='main'>
                    <div class="row gap-2">
                        <h1>Profile</h1>
                        <div class="col mx-2">
                            <form action="<?= $updateProfileEndpoint ?>" method="POST" enctype="multipart/form-data" id="updateProfileForm">
                                <div class="row d-flex gap-3 flex-wrap">
                                    <div class="col-md-auto col-9 position-relative d-flex flex-column align-items-center" class="p-4" style="width:200px ">
                                        <img src="<?= $imageUrl ?>" alt="" id="img_profile_image" class="object-fit-cover border rounded img-thumbnail start-0" style="width:188px;height:250px;cursor: pointer;">
                                        <div style="position: relative">
                                            <label id="label_profile_image" for="profile_image" class="form-label border border-secondary rounded-3 px-4 py-1 my-2 text-secondary" style="cursor:pointer;">Change Picture</label>
                                            <input type="file" name="profile_image" id="input_profile_image" class="form-control opacity-0" style="position: absolute; z-index: 999; top: 0; left: 0">
                                        </div>
                                    </div>
                                    <div class=" col">
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" name="username" id="username" placeholder="data" value="<?= $username ?>" disabled readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="identity" class="form-label">NIM</label>
                                            <input type="text" class="form-control" name="nim" id="identity" placeholder="data" value="<?= $nim ?>" disabled readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Firstname</label>
                                            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Firstname" value="<?= $firstName ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">Lastname</label>
                                            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Lastname" value="<?= $lastName ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Program Studi</label>
                                            <input type="text" class="form-control" name="title" id="title" placeholder="title" value="<?= $mahasiswaTitle ?>" disabled readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="yourEmail@gmail.com" value="<?= $email ?>" disabled readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control" name="address" id="address" placeholder="Address" value="<?= $address ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="number" class="form-label">Number</label>
                                            <input type="number" class="form-control" name="number" id="number" placeholder="Your Number" value="<?= $phoneNumber ?>">
                                        </div>
                                        <div class="d-flex gap-3 justify-content-end">
                                            <button type="submit" onclick="document.querySelector('#updateProfileForm').submit()" class="btn btn-secondary px-4 text-white">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row py-2 my-4 gap-2">
                        <h1>Change Password</h1>
                        <div class="col rounded-5 my-2 mx-2" title="flash">
                            <form action="<?= $updatePasswordEndpoint ?>" method="post" id="updatePasswordForm">
                                <div class="row gap-5 ">
                                    <div class=" col">
                                        <div class="mb-3 d-lg-flex gap-2">
                                            <label for="currentPassword" class="form-label w-50">Current Password</label>
                                            <input type="password" class="form-control" name="current_password" id="currentPassword" placeholder="Enter Your Current Password">
                                        </div>
                                        <div class="mb-3 d-lg-flex gap-2">
                                            <label for="newPassword" class="form-label w-50">New Password</label>
                                            <input type="password" class="form-control" name="new_password" id="newPassword" placeholder="Enter Your New Password">
                                        </div>
                                        <div class="mb-3 d-lg-flex gap-2">
                                            <label for="confirmPassword" class="form-label w-50">Confirm Password</label>
                                            <input type="password" class="form-control" name="confirm_password" id="confirmPassword" placeholder="Enter Your New Password">
                                        </div>
                                        <div class="d-flex gap-3 justify-content-end ">
                                            <button type="submit" onclick="document.querySelector('#updateProfileForm').submit()" class="btn btn-secondary px-4 text-white" id="buttonUpdatePassword">Update Password</button>
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
<script src="<?= App::get("root_uri") . "/public/js/script_password.js" ?>"></script>
<script src="<?= App::get("root_uri") . "/public/js/img_preview.js" ?>"></script>