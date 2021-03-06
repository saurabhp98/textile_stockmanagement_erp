<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('inv_no')->unique();
            $table->date('inv_date');
            $table->string('challan_no')->unique();
            $table->date('challan_date');
            $table->string('lr_no');

            //one to many relation with 
            //clients table
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')
                    ->references('id')
                    ->on('clients')
                    ->onDelete('cascade');

            

            // one to many table 
            // transport table
            $table->unsignedBigInteger('transport_id');
            $table->foreign('transport_id')
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
        Schema::dropIfExists('sales');
    }
}
