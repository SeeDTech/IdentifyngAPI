<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdholderIdproviderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('idholder_idprovider', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idprovider_id')->unsigned();
            $table->integer('idholder_id')->unsigned();

            $table->foreign('idprovider_id')->references('id')
            ->on('idproviders')->onDelete('cascade');

            $table->foreign('idholder_id')->references('id')
            ->on('idholders')->onDelete('cascade');   

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('idholder_idprovider');
    }
}
