<div class="container-fluid">
    <div class="row-auto flex-column flex-lg-row position-relative" style="">
        <div class="col-auto sidebar shadow-sm" style="">
            <?php Helper::importView('partials/nav_dashboard.view.php');
            ?>
        </div>

        <main class="col-auto position-relative" style="left:0;height:200vh">
            <div class="row justify-content-end" title='main'>
                <div class="col-lg-10 col px-5 py4">

                    <div class="row py-2 my-4 gap-4">
                        <h1>Notification</h1>
                        <!-- Start Notif -->
                        <div class="col-xl-9 col">
                            <div class="row-auto flex-column p-3 bg-light-subtle rounded-3">
                                <div class="col ">
                                    <h5>
                                        <span class="badge bg-primary">LG7864</span>
                                        You Have Unread Messages
                                    </h5>
                                </div>
                                <div class="col"></div>
                                <p class="text-wrap">Kami ingin memberitahu Anda bahwa ada perkembangan baru pada halaman report detail yang memerlukan perhatian Anda. Saat ini, terdapat pesan atau chat yang belum dibaca atau dibalas oleh Anda. <a href="">Show Details</a></p>
                            </div>
                        </div>
                        <!-- End Notif -->
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>