<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddSubscriptionToIdproviderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('idproviders', function (Blueprint $table) {
            //
            $table->integer('subscription_id')->unsigned();

            // 
            $table->index('subscription_id');
            
            // Create relations with questions
            $table
                ->foreign('subscription_id')
                ->references('id')
                ->on('subscriptions')
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
        Schema::table('idproviders', function (Blueprint $table) {
            //
            $table->dropColumn('subscription_id');
        });
    }
}