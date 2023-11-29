<?php 
    class AuthService {
        public static function getSingleUser($username) {
            $db = App::get('database');
            $rawUser = $db->findOne('tb_user', ['username' => $username]);
            if ($rawUser) {
                $user = UserModel::fromStdClass($rawUser);
                return $user;
            }
        }
    }