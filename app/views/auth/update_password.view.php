<?php
$redirected =  App::get('root_uri') . "/auth/login";
?>
<main class="container-fluid d-flex flex-column justify-content-center" style="font-family: Poppins; height:100vh;">

    <div class="row rounded-5 align-self-center border border-2 p-1" style="width:min(100%,30vw)">
        <div class="col shadow-sm  d-flex flex-column  rounded-5 m-2 px-0 py-5 p-3">
            <div class="text d-flex flex-column align-items-center mb-5 p-2">
                <h1 class="fs-3 text-center" style="font-family: Poppins Bold;">Change Password</h1>
                <p class="h6 text-center text-wrap">Please Change Your Password
            </div>
            <form action="<?= $redirected ?>" method="POST" class="align-self-center" style="">
                <div class="mb-3">
                    <input type="password" name="newPassword" class="form-control" id="NewPassword" placeholder="Enter Your New Password">
                </div>
                <div class="mb-3">
                    <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" aria-describedby="passwordHelpBlock" placeholder='Confirm Your New Password'>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary text-white w-100 rounded-3" type="submit" id="button-change-password">Change Password</button>
                </div>
            </form>
        </div>
    </div>
    <footer class="text-center m-4 ">
        <p>Copyright | Privacy Policy</p>
    </footer>
</main>