<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Models\User;
use App\Models\Team;

class SocialController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function handleGoogleCallback()
    {
        try {
            //create a user using socialite driver google
            $user = Socialite::driver('google')->user();
            // if the user exits, use that user and login
            $finduser = User::where('google_id', $user->id)->first();
            if($finduser){
                //if the user exists, login and show dashboard
                Auth::login($finduser);
                return redirect('/products');
            }else{
                $currentUser = $this->loginOrCreateAccount('google', $user);
                //every user needs a team for dashboard/jetstream to work.
                //create a personal team for the user
                // $newTeam = Team::forceCreate([
                //     'user_id' => $newUser->id,
                //     'name' => explode(' ', $user->name, 2)[0]."'s Team",
                //     'personal_team' => true,
                // ]);
                // save the team and add the team to the user.
                // $newTeam->save();
                // $newUser->current_team_id = $newTeam->id;
                // $newUser->save();
                //login as the new user
                Auth::login($currentUser);
                // go to the dashboard
                return redirect('/products');
            }
            //catch exceptions
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function loginWithFacebook()
    {
        try {
    
            $user = Socialite::driver('facebook')->user();
            $isUser = User::where('facebook_id', $user->id)->first();
     
            if($isUser){
                Auth::login($isUser);
                return redirect('/products');
            }else{
                $currentUser = $this->loginOrCreateAccount('facebook', $user);
    
                Auth::login($currentUser);
                return redirect('/products');
            }
    
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }

    protected function loginOrCreateAccount($provider, $user)
    {
        $currentUser = User::where('email', $user->email)->first();

        if ($currentUser) {
            // update the avatar and provider that might have changed
            $currentUser->update([
                $provider.'_id' => $user->id,
            ]);
        } else {
            $currentUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                $provider.'_id' => $user->id,
                'password' => encrypt('admin@123')
            ]);
        }

        return $currentUser;
    }
}