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
            // declare services
            $userService = UserService::getInstance();
            $adminService = AdminService::getInstance();

            // get input
            $username = $_POST['username'];
            $password = $_POST['password'];

            // get user
            $user = $userService->getSingleUser($username);

            // check if user exists
            if (!$user) {
                Flasher::setFlash("danger", "Login Failed");
                Helper::redirect('/auth/login');
            }

            // verify password
            $salt = $user->getSalt();
            $passwordHash = $user->getPasswordHash();
            $saltedPassword = $salt . $password;
            $verified = password_verify($saltedPassword, $passwordHash);

            if ($verified) {

                // set role detail
                switch ($user->getRole()) {
                    case 'admin':
                        $user->setRoleDetail($adminService->getSingleAdmin($user->getIdUser()));
                        break;
                    case 'dosen':
                        break;
                    case 'mahasiswa':
                        break;
                    default:
                        break;
                }

                // set session
                Session::getInstance()->push('user', $user);
                Helper::redirect('/admin/dashboard');
            } else {
                Flasher::setFlash("danger", "Login Failed");
                Helper::redirect('/auth/login');
            }
        }
    }

    public function logout()
    {
        Session::getInstance()->pop('user');
        Helper::redirect('/');
    }

    public function forgotPassword()
    {
        return Helper::view('auth/forgot_password');
    }

    public function updatePassword()
    {
        return Helper::view('auth/update_password');
    }
}
