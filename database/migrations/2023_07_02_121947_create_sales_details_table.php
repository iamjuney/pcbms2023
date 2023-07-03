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
        Schema::create('sales_details', function (Blueprint $table) {
            $table->id('item_no');
            $table->unsignedBigInteger('sale_id');
            $table->foreign('sale_id')->references('sale_id')->on('sales')->onDelete('no action');
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('item_id')->on('consigned_details')->onDelete('no action');
            $table->integer('qty_sold');
            $table->decimal('amount_sold', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_details');
    }
};
