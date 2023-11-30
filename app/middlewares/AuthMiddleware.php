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
                Helper::redirect('/auth/dashboard');
                exit;
            }
        }
    }