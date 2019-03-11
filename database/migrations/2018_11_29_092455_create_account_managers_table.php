<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_managers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('surname');
            $table->string('othername');
            $table->string('phone_number');
            $table->string('email_address');
            $table->string('dob');
            $table->string('account_number')->nullable();
            $table->string('password');
            $table->string('account_pin')->nullable();
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
        Schema::dropIfExists('account_managers');
    }
}
