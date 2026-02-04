<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Vozilo;

class BlokirajIstekRegistracije
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $postojiIsteklo = Vozilo::whereDate('istek_registracije', '<', now()->toDateString())->exists();

        if ($postojiIsteklo) {
            return response('Postoji vozilo s isteklom registracijom – lista je blokirana.', 403);
        }
        return $next($request);
    }
}
