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
        Schema::create('consigned_products', function (Blueprint $table) {
            $table->id('cp_id');
            $table->foreignId('supp_id')->constrained('suppliers')->onDelete('no action');
            $table->foreignId('userid')->constrained('users')->onDelete('no action');
            $table->date('date_received');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consigned_products');
    }
};
