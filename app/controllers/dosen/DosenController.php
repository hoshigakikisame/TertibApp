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

		$data = [
			'firstname' => $user->getFirstName(),
			'lastname' => $user->getLastName(),
		];

		return Helper::view('dosen/dashboard', $data);
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
			'username' => $user->getUsername(),
			'firstName' => $user->getFirstName(),
			'lastName' => $user->getLastName(),
			'adminTitle' => $dosenRole->getTitle(),
			'email' => $user->getEmail(),
			'address' => $user->getAddress(),
			'phoneNumber' => $user->getPhoneNumber(),
			'imageUrl' => $user->getImageUrl(),
			'flash' => Flasher::flash()
		];

		return Helper::view('dosen/profile', $data);
	}

    public function reportPage() 
    {
        $data = [
            'flash' => Flasher::flash()
        ];

        return Helper::view('dosen/report', $data);
    }
}
