<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('apellidos');
            $table->string('telefono');
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedBigInteger('restaurante_id')->index()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('users', function ($table) {
            $table->foreign('restaurante_id')->references('id')->on('restaurantes')->onUpdate('CASCADE')->onDelete('CASCADE');
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
