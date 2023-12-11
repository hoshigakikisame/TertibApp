<?php
class AccountRecoveryService extends DBService
{

    public function __construct()
    {
        parent::__construct('tb_account_recovery');
    }

    public static function getInstance(): self
    {
        return parent::getInstance();
    }

    public function revokeAccountRecoveryRequest($idUser)
    {
        return $this->getDB()->delete($this->getTable(), [
            'id_user' => $idUser
        ]);
    }

    public function createNewAccountRecoveryRequest($user)
    {
        if ($user) {
            $token = Helper::generateRandomHex(16);

            /**
             * @var array
             */
            $config = App::get('config');
            $recoveryTokenValidity = $config['recovery_token_validity'];
            $tokenValidityDate = date('Y-m-d H:i:s', (time() + $recoveryTokenValidity));

            parent::getDB()->insert($this->getTable(), [
                'id_user' => $user->getIdUser(),
                'token' => $token,
                'valid_until' => $tokenValidityDate
            ]);

            /**
             * @var EmailApi $emailApi
             */
            $emailApi = App::get('email_api');
            $host = App::get('host');
            $rootUri = App::get('root_uri');

            $email = $user->getEmail();
            $subject = "Reset Password";
            $htmlBody = "
                <h1>Reset Password</h1>
                <p>Click <a href='http://$host$rootUri/auth/update-password/$token'>here</a> to reset your password</p>
            ";

            return $emailApi->sendEmail($email, $subject, $htmlBody);
        }
        return false;
    }

    public function validateToken($token)
    {
        $rawAccountRecovery = parent::getDB()->findOne($this->getTable(), [
            'token' => $token
        ]);

        if ($rawAccountRecovery) {
            $accountRecovery = AccountRecoveryModel::fromStdClass($rawAccountRecovery);
            $validUntil = $accountRecovery->getValidUntil();
            $now = date('Y-m-d H:i:s');

            if ($validUntil > $now) {
                return $accountRecovery;
            }
        }

        return false;
    }
}