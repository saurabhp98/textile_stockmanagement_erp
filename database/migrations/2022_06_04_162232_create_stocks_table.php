<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('roll_no')->unique();
            $table->string('grade');
            $table->double('meter');
            $table->double('width');
            $table->double('weight');

            // one to many relation with purchases table
            $table->unsignedBigInteger('purchases_id');
            $table->foreign('purchases_id')
                    ->references('id')
                    ->on('purchases')
                    ->onDelete('cascade');

            // one to many relation with client_id on purchases
            $table->unsignedBigInteger('purchase_client_id');
            $table->foreign('purchase_client_id')
                    ->references('client_id')
                    ->on('purchases')
                    ->onDelete('cascade');

            // one to many relation with item_id on purchases
            $table->unsignedBigInteger('purchase_item_id');
                    $table->foreign('purchase_item_id')
                            ->references('item_id')
                            ->on('purchases')
                            ->onDelete('cascade');
                            
            // one to many relation with transport_id on purchase
            $table->unsignedBigInteger('purchase_transport_id');
            $table->foreign('purchase_transport_id')
                    ->references('transport_id')
                    ->on('purchases')
                    ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
