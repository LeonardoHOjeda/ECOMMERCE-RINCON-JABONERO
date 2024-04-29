<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ForgotPasswordController extends Controller
{
    public function forgot ()
    {
      $credentials = request()->validate([
        'email' => 'required|email'
      ]);

      $status = Password::sendResetLink($credentials);

      $messages = [
        Password::RESET_LINK_SENT => 'Correo de recuperación enviado. Por favor revise su bandeja de entrada o spam',
        Password::RESET_THROTTLED => 'Ya has solicitado un correo de recuperación. Por favor espera antes de intentar de nuevo',
        Password::INVALID_USER => 'No se ha encontrado un usuario con ese correo'
      ];

      $message = $messages[$status];

      if ($status !== Password::RESET_LINK_SENT) throw new BadRequestHttpException($message);

      return response()->json(['message' => $message]);
    }

    public function reset ()
    {
      $credentials = request()->validate([
        'email' => 'required|email|exists:users,email',
        'token' => 'required|string',
        'password' => 'required|string|confirmed'
      ]);

      $reset_password_status = Password::reset($credentials, function ($user, $password) {
        $user->password = Hash::make($password);
        $user->save();
      });

      $messages = [
        Password::PASSWORD_RESET => 'Contraseña cambiada correctamente',
        Password::INVALID_TOKEN => 'El token proporcionado es invalido',
        Password::INVALID_USER => 'No se ha encontrado un usuario con ese correo'
      ];

      $message = $messages[$reset_password_status];

      if ($reset_password_status !== Password::PASSWORD_RESET) throw new BadRequestHttpException($message);

      return response()->json(['message' => $message]);
    }
}
