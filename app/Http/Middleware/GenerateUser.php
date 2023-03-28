<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;

class GenerateUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       $user = User::factory()->count(1)->create();
    //    \Log::info($user);
       $request['added_by_user_id'] = $user[0]->id;

        return $next($request);
    }
}
