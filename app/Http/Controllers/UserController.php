<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Notifications\EmailVerificationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', User::class);

        $users = User::all();

        return $users;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $body = $request->validate([
          'name' => 'required',
          'lastname' => 'required',
          'email' => 'required',
          'password' => 'required',
          'cellphone' => 'max:15'
        ]);

        try {
          $user = User::create($body);

          $user->notify(new EmailVerificationNotification());

          return response()->json($user, 201);
        } catch (\Throwable $th) {
          throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $body = $request->validate([
          'name' => 'nullable|string',
          'lastname' => 'nullable|string',
          'email' => "nullable|unique:users,email,$user->id",
          'password' => 'nullable|confirmed',
          'cellphone' => 'nullable|max:15',
          'role_id' => 'nullable|numeric'
        ]);

        if (isset($body['password'])) {
          $body['password'] = Hash::make($body['password']);
        }

        if(isset($body['role_id'])) {
          $currentUser = User::find(Auth::id());

          if ($currentUser->hasRole(Role::ADMIN))
            $user->role_id = $body['role_id'];
          else
            unset($body['role_id']);
        }

        $user->load('role');
        $user->update($body);

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
