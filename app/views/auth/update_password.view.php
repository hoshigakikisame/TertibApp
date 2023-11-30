<?php
$redirected =  App::get('root_uri') . "/auth/update-password";
?>
<main class="container-fluid d-flex flex-column justify-content-center" style="font-family: Poppins; height:100vh;">

    <div class="row rounded-5 align-self-center border border-2 p-1" style="width:min(100%,30vw)">
        <div class="col shadow-sm  d-flex flex-column  rounded-5 m-2 px-0 py-5 p-3">
            <div class="text d-flex flex-column align-items-center mb-5 p-2">
                <h1 class="fs-3 text-center" style="font-family: Poppins Bold;">Update Password</h1>
                <p class="h6 text-center text-wrap">Please Update Your Password
            </div>
            <form action="<?= $redirected ?>" method="POST" class="align-self-center" style="">
                <input type="hidden" name="token" value="<?= $token ?>">
                <div class="mb-3">
                    <input type="password" name="new_password" class="form-control" id="newPassword" placeholder="Enter Your New Password">
                </div>
                <div class="mb-3">
                    <input type="password" name="confirm_password" id="confirmPassword" class="form-control" aria-describedby="passwordHelpBlock" placeholder='Confirm Your New Password'>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary text-white w-100 rounded-3" type="submit" id="button-change-password">Update Password</button>
                </div>
            </form>
        </div>
    </div>
    <footer class="text-center m-4 ">
        <p>Copyright | Privacy Policy</p>
    </footer>
</main>
<script>
    const buttonChangePassword = document.querySelector('#button-change-password');
    const newPassword = document.querySelector('#newPassword');
    const confirmPassword = document.querySelector('#confirmPassword');
    const form = document.querySelector('form');

    buttonChangePassword.addEventListener('click', (e) => {
        e.preventDefault();
        if (newPassword.value !== confirmPassword.value) {
            alert('Password and Confirm Password must be the same');
        } else {
            form.submit();
        }
    })
</script>