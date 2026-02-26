<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Varsayılan yönetici kullanıcısı: .env'deki ADMIN_EMAIL / ADMIN_PASSWORD
     * (yoksa omerozer88@gmail.com / 19231923). Deploy sonrası migrate ile otomatik oluşur.
     */
    public function up(): void
    {
        $email = env('ADMIN_EMAIL', 'omerozer88@gmail.com');
        $password = env('ADMIN_PASSWORD', '19231923');

        $exists = DB::table('users')->where('email', $email)->exists();
        if ($exists) {
            DB::table('users')->where('email', $email)->update([
                'password' => Hash::make($password),
                'updated_at' => now(),
            ]);
            return;
        }

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => $email,
            'password' => Hash::make($password),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $email = env('ADMIN_EMAIL', 'omerozer88@gmail.com');
        DB::table('users')->where('email', $email)->delete();
    }
};
