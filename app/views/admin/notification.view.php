<div class="">
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
                        <?php
                        if (empty($newReportComments)): ?>
                            <div class="col-xl-10 col">
                                <div class="row-auto flex-column p-3 bg-light-subtle rounded-3">
                                    <div class="col">
                                        <h5 class="text-left">No new notification</h5>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php
                        /**
                         * @var ReportCommentModel[] $newReportComments
                         */
                        foreach ($newReportComments as $comment): ?>
                            <div class="col-xl-10 col" id="<?= $comment->getIdReportComment() ?>">
                                <div class="row-auto flex-column p-3 bg-light-subtle rounded-3">
                                    <div class="col ">
                                        <h5>
                                            <span class="badge bg-success">#
                                                <?= $comment->getIdReportComment() ?>
                                            </span>
                                            <?= $comment->getAuthorFirstName() ?> Commented On Report
                                            #
                                            <?= $comment->getIdReport() ?>
                                        </h5>
                                    </div>
                                    <div class="col"></div>
                                    <p class="text-wrap text-truncate">
                                        <?= $comment->getContent() ?> <a target="_blank" href="<?= $comment->getReferenceUrl() ?>">Show</a>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <!-- End Notif -->
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>