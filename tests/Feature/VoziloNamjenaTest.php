<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Vozilo;
use App\Models\NamjenaVozila;
use PHPUnit\Framework\Attributes\Test;

class VoziloNamjenaTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    #[Test]
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    #[Test]
    public function vozilo_pripada_namjeni(): void
    {
        $namjena = NamjenaVozila::create([
            'naziv'=>'Osobno',
        ]);

        $vozilo = Vozilo::create([
            'naziv'=>'BMW',
            'tip'=>'320D',
            'motor'=>'dizel',
            'registracija'=>'ZG1234AA',
            'istek_registracije'=>now()->addYear(),
            'namjenaid' => $namjena->id,
        ]);

        $vozilo = Vozilo::with('namjena')->first();

        $this->assertNotNull($vozilo->namjena);
        $this->assertEquals('Putničko',$vozilo->namjena->naziv);
    }


    #[Test]
    public function nije_dozvoljeno_kreirati_vozilo_bez_naziva(): void
    {
        $namjena = NamjenaVozila::create([
            'naziv'=>'Osobno',
        ]);

        $response = $this->post('/vozila',[
            'tip'=>'320D',
            'motor'=>'dizel',
            'registracija'=>'ZG1234AA',
            'istek_registracije'=>now()->addYear(),
            'namjenaid' => $namjena->id,
        ]);

        $response->assertSessionHasErrors('naziv');
    }


    #[Test]
    public function middleware_blokira_prikaz_vozila_istekla_registracija(): void
    {
        $namjena = NamjenaVozila::create([
            'naziv'=>'Osobno',
        ]);

        $vozilo = Vozilo::create([
            'naziv'=>'BMW',
            'tip'=>'320D',
            'motor'=>'dizel',
            'registracija'=>'ZG1234AA',
            'istek_registracije'=>now()->subDays(10),
            'namjenaid' => $namjena->id,
        ]);

        $response = $this->get(route('vozila.index'));

        $response->assertStatus(403);
        $response->assertSee('Postoji vozilo s isteklom registracijom');
    }
//samo koment
    #[Test]
    public function jedna_namjena_ima_vise_vozila(): void
    {
        $namjena = NamjenaVozila::create([
            'naziv'=>'Teretno',
        ]);

        Vozilo::create([
            'naziv'=>'MAN',
            'tip'=>'TGS',
            'motor'=>'dizel',
            'registracija'=>'ST1111AA',
            'istek_registracije'=>now()->addYear(),
            'namjenaid' => $namjena->id,
        ]);

        Vozilo::create([
            'naziv'=>'Mercedes',
            'tip'=>'Actros',
            'motor'=>'dizel',
            'registracija'=>'ST2222BB',
            'istek_registracije'=>now()->addYear(),
            'namjenaid' => $namjena->id,
        ]);

        $vozila = Vozilo::where('namjenaid',$namjena->id)
            ->orderBy('naziv')
            ->get();

        $this->assertCount(2,$vozila);
        $this->assertEquals(
            ['MAN','Mercedes'],
            $vozila->pluck('naziv')->toArray()
        );
    }

}
