<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    

    /**
     * Redirect the user to the Google authentication page.
    *
    * @return \Illuminate\Http\Response
    */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try {

            $data = Socialite::driver('google')->stateless()->user();

            $existingUser = User::where('email', $data->email)->first();

            if($existingUser){

                return formatResponse(200, 'successfully logged in', true, $existingUser);

            } else {
                $newUser                  = new User;
                $newUser->name            = $data->name;
                $newUser->email           = $data->email;
                $newUser->google_id       = $data->id;
                $newUser->token           = $data->token;
                $newUser->token_expires_in= $data->expiresIn;
                $newUser->avatar          = $data->avatar;
                $newUser->avatar_original = $data->avatar_original;
                $newUser->first_name      = $data->user['given_name'];
                $newUser->last_name      = $data->user['family_name'];

                $newUser->save();

                return formatResponse(200, 'successfully logged in', true, $newUser);
            }
           
        } catch (\Exception $e) {
                return formatResponse(fetchErrorCode($e), get_class($e) . ": " . $e->getMessage());
        }



    }
}
