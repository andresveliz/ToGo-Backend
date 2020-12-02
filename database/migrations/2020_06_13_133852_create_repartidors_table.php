<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepartidorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repartidores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('estado')->default(false);
            $table->string('ruat')->nullable();
            $table->string('nit')->nullable();
            $table->point('ubicacion')->nullable();
            $table->unsignedBigInteger('user_id')->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('repartidores', function ($table) {
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('repartidores');
    }
}
