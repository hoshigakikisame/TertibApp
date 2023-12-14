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
                    <div class="row table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Report By</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Create Date</th>
                                    <th scope="col">Completed Date</th>
                                    <th scope="col">Confirm By</th>
                                    <th scope="col">Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                    <td>@mdo</td>
                                    <td>@mdo</td>
                                    <td>@mdo</td>
                                    <td><a href="<?= App::get('root_uri') . '/report/detail/' ?>" class="btn btn-link">Show Details</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>