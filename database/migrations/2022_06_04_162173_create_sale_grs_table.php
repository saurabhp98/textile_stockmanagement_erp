<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleGrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_grs', function (Blueprint $table) {
            $table->id();
            $table->string('salegr_no')->unique();
            $table->date('date');
            $table->string('challan_no')->unique();
            $table->date('challan_date');
            $table->string('lr_no');
            $table->timestamps();

            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')
                    ->references('id')
                    ->on('clients')
                    ->onDelete('cascade');
            
            $table->unsignedBigInteger('sale_id');
            $table->foreign('sale_id')
                    ->references('id')
                    ->on('sales')
                    ->onDelete('cascade');

            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_grs');
    }
}
