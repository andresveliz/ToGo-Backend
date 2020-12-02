<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('restaurante_id')->index();
            $table->unsignedBigInteger('tipo_id')->index();
            $table->string('nombre', 150);
            $table->string('imagen', 150);
            $table->text('descripcion');
            $table->double('precio', 8, 4);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('productos', function ($table) {
            $table->foreign('tipo_id')->references('id')->on('tipos')->onUpdate('CASCADE')->onDelete('CASCADE');
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
        Schema::drop('productos');
    }
}
