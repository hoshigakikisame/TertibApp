<?php 
class ManageDosenController {

    public function manageDosenPage()
	{
		$userService = UserService::getInstance();
		$dosenService = DosenService::getInstance();

		$users = $userService->getManyUser(['role' => 'dosen']);
		$dosens = $dosenService->getAllDosen();

		for ($i = 0; $i < count($users); $i++) {
			for ($j = 0; $j < count($dosens); $j++) {
				if ($users[$i]->getIdUser() == $dosens[$j]->getIdUser()) {
					$users[$i]->setRoleDetail($dosens[$j]);
				}
			}
		}

		$data = [
			'users' => $users,
			'flash' => Flasher::flash(),
			'newDosenEndpoint' => App::get('root_uri') . '/admin/manage/dosen/new',
			'updateDosenEndpoint' => App::get('root_uri') . '/admin/manage/dosen/update',
			'deleteDosenEndpoint' => App::get('root_uri') . '/admin/manage/dosen/delete',
			'usersCount' => count($users),
		];

		return Helper::view('admin/manage/dosen', $data);
	}
    public function addNewDosen()
	{
		if (
			isset($_POST['username']) && $_POST['username'] != '' &&
			isset($_POST['nidn']) && $_POST['nidn'] != '' &&
			isset($_POST['firstname']) && $_POST['firstname'] != '' &&
			isset($_POST['lastname']) && $_POST['lastname'] != '' &&
			isset($_POST['title']) && $_POST['title'] != '' &&
			isset($_POST['email']) && $_POST['email'] != '' &&
			isset($_POST['no_telp']) && $_POST['no_telp'] != '' &&
			isset($_POST['address']) && $_POST['address'] != '' &&
			isset($_POST['password']) && $_POST['password'] != ''
		) {
			$userService = new UserService();
			$dosenService = new DosenService();

			// get input
			$username = $_POST['username'];
			$nidn = $_POST['nidn'];
			$firstName = $_POST['firstname'];
			$lastName = $_POST['lastname'];
			$title = $_POST['title'];
			$email = $_POST['email'];
			$phoneNumber = $_POST['no_telp'];
			$address = $_POST['address'];
			$role = 'dosen';

			$isDosenExist = $dosenService->getSingleDosenByNidn($nidn);

			if($isDosenExist) {
				Flasher::setFlash("danger", "NIDN already exist!");
				return Helper::redirect('/admin/manage/dosen');
			}

			$rawPassword = $_POST['password'];
			$salt = Helper::generateRandomHex(16);
			$password = $userService->hashPassword($salt, $rawPassword);

			$newUserId = $userService->addNewUser($username, $firstName, $lastName, $email, $address, $phoneNumber, $role, $salt, $password);

			$title = $_POST['title'];

			$dosenService->addNewDosen($nidn, $newUserId, $title);

			Flasher::setFlash("success", "Dosen successfully added!");
		} else {
			Flasher::setFlash("danger", "All fields must be filled");
		}

		return Helper::redirect('/admin/manage/dosen');
	}

	public function updateDosen() {
		if (
			isset($_POST['id_user']) && $_POST['id_user'] != '' &&
			isset($_POST['username']) && $_POST['username'] != '' &&
			isset($_POST['nidn']) && $_POST['nidn'] != '' &&
			isset($_POST['firstname']) && $_POST['firstname'] != '' &&
			isset($_POST['lastname']) && $_POST['lastname'] != '' &&
			isset($_POST['title']) && $_POST['title'] != '' &&
			isset($_POST['email']) && $_POST['email'] != '' &&
			isset($_POST['no_telp']) && $_POST['no_telp'] != '' &&
			isset($_POST['address']) && $_POST['address'] != ''
		) {
			$userService = new UserService();
			$dosenService = new DosenService();

			// get input
			$idUser = $_POST['id_user'];
			$username = $_POST['username'];
			$nidn = $_POST['nidn'];
			$firstName = $_POST['firstname'];
			$lastName = $_POST['lastname'];
			$title = $_POST['title'];
			$email = $_POST['email'];
			$phoneNumber = $_POST['no_telp'];
			$address = $_POST['address'];
			$role = 'dosen';

			$isUserExist = $userService->getSingleUser(['username' => $username])->getUsername() != $username;

            if($isUserExist) {
                Flasher::setFlash("danger", "Username already exist!");
                return Helper::redirect('/admin/manage/mahasiswa');
            }

			$isDosenExist = $dosenService->getSingleDosenByNidn($nidn)->getIdUser() != $idUser;

			if($isDosenExist) {
				Flasher::setFlash("danger", "NIDN already exist!");
				return Helper::redirect('/admin/manage/dosen');
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

			$dosenService->updateDosenProfile($nidn, $title, ['id_user' => $idUser]);

			Flasher::setFlash("success", "Dosen successfully updated!");
		} else {
			Flasher::setFlash("danger", "All fields must be filled");
		}

		return Helper::redirect('/admin/manage/dosen');
	}

	public function deleteDosen() {
		if (isset($_POST['id_user']) && $_POST['id_user'] != '') {
			// Defining Services
			$userService = UserService::getInstance();

			// Take inputs from request
			$idUser = $_POST['id_user'];

			// Add new code of conduct
			$userService->deleteUser($idUser);

			Flasher::setFlash('success', 'Dosen has been deleted successfully!');
		} else {
			Flasher::setFlash('danger', 'Please fill all the fields!');
		}
		
		Helper::redirect('/admin/manage/dosen');
	}
}