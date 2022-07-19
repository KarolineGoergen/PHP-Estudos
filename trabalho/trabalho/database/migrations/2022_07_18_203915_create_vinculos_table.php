<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vinculos', function (Blueprint $table) {
            $table->unsignedBigInteger('id_disciplina');
            $table->foreign('id_disciplina')->references('id')->on('disciplinas');
            $table->unsignedBigInteger('id_professor');
            $table->foreign('id_professor')->references('id')->on('professors');
            $table->primary('id_disciplina');
            $table->softDeletes();
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
        Schema::dropIfExists('vinculos');
    }
};
