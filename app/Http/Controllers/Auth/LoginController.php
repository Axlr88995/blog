<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function socialLogin($social){
        return Socialite::driver($social)->redirect();
    }

    // public function handleProviderCallback($social){
    //     $userSocial = Socialite::driver($social)->user();
    //     $user = User::where(['email' => $userSocial->getEmail()])->first();
    //     if($user){
    //         Auth::login($user);
    //         return redirect()->action("HomeController@index");
    //     }else{

    //         return view('auth.register',['email' => $userSocial->getEmail(),'name' => $userSocial->getName()]);
    //     }
    // }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect($this->redirectTo);
    }

    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if(!$authUser){
            $authUser = User::where('email', $user->email)->first();
            if($authUser->privider != $provider)
             {   
                 $authUser->provider = $provider;
                 $authUser->update();
             }
        }

        if ($authUser)
            return $authUser;

        if(!$user->name){
            $user->name = substr($user->email,0,strpos($user->email, '@')-1);
        }
        return User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id,
            'password' => $user->token,
        ]);
    }
}
