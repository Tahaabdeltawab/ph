<?php

namespace App\Http\Controllers\Api;

use App\Models\UserAction;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserActionsRequest;
use App\Http\Requests\UpdateUserActionsRequest;

class UserActionsController extends APIBaseController
{
    public function __construct()
    {
        //$this->middleware('admin');
    }

    /**
     * Display a listing of UserAction.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_actions = UserAction::all();

        return view('user_actions.index', compact('user_actions'));
    }
}
