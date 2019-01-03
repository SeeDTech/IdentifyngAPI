<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddUserToIdholderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('idholders', function (Blueprint $table) {
            //
            $table->integer('user_id')->unsigned();

            // 
            $table->index('user_id');
            
            // Create relations with questions
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::table('idholders', function (Blueprint $table) {
            //
            $table->dropForeign('idholders_user_id_foreign');
            $table->dropIndex('idholders_user_id_index');
            $table->dropColumn('user_id');
        });
    }
}
