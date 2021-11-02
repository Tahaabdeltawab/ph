<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\VerifyEmailException;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest:api')->except('logout');
        $this->middleware('guest:web')->except('logout_web');
    }

    /**
     * Attempt to log the user into the application.
     */
    protected function attemptLogin(Request $request): bool
    {
        $token = $this->guard()->attempt($this->credentials($request));

        if (! $token) {
            return false;
        }

        $user = $this->guard()->user();
        if ($user instanceof MustVerifyEmail && ! $user->hasVerifiedEmail()) {
            return false;
        }

        $this->guard()->setToken($token);

        return true;
    }

    /**
     * Send the response after the user was authenticated.
     */
    protected function sendLoginResponse(Request $request)
    {
        $this->clearLoginAttempts($request);

        $token = (string) $this->guard()->getToken();
        $expiration = $this->guard()->getPayload()->get('exp');

        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $expiration - time(),
        ]);
    }

    /**
     * Get the failed login response instance.
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $user = $this->guard()->user();

        if ($user instanceof MustVerifyEmail && ! $user->hasVerifiedEmail()) {
            throw VerifyEmailException::forUser($user);
        }

        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        return response()->json(null, 204);
    }





    public function postLogin(Request $request)
    {

         $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);

        $user = User::where([['email',$request->email] ])->first();

        if(is_object($user)&& $user != NULL && (Hash::check($request->password,$user->password)))
        {
                if($user->status){

                    $user_role = $user->role;

                     if( $user_role == "1" || $user_role == "3"){
                         \Auth::guard('web')->loginUsingId($user->id);
                         return redirect('admin/home');
                   }else{
                        \Auth::guard('web')->loginUsingId($user->id);
                        return redirect('/');
                     }
                }else{
                    return back()->with('msg', 'المستخدم غير نشط');
                }

            }else{
                return back()->with('msg', 'اسم مستخدم أو كلمة مرور خاطئة');
            }
    }

    public function logout_web(Request $request)
    {
        try{
            // $this->guard()->logout();
            auth('web')->logout();
            // \Auth::guard('api')->logout();
            $request->session()->invalidate();
    
            $request->session()->regenerateToken();
    
            if ($response = $this->loggedOut($request)) {
                return $response;
            }
    
            return $request->wantsJson()
                ? new JsonResponse([], 204)
                : redirect('admin');
        }catch(\Throwable $th){
            throw $th;
        }
    }
}
