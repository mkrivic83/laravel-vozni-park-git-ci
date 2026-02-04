<?php

namespace App\Http\Controllers;

use App\Models\Vozilo;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class VoziloQueryDemoController extends Controller
{
    public function allWithNamjena(): JsonResponse
    {
        $vozila = Vozilo::with('namjena')->get();

        return response()->json($vozila);
    }

    public function orderByNaziv(): JsonResponse
    {
        $vozila = Vozilo::with('namjena')
            ->orderBy('naziv')
            ->get();

        return response()->json($vozila);
    }

    public function onlyDiesel(): JsonResponse
    {
        $vozila = Vozilo::with('namjena')
            ->where('motor', 'dizel')
            ->get();

        return response()->json($vozila);
    }

    public function searchNaziv(): JsonResponse
    {
        $vozila = Vozilo::with('namjena')
            ->where('naziv', 'like', '%B%')
            ->get();

        return response()->json($vozila);
    }

    public function onlyOsobna(): JsonResponse
    {
        $vozila = Vozilo::with('namjena')
            ->whereHas('namjena', function ($q) {
                $q->where('naziv', 'Osobno');
            })
            ->get();

        return response()->json($vozila);
    }

    public function countByNamjena(): JsonResponse
    {
        $data = Vozilo::selectRaw('namjenaid, COUNT(*) as ukupno')
            ->with('namjena')
            ->groupBy('namjenaid')
            ->get();

        return response()->json($data);
    }

    public function joinExample(): JsonResponse
    {
        $data = Vozilo::join('namjena_vozila', 'vozilo.namjenaid', '=', 'namjena_vozila.id')
            ->select(
                'vozilo.id',
                'vozilo.naziv as vnaziv',
                'vozilo.motor',
                'namjena_vozila.naziv as namjena'
            )
            ->orderBy('vozilo.id')
            ->get();

        return response()->json($data);
    }

    public function joinExampleRegistracija(): JsonResponse
    {
        $data = Vozilo::join('namjena_vozila', 'vozilo.namjenaid', '=', 'namjena_vozila.id')
            ->select(
                'vozilo.id',
                'vozilo.naziv',
                'vozilo.motor',
                'vozilo.registracija',
                'vozilo.istek_registracije',
                'namjena_vozila.naziv as namjena'
            )
            ->selectRaw('YEAR(vozilo.istek_registracije) as godina')
            ->orderBy('vozilo.id')
            ->where('vozilo.naziv', 'like', '%B%')
            ->get();

        return response()->json($data);
    }

    public function dieselStartingWithB(): JsonResponse
    {
        $vozila = Vozilo::with('namjena')
            ->where('naziv', 'like', 'B%')
            ->where('motor', 'dizel')        
            ->get();

        return response()->json($vozila);
    }





}
