<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use JWTAuth;
use App\User;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
	public function userAuth(Request $request) {
		$credentials = $request->only('email', 'password');
		error_log(json_encode($credentials));

		$token = null;
		try {
			if (! $token = JWTAuth::attempt($credentials)) {
				return response()->json(['error' => 'invalid_credentials'],401);
			}
		} catch (JWTException $e) {
			return response()->json(['error' => 'somthing_went_wrong'], 500);
		}
		$users = User::where('email', '=', $request->email, 'AND', 'password', '=', $request->password)->first();
		//Se consulta si la cuenta se encuentra confirmada (activada con el email)
		if ($users->confirmed == 1) {
			return response()->json(['token' => $token, 'id_user' => $users->id],200);
		} else {
			return response()->json(['error' => 'Esta cuenta no ha sido activada'], 405);
		}
	}
}
