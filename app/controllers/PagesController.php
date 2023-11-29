<?php


class PagesController
{

	/**
	 * Go to the homepage
	 * @return view
	 */
	public function home()
	{
		return Helper::view('index');
	}

	/**
	 * [about description]
	 * @return [type] [description]
	 */
	public function about()
	{
		return Helper::view('about');
	}

	public function test($id, $id2)
	{
		echo $id;
		echo $id2;
		return Helper::view('about');
	}

	/**
	 * [contact description]
	 * @return [type] [description]
	 */
	public function contact()
	{
		return Helper::view('contact');
	}

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

		return Helper::view('dashboard');
	}
	/**
	 * [contact description]
	 * @return [type] [description]
	 */
	public function report()
	{
		return Helper::view('report');
	}
	/**
	 * [contact description]
	 * @return [type] [description]
	 */
	public function notification()
	{
		return Helper::view('notification');
	}
	/**
	 * [contact description]
	 * @return [type] [description]
	 */
	public function profile()
	{
		return Helper::view('profile');
	}

	/**
	 * [contact description]
	 * @return [type] [description]
	 */
	public function changePassword()
	{
		return Helper::view('change_password');
	}

	/**
	 * [contact description]
	 * @return [type] [description]
	 */
	public function sendVerification()
	{
		return Helper::view('send_verification');
	}
}
