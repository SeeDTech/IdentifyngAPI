<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fname');
            $table->string('lname');
            $table->string('mname');
            $table->string('sname');
            $table->string('gender');
            $table->string('dob');
            $table->string('state');
            $table->string('lga');
            $table->string('bvn')->unique();
            $table->string('phone')->unique();
            $table->string('role')->unique();
            $table->string('qrcode')->unique();
            $table->string('address');
            $table->string('email')->unique();
            $table->char('user_token', 60)->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
