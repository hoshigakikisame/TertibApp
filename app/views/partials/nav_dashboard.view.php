<?php

/**
 *   @var UserModel $user
 */
$user = Session::getInstance()->get('user');

$role = $user->getRole();
?>
<nav class="navbar navbar-expand-lg align-items-stretch">
    <div class="container-fluid align-items-lg-start flex-lg-column ">
        <a class="navbar-brand my-3" href="#">LOGO TATIB</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvasLg" aria-controls="navbarOffcanvasLg">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="navbarOffcanvasLg" aria-labelledby="navbarOffcanvasLgLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body flex-column ">
                <ul class="navbar-nav mb-2 mb-lg-0 flex-column align-items-end  align-items-lg-start flex-grow-1 pe-3">
                    <li class=" mb-2  position-relative">
                        <div class="content nav-item gap-1 d-flex align-items-center">
                            <i class="bi bi-house"></i>
                            <a class="nav-link" aria-current="page" href="<?php echo App::get('root_uri') . "/" . $role . "/dashboard"; ?>">Dashboard</a>
                        </div>
                    </li>
                    <li class="mb-2  position-relative">
                        <div class="content nav-item gap-1 d-flex align-items-center">
                            <i class="bi bi-exclamation-circle"></i>
                            <a class="nav-link" href="<?php echo App::get('root_uri') . "/" . $role . "/report" ?>" title="report">Report</a>
                        </div>
                    </li>
                    <li class="mb-2 position-relative">
                        <div class="content nav-item gap-1 d-flex justify-content-center align-items-center">
                            <i class="bi bi-bell"></i>
                            <a class="nav-link" href="<?php echo App::get('root_uri') . "/" . $role . "/notification" ?>">Notification</a>
                        </div>
                    </li>
                    <?php if ($role == "admin") : ?>
                        <li class="mb-2 gap-1">
                            <div class="col-auto position-relative content nav-item align-items-center" title="<?php echo App::get('root_uri') . "/admin/manage" ?>">
                                <i class="bi bi-folder"></i>
                                <button type="button" class="btn dropdown-toggle shadow-none" data-bs-toggle="dropdown" aria-expanded="false">Manage</button>
                                <ul class="dropdown-menu position-static">
                                    <li><a class="dropdown-item" href="<?php echo App::get('root_uri') . "/" . $role . "/manage/mahasiswa" ?>">Mahasiswa</a></li>
                                    <li><a class="dropdown-item" href="<?php echo App::get('root_uri') . "/" . $role . "/manage/dosen" ?>">Dosen</a></li>
                                    <li><a class="dropdown-item" href="<?php echo App::get('root_uri') . "/" . $role . "/manage/admin" ?>">Admin</a></li>
                                    <li><a class="dropdown-item" href="<?php echo App::get('root_uri') . "/" . $role . "/manage/violation-level" ?>">Violation Level</a></li>
                                    <li><a class="dropdown-item" href="<?php echo App::get('root_uri') . "/" . $role . "/manage/code-of-conduct" ?>">Code of Conduct</a></li>
                                </ul>
                            </div>
                        </li>
                    <?php endif; ?>
                    <li class="mb-2 position-relative">
                        <div class="content nav-item  d-flex gap-1 align-items-center">
                            <i class="bi bi-person"></i>
                            <a class="nav-link" href="<?php echo App::get('root_uri') . "/" . $role . "/profile" ?>">Profile</a>
                        </div>
                    </li>
                    <li class="logOut border-top mt-2 position-relative">
                        <div class="content nav-item gap-1 d-flex align-items-center">
                            <i class="bi bi-box-arrow-in-right"></i>
                            <a class="nav-link" href="<?php echo App::get('root_uri') . "/auth/logout" ?>">Log Out</a>
                        </div>
                    </li>
                </ul>
                <div class="row-auto mt-4">
                    <div class="card-user d-flex justify-content-end gap-2 align-items-center col">
                        <img src="<?= $user->getImageUrl() ?>" alt="" class="img-profile rounded-circle">
                        <div class="userinfo d-flex align-items-start flex-column">
                            <h3 class="fs-6" style=" margin-bottom:-2px;"><?= $user->getFirstName() . " " . $user->getLastName() ?></h3>
                            <p class="" style="font-size:12px;margin-bottom:-5px;">
                                <?= (!$role == "admin") ? $role : $user->getRoleDetail()->getTitle(); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</nav>

<script>

</script>