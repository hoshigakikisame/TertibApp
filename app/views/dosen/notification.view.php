<div class="">
    <div class="row-auto flex-column flex-lg-row position-relative">
        <!-- Start Sidebar -->
        <div class="col-auto sidebar shadow-sm">
            <?php Helper::importView('partials/nav_dashboard.view.php');
            ?>
        </div>
        <!-- End Sidebar -->

        <main class="col-auto position-relative">
            <div class="row justify-content-end px-auto">
                <div class="col-lg-10 col px-5 py-4" title="main">
                    <div class="row mb-4">
                        <h1>Notification</h1>
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
                                            #<?= $comment->getIdReport() ?>
                                        </h5>
                                    </div>
                                    <div class="col"></div>
                                    <p class="text-wrap text-truncate">
                                        <?= $comment->getContent() ?> <a target="_blank" href="<?= $comment->getReferenceUrl() ?>">Show</a>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>
        </main>
    </div>
</div>