<?php
class RoleMiddleware {
    public function shouldAdmin() {

        /**
         * @var UserModel $currentUser
         */
        $currentUser = Session::getInstance()->get('user');
        $role = $currentUser->getRole();

        if ($role != 'admin') {
            Helper::redirect('/auth/dashboard');
            exit;
        }
    }

    public function shouldDosen() {

        /**
         * @var UserModel $currentUser
         */
        $currentUser = Session::getInstance()->get('user');
        $role = $currentUser->getRole();

        if ($role != 'dosen') {
            Helper::redirect('/auth/dashboard');
            exit;
        }
    }
}