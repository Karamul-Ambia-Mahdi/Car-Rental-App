<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->cookie('token');

        $result = JWTToken::VerifyToken($token);

        if ($result !== 'unauthorized') {

            $user = User::where('email', $result->userEmail)->first();
            
            if($user->isAdmin()){
                return $next($request);
            }
            else {
                abort(403, 'You do not have permission to access this page');
            }
        }

        return  response()->json([
            'message' => 'Unauthorized'
        ], 401);
    }
}
