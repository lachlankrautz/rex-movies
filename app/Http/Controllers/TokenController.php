<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class TokenController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        if (empty($email) || empty($password)) {
            return response('Bad Request', 400);
        } else if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = Auth::user();
            return Response::json([
                'user' => $user->name,
                'api_token' => $user->api_token
            ]);
        } else {
            return response('Unauthorized', 401);
        }
    }

}
