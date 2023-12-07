<?php
class EmailApi
{
    private $mailService;
    private $senderEmail;
    private $senderName;
    private $appPassword;

    private static $instances = [];

    protected function __construct()
    {
        /**
         * @var array $config
         */
        $config = App::get('config');
        $this->senderEmail = $config['gmail']['sender_email'];
        $this->senderName = $config['gmail']['sender_name'];
        $this->appPassword = $config['gmail']['app_password'];

        $this->mailService = new \PHPMailer\PHPMailer\PHPMailer; 
        $this->mailService->IsSMTP(); 
        $this->mailService->Mailer     = "smtp";
        $this->mailService->SMTPDebug  = 1;
        $this->mailService->SMTPAuth   = TRUE;
        $this->mailService->SMTPSecure = "tls";
        $this->mailService->Port       = 587;
        $this->mailService->Host       = "smtp.gmail.com";
        $this->mailService->Username   = $this->senderEmail;
        $this->mailService->Password   = $this->appPassword;
    }

    protected function __clone()
    {
    }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): EmailApi
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    public function sendEmail($to, $subject, $body)
    {

        $this->mailService->IsHTML(true);
        $this->mailService->AddAddress($to);
        $this->mailService->SetFrom($this->senderEmail, $this->senderName);
        $this->mailService->Subject = $subject;
        $this->mailService->Body = $body;

        return $this->mailService->Send();
    }
}