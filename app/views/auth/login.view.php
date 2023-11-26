<?php
$redirected =  App::get('root_uri') . "/login";
echo $flash;
?>
<main class="container-fluid d-flex flex-column justify-content-center px-4" style="font-family: Poppins; height:100vh;">
    <div class="row shadow-sm rounded-5 align-self-center  px-2 w-lg-25" style="padding-top:5vh;padding-bottom:10vh;">
        <div class="col d-flex flex-column ">
            <div class="text d-flex flex-column align-items-center mb-5">
                <h1 class="fs-3" style="font-family: Poppins Bold;">Account Login</h1>
                <p class="h6 text-center" style='width:min(80%,300px)'>Hey, Enter Your Details to Get Sign In to Your Account</p>
            </div>
            <form action="<?= $redirected ?>" method="POST" class="align-self-center" style="">
                <div class="mb-3">
                    <label for="usernameInput" class="form-label">Email address</label>
                    <input type="username" name="username" class="form-control" id="usernameInput" placeholder="Username">
                </div>
                <div class="mb-3">
                    <label for="passwordInput" class="form-label">Password</label>
                    <input type="password" name="password" id="passwordInput" class="form-control" aria-describedby="passwordHelpBlock" placeholder='Password'>
                    <div id="forgotPassword" class="form-text">
                        <p>Forgot Your Password? <a class="link-underline link-underline-opacity-0" style="color:var(--red)" href="">Change Password </a></p>
                    </div>
                </div>
                <div class="mb-3">
                    <input type="submit" class="btn w-100 " style='border-radius: 6px;
background: rgba(252, 178, 22, 0.22);'></input>
                </div>
            </form>
        </div>
    </div>
    <footer class="text-center p-3">
        <p>Copyright | Privacy Policy</p>
    </footer>
</main>