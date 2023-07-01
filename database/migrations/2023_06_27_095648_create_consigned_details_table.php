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
        Schema::create('consigned_details', function (Blueprint $table) {
            $table->id('item_id');
            $table->unsignedBigInteger('cp_id');
            $table->foreign('cp_id')->references('cp_id')->on('consigned_products')->onDelete('cascade');
            $table->unsignedBigInteger('prod_id');
            $table->foreign('prod_id')->references('prod_id')->on('products')->onDelete('cascade');
            $table->string('barcode', 12);
            $table->string('particulars', 100);
            $table->date('expiry_date');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('selling_price', 10, 2);
            $table->mediumInteger('quantity');
            $table->decimal('amount', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consigned_details');
    }
};
