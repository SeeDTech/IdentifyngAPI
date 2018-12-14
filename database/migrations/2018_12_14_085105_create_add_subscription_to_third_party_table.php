<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddSubscriptionToThirdPartyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('third_parties', function (Blueprint $table) {
            //
            // Add 
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
        Schema::table('third_parties', function (Blueprint $table) {
            //
            $table->dropForeign('third_parties_subscription_id_foreign');
            $table->dropIndex('third_parties_subscription_id_index');
            $table->dropColumn('subscription_id');
        });
    }
}
