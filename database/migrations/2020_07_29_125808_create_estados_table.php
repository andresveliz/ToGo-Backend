<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('estado', ['PENDIENTE', 'ACEPTADO', 'EN RUTA', 'ENTREGADO'])->default('PENDIENTE');
            $table->unsignedBigInteger('pedido_id')->index();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('estados', function ($table) {
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
        Schema::dropIfExists('estados');
    }
}
