<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('arquivos_casa', function (Blueprint $table) {
            $table->id(); $table->string('titulo',160); $table->string('categoria',100);
            $table->text('descricao')->nullable(); $table->string('arquivo_path');
            $table->string('arquivo_nome_original'); $table->string('arquivo_mime',150);
            $table->unsignedBigInteger('arquivo_tamanho'); $table->string('capa_path')->nullable();
            $table->string('capa_mime',100)->nullable();
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->timestamps(); $table->index(['categoria','created_at']);
        });
    }
    public function down(): void { Schema::dropIfExists('arquivos_casa'); }
};
