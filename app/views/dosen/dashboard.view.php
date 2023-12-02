<div class="">

    <div class="row-auto flex-column flex-lg-row position-relative">
        <!-- Start Sidebar -->
        <div class="col-auto sidebar shadow-sm">
            <?php Helper::importView('partials/nav_dashboard.view.php');
            ?>
        </div>
        <!-- End Sidebar -->

        <main class="col position-relative" style=" height:200vh">
            <div class="container-fluid py-4" title="main">
                <div class="row mb-4">
                    <p class='mb-0' style="color: var(--yellow);">Hi, Jonas</p>
                    <h1>Welcome to Tertib App</h1>
                </div>
                <div class="row px-4 gap-lg-5 gap-1 mb-4">
                    <div class="col-lg-2 col-auto border border-2 py-2 px-2 rounded-3 flex-grow-1 flex-lg-grow-0">
                        <div class="shadow-sm rounded-3 py-3 px-4 h-100">
                            <h1 class="mb-0" style="">65</h1>
                            <h6>Reports</h6>
                        </div>
                    </div>
                    <div class="col-lg-2 col-auto border border-2 py-2 px-2 rounded-3 flex-grow-1 flex-lg-grow-0">
                        <div class="shadow-sm rounded-3 py-3 px-4 h-100 ">
                            <h1 class="mb-0" style="">65</h1>
                            <h6>Aproved <br> Reports</h6>
                        </div>
                    </div>
                    <div class="col-lg-2 col-auto border border-2 py-2 px-2 rounded-3 flex-grow-1 flex-lg-grow-0">
                        <div class="shadow-sm rounded-3 py-3 px-4 h-100 ">
                            <h1 class="mb-0" style="">65</h1>
                            <h6 class="">Rejected <br> Reports</h6>
                        </div>
                    </div>

                </div>

                <div class="row mb-4">
                    <h1>Recent Reports</h1>
                </div>
            </div>
        </main>
    </div>
</div>