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
        Schema::table('periodicals', function (Blueprint $table) {

            $table->string('name_eng');
            $table->string('name_mal');
            $table->date('date')->nullable();
            $table->string('path');
            $table->string('img');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('periodicals', function (Blueprint $table) {
            $table->dropColumn(['name_eng', 'name_mal', 'date']);
            $table->string('name');
        });
    }
};
