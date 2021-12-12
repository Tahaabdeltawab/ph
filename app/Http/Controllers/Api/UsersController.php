<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUsersRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;

class UsersController extends APIBaseController
{
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('admin');
    }

    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return $this->sendResponse( UserResource::collection($users));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $relations = [
            'roles' => Role::get()->pluck('title', 'id')->prepend('Please select', ''),
        ];

        return view('users.create', $relations);
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpdateUsersRequest $request)
    {
        $user = User::create($request->validated());

        return $this->sendResponse( new UserResource( $user ), 'created successfully' );
        
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $relations = [
            'roles' => Role::get()->pluck('title', 'id')->prepend('Please select', ''),
        ];

        $user = User::findOrFail($id);

        return view('users.edit', compact('user') + $relations);
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsersRequest $request, $id)
    {
        $user = User::findOrFail($id);

          $to_save = [
          'username' => $request->username,
          'email' => $request->email,
          'phone' => $request->phone,
          'university_id' => $request->university_id,
          'faculty_id' => $request->faculty_id,
          'year_id' => $request->year_id,
          'role' => $request->role,
          'status' => $request->status,
          ];

          if($request->password && ! empty($request->password))
          $to_save['password'] = $request->password;


        $user->update($to_save);
        return $this->sendResponse( new UserResource( User::find($id) ), 'updated successfully' );
    }
    public function updateProfile(UpdateProfileRequest $request)
    {
          $to_save = [
          'username' => $request->username,
          'email' => $request->email,
          'phone' => $request->phone,
          'university_id' => $request->university_id,
          'faculty_id' => $request->faculty_id,
          'year_id' => $request->year_id,
          ];

        auth()->user()->update($to_save);
        return $this->sendResponse( new UserResource( auth()->user() ), 'Updated successfully' );
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $old_password_required = auth()->user()->password ? 'required' : 'nullable';
        if($old_password_required == 'required'){
            if(! password_verify($request->old_password, auth()->user()->password))
                return $this->sendError('Incorrect old password');

            if(password_verify($request->new_password, auth()->user()->password))
                return $this->sendError('The new password is identical to the old password');
        }
        auth()->user()->password = bcrypt($request->new_password);
        auth()->user()->save();

        return $this->sendSuccess(__('Password updated successfully'));
    }


    /**
     * Display User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $relations = [
            'roles' => Role::get()->pluck('title', 'id')->prepend('Please select', ''),
        ];

        $user = User::findOrFail($id);

        return view('users.show', compact('user') + $relations);
    }


    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return $this->sendSuccess( 'User deleted successfully' );
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = User::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        return $this->sendSuccess( 'Users deleted successfully' );

        }
    }

}
