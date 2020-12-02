<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurantes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 150);
            $table->string('direccion', 150);
            $table->string('telefono', 150);
            $table->string('email', 150)->unique();
            $table->string('logo', 150);
            $table->text('descripcion');
            $table->point('ubicacion');
            $table->boolean('estado')->default(false);
            $table->string('tiempo_entrega')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('restaurantes');
    }
}
