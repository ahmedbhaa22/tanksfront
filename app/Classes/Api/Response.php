<?php
namespace App\Classes\Api;

class Response
{
    private $result = '';

    private $content = [];

    private $code;

    private $message;

    private $errorMessages;

    public function __construct($result)
    {
        $this->result = $result;
        return $this;
    }

    public function decode()
    {
        if($this->result["state"] == 1) {
            $jsonToArray = json_decode($this->result["result"], true);

            $this->code = $jsonToArray["status"]["code"]??"";

            $this->message = ($jsonToArray["status"]["message"]??($jsonToArray["status"]["message_en"]??[]));

            $this->errorMessages = ($jsonToArray["status"]["error_messages"]??($jsonToArray["status"]["error_details"]??[]));

            if($jsonToArray["status"]["code"] == 200) {
                $this->content = $jsonToArray["content"]??[];
            }
        }

        return $this;
    }

    public function content()
    {
        return $this->content;
    }

    public function errorMessages()
    {
        return $this->errorMessages;
    }

    public function code()
    {
        return $this->code;
    }

    public function message()
    {
        return $this->message;
    }
}