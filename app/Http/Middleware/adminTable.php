<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class adminTable
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle(Request $request, Closure $next)
    {
        // if (!auth()->check()) {
        //     return response()->json(['message' => 'Authentification requise'], 401);
        // }

        // // Vérifier si l'utilisateur existe bien dans la table `admin`
        // $isAdmin = DB::table('admins')->where('password', auth()->user()->password)->exists();

        // if (!$isAdmin) {
        //     return response()->json(['message' => 'Accès refusé'], 403);
        // }

        // return $next($request);
    }
}
