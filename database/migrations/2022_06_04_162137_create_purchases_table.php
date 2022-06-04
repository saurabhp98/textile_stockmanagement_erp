<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->unique('invoice');// should be unique
            $table->date('invoice_date');
            $table->string('challan_no');
            $table->date('challan_date');

            //one to many relation with 
            //clients table
            $table->unsignedBigInteger('clients_id');
            $table->foreign('clients_id')
                    ->references('id')
                    ->on('clients')
                    ->onDelete('cascade');

            //one to many relation 
            //items table
            $table->unsignedBigInteger('items_id');
            $table->foreign('items_id')
                    ->references('id')
                    ->on('items')
                    ->onDelete('cascade');

            // one to many table 
            // transport table
            $table->unsignedBigInteger('transports_id');
            $table->foreign('transports_id')
                    ->references('id')
                    ->on('transports')
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
        Schema::dropIfExists('purchases');
    }
}
