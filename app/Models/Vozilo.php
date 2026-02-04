<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vozilo extends Model
{
     protected $table = 'vozilo';

    protected $fillable = [
        'naziv','tip','motor','registracija','istek_registracije','namjenaid'
    ];

    protected $casts = [
        'istek_registracije' => 'date',
    ];

    public function namjena()
    {
        return $this->belongsTo(NamjenaVozila::class,'namjenaid');
    }
}
