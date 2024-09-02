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
    Schema::create('produto', function (Blueprint $table) {
      $table->id();
      $table->string('nome', 100)->nullable(false);
      $table->decimal('valor', 7, 2)->nullable(false);
      $table->foreignId('categoria_produto_id')->constrained('categoria_produto');
      $table->foreignId('estabelecimento_id')->constrained('estabelecimento');
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('produto');
  }
};
