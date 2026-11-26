<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CheckRole
{
	public function handle(Request $request, Closure $next, ...$roles)
	{
		if (Auth::check() && in_array(Auth::user()->role, $roles)) {
			return $next($request);
		}
		return redirect()->route('campaigns.index')->with('error', 'Anda tidak memiliki hak akses untuk fitur tersebut.');
	}
}