<?php
$profile = '';
$password = '';
?>

<div class="container-fluid">
    <div class="row-auto flex-column flex-lg-row position-relative">
        <div class="col-auto sidebar shadow-sm">
            <?php Helper::importView('partials/nav_dashboard.view.php');
            ?>
        </div>

        <main class="col-auto position-relative">
            <div class=" " title='main'>
                <div class="row py-2 my-4 gap-2">
                    <h1>Profile</h1>
                    <div class="col my-2 mx-2">
                        <form action="<?= $profile ?>" method="POST">
                            <div class="row d-flex gap-3 flex-wrap">
                                <div class="col-md-auto col-9" class="p-4">
                                    <img src="<?= App::get("root_uri") . "/public/img/hasyim.jpg" ?>" alt="" class="object-fit-cover border rounded img-thumbnail" style="width:188px;height:250px;">
                                </div>
                                <div class="col-lg-5 col">
                                    <div class="mb-3">
                                        <label for="firstname" class="form-label">Firstname</label>
                                        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Firstname">
                                    </div>
                                    <div class="mb-3">
                                        <label for="lastname" class="form-label">Lastname</label>
                                        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Lastname">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="yourEmail@gmail.com">
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control" name="address" id="address" placeholder="Address">
                                    </div>
                                    <div class="mb-3">
                                        <label for="number" class="form-label">Number</label>
                                        <input type="number" class="form-control" name="number" id="number" placeholder="Your Number">
                                    </div>
                                    <div class="d-flex gap-3 justify-content-end ">
                                        <button type="button" class="btn btn-primary px-4 text-white">Edit</button>
                                        <button type="submit" class="btn btn-secondary px-4 text-white">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row py-2 my-4 gap-2">
                    <h1>Change Password</h1>
                    <div class="col rounded-5 my-2 mx-2">
                        <form action="<?= $password ?>" method="post">
                            <div class="row gap-5 ">
                                <div class="col-lg-7 col">
                                    <div class="mb-3 d-lg-flex gap-2">
                                        <label for="currentPassword" class="form-label w-50">Current Password</label>
                                        <input type="password" class="form-control" name="currentPassword" id="currentPassword" placeholder="Enter Your Current Password">
                                    </div>
                                    <div class="mb-3 d-lg-flex gap-2">
                                        <label for="NewPassword" class="form-label w-50">New Password</label>
                                        <input type="password" class="form-control" name="newPassword" id="newPassword" placeholder="Enter Your New Password">
                                    </div>
                                    <div class="mb-3 d-lg-flex gap-2">
                                        <label for="confirmPassword" class="form-label w-50">Confirm Password</label>
                                        <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Enter Your New Password">
                                    </div>
                                    <div class="d-flex gap-3 justify-content-end ">
                                        <button type="submit" class="btn btn-secondary px-4 text-white">Change Password</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>