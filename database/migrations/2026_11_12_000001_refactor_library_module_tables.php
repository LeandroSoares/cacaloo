<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('library_tags')) {
            Schema::create('library_tags', function (Blueprint $table) {
                $table->id();
                $table->string('name', 100);
                $table->string('slug', 120)->unique();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('library_files')) {
            Schema::create('library_files', function (Blueprint $table) {
                $table->id();
                $table->string('title', 160);
                $table->text('description')->nullable();
                $table->string('file_path');
                $table->string('original_name');
                $table->string('mime_type', 150);
                $table->unsignedBigInteger('file_size');
                $table->string('cover_path')->nullable();
                $table->string('cover_mime', 100)->nullable();
                $table->string('visibility', 20)->default('private');
                $table->boolean('is_active')->default(true);
                $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
                $table->timestamps();

                $table->index(['is_active', 'created_at']);
            });
        }

        if (! Schema::hasTable('library_file_tag')) {
            Schema::create('library_file_tag', function (Blueprint $table) {
                $table->id();
                $table->foreignId('library_file_id')->constrained('library_files')->cascadeOnDelete();
                $table->foreignId('library_tag_id')->constrained('library_tags')->cascadeOnDelete();
                $table->unique(['library_file_id', 'library_tag_id']);
            });
        }

        // Non-destructively copy any existing records from legacy arquivos_casa table (without dropping it)
        if (Schema::hasTable('arquivos_casa') && DB::table('library_files')->count() === 0) {
            try {
                $legacyFiles = DB::table('arquivos_casa')->orderBy('id')->get();

                foreach ($legacyFiles as $legacy) {
                    $fileId = DB::table('library_files')->insertGetId([
                        'title' => $legacy->titulo,
                        'description' => $legacy->descricao,
                        'file_path' => $legacy->arquivo_path,
                        'original_name' => $legacy->arquivo_nome_original,
                        'mime_type' => $legacy->arquivo_mime,
                        'file_size' => $legacy->arquivo_tamanho,
                        'cover_path' => $legacy->capa_path,
                        'cover_mime' => $legacy->capa_mime,
                        'visibility' => 'private',
                        'is_active' => true,
                        'uploaded_by' => $legacy->user_id,
                        'created_at' => $legacy->created_at ?? now(),
                        'updated_at' => $legacy->updated_at ?? now(),
                    ]);

                    $categoryName = trim((string) ($legacy->categoria ?? ''));
                    if ($categoryName !== '') {
                        $slug = Str::slug($categoryName) ?: Str::lower($categoryName);
                        $existingTag = DB::table('library_tags')->where('slug', $slug)->first();

                        $tagId = $existingTag
                            ? $existingTag->id
                            : DB::table('library_tags')->insertGetId([
                                'name' => $categoryName,
                                'slug' => $slug,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);

                        DB::table('library_file_tag')->insertOrIgnore([
                            'library_file_id' => $fileId,
                            'library_tag_id' => $tagId,
                        ]);
                    }
                }
            } catch (Throwable) {
                // Ignore legacy copy errors to never block production migrations
            }
        }

        // Seed default tags if table is empty
        if (DB::table('library_tags')->count() === 0) {
            $defaultTags = ['Orientações', 'Estudos', 'Apostilas', 'Documentos', 'Imagens', 'Rituais e Trabalhos'];
            foreach ($defaultTags as $tagName) {
                DB::table('library_tags')->insertOrIgnore([
                    'name' => $tagName,
                    'slug' => Str::slug($tagName),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Ensure library.manage permission exists and is assigned to admin and sysadmin
        if (Schema::hasTable('permissions') && Schema::hasTable('roles')) {
            try {
                app()[PermissionRegistrar::class]->forgetCachedPermissions();

                $permission = Permission::firstOrCreate(['name' => 'library.manage', 'guard_name' => 'web']);

                foreach (['sysadmin', 'admin'] as $roleName) {
                    $role = Role::where('name', $roleName)->where('guard_name', 'web')->first();
                    if ($role && ! $role->hasPermissionTo($permission)) {
                        $role->givePermissionTo($permission);
                    }
                }

                app()[PermissionRegistrar::class]->forgetCachedPermissions();
            } catch (Throwable) {
                // Ignore permission sync errors during migration; Gate::after fallback handles admin/sysadmin
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('library_file_tag');
        Schema::dropIfExists('library_files');
        Schema::dropIfExists('library_tags');
    }
};
