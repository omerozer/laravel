<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->boolean('redirect_to_home')->default(false)->after('view_count');
        });

        // Mevcut tüm postları anasayfaya yönlendir (sadece şu anki var olanlar)
        DB::table('blog_posts')->update(['redirect_to_home' => true]);
    }

    public function down(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropColumn('redirect_to_home');
        });
    }
};
