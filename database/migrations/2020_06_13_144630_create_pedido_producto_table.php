<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_producto', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('producto_id')->index();
            $table->unsignedBigInteger('pedido_id')->index();
            $table->integer('cantidad')->unsigned();
            $table->double('sub_total')->defautl(0);
            $table->timestamps();
        });

        Schema::table('pedido_producto', function ($table) {
            $table->foreign('producto_id')->references('id')->on('productos')->onUpdate('CASCADE')->onDelete('CASCADE');
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
        Schema::drop('pedido_producto');
    }
}
