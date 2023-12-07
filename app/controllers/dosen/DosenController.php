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
}
