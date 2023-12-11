<?php

namespace App\Jobs\backend;

use App\Helpers\EmailHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class JobSendEmailOnRegisration implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected String $name, $email, $otp, $verify_screen_link;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(String $name, String $email, String $otp, String $verify_screen_link)
    {
        $this->name = $name;
        $this->email = $email;
        $this->otp = $otp;
        $this->verify_screen_link = $verify_screen_link;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $emaiHelper = new EmailHelper(EmailHelper::EMAIL_VIA_BREVO);

        $emaiHelper->setType(config("constant.email_type.backend_registration"));

        $emaiHelper->setTo($this->email, $this->name);

        $emaiHelper->setSubject("Verification of Ecommerce Regisration On Backend");

        $html = view("emails.backend.registration", [
            "otp" => $this->otp,
            "verify_link" => $this->verify_screen_link
        ]);

        $emaiHelper->setBody((string) $html);

        $emaiHelper->send();
    }
}
