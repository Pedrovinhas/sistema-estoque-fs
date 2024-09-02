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
        Schema::create('estabelecimento', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100)->nullable(false);
            $table->string('descricao', 255);
            $table->string('cep', 8);
            $table->foreignId('categoria_estabelecimento_id')->constrained('categoria_estabelecimento');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estabelecimento');
    }
};
