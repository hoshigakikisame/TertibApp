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
}
