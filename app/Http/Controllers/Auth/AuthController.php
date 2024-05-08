<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;


class AuthController extends Controller
{
  use HasApiTokens;

  public function register(Request $request)
  {
    $body = $request->validate([
      'name' => 'required|string',
      'lastname' => 'required|string',
      'email' => 'required|email|unique:users,email',
      'password' => 'required',
      'role_id' => 'integer',
    ]);

    $user = User::create($body);

    event(new Registered($user));

    $token = $user->createToken('authToken')->plainTextToken;

    $response = [
      'user' => $user,
      'token' => $token
    ];

    return response()->json($response, 201);
  }

  public function login(Request $request)
  {
    $body = $request->validate([
      'email' => 'required|email',
      'password' => 'required|string'
    ]);

    if (!Auth::attempt($body)) {
      return response()->json([
        'message' => 'Credenciales incorrectas'
      ], 401);
    }

    // Error si el correo no ha sido verificado
    if (!Auth::user()->hasVerifiedEmail()) {
      return response()->json([
        'message' => 'Correo no verificado'
      ], 401);
    }

    $user = Auth::user();

    $token = $user->createToken('authToken')->plainTextToken;

    $response = [
      'user' => $user,
      'token' => $token
    ];

    return $response;
  }

  public function logout(Request $request)
  {
    $request->user()->currentAccessToken()->delete();

    return response()->noContent();
  }

  
}
