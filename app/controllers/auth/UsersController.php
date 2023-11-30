<?php
	

	class UsersController
	{
		public function index()
		{
			/**
			 * @var QueryBuilder
			 */
			$db = App::get('database');
			$users = $db->selectAll("users");
			return Helper::view('users', [
					'users' => $users
				]);
		}

		public function store()
		{
			/**
			 * @var QueryBuilder
			 */
			$db = App::get('database');
			$db->insert('users', [
				'name' => $_POST['name']
			]);

			Helper::redirect('users');
		}
	}