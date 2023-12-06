<?php 
class ManageMahasiswaController {

    public function manageMahasiswaPage()
	{
		$userService = UserService::getInstance();
		$mahasiswaService = MahasiswaService::getInstance();

		$users = $userService->getManyUser(['role' => 'mahasiswa']);
		$mahasiswas = $mahasiswaService->getAllMahasiswa();

		for ($i = 0; $i < count($users); $i++) {
			for ($j = 0; $j < count($mahasiswas); $j++) {
				if ($users[$i]->getIdUser() == $mahasiswas[$j]->getIdUser()) {
					$users[$i]->setRoleDetail($mahasiswas[$j]);
				}
			}
		}

		$data = [
			'users' => $users,
			'flash' => Flasher::flash(),
			'newMahasiswaEndpoint' => App::get('root_uri') . '/admin/manage/mahasiswa/new',
			'updateMahasiswaEndpoint' => App::get('root_uri') . '/admin/manage/mahasiswa/update',
			'deleteMahasiswaEndpoint' => App::get('root_uri') . '/admin/manage/mahasiswa/delete',
			'usersCount' => count($users),
		];

		return Helper::view('admin/manage/mahasiswa', $data);
	}
    public function addNewMahasiswa()
	{
		if (
			isset($_POST['username']) && $_POST['username'] != '' &&
			isset($_POST['nim']) && $_POST['nim'] != '' &&
			isset($_POST['firstname']) && $_POST['firstname'] != '' &&
			isset($_POST['lastname']) && $_POST['lastname'] != '' &&
			isset($_POST['prodi']) && $_POST['prodi'] != '' &&
			isset($_POST['email']) && $_POST['email'] != '' &&
			isset($_POST['no_telp']) && $_POST['no_telp'] != '' &&
			isset($_POST['address']) && $_POST['address'] != '' &&
			isset($_POST['password']) && $_POST['password'] != ''
		) {
			$userService = new UserService();
			$mahasiswaService = new MahasiswaService();

			// get input
			$username = $_POST['username'];
			$nim = $_POST['nim'];
			$firstName = $_POST['firstname'];
			$lastName = $_POST['lastname'];
			$prodi = $_POST['prodi'];
			$email = $_POST['email'];
			$phoneNumber = $_POST['no_telp'];
			$address = $_POST['address'];
			$role = 'mahasiswa';

			$isMahasiswaExist = $mahasiswaService->getSingleMahasiswaByNim($nim);

			if($isMahasiswaExist) {
				Flasher::setFlash("danger", "NIM already exist!");
				return Helper::redirect('/admin/manage/mahasiswa');
			}

			$rawPassword = $_POST['password'];
			$salt = Helper::generateRandomHex(16);
			$password = $userService->hashPassword($salt, $rawPassword);

			$newUserId = $userService->addNewUser($username, $firstName, $lastName, $email, $address, $phoneNumber, $role, $salt, $password);

			$prodi = $_POST['prodi'];

			$mahasiswaService->addNewMahasiswa($nim, $newUserId, $prodi);

			Flasher::setFlash("success", "Mahasiswa successfully added!");
		} else {
			Flasher::setFlash("danger", "All fields must be filled");
		}

		return Helper::redirect('/admin/manage/mahasiswa');
	}

	public function updateMahasiswa() {
		if (
			isset($_POST['id_user']) && $_POST['id_user'] != '' &&
			isset($_POST['username']) && $_POST['username'] != '' &&
			isset($_POST['nim']) && $_POST['nim'] != '' &&
			isset($_POST['firstname']) && $_POST['firstname'] != '' &&
			isset($_POST['lastname']) && $_POST['lastname'] != '' &&
			isset($_POST['prodi']) && $_POST['prodi'] != '' &&
			isset($_POST['email']) && $_POST['email'] != '' &&
			isset($_POST['no_telp']) && $_POST['no_telp'] != '' &&
			isset($_POST['address']) && $_POST['address'] != ''
		) {
			$userService = new UserService();
			$mahasiswaService = new MahasiswaService();

			// get input
			$idUser = $_POST['id_user'];
			$username = $_POST['username'];
			$nim = $_POST['nim'];
			$firstName = $_POST['firstname'];
			$lastName = $_POST['lastname'];
			$prodi = $_POST['prodi'];
			$email = $_POST['email'];
			$phoneNumber = $_POST['no_telp'];
			$address = $_POST['address'];
			$role = 'mahasiswa';

            $isUserExist = $userService->getSingleUser(['username' => $username])->getUsername() != $username;

            if($isUserExist) {
                Flasher::setFlash("danger", "Username already exist!");
                return Helper::redirect('/admin/manage/mahasiswa');
            }

			$isMahasiswaExist = $mahasiswaService->getSingleMahasiswaByNim($nim)->getIdUser() != $idUser;

			if($isMahasiswaExist) {
				Flasher::setFlash("danger", "NIM already exist!");
				return Helper::redirect('/admin/manage/mahasiswa');
			}

			if (isset($_POST['password']) && $_POST['password'] != '') {
				$rawPassword = $_POST['password'];
				$salt = Helper::generateRandomHex(16);
				$password = $userService->hashPassword($salt, $rawPassword);

				$userService->updateUser($username, $firstName, $lastName, $email, $address, $phoneNumber, $role, $salt, $password, ['id_user' => $idUser]);
			} else {
				$userService->updateUser($username, $firstName, $lastName, $email, $address, $phoneNumber, $role, '', '', ['id_user' => $idUser]);
			}

			$prodi = $_POST['prodi'];

			$mahasiswaService->updateMahasiswaProfile($nim, $prodi, ['id_user' => $idUser]);

			Flasher::setFlash("success", "Mahasiswa successfully updated!");
		} else {
			Flasher::setFlash("danger", "All fields must be filled");
		}

		return Helper::redirect('/admin/manage/mahasiswa');
	}

	public function deleteMahasiswa() {
		if (isset($_POST['id_user']) && $_POST['id_user'] != '') {
			// Defining Services
			$userService = UserService::getInstance();

			// Take inputs from request
			$idUser = $_POST['id_user'];

			// Add new code of conduct
			$userService->deleteUser($idUser);

			Flasher::setFlash('success', 'Mahasiswa has been deleted successfully!');
		} else {
			Flasher::setFlash('danger', 'Please fill all the fields!');
		}
		
		Helper::redirect('/admin/manage/mahasiswa');
	}
}