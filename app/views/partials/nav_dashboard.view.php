<?php

/**
 *   @var UserModel $user
 */
$user = Session::getInstance()->get('user');

$role = $user->getRole();

$newReportCommentCount = 0;
$newViolationCount = 0;

switch ($role) {
    case 'dosen':
        $dosenRole = $user->getRoleDetail();
        assert($dosenRole instanceof DosenModel);
        $dosenService = DosenService::getInstance();
        $newReportCommentCount = $dosenService->getDosenNotificationCount($dosenRole);
        break;
    case 'admin':
        $adminRole = $user->getRoleDetail();
        assert($adminRole instanceof AdminModel);
        $adminService = AdminService::getInstance();
        $newReportCommentCount = $adminService->getAdminNotificationCount($adminRole);
        break;
    case 'mahasiswa':
        $mahasiswaRole = $user->getRoleDetail();
        assert($mahasiswaRole instanceof MahasiswaModel);
        $mahasiswaService = MahasiswaService::getInstance();
        $newViolationCount = $mahasiswaService->getMahasiswaNotificationCount($mahasiswaRole);
        break;
}

?>
<nav class="navbar navbar-expand-lg align-items-stretch">
    <div class="container-fluid align-items-lg-start flex-lg-column ">
        <a class="navbar-brand my-3" href="#"><img src="<?php echo App::get('root_uri') . "/public/img/logo.png" ?>" class="d-inline-block align-text-center" alt="Tertib APP" width="40" height="40"> Tertib APP</a>
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
                    <?php if ($role == "mahasiswa") : ?>
                        <li class="mb-2  position-relative">
                            <div class="content nav-item gap-1 d-flex align-items-center">
                                <i class="bi bi-exclamation-circle"></i>
                                <a class="nav-link" href="<?php echo App::get('root_uri') . "/" . $role . "/violation-history" ?> " title="report">Violation History</a>
                            </div>
                        </li>
                    <?php else : ?>
                        <li class="mb-2  position-relative">
                            <div class="content nav-item gap-1 d-flex align-items-center">
                                <i class="bi bi-exclamation-circle"></i>
                                <a class="nav-link" href="<?php echo App::get('root_uri') . "/" . $role . "/report" ?>" title="report">Report</a>
                            </div>
                        </li>
                    <?php endif; ?>
                    <li class="mb-2 position-relative">
                        <div class="content nav-item gap-1 d-flex justify-content-center align-items-center">
                            <i class="bi bi-bell"></i>
                            <a class="nav-link" href="<?php echo App::get('root_uri') . "/" . $role . "/notification" ?>">Notification
                                <?php if ($role == "mahasiswa") : ?>
                                    <?php if ($newViolationCount > 0) : ?>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            <?= $newViolationCount ?>
                                            <span class="visually-hidden">unread messages</span>
                                        </span>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <?php if ($newReportCommentCount > 0) : ?>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            <?= $newReportCommentCount ?>
                                            <span class="visually-hidden">unread messages</span>
                                        </span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </a>
                        </div>
                    </li>
                    <?php if ($role == "admin") : ?>
                        <li class="mb-2 gap-1">
                            <div class="col-auto position-relative content nav-item align-items-center" title="<?php echo App::get('root_uri') . "/admin/manage" ?>">
                                <i class="bi bi-folder"></i>
                                <button type="button" class="btn dropdown-toggle shadow-none" data-bs-toggle="dropdown" aria-expanded="false">Manage</button>
                                <ul class="dropdown-menu position-static">
                                    <li><a class="dropdown-item" href="<?php echo App::get('root_uri') . "/" . $role . "/manage/mahasiswa" ?>">Mahasiswa</a>
                                    </li>
                                    <li><a class="dropdown-item" href="<?php echo App::get('root_uri') . "/" . $role . "/manage/dosen" ?>">Dosen</a>
                                    </li>
                                    <li><a class="dropdown-item" href="<?php echo App::get('root_uri') . "/" . $role . "/manage/admin" ?>">Admin</a>
                                    </li>
                                    <li><a class="dropdown-item" href="<?php echo App::get('root_uri') . "/" . $role . "/manage/violation-level" ?>">Violation
                                            Level</a></li>
                                    <li><a class="dropdown-item" href="<?php echo App::get('root_uri') . "/" . $role . "/manage/code-of-conduct" ?>">Code
                                            of Conduct</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="mb-2 position-relative">
                            <div class="content nav-item gap-1 d-flex align-items-center">
                                <i class="bi bi-exclamation-circle"></i>
                                <a class="nav-link" href="<?php echo App::get('root_uri') . "/" . $role . "/log-activity" ?>">Log Activity</a>
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
                            <h3 class="fs-6" style=" margin-bottom:-2px;">
                                <?= $user->getFirstName() . " " . $user->getLastName() ?>
                            </h3>
                            <p class="" style="font-size:12px;margin-bottom:-5px;">
                                <?= ($role == "admin") ? $user->getRoleDetail()->getTitle() : $role; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</nav>

<script>

</script>