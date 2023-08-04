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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produto_id');
            $table->unsignedBigInteger('cliente_id');
            $table->string('status');
            $table->timestamps();
            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade');
            $table->foreign('cliente_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->dropForeign('pedidos_produto_id_foreign');
            $table->dropForeign('pedidos_cliente_id_foreign');
            $table->dropColumn('produto_id');
            $table->dropColumn('cliente_id');
        });
        Schema::dropIfExists('pedidos');
    }
};
