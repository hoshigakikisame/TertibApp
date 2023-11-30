<?php
class EmailApi
{
    private $apiKey;
    private $secretKey;
    private $senderEmail;
    private $senderName;
    private $mailJet;

    private static $instances = [];

    protected function __construct()
    {
        /**
         * @var array $config
         */
        $config = App::get('config');
        $this->apiKey = $config['mailjet']['api_key'];
        $this->secretKey = $config['mailjet']['secret_key'];
        $this->senderEmail = $config['mailjet']['sender_email'];
        $this->senderName = $config['mailjet']['sender_name'];
        $this->mailJet = new \Mailjet\Client($this->apiKey, $this->secretKey, true, ['version' => 'v3.1']);
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
        $email = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => $this->senderEmail,
                        'Name' => $this->senderName
                    ],
                    'To' => [
                        [
                            'Email' => $to,
                            'Name' => $to
                        ]
                    ],
                    'Subject' => $subject,
                    'TextPart' => $body,
                    'HTMLPart' => $body
                ]
            ]
        ];
        $response = $this->mailJet->post(Mailjet\Resources::$Email, ['body' => $email]);
        var_dump($response->getData());
        return $response->success();
    }
}