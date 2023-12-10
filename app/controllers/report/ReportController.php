<?php

class ReportController {
    public function reportDetailPage(int $idReport)
	{

        $reportService = ReportService::getInstance();
        $codeOfConductService = CodeOfConductService::getInstance();
        $violationLevelService = ViolationLevelService::getInstance();
        $userService = UserService::getInstance();
        $mahasiswaService = MahasiswaService::getInstance();
        $dosenService = DosenService::getInstance();
        $adminService = AdminService::getInstance();

        $report = $reportService->getSingleReport(['id_report' => $idReport]);
        $codeOfConduct = $codeOfConductService->getSingleCodeOfConduct(['id_code_of_conduct' => $report->getIdCodeOfConduct()]);
        $violationLevel = $violationLevelService->getSingleViolationLevel(['id_violation_level' => $codeOfConduct->getIdViolationLevel()]);
        
        // $adminUser = $userService->getSingleUser(['id_user' => $report->getIdAdmin()]);
        // $adminRole = $adminService->getSingleAdmin(['id_user' => $adminUser->getIdUser()]);

        $mahasiswaRole = $mahasiswaService->getSingleMahasiswa(['nim' => $report->getNimMahasiswa()]);
        $mahasiswaUser = $userService->getSingleUser(['id_user' => $mahasiswaRole->getIdUser()]);
        $mahasiswaUser->setRoleDetail($mahasiswaRole);

        $dosenRole = $dosenService->getSingleDosen(['nidn' => $report->getNidnDosen()]);
        $dosenUser = $userService->getSingleUser(['id_user' => $dosenRole->getIdUser()]);
        $dosenUser->setRoleDetail($dosenRole);

		$data = [
			'flash' => Flasher::flash(),
            'report' => $report,
            'codeOfConduct' => $codeOfConduct,
            'violationLevel' => $violationLevel,
            'mahasiswaUser' => $mahasiswaUser,
            'dosenUser' => $dosenUser
		];

		return Helper::view('report/report_detail', $data);
	}
}