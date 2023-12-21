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
            <head>
            <style>
            *{
                font-family: 'Poppins', sans-serif !important;
                }

                a.link{
                    color: #fff;
                    text-decoration: none !important;
                    padding: 10px 20px;
                    background-color: #FCB216;
                    border-radius: 5px;
                }
                </style>
            </head>
            <body>
            <h1>Tertib App</h1>
            <h2>Halo</h2>
            <p>
              Kami telah menerima permintaan anda untuk mengatur ulang password anda.
              Apabila anda tidak membuat permintaan, abaikan pesan ini.
            </p>
    
            <a class='link' href='http://$host$rootUri/auth/update-password/$token'> Reset Password </a>
        
            <h3>Terima Kasih</h3>
            <h6>Tim Admin Tertib App</h6>
            </body>
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
