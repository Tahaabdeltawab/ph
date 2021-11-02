<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\EmailTakenException;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\City;
use App\Models\OAuthProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        config([
            'services.facebook.redirect' => route('oauth.callback', 'facebook'),
            'services.google.redirect' => route('oauth.callback', 'google'),
        ]);
    }

    /**
     * Redirect the user to the provider authentication page.
     */
    public function redirect(string $provider)
    {
        return response()->json([
            'url' => Socialite::driver($provider)->stateless()->redirect()->getTargetUrl(),
        ]);
    }

    /**
     * Obtain the user information from the provider.
     */
    public function handleCallback(string $provider)
    {
        $sUser = Socialite::driver($provider)->stateless()->user();
        $user = $this->findOrCreateUser($provider, $sUser);
        $this->guard()->setToken( $token = $this->guard()->login($user) );

        return view('oauth/callback', [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->getPayload()->get('exp') - time(),
        ]);
    }

    /**
     * Find or create a user.
     */
    protected function findOrCreateUser(string $provider, SocialiteUser $sUser): User
    {
        $oauthProvider = OAuthProvider::where('provider', $provider)
            ->where('provider_user_id', $sUser->getId())
            ->first();

        if ($oauthProvider) {
            $oauthProvider->update([
                'access_token' => $sUser->token,
                'refresh_token' => $sUser->refreshToken,
            ]);

            return $oauthProvider->user;
        }

        if ($dbUser = User::where('email', $sUser->getEmail())->first()) {
            // throw new EmailTakenException;
            $dbUser->update(['username' => $sUser->getName()]);
            return $dbUser;
        }

        return $this->createUser($provider, $sUser);
    }

    /**
     * Create a new user.
     */
    protected function createUser(string $provider, SocialiteUser $sUser)
    {
        try{
            DB::beginTransaction();
            $city   = City::first();
            $area   = Area::where('city_id',$city->id)->first();
            $user   = User::create([
                'username'  => $sUser->getName(),
                'email'     => $sUser->getEmail(),
                'city_id'   => $city->id,
                'area_id'   => $area->id,
                // 'email_verified_at' => now(),
            ]);
    
            $user->oauthProviders()->create([
                'provider' => $provider,
                'provider_user_id' => $sUser->getId(),
                'access_token' => $sUser->token,
                'refresh_token' => $sUser->refreshToken,
            ]);
            DB::commit();
    
            return $user;
        }catch(\Throwable $th){
            DB::rollBack();
        }
    }


    public function handleDeletionCallback(Request $request, $provider){
        if($request->del_id && $request->confirmation_code){
            $user = User::find($request->del_id);
            return !$user ? true : false;
        }

        $signed_request = $_POST['signed_request'];
        $data = $this->parse_signed_request($signed_request);
        $provider_user_id = $data['user_id'];

        // Start data deletion

        $oauthProvider = OAuthProvider::where('provider', $provider)
            ->where('provider_user_id', $provider_user_id)
            ->first();

        if ($oauthProvider) {
            $user_id = $oauthProvider->user->id;
            $oauthProvider->user()->delete();
        }
        
        // $status_url = 'http://localhost:8000/deletion?id=abc123'; // URL to track the deletion
        $confirmation_code = $user_id; // unique code for the deletion request
        $status_url = url("oauth/facebook/deletion_callback", ['del_id' => $user_id, 'confirmation_code' => $confirmation_code]); // URL to track the deletion

        $data = array(
        'url' => $status_url,
        'confirmation_code' => $confirmation_code
        );
        echo json_encode($data);
    }

    protected function parse_signed_request($signed_request) {
        list($encoded_sig, $payload) = explode('.', $signed_request, 2);

        $secret = env('FACEBOOK_CLIENT_SECRET');

        // decode the data
        $sig = base64_url_decode($encoded_sig);
        $data = json_decode($this->base64_url_decode($payload), true);

        // confirm the signature
        $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
        if ($sig !== $expected_sig) {
            error_log('Bad Signed JSON signature!');
            return null;
        }

        return $data;
    }

    protected function base64_url_decode($input) {
        return base64_decode(strtr($input, '-_', '+/'));
    }
}
