<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeguimientoMateriales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguimiento_materiales', function (Blueprint $table) {

            $table->id();
            $table->bigInteger('id_usuario');
            $table->bigInteger('id_material');
            $table->bigInteger('id_solicitud')->nullable();
            $table->bigInteger('id_categoria')->nullable();
            $table->string('descripcion_seguimiento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seguimiento_materiales');
    }
}
