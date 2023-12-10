<?php


class DosenController
{

	/**
	 * [contact description]
	 * @return [type] [description]
	 */
	public function dashboardPage()
	{
		/**
		 * @var UserModel
		 */
		$user = Session::getInstance()->get('user');

		$reportService = ReportService::getInstance();
		$codeOfConductService = CodeOfConductService::getInstance();

		$reports = $reportService->getManyReport(['nidn_dosen' => $user->getRoleDetail()->getNidn()]);
		$codeOfConducts = $codeOfConductService->getAllCodeOfConduct();

		for ($i = 0; $i < count($reports); $i++) {
			for ($j = 0; $j < count($codeOfConducts); $j++) {
				if ($reports[$i]->getIdCodeOfConduct() == $codeOfConducts[$j]->getIdCodeOfConduct()) {
					$reports[$i]->setCodeOfConduct($codeOfConducts[$j]);
				}
			}
		}

		$data = [
			'firstname' => $user->getFirstName(),
			'lastname' => $user->getLastName(),
			'reports' => $reports
		];

		return Helper::view('dosen/dashboard', $data);
	}

	public function notificationPage()
	{
		/**
		 * @var UserModel
		 */
		$user = Session::getInstance()->get('user');

		$data = [
			'firstname' => $user->getFirstName(),
			'lastname' => $user->getLastName(),
		];

		return Helper::view('dosen/notification', $data);
	}

	public function profilePage()
	{
		/**
		 * @var UserModel
		 */
		$user = Session::getInstance()->get('user');

		$dosenRole = $user->getRoleDetail();
		assert($dosenRole instanceof DosenModel);

		$data = [
			'nidn' => $dosenRole->getNidn(),
			'username' => $user->getUsername(),
			'firstName' => $user->getFirstName(),
			'lastName' => $user->getLastName(),
			'dosenTitle' => $dosenRole->getTitle(),
			'email' => $user->getEmail(),
			'address' => $user->getAddress(),
			'phoneNumber' => $user->getPhoneNumber(),
			'imageUrl' => $user->getImageUrl(),
			'flash' => Flasher::flash(),
			'updateProfileEndpoint' => App::get('root_uri') . '/dosen/profile/update'
		];

		return Helper::view('dosen/profile', $data);
	}

	public function updateProfile()
	{
		if (
			isset($_POST['firstname']) && $_POST['firstname'] != '' &&
			isset($_POST['lastname']) && $_POST['lastname'] != '' &&
			isset($_POST['title']) && $_POST['title'] != '' &&
			isset($_POST['address']) && $_POST['address'] != '' &&
			isset($_POST['number']) && $_POST['number'] != ''
		) {
			$userService = UserService::getInstance();
			$dosenService = DosenService::getInstance();
			$mediaStorageService = MediaStorageService::getInstance();

			/**
			 * @var UserModel
			 */

			$user = Session::getInstance()->get('user');

			// get input
			$idUser = $user->getIdUser();
			$firstName = $_POST['firstname'];
			$lastName = $_POST['lastname'];
			$title = $_POST['title'];
			$address = $_POST['address'];
			$phoneNumber = $_POST['number'];

			$imagePath = $user->getImagePath();

			if (isset($_FILES['profile_image']) && $_FILES['profile_image']['name'] != '') {
				$profileImage = $_FILES['profile_image'];

				// validate image extension
				$validImageExtension = $mediaStorageService->validateImageExtension($profileImage);
				if (!$validImageExtension) {
					Flasher::setFlash("danger", "Invalid image extension");
					return Helper::redirect('/dosen/profile');
				}

				// validate image size
				$validImageSize = $mediaStorageService->validateImageSize($profileImage);
				if (!$validImageSize) {
					Flasher::setFlash("danger", "Image size must be less than " . MediaStorageService::getInstance()->getMaxImageSize() . " bytes");
					return Helper::redirect('/dosen/profile');
				}

				// upload image
				$uploadResult = $mediaStorageService::getInstance()->uploadImage($profileImage['tmp_name'], 'user_profile', $idUser);

				// get image path from upload result publicId and extension
				$imagePath = $uploadResult->publicId . '.' . $mediaStorageService->getImageExtension($profileImage);
			}


			// update user's profile
			$userService->updateUserProfile(
				$firstName,
				$lastName,
				$address,
				$phoneNumber,
				$imagePath,
				['id_user' => $idUser]
			);

			// update dosen's profile
			$dosenService->updateDosenProfile(
				$title,
				['id_user' => $idUser]
			);

			// refresh user session
			$userService->refreshUserSession($idUser);

			Flasher::setFlash("success", "Profile updated successfully");
		} else {
			Flasher::setFlash("danger", "All fields must be filled");
		}

		return Helper::redirect('/dosen/profile');
	}

	public function reportPage()
	{

		$userService = UserService::getInstance();
		$mahasiswaService = MahasiswaService::getInstance();
		$codeOfConductService = CodeOfConductService::getInstance();
		$violationLevelService = ViolationLevelService::getInstance();

		/**
		 * @var UserModel[]
		 */
		$users = $userService->getManyUser(['role' => 'mahasiswa']);
		/**
		 * @var MahasiswaModel[]
		 */
		$mahasiswaList = $mahasiswaService->getAllMahasiswa();
		/**
		 * @var CodeOfConductModel[]
		 */
		$codeOfConducts = $codeOfConductService->getAllCodeOfConduct();
		/**
		 * @var ViolationLevelModel[]
		 */
		$violationLevels = $violationLevelService->getAllViolationLevel();

		for ($i = 0; $i < count($users); $i++) {
			for ($j = 0; $j < count($mahasiswaList); $j++) {
				if ($users[$i]->getIdUser() == $mahasiswaList[$j]->getIdUser()) {
					$users[$i]->setRoleDetail($mahasiswaList[$j]);
				}
			}
		}

		for ($i = 0; $i < count($codeOfConducts); $i++) {
			for ($j = 0; $j < count($violationLevels); $j++) {
				if ($codeOfConducts[$i]->getIdViolationLevel() == $violationLevels[$j]->getIdViolationLevel()) {
					$codeOfConducts[$i]->setViolationLevel($violationLevels[$j]);
				}
			}
		}

		// sort code of conducts by violation level
		usort($codeOfConducts, function ($a, $b) {
			return $a->getViolationLevel()->getLevel() <=> $b->getViolationLevel()->getLevel();
		});

		$data = [
			'flash' => Flasher::flash(),
			'users' => $users,
			'codeOfConducts' => $codeOfConducts,
			'addNewReportEndpoint' => App::get('root_uri') . '/dosen/report/new'
		];

		return Helper::view('dosen/report', $data);
	}

	public function addNewReport()
	{
		if (
			isset($_POST['title']) && $_POST['title'] != '' &&
			isset($_POST['nim_mahasiswa']) && $_POST['nim_mahasiswa'] != '' &&
			isset($_POST['id_code_of_conduct']) && $_POST['id_code_of_conduct'] != '' &&
			isset($_POST['location']) && $_POST['location'] != '' &&
			isset($_POST['content']) && $_POST['content'] != ''
		) {
			$reportService = ReportService::getInstance();
			$mediaStorageService = MediaStorageService::getInstance();

			/**
			 * @var UserModel
			 */

			$user = Session::getInstance()->get('user');
			/**
			 * @var DosenModel
			 */
			$dosenRole = $user->getRoleDetail();

			// get input
			$nidnDosen = $dosenRole->getNidn();
			$title = $_POST['title'];
			$nimMahasiswa = $_POST['nim_mahasiswa'];
			$idCodeOfConduct = $_POST['id_code_of_conduct'];
			$location = $_POST['location'];
			$content = $_POST['content'];

			$imagePath = '';

			if (isset($_FILES['evidence_picture']) && $_FILES['evidence_picture']['name'] != '') {
				$evidencePicture = $_FILES['evidence_picture'];

				// validate image extension
				$validImageExtension = $mediaStorageService->validateImageExtension($evidencePicture);
				if (!$validImageExtension) {
					Flasher::setFlash("danger", "Invalid image extension");
					return Helper::redirect('/dosen/report');
				}

				// validate image size
				$validImageSize = $mediaStorageService->validateImageSize($evidencePicture);
				if (!$validImageSize) {
					Flasher::setFlash("danger", "Image size must be less than " . MediaStorageService::getInstance()->getMaxImageSize() . " bytes");
					return Helper::redirect('/dosen/report');
				}

				$publicId = Helper::generateRandomHex(16);

				// upload image
				$uploadResult = $mediaStorageService::getInstance()->uploadImage($evidencePicture['tmp_name'], 'report', $publicId);

				// get image path from upload result publicId and extension
				$imagePath = $uploadResult->publicId . '.' . $mediaStorageService->getImageExtension($evidencePicture);
			}


			// update user's profile
			$reportService->addNewReport(
				$idCodeOfConduct,
				$title,
				$nidnDosen,
				$nimMahasiswa,
				$content,
				'New',
				$imagePath,
				$location
			);

			Flasher::setFlash("success", "Report added successfully");
		} else {
			Flasher::setFlash("danger", "All fields must be filled");
		}

		return Helper::redirect('/dosen/report');
	}
}
