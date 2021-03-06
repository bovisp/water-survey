<?php

namespace App\Http\Controllers\Users\Api;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\Users\UserResource;

class UsersController extends Controller
{
    public function __construct ()
    {
        $this->middleware(['auth']);

        $this->middleware(['role:administrator'])->except(['show']);
    }

    public function index()
    {
        return User::whereActive(1)->get();
    }

    public function inactiveIndex()
    {
        return User::whereActive(0)->get();
    }

    public function show(User $user)
    {
        return new UserResource(User::find($user->id));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'data' => [
                'type' => 'success',
                'message' => 'User successfully deleted'
            ]
        ], 200);
    }
}
