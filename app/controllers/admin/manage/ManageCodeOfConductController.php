<?php
class ManageCodeOfConductController {
    public function manageCodeOfConductPage()
	{
        // Defining services
		$violationLevelService = new ViolationLevelService();
        $codeOfConductService = new CodeOfConductService();

        // Get all violation levels
		$violationLevels = $violationLevelService->getAllViolationLevel() ?? [];

        // Get all code of conducts
        $codeOfConducts = $codeOfConductService->getAllCodeOfConduct() ?? [];

        for ($i = 0; $i < count($codeOfConducts); $i++) {
            for ($j = 0; $j < count($violationLevels); $j++) {
                if ($codeOfConducts[$i]->getIdViolationLevel() == $violationLevels[$j]->getIdViolationLevel()) {
                    $codeOfConducts[$i]->setViolationLevel($violationLevels[$j]);
                }
            }
        }

		$data = [
			'flash' => Flasher::flash(),
            'violationLevels' => $violationLevels,
            'violationLevelsCount' => count($violationLevels),
			'codeOfConducts' => $codeOfConducts,
			'codeOfConductCount' => count($codeOfConducts),
			'manageCodeOfConductEndpoint' => App::get('root_uri') . '/admin/manage/code-of-conduct',
			'addCodeOfConductEndpoint' => App::get('root_uri') . '/admin/manage/code-of-conduct/new',
			'updateCodeOfConductEndpoint' => App::get('root_uri') . '/admin/manage/code-of-conduct/update',
			'deleteCodeOfConductEndpoint' => App::get('root_uri') . '/admin/manage/code-of-conduct/delete',
		];

		return Helper::view('admin/manage/code_of_conduct', $data);
	}

    public function addCodeOfConduct() {
        if (
			isset($_POST['name']) && $_POST['name'] != '' &&
			isset($_POST['id_violation_level']) && $_POST['id_violation_level'] != '' &&
			isset($_POST['description']) && $_POST['description'] != ''
		) {
			// Defining Services
			$codeOfConductService = new CodeOfConductService();

			// Take inputs from request
			$name = $_POST['name'];
			$idViolationLevel = $_POST['id_violation_level'];
			$description = $_POST['description'];

			// Add new code of conduct
			$codeOfConductService->addNewCodeOfConduct($name, $description, $idViolationLevel);

			Flasher::setFlash('success', 'Code of Conduct has been added successfully!');
		} else {
			Flasher::setFlash('danger', 'Please fill all the fields!');
		}
		
		Helper::redirect('/admin/manage/code-of-conduct');
    }

	public function updateCodeOfConduct() {
		if (
			isset($_POST['id_code_of_conduct']) && $_POST['id_code_of_conduct'] != '' &&
			isset($_POST['name']) && $_POST['name'] != '' &&
			isset($_POST['id_violation_level']) && $_POST['id_violation_level'] != '' &&
			isset($_POST['description']) && $_POST['description'] != ''
		) {
			// Defining Services
			$codeOfConductService = new CodeOfConductService();

			// Take inputs from request
			$idCodeOfConduct = $_POST['id_code_of_conduct'];
			$name = $_POST['name'];
			$idViolationLevel = $_POST['id_violation_level'];
			$description = $_POST['description'];

			// Add new code of conduct
			$codeOfConductService->updateCodeOfConduct($name, $description, $idViolationLevel, ['id_code_of_conduct' => $idCodeOfConduct]);

			Flasher::setFlash('success', 'Code of Conduct has been added successfully!');
		} else {
			Flasher::setFlash('danger', 'Please fill all the fields!');
		}
		
		Helper::redirect('/admin/manage/code-of-conduct');
	}

	public function deleteCodeOfConduct() {
		if (isset($_POST['id_code_of_conduct']) && $_POST['id_code_of_conduct'] != '') {
			// Defining Services
			$codeOfConductService = CodeOfConductService::getInstance();

			// Take inputs from request
			$idCodeOfConduct = $_POST['id_code_of_conduct'];

			// Add new code of conduct
			$codeOfConductService->deleteCodeOfConduct($idCodeOfConduct);

			Flasher::setFlash('success', 'Code of Conduct has been deleted successfully!');
		} else {
			Flasher::setFlash('danger', 'Please fill all the fields!');
		}
		
		Helper::redirect('/admin/manage/code-of-conduct');
	}
}