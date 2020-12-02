<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriaRestauranteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoria_restaurante', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('categoria_id')->index();
            $table->unsignedBigInteger('restaurante_id')->index();
            $table->timestamps();
        });

        Schema::table('categoria_restaurante', function ($table) {
            $table->foreign('categoria_id')->references('id')->on('categorias')->onUpdate('CASCADE')->onDelete('CASCADE');
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
        Schema::dropIfExists('categoria_restaurante');
    }
}
