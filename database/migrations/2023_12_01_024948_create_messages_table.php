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
        Schema::create('messages', function (Blueprint $table) {
            $table->id('id');
			$table->unsignedBigInteger('from')->nullable();
			$table->unsignedBigInteger('to')->nullable();
			$table->text('content')->nullable();
			$table->boolean('read')->default(false)->nullable();
            $table->timestamps();

			$table->foreign('from')->references('id')->on('users')->cascadeOnDelete();
			$table->foreign('to')->references('id')->on('users')->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
