<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('disciplinas', function (Blueprint $table) {
            $table->id('id');
            $table->string('nome');
            $table->string('sigla');
            $table->integer('carga_horaria');
            $table->bigInteger('pre_requisito_id')->unsigned()->nullable();
            $table->bigInteger('curso_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('pre_requisito_id')->references('id')->on('disciplinas')->onDelete('cascade');
            $table->foreign('curso_id')->references('id')->on('cursos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disciplinas');
    }
};
