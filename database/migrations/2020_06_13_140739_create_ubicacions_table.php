<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUbicacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ubicaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cliente_id')->index();
            $table->text('direccion');
            $table->point('ubicacion');
            $table->text('referencia');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('ubicaciones', function ($table) {
            $table->foreign('cliente_id')->references('id')->on('clientes')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ubicaciones');
    }
}
