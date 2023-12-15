<?php

class ReportController
{
	public function reportDetailPage(int $idReport)
	{

		$reportService = ReportService::getInstance();
		$reportCommentService = ReportCommentService::getInstance();
		$codeOfConductService = CodeOfConductService::getInstance();

		$report = $reportService->getSingleReport(['id_report' => $idReport]);

		$reportComments = $reportCommentService->getManyReportComment(['id_report' => $idReport]);
		$codeOfConducts = $codeOfConductService->getAllCodeOfConduct();

		$data = [
			'flash' => Flasher::flash(),
			'report' => $report,
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

			// if report status is 'Valid' or 'Invalid', then cancel update
			if ($report->getStatus() == 'Valid' || $report->getStatus() == 'Invalid') {
				Flasher::setFlash("danger", "Report status is already 'Valid' or 'Invalid'");
				return Helper::redirect("/report/detail/$idReport");
			}

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

			if ($status == 'Valid') {
				// if report status is 'Valid', then add violation to mahasiswa
				$mahasiswaViolationService = MahasiswaViolationService::getInstance();
				$mahasiswaViolationService->addNewMahasiswaViolation($report->getNimMahasiswa(), $idReport);
			}

			Flasher::setFlash("success", "Report updated successfully");
		} else {
			Flasher::setFlash("danger", "All fields must be filled");
		}

		return Helper::redirect("/report/detail/$idReport");
	}
}