<?php

namespace App\Http\Controllers;

use App\Services\TokenService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokenController extends Controller
{

    private $tokenService;

    public function __construct(TokenService $tokenService)
    {
        $this->tokenService = $tokenService;
    }

    public function getToken (Request $request) {
        $email = $request->get("email");
        $password = $request->get("password");
        $userdata = array(
            "email"     => $email,
            "password"  => $password,
        );

        $isValidUser = Auth::attempt($userdata);

        if ($isValidUser) {
            $token = $this->tokenService->generate(Auth::id($userdata));
            return response()->json([
                "token" => $token,
            ]);
        } else {
            return response()->json(['error' => 'Not authorized.'],403);
        }
    }

    public function verifyToken ($token) {
        $result = $this->tokenService->verifyToken($token);
        if ($result['isValid']) {
            return response()->json($result);
        } else {
            return response()->json(['error' => 'Not authorized.'],403);
        }


    }

}
