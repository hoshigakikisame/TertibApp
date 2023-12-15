<div class="">
    <div class="row-auto flex-column flex-lg-row position-relative">
        <div class="col-auto sidebar shadow-sm">
            <?php Helper::importView('partials/nav_dashboard.view.php');
            ?>
        </div>

        <main class="col position-relative" style="left:0;height:200vh">
            <div class="row justify-content-end px-auto" title='main'>
                <div class="col-lg-10 col px-5 py-4">
                    <div class="row mb-4">
                        <h1>Reports</h1>
                    </div>
                    <div class="d-flex flex-row-reverse mt-4 mb-4">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle text-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-funnel"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= App::get('root_uri') . '/admin/report' ?>">All</a></li>
                                <?php foreach (ReportModel::getStatusChoices() as $status) : ?>
                                    <li><a class="dropdown-item" href="<?= App::get('root_uri') . '/admin/report?status=' . $status ?>"><?= $status ?></a></li>
                                <?php endforeach; ?>
                                <li><a class="dropdown-item" href="<?= App::get('root_uri') . '/admin/report?managed_by_me=1' ?>">Managed By Me</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Report By</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Create Date</th>
                                    <th scope="col">Confirm By</th>
                                    <th scope="col">Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                /**
                                 * @var ReportModel $report
                                 */
                                foreach ($reports as $report) : ?>
                                    <tr>
                                        <th>
                                            <?= $report->getTitle() ?>
                                        </th>
                                        <td>
                                            <?= $report->getMahasiswaUsername() ?>
                                        </td>
                                        <td>
                                            <?= $report->getDosenUsername() ?>
                                        </td>
                                        <td>
                                            <?= $report->getStatus() ?>
                                        </td>
                                        <td>
                                            <?= $report->getReportDate() ?>
                                        </td>
                                        <td>
                                            <?= $report->getAdminUsername() ?? "No one yet" ?>
                                        </td>
                                        <td><a href="<?= App::get('root_uri') . '/report/detail/' . $report->getIdReport() ?>" class="btn btn-link">Show Details</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>