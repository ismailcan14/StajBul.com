<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // DİKKAT: DB kullanıyorsan bunu ekle!

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('value')->nullable();
            $table->integer('session_timeout')->default(30);
            $table->timestamps();
        });

        // Varsayılan satırları ekle
        DB::table('settings')->insert([
            [
                'key' => 'session_timeout',
                'value' => '120',
                'session_timeout' => 120, // istersen!
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Başka ayarlar da ekleyebilirsin...
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
