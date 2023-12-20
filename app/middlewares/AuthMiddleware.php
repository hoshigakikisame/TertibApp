<?php 
    class AuthMiddleware {

        /**
         * Validate session
         * @return void
         */
        public function shouldValidated() {
            if (!Session::getInstance()->has('user')) {
                Helper::redirect('/auth/login');
                exit;
            }
        }

        public function shouldAnonymous() {
            if (Session::getInstance()->has('user')) {
                /**
                 * @var UserModel $user
                 */
                $user = Session::getInstance()->get('user');

                echo $user->getRole();

                switch($user->getRole()) {
                    case "mahasiswa":
                        Helper::redirect('/mahasiswa/dashboard');
                        exit;
                    case "dosen":
                        Helper::redirect('/dosen/dashboard');
                        exit;
                    case "admin":
                        Helper::redirect('/admin/dashboard');
                        exit;
                    default:
                        Helper::redirect('/');
                        exit;
                }
            }
        }
    }