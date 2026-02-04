<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoziloController;
use App\Http\Controllers\VoziloQueryDemoController;

// Route::get('/', fn() => redirect()->route('vozila.index'));

// Route::get('/vozila', [VoziloController::class, 'index'])
//     ->middleware('blokiraj.istek')
//     ->name('vozila.index');

// Route::get('/vozila/create', [VoziloController::class, 'create'])->name('vozila.create');
// Route::post('/vozila', [VoziloController::class, 'store'])->name('vozila.store');

// Route::get('/vozila/{vozilo}/edit', [VoziloController::class, 'edit'])->name('vozila.edit');
// Route::put('/vozila/{vozilo}', [VoziloController::class, 'update'])->name('vozila.update');

// Route::delete('/vozila/{vozilo}', [VoziloController::class, 'destroy'])->name('vozila.destroy');

// Route::get('/namjene', [VoziloController::class, 'namjene'])->name('namjene.index');

Route::get('/', function () {
    return view('vozila/pocetna');
});

//grupiranje
Route::prefix('vozila')
    ->name('vozila.')
    ->controller(VoziloController::class)
    ->group(function () {

        // Ispis (blokiran ako postoji istekla registracija)
        Route::get('/', 'index')
            ->middleware('blokiraj.istek')
            ->name('index');

        // Create
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');

        // Edit / Update
        Route::get('/{vozilo}/edit', 'edit')->name('edit');
        Route::put('/{vozilo}', 'update')->name('update');

        // Delete
        Route::delete('/{vozilo}', 'destroy')->name('destroy');
    });

/*
|--------------------------------------------------------------------------
| Namjene vozila
|--------------------------------------------------------------------------
*/
Route::get('/namjene', [VoziloController::class, 'namjene'])
    ->name('namjene.index');

/*
rute za eager loading
*/

// Route::get('/demo/vozila/all', [VoziloQueryDemoController::class, 'allWithNamjena']);
// Route::get('/demo/vozila/order-by-naziv', [VoziloQueryDemoController::class, 'orderByNaziv']);
// Route::get('/demo/vozila/diesel', [VoziloQueryDemoController::class, 'onlyDiesel']);
// Route::get('/demo/vozila/search', [VoziloQueryDemoController::class, 'searchNaziv']);
// Route::get('/demo/vozila/osobna', [VoziloQueryDemoController::class, 'onlyOsobna']);
// Route::get('/demo/vozila/group-namjena', [VoziloQueryDemoController::class, 'countByNamjena']);
// Route::get('/demo/vozila/join', [VoziloQueryDemoController::class, 'joinExample']);
// Route::get('/demo/vozila/joinRegistracija', [VoziloQueryDemoController::class, 'joinExampleRegistracija']);
// Route::get(
//     '/demo/vozila/b-dizel',
//     [VoziloQueryDemoController::class, 'dieselStartingWithB']
// );

/*
rute za eager loading grupirane
*/
Route::prefix('demo/vozila')
    ->controller(VoziloQueryDemoController::class)
    ->group(function () {
        // Ispis (blokiran ako postoji istekla registracija)
        Route::get('/all', 'allWithNamjena');
        Route::get('/order-by-naziv', 'orderByNaziv');
        Route::get('/diesel', 'onlyDiesel');
        Route::get('/search', 'searchNaziv');
        Route::get('/osobna', 'onlyOsobna');
        Route::get('/group-namjena', 'countByNamjena');
        Route::get('/join', 'joinExample');
        Route::get('/joinRegistracija', 'joinExampleRegistracija');
        Route::get('/joinRegistracija', 'joinExampleRegistracija');
        Route::get('/b-dizel', 'dieselStartingWithB');

    });
