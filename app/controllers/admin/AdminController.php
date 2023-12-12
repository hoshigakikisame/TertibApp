<?php


class AdminController
{

	/**
	 * [contact description]
	 * @return [type] [description]
	 */
	public function dashboard()
	{
		/**
		 * @var UserModel
		 */
		$user = Session::getInstance()->get('user');

		$reportService = ReportService::getInstance();
		$codeOfConductService = CodeOfConductService::getInstance();

		$reports = $reportService->getAllReport();
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

		return Helper::view('admin/dashboard', $data);
	}
	/**
	 * [contact description]
	 * @return [type] [description]
	 */
	public function report()
	{
		return Helper::view('admin/report');
	}

	/**
	 * [contact description]
	 * @return [type] [description]
	 */
	public function notification()
	{
		return Helper::view('admin/notification');
	}

	/**
	 * [contact description]
	 * @return [type] [description]
	 */
	
	public function profilePage()
	{
		/**
		 * @var UserModel
		 */
		$user = Session::getInstance()->get('user');

		$adminRole = $user->getRoleDetail();
		assert($adminRole instanceof AdminModel);

		$data = [
			'username' => $user->getUsername(),
			'firstName' => $user->getFirstName(),
			'lastName' => $user->getLastName(),
			'adminTitle' => $adminRole->getTitle(),
			'email' => $user->getEmail(),
			'address' => $user->getAddress(),
			'phoneNumber' => $user->getPhoneNumber(),
			'imageUrl' => $user->getImageUrl(),
			'flash' => Flasher::flash()
		];

		return Helper::view('admin/profile', $data);
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
			$adminService = AdminService::getInstance();
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
					return Helper::redirect('/admin/profile');
				}

				// validate image size
				$validImageSize = $mediaStorageService->validateImageSize($profileImage);
				if (!$validImageSize) {
					Flasher::setFlash("danger", "Image size must be less than " . MediaStorageService::getInstance()->getMaxImageSize() . " bytes");
					return Helper::redirect('/admin/profile');
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

			// update admin's profile
			$adminService->updateAdminProfile(
				$title,
				['id_user' => $idUser]
			);

			// refresh user session
			$userService->refreshUserSession($idUser);

			Flasher::setFlash("success", "Profile updated successfully");
		} else {
			Flasher::setFlash("danger", "All fields must be filled");
		}

		return Helper::redirect('/admin/profile');
	}

	public function updatePassword()
	{
		if (
			isset($_POST['current_password']) && $_POST['current_password'] != '' &&
			isset($_POST['new_password']) && $_POST['new_password'] != ''
		) {
			$userService = UserService::getInstance();

			/**
			 * @var UserModel
			 */
			$user = Session::getInstance()->get('user');

			// get input
			$currentPassword = $_POST['current_password'];
			$newPassword = $_POST['new_password'];

			// validate password
			$validated = $userService->validatePassword($user->getSalt(), $currentPassword, $user->getPasswordHash());

			// if validation failed return to profile page
			if (!$validated) {
				Flasher::setFlash("danger", "Current password is incorrect");
				return Helper::redirect('/admin/profile');
			}

			// define updateUserPassword parameters
			$idUser = $user->getIdUser();
			$newPassword = $userService->hashPassword($user->getSalt(), $newPassword);

			// update user's password
			$userService->updateUserPassword($idUser, $newPassword);

			// refresh user session
			$userService->refreshUserSession($idUser);

			Flasher::setFlash("success", "Password updated successfully");
		} else {
			Flasher::setFlash("danger", "All fields must be filled");
		}

		return Helper::redirect('/admin/profile');
	}
}
