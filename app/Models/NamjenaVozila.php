<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NamjenaVozila extends Model
{
      protected $table = 'namjena_vozila';

     protected $fillable = ['naziv'];


    public function vozila()
    {
        return $this->hasMany(Vozilo::class);
    }


}

