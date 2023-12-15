<?php


class MahasiswaController
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
        $mahasiswaRole = $user->getRoleDetail();
        assert($mahasiswaRole instanceof MahasiswaModel);

        $mahasiswaViolationService = MahasiswaViolationService::getInstance();

        /**
         * @var MahasiswaViolationModel[] $mahasiswaViolations
         */
        $mahasiswaViolations = $mahasiswaViolationService->getManyMahasiswaViolation(['nim_mahasiswa' => $mahasiswaRole->getNim()]);
        $totalPoints = 0;
        foreach ($mahasiswaViolations as $mahasiswaViolation) {
            $totalPoints += $mahasiswaViolation->getViolationLevelWeight();
        }

        $data = [
            'firstname' => $user->getFirstName(),
            'lastname' => $user->getLastName(),
            'mahasiswaViolations' => $mahasiswaViolations,
            'totalViolations' => count($mahasiswaViolations) ?? 0,
            'totalPoints' => $totalPoints
        ];

        return Helper::view('mahasiswa/dashboard', $data);
    }

    public function notificationPage()
	{
		/**
		 * @var UserModel
		 */
		$user = Session::getInstance()->get('user');
		$mahasiswaRole = $user->getRoleDetail();
		assert($mahasiswaRole instanceof MahasiswaModel);

		$mahasiswaViolationService = MahasiswaViolationService::getInstance();

		$newMahasiswaViolations = $mahasiswaViolationService->getManyMahasiswaViolation(['nim_mahasiswa' => $mahasiswaRole->getNim(), 'is_new' => true]);

		$data = [
			'firstname' => $user->getFirstName(),
			'lastname' => $user->getLastName(),
			'newMahasiswaViolations' => $newMahasiswaViolations,
		];

		// mark all new violations as read
		if (count($newMahasiswaViolations) > 0)
            $mahasiswaViolationService->markNewMahasiswaViolationAsRead($newMahasiswaViolations);

		return Helper::view('mahasiswa/notification', $data);
	}

    public function profilePage()
    {
        /**
         * @var UserModel
         */
        $user = Session::getInstance()->get('user');

        $mahasiswaRole = $user->getRoleDetail();
        assert($mahasiswaRole instanceof MahasiswaModel);

        $data = [
            'nim' => $mahasiswaRole->getNim(),
            'username' => $user->getUsername(),
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
            'prodi' => $mahasiswaRole->getProdi(),
            'email' => $user->getEmail(),
            'address' => $user->getAddress(),
            'phoneNumber' => $user->getPhoneNumber(),
            'imageUrl' => $user->getImageUrl(),
            'flash' => Flasher::flash(),
            'updateProfileEndpoint' => App::get('root_uri') . '/mahasiswa/update-profile',
            'updatePasswordEndpoint' => App::get('root_uri') . '/mahasiswa/update-password'
        ];

        return Helper::view('mahasiswa/profile', $data);
    }

    public function updateProfile()
    {
        if (
            isset($_POST['firstname']) && $_POST['firstname'] != '' &&
            isset($_POST['lastname']) && $_POST['lastname'] != '' &&
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
            $address = $_POST['address'];
            $phoneNumber = $_POST['number'];

            $imagePath = $user->getImagePath();

            if (isset($_FILES['profile_image']) && $_FILES['profile_image']['name'] != '') {
                $profileImage = $_FILES['profile_image'];

                // validate image extension
                $validImageExtension = $mediaStorageService->validateImageExtension($profileImage);
                if (!$validImageExtension) {
                    Flasher::setFlash("danger", "Invalid image extension");
                    return Helper::redirect('/mahasiswa/profile');
                }

                // validate image size
                $validImageSize = $mediaStorageService->validateImageSize($profileImage);
                if (!$validImageSize) {
                    Flasher::setFlash("danger", "Image size must be less than " . MediaStorageService::getInstance()->getMaxImageSize() . " bytes");
                    return Helper::redirect('/mahasiswa/profile');
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

            // refresh user session
            $userService->refreshUserSession($idUser);

            Flasher::setFlash("success", "Profile updated successfully");
        } else {
            Flasher::setFlash("danger", "All fields must be filled");
        }

        // Helper::dd($_POST);

        return Helper::redirect('/mahasiswa/profile');
    }

    public function violationHistoryPage()
    {
        /**
         * @var UserModel
         */
        $user = Session::getInstance()->get('user');
        $mahasiswaRole = $user->getRoleDetail();
        assert($mahasiswaRole instanceof MahasiswaModel);

        $mahasiswaViolationService = MahasiswaViolationService::getInstance();

        /**
         * @var MahasiswaViolationModel[] $mahasiswaViolations
         */
        $mahasiswaViolations = $mahasiswaViolationService->getManyMahasiswaViolation(['nim_mahasiswa' => $mahasiswaRole->getNim()]);

        $data = [
            'mahasiswaViolations' => $mahasiswaViolations,
        ];

        return Helper::view('mahasiswa/violation_history', $data);
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
				return Helper::redirect('/mahasiswa/profile');
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

		return Helper::redirect('/mahasiswa/profile');
	}
}
