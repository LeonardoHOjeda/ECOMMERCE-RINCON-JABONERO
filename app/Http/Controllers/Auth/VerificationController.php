<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class VerificationController extends Controller
{
    public function verify(Request $request, $id)
    {
      if (!$request->hasValidSignature()) {
        throw new UnauthorizedHttpException('La URL proporcionada es invalida o ha expirado');
      }

      $user = User::findOrFail($id);

      if (!$user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
      }

      return 'Email verificado correctamente. Puede cerrar esta ventana';
    }

    public function resend()
    {
      if (auth()->user()->hasVerifiedEmail()) {
        throw new BadRequestHttpException('El correo ya ha sido verificado');
      }

      auth()->user()->sendEmailVerificationNotication();

      return response()->json([
        'message' => 'Correo de verificación reenviado. Por favor revise su bandeja de entrada o spam'
      ]);
    }
}
