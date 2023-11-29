<?php
class AuthsController
{

    public function loginForm()
    {

        if (Session::getInstance()->has('user')) {
            return Helper::redirect('/');
        }

        return Helper::view('auth/login', ["flash" => Flasher::flash()]);
    }

    public function login()
    {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = AuthService::getSingleUser($username);

            if (!$user) {
                Flasher::setFlash("danger", "Login Failed");
                Helper::redirect('/login');
            }
            
            $salt = $user->getSalt();
            $passwordHash = $user->getPasswordHash();

            $saltedPassword = $salt . $password;

            $verified = password_verify($saltedPassword, $passwordHash);

            if ($verified) {
                Session::getInstance()->push('user', $user);
                Helper::redirect('/dashboard');
            } else {
                Flasher::setFlash("danger", "Login Failed");
                Helper::redirect('/login');
            }
        }
    }

    public function logout()
    {
        Session::getInstance()->pop('user');
        Helper::redirect('/');
    }
}
