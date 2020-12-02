<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ubicacion_id')->index();
            $table->unsignedBigInteger('cliente_id')->index();
            $table->unsignedBigInteger('restaurante_id')->index();
            $table->date('fecha');
            $table->double('total', 8, 2);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('pedidos', function ($table) {
            $table->foreign('ubicacion_id')->references('id')->on('ubicaciones')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onUpdate('CASCADE')->onDelete('CASCADE');
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
        Schema::drop('pedidos');
    }
}
