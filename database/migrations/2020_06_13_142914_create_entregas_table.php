<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntregasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entregas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('repartidor_id')->index();
            $table->unsignedBigInteger('pedido_id')->index();
            $table->text('observaciones')->nullable();
            $table->enum('estado', ['ENTREGADO', 'PENDIENTE'])->default('PENDIENTE');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('entregas', function ($table) {
            $table->foreign('repartidor_id')->references('id')->on('repartidores')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('pedido_id')->references('id')->on('pedidos')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('entregas');
    }
}
