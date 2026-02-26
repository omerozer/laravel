<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kisiler', function (Blueprint $table) {
            $table->id();
            $table->string('ad');
            $table->string('soyad');
            $table->unsignedInteger('yas');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kisiler');
    }
};
