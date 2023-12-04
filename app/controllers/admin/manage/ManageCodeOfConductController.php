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
		];

		return Helper::view('admin/manage/code_of_conduct', $data);
	}
}