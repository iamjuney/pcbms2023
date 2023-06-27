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
        Schema::create('products', function (Blueprint $table) {
            $table->id('prod_id');
            $table->string('prod_name', 50);
            $table->integer('shelf_life')->unsigned();
            $table->enum('unit', ['piece', 'pack', 'bottle', 'bag'])->default('piece');
            $table->decimal('appreciation', 7, 2);
            $table->integer('max_lvl')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
