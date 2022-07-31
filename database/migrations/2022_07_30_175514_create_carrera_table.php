<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarreraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrera', function (Blueprint $table) {
            $table->string('CarreraId');
            $table->string("Clave");
            $table->string("Nombre");
            $table->string("Abreviatura");
            $table->string("DivisionId");
            $table->string("is_activa");
            $table->string("precio");
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
        Schema::dropIfExists('carrera');
    }
}
