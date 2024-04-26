<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
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
}
