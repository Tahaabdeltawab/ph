<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Api\APIBaseController;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterController extends APIBaseController
{
    use RegistersUsers;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * The user has been registered.
     */
    protected function registered(Request $request, User $user)
    {
        if ($user instanceof MustVerifyEmail) {
            return response()->json(['status' => trans('verification.sent')]);
        }
                
        // $token = JWTAuth::fromUser($user);
        $token = (string) $this->guard()->getToken();
        $expiration = $this->guard()->getPayload()->get('exp');
        return $this->sendResponse([
            'user' => new UserResource($user),
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $expiration - time(),
            ] , "user data");
    }

    /**
     * Get a validator for an incoming registration request.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:255',
            'email' => 'required|email:filter|max:255|unique:users',
            'phone' => 'required|max:255|unique:users',
            'university_id' => 'required|integer|exists:universities,id',
            'faculty_id' => 'required|integer|exists:faculties,id',
            'year_id' => 'required|integer|exists:years,id',
            'password' => 'required|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     */
    protected function create(array $data): User
    {
        try{
            DB::beginTransaction();
            $user = User::create([
                'username' => $data['username'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'university_id' => $data['university_id'],
                'faculty_id' => $data['faculty_id'],
                'year_id' => $data['year_id'],
                'status' => true,
                'password' => bcrypt($data['password']),
            ]);
            
            $user_role = Role::where('name', 'user')->first();
            if($user_role)
            $user->attachRole($user_role);

            DB::commit();
            return $user;
        }catch(\Throwable $th){
            DB::rollBack();
            return $this->sendError($th->getMessage(), 500);
        }
    }
}
