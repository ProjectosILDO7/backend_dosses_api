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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categoria_id');
            $table->string('nome_produto');
            $table->string('image_produto');
            $table->string('descricao')->nullable();
            $table->string('preco');
            $table->string('receita')->nullable();
            $table->timestamps();
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->dropForeign('produtos_categoria_id_foreign');
            $table->dropColumn('categoria_id');
        });
        Schema::dropIfExists('produtos');
    }
};
