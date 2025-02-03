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
        Schema::create('government_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('go_type_id')->constrained('government_order_types');
            $table->string('go_number');
            $table->date('go_date');
            $table->string('go_title');
            $table->string('go_keywords');
            $table->string('path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('government_orders');
    }
};
