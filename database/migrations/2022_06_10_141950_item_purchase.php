<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ItemPurchase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_purchase', function (Blueprint $table) {
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')
                    ->references('id')
                    ->on('items')
                    ->onDelete('cascade');
            $table->unsignedBigInteger('purchase_id');
            $table->foreign('purchase_id')
                    ->references('id')
                    ->on('purchases')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
