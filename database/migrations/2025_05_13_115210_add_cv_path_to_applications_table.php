<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCvPathToApplicationsTable extends Migration
{
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            // CV dosyasını saklayacak sütun
            $table->string('cv_path')->nullable(); // Eğer varsa null kabul et
        });
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            // Eğer migration geri alınırsa, cv_path sütununu sil
            $table->dropColumn('cv_path');
});
    }}