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
                        <h1>Log Activity</h1>
                        <!-- Start Notif -->
                        <div class="row table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Method</th>
                                        <th scope="col">Activity</th>
                                        <th scope="col">Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    /**
                                     * @var LogActivityModel[] $logActivities
                                     */
                                    if (is_array($logActivities) || is_object($logActivities)) {
                                        foreach ($logActivities as $logActivity) { ?>
                                            <tr>
                                                <th>
                                                    <?= $logActivity->getIdLog() ?>
                                                </th>
                                                <td>
                                                    <?= $logActivity->getMethod() ?>
                                                </td>
                                                <td>
                                                    <?= $logActivity->getActivity() ?>
                                                </td>
                                                <td>
                                                    <?= $logActivity->getCreatedAt() ?>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        echo "Data log tidak tersedia atau tidak valid.";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Notif -->
                    </div>

                    <?php Helper::importView('partials/pagination_control.view.php', [
                        'prevPage' => $prevPage,
                        'currentPage' => $currentPage,
                        'pageCount' => $pageCount,
                        'nextPage' => $nextPage
                    ]); ?>
                </div>
            </div>
        </main>
    </div>
</div>