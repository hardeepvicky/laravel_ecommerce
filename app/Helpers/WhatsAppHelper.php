<?php

namespace App\Helpers;

use Twilio\Rest\Client;

class WhatsAppHelper
{
    const TYPE_TRANSACTIONAL = 'transactional';

    protected String $msg, $from_mobile, $to_mobile;

    public function __construct()
    {
        
    }

    public function setMsg(String $msg)
    {
        if (strlen($msg) > 255) {
            throw_exception("msg can not longer than 255");
        }

        $this->msg = $msg;
    }

    public function setFromMobile(String $mobile)
    {
        if (strlen($mobile) == 10)
        {
            $mobile .= "+91" . $mobile;
        }
        
        $this->from_mobile = $mobile;
    }

    public function setToMobile(String $mobile)
    {
        if (strlen($mobile) == 10)
        {
            $mobile .= "+91" . $mobile;
        }

        $this->to_mobile = $mobile;
    }

    public function saveToLog()
    {
        if (!$this->from_email) {
            throw_exception("from_email is not set");
        }

        if (!$this->from_name) {
            throw_exception("from_name is not set");
        }

        if (!$this->to_email) {
            throw_exception("to_email is not set");
        }

        if (!$this->to_name) {
            throw_exception("to_name is not set");
        }

        if (!$this->subject) {
            throw_exception("subject is not set");
        }

        if (!$this->html) {
            throw_exception("html is not set");
        }

        $emailLog = new EmailLog();

        $path = EmailLog::getFileSavePath();

        FileUtility::createFolder($path);

        $file = $emailLog->getNextId() . ".html";

        file_put_contents($path . $file, $this->html);

        $emailLog->fill([
            "type" => $this->type,
            "from_name" => $this->from_name,
            "from_email" => $this->from_email,
            "to_name" => $this->to_name,
            "to_email" => $this->to_email,
            "subject" => $this->subject,
            "content_file" => $path . $file
        ]);

        if (!$emailLog->save()) {
            throw new \Exception("SMS Log Save Failed");
        }

        return $emailLog->id;
    }

    public function send()
    {
        $sid = env('TWILIO_SID');

        if (!$sid) {
            throw_exception("Twilio SID is not set in env");
        }

        $token = env('TWILIO_TOKEN');

        if (!$token) {
            throw_exception("Twilio Token is not set in env");
        }

        $twilio = new Client($sid, $token);
        
        $message = $twilio->messages->create($this->to_mobile, [
                    "from" => $this->from_mobile,
                    "body" => "Hello there!"
                ]);

        dump($message);

        exit;
    }
}
