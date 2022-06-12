<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseGrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_grs', function (Blueprint $table) {
            $table->id();
            $table->string('purchasegr_no')->unique();
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
            
            $table->unsignedBigInteger('purchaseinv_id');
            $table->foreign('purchaseinv_id')
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
        Schema::dropIfExists('purchase_grs');
    }
}
