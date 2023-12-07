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
            $dosenService = DosenService::getInstance();
            $mahasiswaService = MahasiswaService::getInstance();

            // get input
            $username = $_POST['username'];
            $password = $_POST['password'];

            // get user
            $user = $userService->getSingleUser([
                'username' => $username
            ]);

            // check if user exists
            if (!$user) {
                Flasher::setFlash("danger", "Login Failed");
                Helper::redirect('/auth/login');
            }

            // verify password
            $salt = $user->getSalt();
            $passwordHash = $user->getPasswordHash();
            $verified = $userService->validatePassword($salt, $password, $passwordHash);

            if ($verified) {

                // set role detail
                switch ($user->getRole()) {
                    case 'admin':
                        $user->setRoleDetail($adminService->getSingleAdmin(['id_user' => $user->getIdUser()]));
                        Session::getInstance()->push('user', $user);
                        Helper::redirect('/admin/dashboard');
                        break;
                    case 'dosen':
                        $user->setRoleDetail($dosenService->getSingleDosen(['id_user' => $user->getIdUser()]));
                        Session::getInstance()->push('user', $user);
                        Helper::redirect('/dosen/dashboard');
                        break;
                    case 'mahasiswa':
                        break;
                    default:
                        Flasher::setFlash("danger", "Some Unexpected Happened");
                        Helper::redirect('/auth/login');
                }
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

    public function forgotPasswordView()
    {   
        $data = [
            "flash" => Flasher::flash()
        ];

        return Helper::view('auth/forgot_password', $data);
    }

    public function forgotPassword() {
        $email = $_POST['email'];

        $userService = UserService::getInstance();

        $user = $userService->getSingleUser(
            ['email' => $email]
        );

        if ($user) {
            $accountRecoveryService = AccountRecoveryService::getInstance();
            $accountRecoveryService->revokeAccountRecoveryRequest($user->getIdUser());
            $success = $accountRecoveryService->createNewAccountRecoveryRequest($user);
            
            if (!$success) {
                Flasher::setFlash("danger", "Failed to send reset password link");
                return Helper::redirect('/auth/forgot-password');
            }
        }

        Flasher::setFlash("success", "If your email is registered, you will receive a reset password link");
        return Helper::redirect('/auth/forgot-password');
    }

    public function updatePasswordView(string $token)
    {
        $data = [
            "flash" => Flasher::flash(),
            "token" => $token
        ];
        return Helper::view('auth/update_password', $data);
    }

    public function updatePassword() {
        $token = $_POST['token'];
        $newPassword = $_POST['new_password'];

        $accountRecoveryService = AccountRecoveryService::getInstance();
        $accountRecovery = $accountRecoveryService->validateToken($token);

        if ($accountRecovery) {
            $idUser = $accountRecovery->getIdUser();
            $userService = UserService::getInstance();

            $user = $userService->getSingleUser(
                ['id_user' => $idUser]
            );

            $newPassword = $userService->hashPassword($user->getSalt(), $newPassword);
            $userService->updateUserPassword($idUser, $newPassword);

            $accountRecoveryService->revokeAccountRecoveryRequest($idUser);

            Flasher::setFlash("success", "Password has been updated");
            Helper::redirect('/auth/login');
        } else {   
            Flasher::setFlash("danger", "Invalid token");
            Helper::redirect('/auth/update-password/' . $token);
        }
    }
}
