<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('ekskul_siswa', function (Blueprint $table) {
            $table->text('alasan')->nullable()->after('no_wa');
        });
    }

    public function down()
    {
        Schema::table('ekskul_siswa', function (Blueprint $table) {
            $table->dropColumn('alasan');
        });
    }
};
