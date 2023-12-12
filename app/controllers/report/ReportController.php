<?php

class ReportController
{
	public function reportDetailPage(int $idReport)
	{

		$reportService = ReportService::getInstance();
		$reportCommentService = ReportCommentService::getInstance();
		$codeOfConductService = CodeOfConductService::getInstance();
		$violationLevelService = ViolationLevelService::getInstance();
		$userService = UserService::getInstance();
		$mahasiswaService = MahasiswaService::getInstance();
		$dosenService = DosenService::getInstance();
		$adminService = AdminService::getInstance();

		$report = $reportService->getSingleReport(['id_report' => $idReport]);
		$codeOfConduct = $codeOfConductService->getSingleCodeOfConduct(['id_code_of_conduct' => $report->getIdCodeOfConduct()]);
		$violationLevel = $violationLevelService->getSingleViolationLevel(['id_violation_level' => $codeOfConduct->getIdViolationLevel()]);

		if ($report->getIdAdmin() == null) {
			$adminUser = null;
			$adminRole = null;
		} else {
			$adminUser = $userService->getSingleUser(['id_user' => $report->getIdAdmin()]);
			$adminRole = $adminService->getSingleAdmin(['id_user' => $adminUser->getIdUser()]);
			$adminUser->setRoleDetail($adminRole);
		}

		$mahasiswaRole = $mahasiswaService->getSingleMahasiswa(['nim' => $report->getNimMahasiswa()]);
		$mahasiswaUser = $userService->getSingleUser(['id_user' => $mahasiswaRole->getIdUser()]);
		$mahasiswaUser->setRoleDetail($mahasiswaRole);

		$dosenRole = $dosenService->getSingleDosen(['nidn' => $report->getNidnDosen()]);
		$dosenUser = $userService->getSingleUser(['id_user' => $dosenRole->getIdUser()]);
		$dosenUser->setRoleDetail($dosenRole);

		$reportComments = $reportCommentService->getManyReportComment(['id_report' => $idReport]);
		$participants = [$adminUser, $mahasiswaUser, $dosenUser];

		// assign user to report comment
		for ($i = 0; $i < count($reportComments); $i++) {
			for ($j = 0; $j < count($participants); $j++) {
				if ($participants[$j] == null) continue;
				if ($reportComments[$i]->getIdUser() == $participants[$j]->getIdUser()) {
					$reportComments[$i]->setUser($participants[$j]);
				}
			}
		}

		$codeOfConducts = $codeOfConductService->getAllCodeOfConduct();

		$data = [
			'flash' => Flasher::flash(),
			'report' => $report,
			'codeOfConduct' => $codeOfConduct,
			'violationLevel' => $violationLevel,
			'mahasiswaUser' => $mahasiswaUser,
			'dosenUser' => $dosenUser,
			'adminUser' => $adminUser,
			'reportComments' => $reportComments,
			'codeOfConducts' => $codeOfConducts,
			'addNewReportCommentEndpoint' => App::get('root_uri') . "/report/detail/$idReport/comment/new",
			'updateReportDetailEndpoint' => App::get('root_uri') . "/report/detail/$idReport/update",
		];

		return Helper::view('report/report_detail', $data);
	}

	public function addNewReportComment($idReport)
	{
		if (
			isset($_POST['content']) && $_POST['content'] != ''
		) {
			$reportCommentService = ReportCommentService::getInstance();
			$reportService = ReportService::getInstance();
			$mediaStorageService = MediaStorageService::getInstance();

			/**
			 * @var UserModel
			 */
			$user = Session::getInstance()->get('user');

			// get input
			$idUser = $user->getIdUser();
			$content = $_POST['content'];

			$report = $reportService->getSingleReport(['id_report' => $idReport]);
			$isParticipant = $report->isParticipant($user);

			if ($report == null) {
				Flasher::setFlash("danger", "Report not found");
				return Helper::redirect("/");
			}

			if (!$isParticipant) {
				Flasher::setFlash("danger", "You are not a participant of this report");
				return Helper::redirect("/report/detail/$idReport");
			}

			$imagePath = '';

			if (isset($_FILES['attachment_picture']) && $_FILES['attachment_picture']['name'] != '') {
				$evidencePicture = $_FILES['attachment_picture'];

				// validate image extension
				$validImageExtension = $mediaStorageService->validateImageExtension($evidencePicture);
				if (!$validImageExtension) {
					Flasher::setFlash("danger", "Invalid image extension");
					return Helper::redirect("/report/detail/$idReport");
				}

				// validate image size
				$validImageSize = $mediaStorageService->validateImageSize($evidencePicture);
				if (!$validImageSize) {
					Flasher::setFlash("danger", "Image size must be less than " . MediaStorageService::getInstance()->getMaxImageSize() . " bytes");
					return Helper::redirect("/report/detail/$idReport");
				}

				$publicId = Helper::generateRandomHex(16);

				// upload image
				$uploadResult = $mediaStorageService::getInstance()->uploadImage($evidencePicture['tmp_name'], 'report', $publicId);

				// get image path from upload result publicId and extension
				$imagePath = $uploadResult->publicId . '.' . $mediaStorageService->getImageExtension($evidencePicture);
			}

			// add new report comment
			$reportCommentService->addNewReportComment($idReport, $idUser, $content, $imagePath);

			Flasher::setFlash("success", "Comment added successfully");
		} else {
			Flasher::setFlash("danger", "All fields must be filled");
		}

		return Helper::redirect("/report/detail/$idReport");
	}

	public function updateReportDetail($idReport)
	{
		if (
			isset($_POST['id_code_of_conduct']) && $_POST['id_code_of_conduct'] != '' &&
			isset($_POST['status']) && $_POST['status'] != ''
		) {
			$reportService = ReportService::getInstance();
			$adminService = AdminService::getInstance();

			$report = $reportService->getSingleReport(['id_report' => $idReport]);
			
			if ($report == null) {
				Flasher::setFlash("danger", "Report not found");
				return Helper::redirect("/");
			}
			
			// get input
			$idCodeOfConduct = $_POST['id_code_of_conduct'];
			$status = $_POST['status'];

			/**
			 * @var UserModel
			 */
			$user = Session::getInstance()->get('user');
			$adminRole = $adminService->getSingleAdmin(['id_user' => $user->getIdUser()]);

			if ($report->getIdAdmin() == null) {
				// if report is not assigned to admin, then assign current
				$reportService->updateReport($idReport, $idCodeOfConduct, $status, $adminRole->getIdAdmin());
			} else {
				// if report is assigned to admin, then check if current user is the admin of the report
				if ($report->getIdAdmin() != $adminRole->getIdAdmin()) {
					Flasher::setFlash("danger", "You are not the admin of this report");
					return Helper::redirect("/report/detail/$idReport");
				}

				// if current user is the admin of the report, then update the report
				$reportService->updateReport($idReport, $idCodeOfConduct, $status, $report->getIdAdmin());
			}

			Flasher::setFlash("success", "Report updated successfully");
		} else {
			Flasher::setFlash("danger", "All fields must be filled");
		}

		return Helper::redirect("/report/detail/$idReport");
	}
}