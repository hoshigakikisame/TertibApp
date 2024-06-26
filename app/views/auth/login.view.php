<?php
$redirected =  App::get('root_uri') . "/auth/login";
?>
<?= $flash ?>
<main class="container-fluid d-flex flex-column justify-content-center px-4" style="height:100vh;">
    <div class="row rounded-5 align-self-center border border-2 p-1 w-lg-25">
        <div class="col shadow-sm  d-flex flex-column  rounded-5 m-2 px-0 py-5">
            <div class="text d-flex flex-column align-items-center mb-5">
                <h1 class="fs-3" style="font-family: Poppins-Bold;">Account Login</h1>
                <h6 class="text-center" style='width:min(80%,300px);'>Hey, Enter Your Details to Get Sign In to Your Account</h6>
            </div>
            <form action="<?= $redirected ?>" method="POST" class="align-self-center">
                <div class="mb-3">
                    <label for="usernameInput" class="form-label">Username</label>
                    <input type="username" name="username" class="form-control" id="usernameInput" placeholder="Username">
                </div>
                <div class="mb-3">
                    <label for="passwordInput" class="form-label">Password</label>
                    <input type="password" name="password" id="passwordInput" class="form-control" aria-describedby="passwordHelpBlock" placeholder='Password'>
                    <div id="forgotPassword" class="form-text">
                        <p>Forgot Your Password? <a class="link-underline link-underline-opacity-0" href="<?= App::get('root_uri') . "/auth/forgot-password" ?>">Click Here</a></p>
                    </div>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary text-white w-100 rounded-3" type="submit" id="button-login">Login</button>
                </div>
            </form>
        </div>
    </div>
    <footer class="text-center m-4">
        <p>Copyright | Privacy Policy</p>
    </footer>
</main>