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

		$data = [
			'firstname' => $user->getFirstName(),
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
	public function manageStudent()
	{
		return Helper::view('admin/manage/student');
	}
	public function manageLecture()
	{
		return Helper::view('admin/manage/lecture');
	}
	public function manageAdmin()
	{
		return Helper::view('admin/manage/admin');
	}
	public function manageCodeOfConduct()
	{
		return Helper::view('admin/manage/code_of_conduct');
	}
	public function profilePage()
	{
		/**
		 * @var UserModel
		 */
		$user = Session::getInstance()->get('user');

		$adminRole = $user->getRoleDetail();
		assert($adminRole instanceof AdminModel);

		$data = [
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
			isset($_POST['firstname']) &&
			isset($_POST['lastname']) &&
			isset($_POST['title']) &&
			isset($_POST['address']) &&
			isset($_POST['number']) &&
			isset($_FILES['profile_image'])
		) {
			$userService = new UserService();
			$adminService = new AdminService();
			$mediaStorageService = new MediaStorageService();

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
			$profileImage = $_FILES['profile_image'];

			var_dump($profileImage);

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
			$imagePath = $uploadResult->imagePath;
			
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
			isset($_POST['current_password']) &&
			isset($_POST['new_password'])
		) {
			$userService = new UserService();

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
