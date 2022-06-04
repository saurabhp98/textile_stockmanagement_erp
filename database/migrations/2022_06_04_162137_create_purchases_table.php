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
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')
                    ->references('id')
                    ->on('client')
                    ->onDelete('cascade');

            //one to many relation 
            //items table
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')
                    ->references('id')
                    ->on('item')
                    ->onDelete('cascade');

            // one to many table 
            // transport table
            $table->unsignedBigInteger('transport_id');
            $table->foreign('transport_id')
                    ->references('id')
                    ->on('transport')
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
