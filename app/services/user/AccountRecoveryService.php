<?php
class AccountRecoveryService
{
    private static $instances = [];

    /**
     * @var QueryBuilder
     */
    private $db;
    protected function __construct()
    {
        $this->db = App::get('database');
        assert($this->db instanceof QueryBuilder);
    }


    protected function __clone()
    {
    }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }
    public static function getInstance(): AccountRecoveryService
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    public static function revokeAccountRecoveryRequest($idUser)
    {
        /**
         * @var QueryBuilder
         */
        $db = App::get('database');
        $db->delete('tb_account_recovery', [
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

            $this->db->insert('tb_account_recovery', [
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
        $rawAccountRecovery = $this->db->findOne('tb_account_recovery', [
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