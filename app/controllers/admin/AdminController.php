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
			'lastname' => $user->getLastName(),
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
		$userService = new UserService();
		$adminService = new AdminService();

		$users = $userService->getManyUser(['role' => 'admin']);
		$admins = $adminService->getAllAdmin();

		for ($i = 0; $i < count($users); $i++) {
			for ($j = 0; $j < count($admins); $j++) {
				if ($users[$i]->getIdUser() == $admins[$j]->getIdUser()) {
					$users[$i]->setRoleDetail($admins[$j]);
				}
			}
		}

		$data = [
			'users' => $users,
			'flash' => Flasher::flash(),
			'newAdminEndpoint' => App::get('root_uri') . '/admin/manage/admin/new',
			'updateAdminEndpoint' => App::get('root_uri') . '/admin/manage/admin/update',
			'usersCount' => count($users),
		];

		return Helper::view('admin/manage/admin', $data);
	}
	public function manageLevelViolation()
	{
		return Helper::view('admin/manage/level_violation');
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
			isset($_POST['firstname']) && $_POST['firstname'] != '' &&
			isset($_POST['lastname']) && $_POST['lastname'] != '' &&
			isset($_POST['title']) && $_POST['title'] != '' &&
			isset($_POST['address']) && $_POST['address'] != '' &&
			isset($_POST['number']) && $_POST['number'] != '' &&
			isset($_FILES['profile_image']) && $_FILES['profile_image']['name'] != ''
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

	public function addNewAdmin()
	{
		if (
			isset($_POST['username']) && $_POST['username'] != '' &&
			isset($_POST['firstname']) && $_POST['firstname'] != '' &&
			isset($_POST['lastname']) && $_POST['lastname'] != '' &&
			isset($_POST['email']) && $_POST['email'] != '' &&
			isset($_POST['title']) && $_POST['title'] != '' &&
			isset($_POST['no_telp']) && $_POST['no_telp'] != '' &&
			isset($_POST['address']) && $_POST['address'] != '' &&
			isset($_POST['password']) && $_POST['password'] != ''
		) {
			$userService = new UserService();
			$adminService = new AdminService();

			// get input
			$username = $_POST['username'];
			$firstName = $_POST['firstname'];
			$lastName = $_POST['lastname'];
			$email = $_POST['email'];
			$address = $_POST['address'];
			$phoneNumber = $_POST['no_telp'];
			$role = 'admin';

			$rawPassword = $_POST['password'];
			$salt = Helper::generateRandomHex(16);
			$password = $userService->hashPassword($salt, $rawPassword);

			$newUserId = $userService->addNewUser($username, $firstName, $lastName, $email, $address, $phoneNumber, $role, $salt, $password);

			$title = $_POST['title'];

			$adminService->addNewAdmin($newUserId, $title);

			Flasher::setFlash("success", "User successfully added!");
		} else {
			Flasher::setFlash("danger", "All fields must be filled");
		}

		return Helper::redirect('/admin/manage/admin');
	}

	public function updateAdmin() {
		if (
			isset($_POST['id_user']) && $_POST['id_user'] != '' &&
			isset($_POST['firstname']) && $_POST['firstname'] != '' &&
			isset($_POST['lastname']) && $_POST['lastname'] != '' &&
			isset($_POST['email']) && $_POST['email'] != '' &&
			isset($_POST['title']) && $_POST['title'] != '' &&
			isset($_POST['no_telp']) && $_POST['no_telp'] != '' &&
			isset($_POST['address']) && $_POST['address'] != '' &&
			isset($_POST['password']) && $_POST['password'] != ''
		) {
			$userService = new UserService();
			$adminService = new AdminService();

			// get input
			$idUser = $_POST['id_user'];
			$username = $_POST['username'];
			$firstName = $_POST['firstname'];
			$lastName = $_POST['lastname'];
			$email = $_POST['email'];
			$address = $_POST['address'];
			$phoneNumber = $_POST['no_telp'];
			$role = 'admin';

			$rawPassword = $_POST['password'];
			$salt = Helper::generateRandomHex(16);
			$password = $userService->hashPassword($salt, $rawPassword);

			$userService->updateUser($username, $firstName, $lastName, $email, $address, $phoneNumber, $role, $salt, $password, ['id_user' => $idUser]);

			$title = $_POST['title'];

			$adminService->updateAdminProfile($title, ['id_user' => $idUser]);

			Flasher::setFlash("success", "User successfully updated!");
		} else {
			Flasher::setFlash("danger", "All fields must be filled");
		}

		return Helper::redirect('/admin/manage/admin');
	}
}
