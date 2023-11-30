<?php
$redirected =  App::get('root_uri') . "/auth/forgot-password";
?>
<main class="container d-flex flex-column justify-content-center" style="font-family: Poppins; height:100vh;">
    <div class="row-auto rounded-5 align-self-center border border-2 p-1 w-lg-25" style="width:min(100%,400px) !important">
        <div class="col shadow-sm  d-flex flex-column align-items-center rounded-5 m-2 px-0 py-5">
            <div class="text d-flex flex-column  mb-5">
                <h1 class="fs-3 text-center" style="font-family: Poppins Bold;">Send Verification</h1>
                <p class="h6 fs-6 text-center px-5">Enter Your Email Address Associated With Your Account and We`ll Send You a Verification Code</p>
            </div>
            <form action="<?= $redirected ?>" method="POST" class="align-self-center " style="">
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" id="emailInput" placeholder="Enter Your Email">
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary text-white w-100 rounded-3" type="submit" id="button-send">Send Verification</button>
                </div>
            </form>
            <div id="forgotPassword" class="form-text mt-3">
                <p>Do You Have an Account? <a class="link-underline link-underline-opacity-0" href="<?= App::get('root_uri') . "/auth/login" ?>">Login</a></p>
            </div>
        </div>
    </div>
    <footer class="text-center m-4 ">
        <p>Copyright | Privacy Policy</p>
    </footer>
</main>