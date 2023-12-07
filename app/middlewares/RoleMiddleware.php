<?php
class RoleMiddleware {
    public function shouldAdmin() {

        /**
         * @var UserModel $currentUser
         */
        $currentUser = Session::getInstance()->get('user');
        $role = $currentUser->getRole();

        if ($role != 'admin') {
            echo 'Forbidden';
            http_response_code(403);
            return die();
        }
    }

    public function shouldDosen() {

        /**
         * @var UserModel $currentUser
         */
        $currentUser = Session::getInstance()->get('user');
        $role = $currentUser->getRole();

        if ($role != 'dosen') {
            echo 'Forbidden';
            http_response_code(403);
            return die();
        }
    }
}