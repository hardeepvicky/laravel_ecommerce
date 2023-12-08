<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Helpers\FileUtility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use UserType;

class PublicController extends BackendController
{
    public function ajax_upload(Request $request)
    {
        die("code not implemented");
        dd($request->get("file"));
    }

    public function ajax_upload_base64(Request $request)
    {
        $response = ["status" => 1, "msg" => ""];

        try
        {
            $base64 = $request->get("base64", null);
            $filename = $request->get("filename", null);

            if (!$base64)
            {
                throw_exception("base64 not found in request");
            }

            if (!$filename)
            {
                throw_exception("filename not found in request");
            }

            $path = Config::get('constant.path.temp');

            $response['file'] = FileUtility::base64ToFile($base64, $path, $filename);
            $response['filename'] = pathinfo($response['file'], PATHINFO_BASENAME);
        }
        catch(Exception $ex)
        {
            $response['status'] = 0;
            $response['msg'] = $ex->getMessage();
        }

        return $this->responseJson($response);
    }

    public function google_sign_in()
    {
        return Socialite::driver('google')->redirect();
    }

    public function google_callback()
    {
        try {

            $google_user = Socialite::driver('google')->user();

            //dd($user);

            $finduser = User::where('email', $google_user->email)->first();

            if (!$finduser)
            {
                $finduser = User::where('oauth_uid', $google_user->id)->first();
            }

            if($finduser){

                Auth::login($finduser);

                return redirect('/admin/dashboard');

            }else{
                $newUser = new User();

                $newUser->name = $google_user->name;
                $newUser->email = $google_user->email;
                $newUser->oauth_provider = 'google';
                $newUser->oauth_uid = $google_user->id;
                $newUser->avatar = $google_user->avatar;
                $newUser->password = encrypt('admin@123');
                $newUser->type = UserType::BACKEND;
                $newUser->email_verified_at = date('Y-m-d H:i:s');

                if (!$newUser->save())
                {
                    throw new Exception("User Save Failed");
                }

                Auth::login($newUser);

                return redirect('/admin/dashboard');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    
}