<?php ?>
<div class="">

    <div class="row-auto flex-column flex-lg-row position-relative">
        <!-- Start Sidebar -->
        <div class="col-auto sidebar shadow-sm">
            <?php Helper::importView('partials/nav_dashboard.view.php');
            ?>
        </div>
        <!-- End Sidebar -->

        <main class="col position-relative overflow-x-hidden">
            <div class="row justify-content-lg-end">
                <div class="col-lg-10 col px-2 px-lg-5 py-4" title="main">
                    <div class="content p-lg-4 p-0">
                        <?= $flash ?>
                        <h1>Code Of Conduct</h1>
                        <div class="row gap-4">
                            <div class="col-lg-2 col-auto border border-2 mt-3 py-2 px-2 rounded-3 flex-grow-1 flex-lg-grow-0">
                                <div class="shadow-sm rounded-3 py-3 px-lg-4 px-0 h-100">
                                    <h1 class="mb-0">80</h1>
                                    <h6>Code Of Conduct Totals</h6>
                                </div>
                            </div>
                            <div class="col-lg-2 col-auto border border-2 mt-3 py-2 px-2 rounded-3 flex-grow-1 flex-lg-grow-0">
                                <div class="shadow-sm rounded-3 py-3 px-lg-4 px-0 h-100">
                                    <h1 class="mb-0">20</h1>
                                    <h6>Offense level V</h6>
                                </div>
                            </div>
                        </div>

                        <div class="row flex-column gap-3 mt-4">
                            <div class="col justify-content-end d-flex">
                                <button type="button" class="btn border-none shadow-sm px-3 py-2 rounded-4 flex-shrink-1" data-bs-toggle="modal" data-bs-target="#modalAdd">
                                    <i class="bi bi-file-earmark-plus"></i>
                                </button>

                                <!-- pop up -->
                                <div class="modal fade" id="modalAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalAdd" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered ">
                                        <div class="modal-content modal-dialog-scrollable">
                                            <form action="<?= $addCodeOfConductEndpoint ?>" method="post">
                                                <div class="modal-header justify-content-center">
                                                    <h4 class="modal-title" id="modalAdd">ADD CODE OF CONDUCT</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Name</label>
                                                        <input type="text" class="form-control" id="name" name="name" placeholder="Code of Conduct Name">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="level" class="form-label">Level</label>
                                                        <select class="form-select" id="level" aria-label="Default select example" name="id_violation_level">
                                                            <?php 
                                                            /**
                                                             * @var ViolationLevelModel[] $violationLevels
                                                             */
                                                            foreach ($violationLevels as $violationLevel) : ?>
                                                            <option value="<?= $violationLevel->getIdViolationLevel(); ?>"><?= "Level " . $violationLevel->getLevel() . "; Name " . $violationLevel->getName() . "; Weight " . $violationLevel->getWeight() ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="description" class="form-label">Description</label>
                                                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Code of Conduct Description"></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Level</th>
                                            <th scope="col">Weight</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        /**
                                         * @var CodeOfConductModel[] $codeOfConducts
                                         */
                                        foreach ($codeOfConducts as $codeOfConduct) :
                                            /**
                                             * @var ViolationLevelModel $violationLevel
                                             */
                                            $violationLevel = $codeOfConduct->getViolationLevel();
                                        ?>
                                        <tr>
                                            <td><?= $codeOfConduct->getIdCodeOfConduct(); ?></td>
                                            <td><?= $codeOfConduct->getName(); ?></td>
                                            <td><?= $codeOfConduct->getDescription(); ?></td>
                                            <td><?= $violationLevel->getLevel(); ?></td>
                                            <td><?= $violationLevel->getWeight(); ?></td>
                                            <td class="d-flex" id="action_wrapper">
                                                <!-- modal trigger -->
                                                <button type="button" class="btn btn-link" onclick="editButtonAction('<?= $codeOfConduct->getName(); ?>', <?= $violationLevel->getIdViolationLevel(); ?>, '<?= $codeOfConduct->getDescription(); ?>')">
                                                    edit
                                                </button>
                                                <form action="<?= '' ?>" method="post">
                                                    <input type="hidden" name="id_user" value="<?= '' ?>">
                                                    <button type="submit" class="btn btn-link text-secondary">delete</button>
                                                </form>
                                                <!-- Modal -->
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    function editButtonAction(name, id_violation_level, description) {
        const modal = `
        <div class="modal fade" id="modalEdit" data-bs-backdrop="dynamic" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEdit" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content modal-dialog-scrollable">
                    <form action="<?= $updateCodeOfConductEndpoint ?>" method="post">
                        <div class="modal-header justify-content-center">
                            <h4 class="modal-title" id="modalEdit">UPDATE CODE OF CONDUCT</h4>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="${name}" placeholder="Code of Conduct Name">
                            </div>
                            <div class="mb-3">
                                <label for="level" class="form-label">Level</label>
                                <select class="form-select" id="level" aria-label="Default select example" name="id_violation_level">
                                    <?php 
                                    /**
                                     * @var ViolationLevelModel[] $violationLevels
                                     */
                                    foreach ($violationLevels as $violationLevel) : ?>
                                    <option value="<?= $violationLevel->getIdViolationLevel(); ?>" ${<?= $violationLevel->getIdViolationLevel(); ?> == id_violation_level ? "selected" : ""}><?= "Level " . $violationLevel->getLevel() . "; Name " . $violationLevel->getName() . "; Weight " . $violationLevel->getWeight() ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Code of Conduct Description"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="$('#modalEdit').remove()">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        `
        $('#action_wrapper').append(modal)
        $('#modalEdit').modal('show')
    }
</script>