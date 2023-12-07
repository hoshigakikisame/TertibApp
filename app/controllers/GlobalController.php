<?php


class GlobalController
{

	/**
	 * Go to the homepage
	 * @return view
	 */
	public function landing()
	{
		// Defining services
		$violationLevelService = ViolationLevelService::getInstance();
		$codeOfConductService = CodeOfConductService::getInstance();

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
			'violationLevels' => $violationLevels,
			'codeOfConducts' => $codeOfConducts,
		];

		return Helper::view('index', $data);
	}

	/**
	 * [about description]
	 * @return [type] [description]
	 */
	public function about()
	{
		return Helper::view('global/about');
	}

	public function test($id, $id2)
	{
		echo $id;
		echo $id2;
		return Helper::view('global/about');
	}

	/**
	 * [contact description]
	 * @return [type] [description]
	 */
	public function contact()
	{
		return Helper::view('contact');
	}
}
