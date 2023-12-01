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

		$adminRole = $user->getRoleDetail();
		assert($adminRole instanceof AdminModel);

		$data = [
			'firstname' => $adminRole->getFirstName(),
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
			'firstName' => $user->getFirstName(),
			'lastName' => $user->getLastName(),
			'title' => $adminRole->getTitle(),
			'email' => $user->getEmail(),
			'address' => $user->getAddress(),
			'phoneNumber' => $user->getPhoneNumber(),
		];

		return Helper::view('admin/profile', $data);
	}

	/**
	 * [contact description]
	 * @return [type] [description]
	 */
	public function changePassword()
	{
		return Helper::view('admin/change_password');
	}

	public function updateProfile()
	{

		if (
			isset($_POST['firstname']) ||
			isset($_POST['lastname']) ||
			isset($_POST['title']) ||
			isset($_POST['address']) ||
			isset($_POST['number'])
		) {
			$userService = new UserService();
			$adminService = new AdminService();

			/**
			 * @var UserModel
			 */
			$user = Session::getInstance()->get('user');

			$firstName = $_POST['firstname'];
			$lastName = $_POST['lastname'];
			$title = $_POST['title'];
			$address = $_POST['address'];
			$phoneNumber = $_POST['number'];

			$userService->updateUserProfile(
				$firstName,
				$lastName,
				$address,
				$phoneNumber,
				['id_user' => $user->getIdUser()]
			);

			$adminService->updateAdminProfile(
				$title,
				['id_user' => $user->getIdUser()]
			);

			$user = $userService->getSingleUser([
				'id_user' => $user->getIdUser()
			]);

			$user->setRoleDetail($adminService->getSingleAdmin($user->getIdUser()));

			Session::getInstance()->push('user', $user);

			Flasher::setFlash("success", "Profile updated successfully");
		} else {
			Flasher::setFlash("danger", "Failed to update profile");
		}

		return Helper::redirect('/admin/profile');
	}
}
