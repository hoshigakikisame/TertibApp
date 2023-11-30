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

        <main class="col-auto position-relative" style="height:200vh">
            <div class=" " title='main'>
                <div class="row py-2 my-4 gap-2">
                    <div class="col">
                        <h1>Profile</h1>
                        <form action="<?= $profile ?>" method="POST">
                            <div class="row gap-5 justify-content-center">
                                <div class="col-auto">
                                    <img src="" alt="" class="bg-grey">
                                </div>
                                <div class="col-6">
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
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="row py-2 my-4 ">
                    <h1>Change Password</h1>
                    <div class="col rounded-5 p-4 m-2">
                        <form action="<?= $password ?>" method="post">
                            <div class="row gap-5 justify-content-center">
                                <div class="col-7 ">
                                    <div class="mb-3 d-flex gap-2">
                                        <label for="currentPassword" class="form-label w-50">Current Password</label>
                                        <input type="password" class="form-control" name="currentPassword" id="currentPassword" placeholder="Enter Your Current Password">
                                    </div>
                                    <div class="mb-3 d-flex gap-2">
                                        <label for="NewPassword" class="form-label w-50">New Password</label>
                                        <input type="password" class="form-control" name="newPassword" id="newPassword" placeholder="Enter Your New Password">
                                    </div>
                                    <div class="mb-3 d-flex gap-2">
                                        <label for="confirmPassword" class="form-label w-50">Confirm Password</label>
                                        <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Enter Your New Password">
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