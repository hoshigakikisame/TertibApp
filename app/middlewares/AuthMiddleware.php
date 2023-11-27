<?php 
    class AuthMiddleware {

        /**
         * Validate session
         * @return void
         */
        public function validateSession() {
            if (!Session::getInstance()->has('auth')) {
                Helper::redirect('/login');
                exit;
            }
        }
    }