<?php
class ManageViolationLevelController
{
	public function manageViolationLevelPage()
	{

		$violationLevelService = new ViolationLevelService();

		$violationLevels = $violationLevelService->getAllViolationLevel() ?? [];

		$data = [
			'flash' => Flasher::flash(),
			'violationLevels' => $violationLevels,
			'violationLevelsCount' => count($violationLevels),
			'violationLevelEndpoint' => App::get('root_uri') . '/admin/manage/violation-level',
			'addViolationLevelEndpoint' => App::get('root_uri') . '/admin/manage/violation-level/new',
			'updateViolationLevelEndpoint' => App::get('root_uri') . '/admin/manage/violation-level/update',
		];

		return Helper::view('admin/manage/violation_level', $data);
	}

	public function addViolationLevel()
	{
		if (
			isset($_POST['level']) && $_POST['level'] != '' &&
			isset($_POST['name']) && $_POST['name'] != '' &&
			isset($_POST['weight']) && $_POST['weight'] != ''
		) {
			$violationLevelService = new ViolationLevelService();

			$level = $_POST['level'];
			$name = $_POST['name'];
			$weight = $_POST['weight'];

			$violationLevelService->addNewViolationLevel($level, $name, $weight);

			Flasher::setFlash('Violation level has been added successfully!', 'success');
		} else {
			Flasher::setFlash('Please fill all the fields!', 'danger');
		}

		Helper::redirect('/admin/manage/violation-level');
	}

	public function updateViolationLevel()
	{
		if (
			isset($_POST['id_violation_level']) && $_POST['id_violation_level'] != '' &&
			isset($_POST['level']) && $_POST['level'] != '' &&
			isset($_POST['name']) && $_POST['name'] != '' &&
			isset($_POST['weight']) && $_POST['weight'] != ''
		) {
			$violationLevelService = new ViolationLevelService();

			$idViolationLevel = $_POST['id_violation_level'];
			$level = $_POST['level'];
			$name = $_POST['name'];
			$weight = $_POST['weight'];

			$violationLevelService->updateViolationLevel($level, $name, $weight, ['id_violation_level' => $idViolationLevel]);

			Flasher::setFlash('success', 'Violation level has been updated successfully!');
		} else {
			Flasher::setFlash('danger', 'Please fill all the fields!');
		}

		Helper::redirect('/admin/manage/violation-level');
	}
}
