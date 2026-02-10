<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('work_guide_user_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')
                ->constrained('work_guide_categories')
                ->onDelete('cascade');
            $table->string('value')->nullable();
            $table->timestamps();

            // Unique constraint: um usuário pode ter apenas um valor por categoria
            $table->unique(['user_id', 'category_id']);

            // Indexes para performance
            $table->index('user_id');
            $table->index('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_guide_user_values');
    }
};
