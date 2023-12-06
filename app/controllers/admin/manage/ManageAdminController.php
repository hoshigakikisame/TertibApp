<?php 
class ManageAdminController {

    public function manageAdminPage()
	{
		$userService = UserService::getInstance();
		$adminService = AdminService::getInstance();

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
			$userService = UserService::getInstance();
			$adminService = AdminService::getInstance();

			// get input
			$username = $_POST['username'];
			$firstName = $_POST['firstname'];
			$lastName = $_POST['lastname'];
			$email = $_POST['email'];
			$address = $_POST['address'];
			$phoneNumber = $_POST['no_telp'];
			$role = 'admin';

			$isUserExists = $userService->getSingleUser(['username' => $username]);

            if($isUserExists) {
                Flasher::setFlash("danger", "Username already exist!");
                return Helper::redirect('/admin/manage/admin');
            }

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
			isset($_POST['username']) && $_POST['username'] != '' &&
			isset($_POST['firstname']) && $_POST['firstname'] != '' &&
			isset($_POST['lastname']) && $_POST['lastname'] != '' &&
			isset($_POST['email']) && $_POST['email'] != '' &&
			isset($_POST['title']) && $_POST['title'] != '' &&
			isset($_POST['no_telp']) && $_POST['no_telp'] != '' &&
			isset($_POST['address']) && $_POST['address'] != ''
		) {
			$userService = UserService::getInstance();
			$adminService = AdminService::getInstance();

			// get input
			$idUser = $_POST['id_user'];
			$username = $_POST['username'];
			$firstName = $_POST['firstname'];
			$lastName = $_POST['lastname'];
			$email = $_POST['email'];
			$address = $_POST['address'];
			$phoneNumber = $_POST['no_telp'];
			$role = 'admin';

			$tempUser = $userService->getSingleUser(['username' => $username]);
			$isUserExists = $tempUser != null && $tempUser->getIdUser() != $idUser;

            if($isUserExists) {
                Flasher::setFlash("danger", "Username already exist!");
                return Helper::redirect('/admin/manage/admin');
            }

			if (isset($_POST['password']) && $_POST['password'] != '') {
				$rawPassword = $_POST['password'];
				$salt = Helper::generateRandomHex(16);
				$password = $userService->hashPassword($salt, $rawPassword);

				$userService->updateUser($username, $firstName, $lastName, $email, $address, $phoneNumber, $role, $salt, $password, ['id_user' => $idUser]);
			} else {
				$userService->updateUser($username, $firstName, $lastName, $email, $address, $phoneNumber, $role, '', '', ['id_user' => $idUser]);
			}
			
			$title = $_POST['title'];

			$adminService->updateAdminProfile($title, ['id_user' => $idUser]);

			Flasher::setFlash("success", "Admin successfully updated!");
		} else {
			Flasher::setFlash("danger", "All fields must be filled");
		}

		return Helper::redirect('/admin/manage/admin');
	}   
}