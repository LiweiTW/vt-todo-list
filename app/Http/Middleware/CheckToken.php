<?php

namespace App\Http\Middleware;

use App\Services\TokenService;
use Closure;
use Illuminate\Support\Arr;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    private $tokenService;

    public function __construct(TokenService $tokenService)
    {
        $this->tokenService = $tokenService;
    }


    public function handle($request, Closure $next)
    {
        $token = $request->header("todo-token");
        $tokenStatus = $this->tokenService->verifyToken($token);
        $isValid = Arr::get($tokenStatus, 'isValid', false);
        $userId = Arr::get($tokenStatus, 'userId', "");
//        $expiredAt = Arr::get($tokenStatus, 'isValid', "");

        if ($isValid) {
            $request->request->add(['userId' => $userId]);
            return $next($request);

        }

//        if ($request->token <= 200) {
//            return redirect('home');
//        }
        return response()->json(['error' => 'Not authorized.'],403);
    }
}
