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

		// echo $admin->getFirstName();

		return Helper::view('admin/dashboard');
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
	public function profile()
	{
		return Helper::view('admin/profile');
	}

	/**
	 * [contact description]
	 * @return [type] [description]
	 */
	public function changePassword()
	{
		return Helper::view('admin/change_password');
	}
}
