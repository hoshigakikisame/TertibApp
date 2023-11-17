<?php 
    class AuthMiddleware {

        /**
         * Validate session
         * @return void
         */
        public function validateSession() {
            if (!Session::has('auth')) {
                Helper::redirect('/login');
                exit;
            }
        }
    }