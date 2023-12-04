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
        Schema::create('turmas', function (Blueprint $table) {
            $table->id('id');
            $table->string('nome');
            $table->string('semestre');
            $table->enum('turno', ['Manhã', 'Tarde', 'Noite']);
            $table->string('horario');
            $table->bigInteger('disciplina_id')->unsigned();
			$table->bigInteger('professor_id')->unsigned();
            $table->timestamps();

			$table->foreign('disciplina_id')->references('id')->on('disciplinas')->onDelete('cascade');
			$table->foreign('professor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turmas');
    }
};
