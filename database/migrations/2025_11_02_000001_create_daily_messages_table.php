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
        Schema::create('daily_messages', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Título da mensagem');
            $table->text('message')->comment('Conteúdo da mensagem');
            $table->string('author')->nullable()->comment('Autor da mensagem');
            $table->boolean('active')->default(true)->comment('Se a mensagem está ativa');
            $table->date('valid_from')->nullable()->comment('Data de início da validade');
            $table->date('valid_until')->nullable()->comment('Data de fim da validade');
            $table->text('notes')->nullable()->comment('Observações internas');
            $table->timestamps();

            $table->index(['active', 'valid_from', 'valid_until']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_messages');
    }
};
