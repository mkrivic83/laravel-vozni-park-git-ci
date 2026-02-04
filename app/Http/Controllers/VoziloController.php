<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vozilo;
use App\Models\NamjenaVozila;

class VoziloController extends Controller
{
    public function index()
    {
        //$vozila = Vozilo::with('namjena')->orderBy('id')->get();
        $vozila = Vozilo::with('namjena')->orderBy('id')->paginate(5);
        return view('vozila.index', compact('vozila'));
    }

    public function create()
    {
        $namjene = NamjenaVozila::orderBy('naziv')->get();
        return view('vozila.create', compact('namjene'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'naziv' => ['required','string','max:100'],
            'tip' => ['required','string','max:50'],
            'motor' => ['required','string','max:50'],
            'registracija' => ['required','string','max:20'],
            'istek_registracije' => ['required','date'],
            'namjenaid' => ['required','exists:namjena_vozila,id'],
        ]);

        Vozilo::create($validated);

        return redirect()->route('vozila.index')->with('status', 'Vozilo dodano.');
    }

    public function edit(Vozilo $vozilo)
    {
        $namjene = NamjenaVozila::orderBy('naziv')->get();
        return view('vozila.edit', compact('vozilo','namjene'));
    }

    public function update(Request $request, Vozilo $vozilo)
    {
        $validated = $request->validate([
            'naziv' => ['required','string','max:100'],
            'tip' => ['required','string','max:50'],
            'motor' => ['required','string','max:50'],
            'registracija' => ['required','string','max:20'],
            'istek_registracije' => ['required','date'],
            'namjenaid' => ['required','exists:namjena_vozila,id'],
        ]);

        $vozilo->update($validated);

        return redirect()->route('vozila.index')->with('status', 'Vozilo ažurirano.');
    }

    public function destroy(Vozilo $vozilo)
    {
        $vozilo->delete();
        return redirect()->route('vozila.index')->with('status', 'Vozilo obrisano.');
    }

    //namjene
    public function namjene()
    {
        //$vozila = Vozilo::with('namjena')->orderBy('id')->get();
        $namjene = NamjenaVozila::orderBy('id')->get();

        return view('namjene.index', [
            'namjene' => $namjene,
        ]);
    }
}
