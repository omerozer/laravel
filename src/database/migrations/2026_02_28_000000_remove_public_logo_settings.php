<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('settings')->whereIn('key', [
            'public_logo',
            'public_logo_width',
            'public_logo_height',
        ])->delete();

        Cache::forget('settings');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Geri alınamaz; eski değerler bilinmiyor.
    }
};
