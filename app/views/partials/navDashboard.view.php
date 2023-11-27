<nav class="navbar navbar-expand-lg align-items-stretch" style="">
    <div class="container-fluid align-items-lg-start flex-lg-column ">
        <a class="navbar-brand my-3" href="#">LOGO TATIB</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvasLg" aria-controls="navbarOffcanvasLg">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="navbarOffcanvasLg" aria-labelledby="navbarOffcanvasLgLabel" style="">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body flex-column " style="height:80vh">
                <ul class="navbar-nav mb-2 mb-lg-0 flex-column align-items-end  align-items-lg-start flex-grow-1 pe-3">
                    <li class="nav-item d-flex align-items-center mb-2 gap-1">
                        <i class="bi bi-house"></i>
                        <a class="nav-link" aria-current="page" href="<?php echo App::get('root_uri') . "/dashboard"; ?>">Dashboard</a>
                    </li>
                    <li class="nav-item d-flex align-items-center mb-2 gap-1">
                        <i class="bi bi-exclamation-circle"></i>
                        <a class="nav-link" href="<?php echo App::get('root_uri') . "/report" ?>">Report</a>
                    </li>
                    <li class="nav-item d-flex align-items-center mb-2 gap-1">
                        <i class="bi bi-bell"></i>
                        <a class="nav-link" href="<?php echo App::get('root_uri') . "/notification" ?>">Notification</a>
                    </li>
                    <li class="nav-item d-flex align-items-center mb-2 gap-1">
                        <i class="bi bi-person"></i>
                        <a class="nav-link" href="<?php echo App::get('root_uri') . "/profile" ?>">Profile</a>
                    </li>
                    <li class="nav-item logOut d-flex align-items-center border-top mt-4 gap-2">
                        <i class="bi bi-box-arrow-in-right"></i>
                        <a class="nav-link" href="<?php echo App::get('root_uri') . "/logout" ?>">Log Out</a>
                    </li>
                </ul>
                <div class="container end-0">
                    <div class="card-user d-flex gap-2 align-items-center">
                        <div class="img-profile border rounded-circle" style="background:grey"></div>
                        <div class="userinfo d-flex align-items-start flex-column">
                            <h3 class="fs-5" style="margin-bottom:-5px;">Jonas sutoyo</h3>
                            <p style="margin-bottom:-5px;">Dosen</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</nav>

<script>

</script>