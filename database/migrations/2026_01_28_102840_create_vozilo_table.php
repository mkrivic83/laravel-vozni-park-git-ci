<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vozilo', function (Blueprint $table) {
            $table->id();
            $table->string('naziv', 100);
            $table->string('tip', 50);
            $table->string('motor', 50);
            $table->string('registracija', 20);
            $table->date('istek_registracije');
            $table->foreignId('namjenaid')->constrained('namjena_vozila');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vozilo');
    }
};
