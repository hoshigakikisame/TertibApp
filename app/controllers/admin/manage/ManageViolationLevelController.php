<?php
class ManageViolationLevelController
{
	public function manageViolationLevelPage()
	{

		$data = [
			'flash' => Flasher::flash(),
			'violationLevelEndpoint' => App::get('root_uri') . '/admin/manage/violation-level',
			'violationLevelUpdateEndpoint' => App::get('root_uri') . '/admin/manage/violation-level/update',
			'violationLevelAddEndpoint' => App::get('root_uri') . '/admin/manage/violation-level/new',
		];

		return Helper::view('admin/manage/violation_level');
	}

	public function addViolationLevel()
	{
		if (
			isset($_POST['name']) && $_POST['name'] != '' &&
			isset($_POST['description']) && $_POST['description'] != '' &&
			isset($_POST['weight']) && $_POST['weight'] != ''
		) {
			$violationLevelService = new ViolationLevelService();

			$name = $_POST['name'];
			$description = $_POST['description'];
			$weight = $_POST['weight'];

			$violationLevelService->addNewViolationLevel($name, $description, $weight);

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
			isset($_POST['name']) && $_POST['name'] != '' &&
			isset($_POST['description']) && $_POST['description'] != '' &&
			isset($_POST['weight']) && $_POST['weight'] != ''
		) {
			$violationLevelService = new ViolationLevelService();

			$idViolationLevel = $_POST['id_violation_level'];
			$name = $_POST['name'];
			$description = $_POST['description'];
			$weight = $_POST['weight'];

			$violationLevelService->updateViolationLevel($name, $description, $weight, ['id_violation_level' => $idViolationLevel]);

			Flasher::setFlash('Violation level has been updated successfully!', 'success');
		} else {
			Flasher::setFlash('Please fill all the fields!', 'danger');
		}

		Helper::redirect('/admin/manage/violation-level');
	}
}