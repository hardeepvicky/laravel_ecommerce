<?php

namespace App\Http\Controllers;

use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class HomeController extends WebController
{
    public function index()
    {
        if (Auth::check()) {
            return Redirect::route("admin.dashboard");
        } else {
            return Redirect::route("login");
        }
    }

    public function test()
    {
        //Set endpoint and api key

        $this->sent_test_email();

        return view("backend.test");
    }

    public function theme()
    {
        return view("backend.theme");
    }

    public function developer_components()
    {
        return view("backend.developer_components");
    }

    protected function sent_test_email()
    {
        $endpoint = 'https://api.brevo.com/v3/smtp/email';

        $api_key = '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';

        //Request payload

        $data = array(
            'sender' => array(
                'name' => 'Sender Alex',
                'email' => 'senderalex@example.com'
            ),
            'to' => array(
                array(
                    'email' => 'hardeep.singh417@gmail.com',
                    'name' => 'Hardeep Singh'
                )
            ),
            'subject' => 'Hello world',
            'htmlContent' => '<html><head></head><body><p>Hello,</p><p>This is my first transactional email sent from Brevo.</p></body></html>'

        );

        //Set cURL options

        $options = array(
            CURLOPT_URL => $endpoint,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                'accept: application/json',
                'api-key: ' . $api_key,
                'content-type: application/json'
            )
        );

        //Initialize cURL session
        $curl = curl_init();
        //Set cURL options
        curl_setopt_array($curl, $options);
        //Execute the request
        $response = curl_exec($curl);

        //Check for errors

        if ($response === false) {

            echo 'Error: ' . curl_error($curl);
        } else {

            //Process the response

            $response_data = json_decode($response, true);

            dump($response_data);

            if (isset($response_data['messageId'])) {

                echo 'Email sent successfully!';
            } else {

                //echo 'Email sending failed. Error: ' . $response_data['error'];
            }
        }

        //Close cURL session

        curl_close($curl);

        exit;
    }
}
