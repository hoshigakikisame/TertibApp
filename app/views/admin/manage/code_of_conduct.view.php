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
                                    <h1 class="mb-0"><?= $codeOfConductCount ?></h1>
                                    <h6>Code Of Conduct Totals</h6>
                                </div>
                            </div>
                            <?php 
                            /**
                             * @var ViolationLevelModel[] $violationLevels
                             */
                            for ($i=0; $i < count($violationLevels); $i++) : 
                                $violationLevel = $violationLevels[$i];
                                $memberCount = 0;
                                foreach ($codeOfConducts as $codeOfConduct) {
                                    if ($codeOfConduct->getViolationLevel()->getIdViolationLevel() == $violationLevel->getIdViolationLevel()) {
                                        $memberCount++;
                                    }
                                }
                            ?>
                            <div class="col-lg-2 col-auto border border-2 mt-3 py-2 px-2 rounded-3 flex-grow-1 flex-lg-grow-0">
                                <div class="shadow-sm rounded-3 py-3 px-lg-4 px-0 h-100">
                                    <h1 class="mb-0"><?= $memberCount ?></h1>
                                    <h6>Offense level <?= GenericUtil::intToRoman($violationLevel->getLevel()) ?> </h6>
                                </div>
                            </div>
                            <?php endfor; ?>
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
                                                    <!-- Edit Modal trigger -->
                                                    <button type="button" class="btn btn-link" onclick="editButtonAction('<?= $codeOfConduct->getIdCodeOfConduct(); ?>', '<?= $codeOfConduct->getName(); ?>', <?= $violationLevel->getIdViolationLevel(); ?>, '<?= $codeOfConduct->getDescription(); ?>')">
                                                        edit
                                                    </button>
                                                    <!-- Delete Modal trigger -->
                                                    <button type="button" class="btn btn-link text-secondary" onclick="deleteButtonAction('<?= $codeOfConduct->getIdCodeOfConduct(); ?>','<?= $codeOfConduct->getName(); ?>')">delete</button>

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
    function editButtonAction(idCodeOfConduct, name, idViolationLevel, description) {
        const modal = /*html*/ `
        <div class="modal fade" id="modalEdit" data-bs-backdrop="dynamic" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEdit" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content modal-dialog-scrollable">
                    <form action="<?= $updateCodeOfConductEndpoint ?>" method="post">
                        <div class="modal-header justify-content-center">
                            <h4 class="modal-title" id="modalEdit">UPDATE CODE OF CONDUCT</h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="id_code_of_conduct" name="id_code_of_conduct" value="${idCodeOfConduct}">
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
                                    <option value="<?= $violationLevel->getIdViolationLevel(); ?>" ${<?= $violationLevel->getIdViolationLevel(); ?> == idViolationLevel ? "selected" : ""}><?= "Level " . $violationLevel->getLevel() . "; Name " . $violationLevel->getName() . "; Weight " . $violationLevel->getWeight() ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Code of Conduct Description">${description}</textarea>
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
        `
        $('#action_wrapper').append(modal)
        $('#modalEdit').modal('show')
        const myModalEl = document.getElementById('modalEdit')
        myModalEl.addEventListener('hidden.bs.modal', event => {
            $('#modalEdit').remove();
        })
    }

    function deleteButtonAction(id_code_of_conduct, name) {
        const modal = /*template*/ `
        <div class="modal fade" id="modalDelete" data-bs-keyboard="false" tabindex="-1"
          aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <form action="<?= $updateCodeOfConductEndpoint ?>" method="post">
                      <div class="modal-header justify-content-center">
                          <h1 class="modal-title fs-5" id="staticBackdropLabel">DELETE CODE OF CONDUCT</h1>
                      </div>
                      <div class="modal-body">
                          <input type="hidden" name="id_code_of_conduct" value="${id_code_of_conduct}">
                          <p class="">Are You Sure Want to Delete ${name} From Code Of Conduct? </p>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                          <button type="sumbit" class="btn btn-primary">Yes</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
        `

        $('#action_wrapper').append(modal)
        $('#modalDelete').modal('show')
        const myModalEl = document.getElementById('modalDelete')
        myModalEl.addEventListener('hidden.bs.modal', event => {
            $('#modalDelete').remove();
        })
    }
</script>